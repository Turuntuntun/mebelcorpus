<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (isset($templateData['TEMPLATE_THEME'])) {
    $this->addExternalCss($templateData['TEMPLATE_THEME']);
}

$retail_price_type = $GLOBALS['UF_USER_REGION']['PROPS']['RETAIL_PRICE_TYPE_CODE']['VALUE'];
$opt_price_type = $GLOBALS['UF_USER_REGION']['PROPS']['OPT_PRICE_TYPE_CODE']['VALUE'];
$user_groups = \Bitrix\Main\Engine\CurrentUser::get()->getUserGroups();

$is_opt_user = false;
if ( in_array('10', $user_groups) ) {
    $is_opt_user = true;
}

$dbPriceType = CCatalogGroup::GetList();
$price_types_map = [];

while ($arPriceType = $dbPriceType->Fetch()) {
    array_push($price_types_map, $arPriceType['NAME']);
}


if ( $is_opt_user ) {
    if ( isset($arResult['PRICES'][$opt_price_type]) ) {
        $active_price = $opt_price_type;
    } elseif (isset($arResult['PRICES']['Opt'])) {
        $active_price = 'Opt';
    } else {
        $active_price = 'BASE';
    }
} else {
    if ( isset($arResult['PRICES'][$retail_price_type]) ) {
        $active_price = $retail_price_type;
    } else {
        $active_price = 'BASE';
    }
}

$unsetable_filter_prices = [];
foreach ($price_types_map as $price_type) {
    if ($price_type != $active_price) {
        array_push($unsetable_filter_prices, $price_type);
    }
}


foreach ($unsetable_filter_prices as $unsetable_filter_price) {
    unset($arResult["ITEMS"][$unsetable_filter_price]);
}


