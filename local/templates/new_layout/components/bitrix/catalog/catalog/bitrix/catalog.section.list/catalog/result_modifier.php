<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$lastLevel = 1;
$boolFirst = true;
$count = 1;
foreach ($arResult['SECTIONS'] as $key => $arSection) {

    if ($boolFirst or  $lastLevel > $arSection['RELATIVE_DEPTH_LEVEL']) {
        $arResult['NEW_SECTIONS'][] = $arSection;
        $currentKey = array_key_last($arResult['NEW_SECTIONS']);
        $count = 1;
    } else {
        if ($count > 6) continue;
        $arResult['NEW_SECTIONS'][$currentKey]['CHILDS'][] = $arSection;
        $count++;
    }

    $lastLevel = $arSection['RELATIVE_DEPTH_LEVEL'];
    $boolFirst = false;
}

?>