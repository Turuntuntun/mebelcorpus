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

foreach ($arResult['ITEMS'] as $key => $arItem) {
    if ($arItem['PROPERTIES']['UF_IMAGE']['VALUE']) {
        $arItem['PROPERTIES']['UF_IMAGE']['SRC'] = CFile::getPath($arItem['PROPERTIES']['UF_IMAGE']['VALUE']);
    }
}