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
<section class="warranty mb-90">
    <div class="container">
        <div class="container__narrow">
            <h1 class="warranty__title title-first mb-60"><?=GetMessage('CTR_GAR_TITLE')?></h1>
            <div class="warranty__content">
                <?=$arResult['DETAIL_TEXT']?>
            </div>
        </div>
    </div>
</section>