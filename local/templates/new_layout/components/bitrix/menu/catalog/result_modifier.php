<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php

$lastLevel = 1;
$boolFirst = true;

foreach ($arResult as $key => $arSection) {

    if ($boolFirst or  $lastLevel > $arSection['DEPTH_LEVEL']) {
        $arResult['ITEMS'][] = $arSection;
        $currentKey = array_key_last($arResult['ITEMS']);
    } else {
        $arResult['ITEMS'][$currentKey]['CHILDS'][] = $arSection;
    }

    $lastLevel = $arSection['DEPTH_LEVEL'];
    $boolFirst = false;
}