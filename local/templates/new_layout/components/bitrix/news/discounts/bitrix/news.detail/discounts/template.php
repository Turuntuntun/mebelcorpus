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
<section class="discount-item mb-90">
    <div class="container">
        <h1 class="discount-item__title title-first mb-60"><?=$arResult['NAME']?></h1>
        <div class="discount-item__banner mb-60"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>"></div>
        <div class="discount-item__text-wrap container__narrow">
            <div class="discount-item__caption"><?=GetMessage('CTL_TEXT_DISCOUNT_TITLE_LENGTH')?></div>
            <? if ($arResult['PROPERTIES']['UF_START_END_STRING']['VALUE']) :?>
            <div class="discount-item__timing">
                <svg width="20" height="20">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#calendar"></use>
                </svg>
                <span><?=$arResult['PROPERTIES']['UF_START_END_STRING']['VALUE']?></span>
            </div>
            <? endif;?>
            <p class="discount-item__bold-text"><?=$arResult['PROPERTIES']['UF_TITLE_DETAIL']['VALUE']['TEXT']?></p>
            <p><?=$arResult['DETAIL_TEXT']?></p>
        </div>
    </div>
</section>