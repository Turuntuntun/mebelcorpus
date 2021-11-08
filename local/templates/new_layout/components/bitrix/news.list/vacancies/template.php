<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<?php if($arResult["ITEMS"]) :?>
<section class="vacancy mb-90">
    <div class="container">
        <div class="container__narrow">
            <h2 class="vacancy__title title-second mb-60"><?=GetMessage('VACANCIES_TITLE')?></h2>
            <div class="vacancy__accordion accordion">
                <?foreach($arResult["ITEMS"] as $key => $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
                    ?>
                <div class="accordion__item ac js-enabled" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="accordion__header ac-header"><span class="accordion__info"><?=$arItem['PROPERTIES']['UF_TITILE']["VALUE"]?></span>
                        <div class="accordion__wrap">
                            <div class="accordion__place"><span><?=GetMessage('VACANCIES_CITY_NAME')?></span><span class="accordion__city"><?=$arItem['PROPERTIES']['UF_CITY']['VALUE']?></span>
                            </div>
                            <span class="accordion__info"><?=$arItem['PROPERTIES']['UF_SALARY']['VALUE']?></span>
                        </div>
                    </div>
                    <div class="accordion__panel ac-panel" id="ac-panel-<?=$key?>" role="region" aria-labelledby="ac-trigger-<?=$key?>" style="transition-duration: 600ms; height: 0px;">
                        <div class="accordion__content">
                            <p><?=$arItem['PROPERTIES']['UF_DESCRIPTION']['~VALUE']['TEXT']?></p>
                            <button class="accordion__content-btn button" data-modal-trigger="vacancy-form"><?=GetMessage('VACANCIES_BUTTON_NAME')?></button>
                        </div>
                    </div>
                    <button class="accordion__btn ac-trigger" id="ac-trigger-<?=$key?>" role="button" aria-controls="ac-panel-<?=$key?>" aria-disabled="false" aria-expanded="false">
                        <svg width="30" height="30">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-incircle"></use>
                        </svg>
                    </button>
                </div>
                <? endforeach;?>
            </div>
        </div>
    </div>
</section>
<?php endif;?>
