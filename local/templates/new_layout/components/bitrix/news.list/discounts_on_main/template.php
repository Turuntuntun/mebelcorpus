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
<section class="sales mb-90">
    <div class="container">
        <div class="sales__header title-wb mb-60">
            <h2 class="title-second"><?=GetMessage("CT_BNL_TEXT_LINK")?></h2>
            <a class="sales__more title-wb__link" href="#"><?=GetMessage("CT_BNL_TITLE_COMPONENT")?></a>
        </div>
        <div class="sales__slider slider-withone">
            <div class="swiper-container">
                <div class="swiper-wrapper">



<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="swiper-slide">
        <div class="sales__item"><img class="sales__img" src="<?=$arItem['PROPERTIES']['UF_IMAGE']['SRC']?>" alt="">
            <div class="sales__text-wrap">
                <div class="sales__caption"><?=$arItem['PROPERTIES']['UF_TEXT']['VALUE']?></div>
                <? if ($arItem['PROPERTIES']['UF_LINK']['VALUE'] and $arItem['PROPERTIES']['UF_LINK_TEXT']['VALUE']) :?>
                    <a class="sales__btn button" href="<?=$arItem['PROPERTIES']['UF_LINK']['VALUE']?>"><?=$arItem['PROPERTIES']['UF_LINK_TEXT']['VALUE']?></a>
                <? endif;?>
            </div>
        </div>
    </div>
<?endforeach;?>

                </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>