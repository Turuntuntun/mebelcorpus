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
<!-- Слайдер-->
<section class="main-slider mb-90">
    <div class="swiper-container swiper-oneslide">
        <div class="swiper-wrapper">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="swiper-slide">
        <div class="main-slider__item">
            <img class="main-slider__img" src="<?=$arItem['PROPERTIES']['UF_IMAGE']['SRC']?>" alt="">
            <div class="container">
                <div class="main-slider__text-wrap">
                    <h2 class="main-slider__title">
                        <span class="main-slider__small"><?=$arItem['PROPERTIES']['UF_MIDDLE_TITLE']['VALUE']?></span>
                        <span class="main-slider__big"><?=$arItem['PROPERTIES']['UF_BIG_TITLE']['VALUE']?></span>
                        <span class="main-slider__middle"><?=$arItem['PROPERTIES']['UF_SMAL_TITLE']['VALUE']?></span>
                    </h2>
                    <? if ($arItem['PROPERTIES']['UF_LINK']['VALUE'] and $arItem['PROPERTIES']['UF_LINK_TEXT']['VALUE']) :?>
                    <a class="main-slider__button button" href="<?=$arItem['PROPERTIES']['UF_LINK']['VALUE']?>">
                        <?=$arItem['PROPERTIES']['UF_LINK_TEXT']['VALUE']?>
                    </a>
                    <? endif?>
                    <div class="main-slider__sale-wrap">
                        <span class="main-slider__sale-caption"><?=$arItem['PROPERTIES']['UF_DISCOUNT_TEXT']['VALUE']?></span>
                        <span class="main-slider__sale-val"><?=$arItem['PROPERTIES']['UF_DISCOUNT_VALUE']['VALUE']?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endforeach;?>
        </div>
    <div class="swiper-pagination"></div>
    <div class="main-slider__btns container">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>
</section>
