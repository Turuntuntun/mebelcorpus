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
<section class="about-company mb-90">
    <div class="container">
        <div class="container__narrow">
            <h1 class="about-company__title title-first mb-60"><?=$arResult['NAME']?></h1>
            <div class="about-company__content content"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="">
                <p class="content__main-text"><?=$arResult['PREVIEW_TEXT']?></p>
                <?=$arResult['DETAIL_TEXT']?>
            </div>
        </div>
    </div>
</section>