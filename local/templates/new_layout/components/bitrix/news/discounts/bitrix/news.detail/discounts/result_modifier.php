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

if ($arResult['PROPERTIES']['UF_DISCOUNT_START']['VALUE'] and $arResult['PROPERTIES']['UF_DISCOUNT_END']['VALUE']) {
    $startDateArray = explode('/',$arResult['PROPERTIES']['UF_DISCOUNT_START']['VALUE']);
    $endtDateArray = explode('/',$arResult['PROPERTIES']['UF_DISCOUNT_END']['VALUE']);
    $monthStart = transformMonthInText($startDateArray[0]);
    $monthEnd = transformMonthInText($endtDateArray[0]);
    $arResult['PROPERTIES']['UF_START_END_STRING']['VALUE'] = "c $startDateArray[1] $monthStart $startDateArray[2] по $endtDateArray[1] $monthEnd $endtDateArray[2]";
}