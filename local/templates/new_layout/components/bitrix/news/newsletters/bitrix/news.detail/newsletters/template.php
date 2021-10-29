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
<section class="news-item mb-90">
    <div class="container">
        <div class="container__narrow container__narrow--center">
            <h1 class="news-item__title title-first mb-60"><?=$arResult['NAME']?></h1>
            <div class="news-item__block">
                <? if ($arResult['DETAIL_PICTURE']['SRC']) :?>
                <div class="news-item__banner"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>"></div>
                <? endif;?>
                <? if ($arResult['DETAIL_TEXT']) :?>
                    <p><?=$arResult['DETAIL_TEXT']?></p>
                <? endif;?>
            </div>
        </div>
    </div>
</section>