<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

// echo "<pre>";
// var_dump($GLOBALS['UF_USER_REGION']['PROPS']['REGION_SCHEDULE']);

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}


$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => array(
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS' => $arResult['JS_OFFERS']
    )
);
unset($currencyList, $templateLibrary);


$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DESCRIPTION_ID' => $mainId . '_description',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
    $actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
        ? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
        : reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
    $skuDescription = false;
    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
            $skuDescription = true;
            break;
        }
    }
    $showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
    $showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}



$stores_ids_array = $GLOBALS['UF_USER_REGION']["PROPS"]["STORES_REF"]["VALUE"];

?>
<section class="catalog-item mb-90" id="<?= $itemIds['ID'] ?>" itemscope itemtype="http://schema.org/Product">
    <div class="container">
        <div class="catalog-item__wrap mb-90">
            <div class="catalog-item__slider">
                <?php 
                $add_proto = false;
                if ( !empty($arResult['DETAIL_PICTURE']['SRC']) ) {
                    $add_proto = $arResult['DETAIL_PICTURE']['SRC'];
                } elseif (!empty($arResult['PREVIEW_PICTURE']['SRC'])) {
                    $add_proto = $arResult['PREVIEW_PICTURE']['SRC'];
                }
                // $add_proto = (!empty($arResult['DETAIL_PICTURE']['SRC'])) ? $arResult['DETAIL_PICTURE']['SRC'] : (!empty($arResult['PREVIEW_PICTURE']['SRC'])) ? $arResult['PREVIEW_PICTURE']['SRC'] : false;
                ?>
                <!-- ЧАСТЬ ДЛЯ ИЗЪЯТИЯ ФОТОГРАФИЙ ИЗ ЭЛЕМНТА УДАЛИТЬ, ЕСЛИ БУДЕТ ИСПОЛЬЗОВАН ДРУГОЙ ВАРИАНТ -->
                <div class="swiper-container swiper-with-thumbs">
                        <div class="swiper-wrapper">
                            <?php if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) : ?>
                                <?php foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $photo) : ?>
                                    <div class="swiper-slide">
                                        <div class="catalog-item__slide">
                                            <img src="<?= CFIle::getPath($photo) ?>" alt="">
                                            <button class="catalog-item__zoom-btn zoom-btn spotlight" data-src="<?= CFIle::getPath($photo) ?>">
                                                <svg width="30" height="30">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/images/sprite.svg#bi_zoom-in"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <? endif; ?>
                            <? if ($add_proto) : ?>
                                <div class="swiper-slide">
                                    <div class="catalog-item__slide">
                                        <img src="<?= $add_proto ?>" alt="">
                                        <button class="catalog-item__zoom-btn zoom-btn spotlight" data-src="<?= $add_proto ?>">
                                            <svg width="30" height="30">
                                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/images/sprite.svg#bi_zoom-in"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <!-- ЧАСТЬ ДЛЯ ИЗЪЯТИЯ ФОТОГРАФИЙ ИЗ ЭЛЕМНТА УДАЛИТЬ, ЕСЛИ БУДЕТ ИСПОЛЬЗОВАН ДРУГОЙ ВАРИАНТ -->

                    <?php if (isset($arResult["OFFERS"]) && $arResult["OFFERS"]) : ?>
                        <div class="possible_options" style="display: none;">
                            <?php $first_offer_count = 0; ?>
                            <?php foreach ($arResult["OFFERS"] as $key => $offer) : ?>
                                <?php 
                                    $offer_store_count = 0;
                                    foreach($stores_ids_array as $store_id) {
                                        $arFilter = Array("PRODUCT_ID"=>$offer['ID'],"STORE_ID"=>$store_id);
                                        $res = CCatalogStoreProduct::GetList(Array(),$arFilter,false,false,Array());
                                        if ( $count =  $res->getNext() ) {
                                            $offer_store_count += $count["AMOUNT"];
                                        }
                                    }

                                    if ($key === 0) $first_offer_count = $offer_store_count;
                                ?>
                                <div class="item" data-color-xmlid="<?= $offer["PROPERTIES"]["COLOR"]["VALUE"]?>" data-offer-count="<?= $offer_store_count ?>">
                                    <?php if (!empty($offer['PROPERTIES']['MORE_PHOTO']['VALUE'])) : ?>
                                        <?php foreach ($offer['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $image): ?>
                                            <img src="<?= CFIle::getPath($image) ?>" alt="">
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- ЧАСТЬ ДЛЯ ИЗЪЯТИЯ ФОТОГРАФИЙ ИЗ ТП С ФОТО -->
                <!-- <?php if (isset($arResult["OFFERS"]) && $arResult["OFFERS"]) : ?>
                    <div class="possible_options" style="display: none;">
                        <?php foreach ($arResult["OFFERS"] as $key => $offer) : ?>
                            <?php 
                                // $offer_store_count = 0;
                                // $first_offer_count = 0;
                                foreach($stores_ids_array as $store_id) {
                                    $arFilter = Array("PRODUCT_ID"=>$offer['ID'],"STORE_ID"=>$store_id);
                                    $res = CCatalogStoreProduct::GetList(Array(),$arFilter,false,false,Array());
                                    if ( $count =  $res->getNext() ) {
                                        $offer_store_count += $count["AMOUNT"];
                                    }
                                }

                                // if ($key === 0) $first_offer_count = $offer_store_count;
                            ?>
                            <div class="item" data-color-xmlid="<?= $offer["PROPERTIES"]["COLOR"]["VALUE"]?>" data-offer-count="<?= $offer_store_count ?>">
                                <?php if (!empty($offer['PROPERTIES']['MORE_PHOTO']['VALUE'])) : ?>
                                    <?php foreach ($offer['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $image): ?>
                                        <img src="<?= CFIle::getPath($image) ?>" alt="">
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-container swiper-with-thumbs">
                        <div class="swiper-wrapper">
                            <?php if (!empty($arResult["OFFERS"][0]['PROPERTIES']['MORE_PHOTO']['VALUE'])) : ?>
                                <?php foreach ($arResult["OFFERS"][0]['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $photo) : ?>
                                    <div class="swiper-slide">
                                        <div class="catalog-item__slide">
                                            <img src="<?= CFIle::getPath($photo) ?>" alt="">
                                            <button class="catalog-item__zoom-btn zoom-btn spotlight" data-src="<?= CFIle::getPath($photo) ?>">
                                                <svg width="30" height="30">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/images/sprite.svg#bi_zoom-in"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else :?>
                    <div class="swiper-container swiper-with-thumbs">
                        <div class="swiper-wrapper">
                            <?php if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) : ?>
                                <?php foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $photo) : ?>
                                    <div class="swiper-slide">
                                        <div class="catalog-item__slide">
                                            <img src="<?= CFIle::getPath($photo) ?>" alt="">
                                            <button class="catalog-item__zoom-btn zoom-btn spotlight" data-src="<?= CFIle::getPath($photo) ?>">
                                                <svg width="30" height="30">
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/images/sprite.svg#bi_zoom-in"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif ?>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                <?php endif; ?> -->
                <!-- ЧАСТЬ ДЛЯ ИЗЪЯТИЯ ФОТОГРАФИЙ ИЗ ТП С ФОТО -->

                <!-- ЧАСТЬ ДЛЯ ИЗЪЯТИЯ ФОТОГРАФИЙ ИЗ ЭЛЕМНТА УДАЛИТЬ, ЕСЛИ БУДЕТ ИСПОЛЬЗОВАН ДРУГОЙ ВАРИАНТ -->
                <div class="swiper-container swiper-thumbs" thumbsSlider="">
                    <div class="swiper-wrapper">
                        <?php if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) : ?>
                            <?php foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $photo): ?>
                                <div class="swiper-slide">
                                    <div class="catalog-item__slide"><img src="<?= CFIle::getPath($photo) ?>" alt=""></div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ( $add_proto ) : ?>
                            <div class="swiper-slide">
                                <div class="catalog-item__slide"><img src="<?= $add_proto ?>" alt=""></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ЧАСТЬ ДЛЯ ИЗЪЯТИЯ ФОТОГРАФИЙ ИЗ ЭЛЕМНТА УДАЛИТЬ, ЕСЛИ БУДЕТ ИСПОЛЬЗОВАН ДРУГОЙ ВАРИАНТ -->

                <!-- ЧАСТЬ ДЛЯ ИЗЪЯТИЯ ФОТОГРАФИЙ ИЗ ТП С ФОТО -->
                    <!-- <?php if (isset($arResult["OFFERS"]) && $arResult["OFFERS"]) : ?>
                        <div class="swiper-container swiper-thumbs" thumbsSlider="">
                            <div class="swiper-wrapper">
                                <?php if (!empty($arResult["OFFERS"][0]['PROPERTIES']['MORE_PHOTO']['VALUE'])) : ?>
                                    <?php foreach ($arResult["OFFERS"][0]['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $photo): ?>
                                        <div class="swiper-slide">
                                            <div class="catalog-item__slide"><img src="<?= CFIle::getPath($photo) ?>" alt=""></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="swiper-container swiper-thumbs" thumbsSlider="">
                            <div class="swiper-wrapper">
                                <?php if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) : ?>
                                    <?php foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $photo): ?>
                                        <div class="swiper-slide">
                                            <div class="catalog-item__slide"><img src="<?= CFIle::getPath($photo) ?>" alt=""></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?> -->
                <!-- ЧАСТЬ ДЛЯ ИЗЪЯТИЯ ФОТОГРАФИЙ ИЗ ТП С ФОТО -->
            </div>
            <div class="catalog-item__info">
                <h1 class="catalog-item__title title-first"><?= $name ?></h1>
                <div class="catalog-item__list">
                    <?php if (!empty($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'])) : ?>
                        <div class="catalog-item__row"><span><?= $arResult['PROPERTIES']['CML2_ARTICLE']['NAME'] ?>:</span><span><?= $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'] ?></span></div>
                    <?php endif; ?>
                    <!--<div class="catalog-item__row"><span>Остаток на складе:</span><span class="catalog-item__value">12 шт.</span></div>-->
                </div>
                <?php
                    $retail_price_type = $GLOBALS['UF_USER_REGION']['PROPS']['RETAIL_PRICE_TYPE_CODE']['VALUE'];
                    $opt_price_type = $GLOBALS['UF_USER_REGION']['PROPS']['OPT_PRICE_TYPE_CODE']['VALUE'];
                    $user_groups = \Bitrix\Main\Engine\CurrentUser::get()->getUserGroups();

                    $is_opt_user = false;
                    if ( in_array('10', $user_groups) ) {
                        $is_opt_user = true;
                    }

                    // var_dump($opt_price_type);

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
                 ?>
                <?php $prices_itterator = 0; ?>
                <?php foreach ($arResult['PRICES'] as $keyPrice => $curentPrice) : ?>
                    <?php  if ($keyPrice != $active_price) continue; ?>
                    <div class="catalog-item__price <?= ($prices_itterator == 0) ? 'active' : '' ?>" data-price-block="<?= $keyPrice ?>">
                        <?php if ($curentPrice['DISCOUNT_DIFF']) : ?>
                            <span class="catalog-item__new-price"> <?= $curentPrice['PRINT_DISCOUNT_VALUE'] ?></span>
                            <span class="catalog-item__old-price"><?= $curentPrice['PRINT_VALUE'] ?></span>
                        <?php else : ?>
                            <span class="catalog-item__new-price"> <?= $curentPrice['PRINT_VALUE'] ?></span>
                        <?php endif; ?>
                    </div>
                <?php $prices_itterator++; ?>
                <?php endforeach; ?>
                <div class="catalog-item__radios">
                    <?php $prices_itterator = 0; ?>
                    <?php foreach ($arResult['CAT_PRICES'] as $keyPrice => $curentPrice) : ?>
                        <?php  if ($keyPrice != $active_price) {
                     continue;
                 } ?>
                        <?php if ($arResult['PRICES'][$keyPrice]) : ?>
                            <label class="catalog-item__label radio-btn">
                                <input class="radio-btn__input visually-hidden" <?= ($prices_itterator == 0) ? 'checked' : '' ?>  type="radio" name="price" data-price-btn="<?= $keyPrice ?>" value="<?= $keyPrice ?>">
                                <span class="radio-btn__caption"><?= $curentPrice['TITLE'] ?>
                                </span>
                            </label>
                        <?php endif; ?>
                        <?php $prices_itterator++; ?>
                    <?php endforeach; ?>
                </div>
                <div class="catalog-item__color mb-60">
                    <?php if (!empty($arResult['PROPERTIES']['COLORS']['NEW_VALUES'])) : ?>

                        <span class="catalog-item__caption"><?= $arResult['PROPERTIES']['COLORS']['NAME'] ?></span>
                        <?php foreach ($arResult['PROPERTIES']['COLORS']['NEW_VALUES'] as $key => $color) : ?>
                            <span class="catalog-item__desc <?= ($key == 0) ? 'active' : '' ?>" data-color="<?= $color['CODE'] ?>"><?= $color['TITLE'] ?></span>
                        <?php endforeach; ?>
                        <div class="catalog-item__color-list color-list">
                            <?php foreach ($arResult['PROPERTIES']['COLORS']['NEW_VALUES'] as $key => $color) : ?>
                                <label class="color-list__item">
                                    <input <?= ($key == 0) ? 'checked' : '' ?> data-color-input class="visually-hidden" type="radio" name="colors" data-color-btn="<?= $color['CODE'] ?>" value="<?= $color['CODE'] ?>">
                                    <img class="color-list__img" src="<?= $color['FILE'] ? $color['FILE'] : '/local/templates/new_layout/assets/images/no-image.jpg' ?>" alt="<?= $color['TITLE'] ?>">
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <div class="color-list__count"><span class="color-list__count-label">Остаток на складе:</span> <span class="catalog-list__count-value"><?= $first_offer_count ?></span> шт.</div>

                    <?php endif; ?>
                </div>
                <?php if ($arResult['PROPERTIES']['UF_OUT_OF']['VALUE'] != 'Y') : ?>
                    <div class="catalog-item__btn-wrap">
                        <?php if ($arResult['PRICES'] and  !empty($arResult['PROPERTIES']['COLORS']['NEW_VALUES'])) : ?>
                            <button class="catalog-item__btn catalog-item__btn--cart button" data-modal-trigger="addincart-success" data-add-to-basket data-element-id="<?= $arResult['ID'] ?>">
                                <svg width="21" height="21">
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/images/sprite.svg#cart"></use>
                                </svg><span><?= GetMessage('CT_BCE_CATALOG_ADD') ?></span>
                            </button>
                        <?php endif; ?>
                        <button class="catalog-item__btn button button--ghost">
                            <span><?= GetMessage('CT_BCE_CATALOG_FAVOURITE_BUTTON_TEXT') ?></span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="catalog-item__tab-wrap tab">
            <ul class="tab__nav">
                <?php
                if ($showDescription) {
                    ?>
                    <li class="tab__item">
                        <button class="tab__btn active" data-tab-id="tabId1" data-tab-control="tab1">
                            <?= $arParams['MESS_DESCRIPTION_TAB'] ?>
                        </button>
                    </li>
                <?php
                }

                // if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
                    ?>
                    <li class="tab__item">
                        <button class="tab__btn" data-tab-id="tabId1" data-tab-control="tab2">
                            <?= $arParams['MESS_PROPERTIES_TAB'] ?>
                        </button>
                    </li>
                <?php
                // }

                if ($arParams['USE_COMMENTS'] === 'Y') {
                    ?>
                    <li class="tab__item">
                        <button class="tab__btn">
                            <span><?= $arParams['MESS_COMMENTS_TAB'] ?></span>
                        </button>
                    </li>
                <?php
                }
                ?>
            </ul>
            <?php
                // echo "<pre>";
                // var_dump($arResult["PRODUCT"]);
             ?>
            <div class="tab__content">
                <?php
                if ($showDescription) {
                    ?>
                    <div class="tab__block" data-tab-id="tabId1" data-tab-block="tab1" style="">
                        <?php
                        if (
                            $arResult['PREVIEW_TEXT'] != ''
                            && ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S'
                                || ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == ''))
                        ) {
                            echo $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>' . $arResult['PREVIEW_TEXT'] . '</p>';
                        }

                    if ($arResult['DETAIL_TEXT'] != '') {
                        echo $arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>' . $arResult['DETAIL_TEXT'] . '</p>';
                    } ?>
                    </div>
                <?php
                }

                // if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
                    ?>
                    <div class="tab__block" data-tab-id="tabId1" data-tab-block="tab2" style="display: none;">
                        <!-- <?php
                        if (!empty($arResult['DISPLAY_PROPERTIES'])) {
                            ?>

                            <?php
                            foreach ($arResult['DISPLAY_PROPERTIES'] as $property) {
                                ?>
                                <p><?= $property['NAME'] ?>
                                    <?= (is_array($property['DISPLAY_VALUE'])
                                        ? implode(' / ', $property['DISPLAY_VALUE'])
                                        : $property['DISPLAY_VALUE']) ?>
                                </p>
                            <?php
                            }
                            unset($property); ?>
                        <?php
                        } ?> -->
                        <?php if ($arResult["PRODUCT"]["LENGTH"] && $arResult["PRODUCT"]["HEIGHT"] && $arResult["PRODUCT"]["WIDTH"]): ?>
                            <p>Размер (Д х В х Ш): <?= $arResult["PRODUCT"]["LENGTH"] ?> Х <?= $arResult["PRODUCT"]["HEIGHT"] ?> Х <?= $arResult["PRODUCT"]["WIDTH"] ?> (мм)</p>
                        <? endif; ?>
                        <?php if ($arResult["PRODUCT"]["WEIGHT"]) : ?>
                            <p>Вес: <?= round($arResult["PRODUCT"]["WEIGHT"] / 1000, 1) ?> кг.</p>
                        <?php endif; ?>
                    </div>
                <?php
                // }

                ?>
            </div>
        </div>

        <meta itemprop="name" content="<?= $name ?>" />
        <meta itemprop="category" content="<?= $arResult['CATEGORY_PATH'] ?>" />
    </div>
</section>
<?php
if ($haveOffers) {
                    $offerIds = array();
                    $offerCodes = array();

                    $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

                    foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
                        $offerIds[] = (int)$jsOffer['ID'];
                        $offerCodes[] = $jsOffer['CODE'];

                        $fullOffer = $arResult['OFFERS'][$ind];
                        $measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

                        $strAllProps = '';
                        $strMainProps = '';
                        $strPriceRangesRatio = '';
                        $strPriceRanges = '';

                        if ($arResult['SHOW_OFFERS_PROPS']) {
                            if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                                foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
                                    $current = '<dt>' . $property['NAME'] . '</dt><dd>' . (is_array($property['VALUE'])
                        ? implode(' / ', $property['VALUE'])
                        : $property['VALUE']) . '</dd>';
                                    $strAllProps .= $current;

                                    if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
                                        $strMainProps .= $current;
                                    }
                                }

                                unset($current);
                            }
                        }

                        if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
                            $strPriceRangesRatio = '(' . Loc::getMessage(
                                'CT_BCE_CATALOG_RATIO_PRICE',
                                array('#RATIO#' => ($useRatio
                    ? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
                    : '1') . ' ' . $measureName)
                            ) . ')';

                            foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
                                if ($range['HASH'] !== 'ZERO-INF') {
                                    $itemPrice = false;

                                    foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
                                        if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
                                            break;
                                        }
                                    }

                                    if ($itemPrice) {
                                        $strPriceRanges .= '<dt>' . Loc::getMessage(
                                            'CT_BCE_CATALOG_RANGE_FROM',
                                            array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
                                        ) . ' ';

                                        if (is_infinite($range['SORT_TO'])) {
                                            $strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                                        } else {
                                            $strPriceRanges .= Loc::getMessage(
                                                'CT_BCE_CATALOG_RANGE_TO',
                                                array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
                                            );
                                        }

                                        $strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
                                    }
                                }
                            }

                            unset($range, $itemPrice);
                        }

                        $jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
                        $jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
                        $jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
                        $jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
                    }

                    $templateData['OFFER_IDS'] = $offerIds;
                    $templateData['OFFER_CODES'] = $offerCodes;
                    unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

                    $jsParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => true,
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
            'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
            'OFFER_GROUP' => $arResult['OFFER_GROUP'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
            'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
            'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
            'USE_STICKERS' => true,
            'USE_SUBSCRIBE' => $showSubscribe,
            'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
            'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
            'ALT' => $alt,
            'TITLE' => $title,
            'MAGNIFIER_ZOOM_PERCENT' => 200,
            'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
            'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
            'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                : null,
            'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
            'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE']
        ),
        'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
        'VISUAL' => $itemIds,
        'DEFAULT_PICTURE' => array(
            'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
            'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
        ),
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'ACTIVE' => $arResult['ACTIVE'],
            'NAME' => $arResult['~NAME'],
            'CATEGORY' => $arResult['CATEGORY_PATH'],
            'DETAIL_TEXT' => $arResult['DETAIL_TEXT'],
            'DETAIL_TEXT_TYPE' => $arResult['DETAIL_TEXT_TYPE'],
            'PREVIEW_TEXT' => $arResult['PREVIEW_TEXT'],
            'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE']
        ),
        'BASKET' => array(
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'BASKET_URL' => $arParams['BASKET_URL'],
            'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        ),
        'OFFERS' => $arResult['JS_OFFERS'],
        'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
        'TREE_PROPS' => $skuProps
    );
                } else {
                    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
                    if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
                        ?>
        <div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
            <?php
            if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
                    ?>
                    <input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]" value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
                <?php
                    unset($arResult['PRODUCT_PROPERTIES'][$propId]);
                }
            }

                        $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
                        if (!$emptyProductProperties) {
                            ?>
                <table>
                    <?php
                    foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
                        ?>
                        <tr>
                            <td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
                            <td>
                                <?php
                                if (
                                    $arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
                                    && $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
                                ) {
                                    foreach ($propInfo['VALUES'] as $valueId => $value) {
                                        ?>
                                        <label>
                                            <input type="radio" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]" value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"checked"' : '') ?>>
                                            <?= $value ?>
                                        </label>
                                        <br>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
                                        <?php
                                        foreach ($propInfo['VALUES'] as $valueId => $value) {
                                            ?>
                                            <option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"selected"' : '') ?>>
                                                <?= $value ?>
                                            </option>
                                        <?php
                                        } ?>
                                    </select>
                                <?php
                                } ?>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </table>
            <?php
                        } ?>
        </div>
<?php
                    }
                }

?>
