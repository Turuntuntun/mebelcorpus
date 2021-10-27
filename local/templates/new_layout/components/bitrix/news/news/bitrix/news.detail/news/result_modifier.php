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

if ($arResult['PROPERTIES']['UF_IMAGES']['VALUE']){
    foreach ($arResult['PROPERTIES']['UF_IMAGES']['VALUE'] as $key => &$item) {
        $item = CFile::getPath($item);
    }
}
