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
<div class="catalog-section__aside catalog-aside">
    <ul class="catalog-aside__list">
        <li class="catalog-aside__item">
            <? foreach ($arResult['SECTIONS'] as $key => $arSeciton) :?>
                <a class="catalog-aside__link" href="<?=$arSeciton['SECTION_PAGE_URL']?>"><?=$arSeciton['NAME']?></a></li>
            <? endforeach;?>
    </ul>
</div>