?>
<div class="catalog-section__full-filter full-filter modal" id ="full-filter" data-popup>
    <button class="full-filter__btn button-close" data-close="">
        <svg width="24" height="24">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#close"></use>
        </svg>
    </button>
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="full-filter__form">
            <div class="full-filter__title">Все фильтры</div>
                <?foreach ($arResult["HIDDEN"] as $arItem):?>
                    <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
                <?endforeach;?>
				<?foreach ($arResult["ITEMS"] as $key=>$arItem) {//prices
    $key = $arItem["ENCODED_ID"];
    if (isset($arItem["PRICE"])):
                        if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) {
                            continue;
                        }

    $step_num = 4;
    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
    $prices = array();
    if (Bitrix\Main\Loader::includeModule("currency")) {
        for ($i = 0; $i < $step_num; $i++) {
            $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
        }
        $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
    } else {
        $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
        for ($i = 0; $i < $step_num; $i++) {
            $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
        }
        $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
    } ?>
						<div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-lg-12<?endif?> bx-filter-parameters-box bx-active">
                            <span hidden class="bx-filter-container-modef"></span>
                            <legend class="full-filter__caption">Цена</legend>
							<div>
								<?php $arName = str_replace('_MIN', '', $arItem["VALUES"]["MIN"]["CONTROL_NAME"]) ?>
								<?php $valMin = $arItem["VALUES"]["MIN"]["HTML_VALUE"] ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ?>
								<?php $valMax = $arItem["VALUES"]["MAX"]["HTML_VALUE"] ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"] ?>

								<input
									class="js-range-slider"
									type="text"
									name="<?echo $arName?>"
									value="<?echo $valMin ?>;<?echo $valMax ?>"
									data-type="double"
									data-min="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
									data-max="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>"
									data-from="<?echo $valMin ?>"
									data-to="<?echo $valMax ?>"
									data-grid="true"
								/>
								<input
									type="text"
									class="full-filter__hidden-input"
									name="<?php echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
									id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
									value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
									onkeyup="smartFilter.keyup(this)"
								/>
								<input
									type="text"
									class="full-filter__hidden-input"
									name="<?php echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
									id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
									value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
									onkeyup="smartFilter.keyup(this)"
								/>
							</div>
						</div>
						<div class="full-filter__divider"></div>
						<?php
                        $arJsParams = array(
                            "leftSlider" => 'left_slider_'.$key,
                            "rightSlider" => 'right_slider_'.$key,
                            "tracker" => "drag_tracker_".$key,
                            "trackerWrap" => "drag_track_".$key,
                            "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                            "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                            "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                            "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                            "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                            "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                            "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                            "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                            "precision" => $precision,
                            "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                            "colorAvailableActive" => 'colorAvailableActive_'.$key,
                            "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
                        ); ?>
						<script type="text/javascript">
							BX.ready(function(){
								window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
							});
						</script>
					<?endif;
}				
                //not prices
                foreach ($arResult["ITEMS"] as $key=>$arItem) {
                    if (
                        empty($arItem["VALUES"])
                        || isset($arItem["PRICE"])
                    ) {
                        continue;
                    }

                    if (
                        $arItem["DISPLAY_TYPE"] == "A"
                        && (
                            $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                        )
                    ) {
                        continue;
                    } ?>
					<div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-lg-12<?endif?> bx-filter-parameters-box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>bx-active<?endif?>">
						<span hidden class="bx-filter-container-modef"></span>
						<fieldset class="full-filter__group full-filter__group--col" data-role="bx_filter_block">
                            <legend class="full-filter__caption"><?=$arItem['NAME']?></legend>
							<?php
                            $arCur = current($arItem["VALUES"]);
                    switch ($arItem["DISPLAY_TYPE"]) {
                                case "A"://NUMBERS_WITH_SLIDER
                                    ?>
									<div>
										<?php $arName = str_replace('_MIN', '', $arItem["VALUES"]["MIN"]["CONTROL_NAME"]) ?>
										<?php $valMin = $arItem["VALUES"]["MIN"]["HTML_VALUE"] ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ?>
										<?php $valMax = $arItem["VALUES"]["MAX"]["HTML_VALUE"] ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"] ?>

										<input
											class="js-range-slider"
											type="text"
											name="<?echo $arName?>"
											value="<?echo $valMin ?>;<?echo $valMax ?>"
											data-type="double"
											data-min="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
											data-max="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>"
											data-from="<?echo $valMin ?>"
											data-to="<?echo $valMax ?>"
											data-grid="true"
										/>
										<input
											type="text"
											class="full-filter__hidden-input"
											name="<?php echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
											onkeyup="smartFilter.keyup(this)"
										/>
										<input
											type="text"
											class="full-filter__hidden-input"
											name="<?php echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
											id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>
									<!--
                                    <div class="full-filter__wrap">
                                        <label class="full-filter__range">
                                            <span><?=GetMessage("CT_BCSF_FILTER_FROM")?></span>

                                            <input
                                                    class="min-price"
                                                    type="text"
                                                    name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                                    id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                                    value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                                    placeholder="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
                                            />
                                        </label>

                                        <label class="full-filter__range">
                                            <span><?=GetMessage("CT_BCSF_FILTER_TO")?></span>

                                            <input
                                                    class="max-price"
                                                    type="text"
                                                    name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                                    id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                                    value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                                    placeholder="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>"

                                            />
                                        </label>
                                    </div>
									-->
									<?php
                                    break;
                                case "B"://NUMBERS
                                    ?>
									<div class="full-filter__wrap">
                                        <label class="full-filter__range">
										<span><?=GetMessage("CT_BCSF_FILTER_FROM")?></span>

											<input
												class="min-price"
												type="text"
												name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
                                                placeholder="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
                                            />
                                        </label>

										<label class="full-filter__range">
											<span><?=GetMessage("CT_BCSF_FILTER_TO")?></span>

											<input
												class="max-price"
												type="text"
												name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
												placeholder="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>"

											/>
										</label>
                                    </div>
									<?php
                                    break;
                                case "G"://CHECKBOXES_WITH_PICTURES
                                    ?>
									<div class="col-xs-12">
										<div class="bx-filter-param-btn-inline">
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<input
												style="display: none"
												type="checkbox"
												name="<?=$ar["CONTROL_NAME"]?>"
												id="<?=$ar["CONTROL_ID"]?>"
												value="<?=$ar["HTML_VALUE"]?>"
												<?php echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											/>
											<?php
                                            $class = "";
                                            if ($ar["CHECKED"]) {
                                                $class.= " bx-active";
                                            }
                                            if ($ar["DISABLED"]) {
                                                $class.= " disabled";
                                            }
                                            ?>
											<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
												<span class="bx-filter-param-btn bx-color-sl">
													<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
													<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
													<?endif?>
												</span>
											</label>
										<?endforeach?>
										</div>
									</div>
									<?php
                                    break;
                                    // no break
                                case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                                    ?>
									<div class="col-xs-12">
										<div class="bx-filter-param-btn-block">
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<input
												style="display: none"
												type="checkbox"
												name="<?=$ar["CONTROL_NAME"]?>"
												id="<?=$ar["CONTROL_ID"]?>"
												value="<?=$ar["HTML_VALUE"]?>"
												<?php echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											/>
											<?php
                                            $class = "";
                                            if ($ar["CHECKED"]) {
                                                $class.= " bx-active";
                                            }
                                            if ($ar["DISABLED"]) {
                                                $class.= " disabled";
                                            }
                                            ?>
											<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
												<span class="bx-filter-param-btn bx-color-sl">
													<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
														<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
													<?endif?>
												</span>
												<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?php
                                                if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                    ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><?php echo $ar["ELEMENT_COUNT"]; ?></span>)<?php
                                                endif;?></span>
											</label>
										<?endforeach?>
										</div>
									</div>
									<?php
                                    break;
                                case "P"://DROPDOWN
                                    $checkedItemExist = false;
                                    ?>
									<div class="col-xs-12">
										<div class="bx-filter-select-container">
											<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
												<div class="bx-filter-select-text" data-role="currentOption">
													<?php
                                                    foreach ($arItem["VALUES"] as $val => $ar) {
                                                        if ($ar["CHECKED"]) {
                                                            echo $ar["VALUE"];
                                                            $checkedItemExist = true;
                                                        }
                                                    }
                                                    if (!$checkedItemExist) {
                                                        echo GetMessage("CT_BCSF_FILTER_ALL");
                                                    }
                                                    ?>
												</div>
												<div class="bx-filter-select-arrow"></div>
												<input
													style="display: none"
													type="radio"
													name="<?=$arCur["CONTROL_NAME_ALT"]?>"
													id="<?php echo "all_".$arCur["CONTROL_ID"] ?>"
													value=""
												/>
												<?foreach ($arItem["VALUES"] as $val => $ar):?>
													<input
														style="display: none"
														type="radio"
														name="<?=$ar["CONTROL_NAME_ALT"]?>"
														id="<?=$ar["CONTROL_ID"]?>"
														value="<?php echo $ar["HTML_VALUE_ALT"] ?>"
														<?php echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
												<?endforeach?>
												<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none;">
													<ul>
														<li>
															<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																<?php echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
															</label>
														</li>
													<?php
                                                    foreach ($arItem["VALUES"] as $val => $ar):
                                                        $class = "";
                                                        if ($ar["CHECKED"]) {
                                                            $class.= " selected";
                                                        }
                                                        if ($ar["DISABLED"]) {
                                                            $class.= " disabled";
                                                        }
                                                    ?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
														</li>
													<?endforeach?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<?php
                                    break;
                                case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
                                    ?>
									<div class="col-xs-12">
										<div class="bx-filter-select-container">
											<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
												<div class="bx-filter-select-text fix" data-role="currentOption">
													<?php
                                                    $checkedItemExist = false;
                                                    foreach ($arItem["VALUES"] as $val => $ar):
                                                        if ($ar["CHECKED"]) {
                                                            ?>
															<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
															<?endif?>
															<span class="bx-filter-param-text">
																<?=$ar["VALUE"]?>
															</span>
														<?php
                                                            $checkedItemExist = true;
                                                        }
                                                    endforeach;
                                                    if (!$checkedItemExist) {
                                                        ?><span class="bx-filter-btn-color-icon all"></span> <?php
                                                        echo GetMessage("CT_BCSF_FILTER_ALL");
                                                    }
                                                    ?>
												</div>
												<div class="bx-filter-select-arrow"></div>
												<input
													style="display: none"
													type="radio"
													name="<?=$arCur["CONTROL_NAME_ALT"]?>"
													id="<?php echo "all_".$arCur["CONTROL_ID"] ?>"
													value=""
												/>
												<?foreach ($arItem["VALUES"] as $val => $ar):?>
													<input
														style="display: none"
														type="radio"
														name="<?=$ar["CONTROL_NAME_ALT"]?>"
														id="<?=$ar["CONTROL_ID"]?>"
														value="<?=$ar["HTML_VALUE_ALT"]?>"
														<?php echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
												<?endforeach?>
												<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none">
													<ul>
														<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
															<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																<span class="bx-filter-btn-color-icon all"></span>
																<?php echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
															</label>
														</li>
													<?php
                                                    foreach ($arItem["VALUES"] as $val => $ar):
                                                        $class = "";
                                                        if ($ar["CHECKED"]) {
                                                            $class.= " selected";
                                                        }
                                                        if ($ar["DISABLED"]) {
                                                            $class.= " disabled";
                                                        }
                                                    ?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
																<span class="bx-filter-param-text">
																	<?=$ar["VALUE"]?>
																</span>
															</label>
														</li>
													<?endforeach?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<?php
                                    break;
                                case "K"://RADIO_BUTTONS
                                    ?>
									<div class="col-xs-12">
										<div class="radio">
											<label class="bx-filter-param-label" for="<?php echo "all_".$arCur["CONTROL_ID"] ?>">
												<span class="bx-filter-input-checkbox">
													<input
														type="radio"
														value=""
														name="<?php echo $arCur["CONTROL_NAME_ALT"] ?>"
														id="<?php echo "all_".$arCur["CONTROL_ID"] ?>"
														onclick="smartFilter.click(this)"
													/>
													<span class="bx-filter-param-text"><?php echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
												</span>
											</label>
										</div>
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<div class="radio">
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label" for="<?php echo $ar["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox <?php echo $ar["DISABLED"] ? 'disabled': '' ?>">
														<input
															type="radio"
															value="<?php echo $ar["HTML_VALUE_ALT"] ?>"
															name="<?php echo $ar["CONTROL_NAME_ALT"] ?>"
															id="<?php echo $ar["CONTROL_ID"] ?>"
															<?php echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															onclick="smartFilter.click(this)"
														/>
														<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?php
                                                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                            ?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><?php echo $ar["ELEMENT_COUNT"]; ?></span>)<?php
                                                        endif;?></span>
													</span>
												</label>
											</div>
										<?endforeach;?>
									</div>
									<?php
                                    break;
                                case "U"://CALENDAR
                                    ?>
									<div class="col-xs-12">
										<div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
											<?$APPLICATION->IncludeComponent(
                                        'bitrix:main.calendar',
                                        '',
                                        array(
                                                    'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                                    'SHOW_INPUT' => 'Y',
                                                    'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                    'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                                                    'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                                    'SHOW_TIME' => 'N',
                                                    'HIDE_TIMEBAR' => 'Y',
                                                ),
                                        null,
                                        array('HIDE_ICONS' => 'Y')
                                    );?>
										</div></div>
										<div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
											<?$APPLICATION->IncludeComponent(
                                        'bitrix:main.calendar',
                                        '',
                                        array(
                                                    'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                                    'SHOW_INPUT' => 'Y',
                                                    'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                    'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                                                    'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                                    'SHOW_TIME' => 'N',
                                                    'HIDE_TIMEBAR' => 'Y',
                                                ),
                                        null,
                                        array('HIDE_ICONS' => 'Y')
                                    );?>
										</div></div>
									</div>
									<?php
                                    break;
                                default://CHECKBOXES
                                    ?>

										<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="full-filter__label checkbox">
													<span class="bx-filter-input-checkbox">
														<input
															type="checkbox"
															value="<?php echo $ar["HTML_VALUE"] ?>"
															name="<?php echo $ar["CONTROL_NAME"] ?>"
															id="<?php echo $ar["CONTROL_ID"] ?>"
															<?php echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															onclick="smartFilter.click(this)"
                                                            class="checkbox__input visually-hidden"
														/>
														<span class="checkbox__caption" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?></span>
												</label>
										<?endforeach;?>

							<?php
                            } ?>
						</fieldset>
					</div>
					<div class="full-filter__divider"></div>
				<?php
                }
                ?>
			    <!--//row-->

				<div class="full-filter__buttons">
					<button class="full-filter__reset-btn button" type="submit" id="set_filter" name="set_filter"><?=GetMessage("CT_BCSF_SET_FILTER")?></button>
					<button class="full-filter__reset-btn button button--ghost" type="submit" type="submit" id="del_filter" name="del_filter"><?=GetMessage("CT_BCSF_DEL_FILTER")?></button>
				</div>

							<input
								class="full-filter__reset-btn"
								type="submit"
								id="set_filter"
								name="set_filter"
								value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
								style="display: none"
							/>
							<input
								class="full-filter__reset-btn"
								type="submit"
								id="del_filter"
								name="del_filter"
								value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
								style="display: none"
							/>
							<div class="bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") {
                    echo $arParams["POPUP_POSITION"];
                }?>" id="modef" <?if (!isset($arResult["ELEMENT_COUNT"])) {
                    echo 'style="display:none"';
                }?> style="display: inline-block;">
								<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
								<span class="arrow"></span>
								<br/>
								<a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
							</div>

		</form>

</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
