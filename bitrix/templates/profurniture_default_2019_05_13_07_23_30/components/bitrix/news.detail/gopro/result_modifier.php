<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (!empty($arResult['PROPERTIES']['BINDED_ELEMENTS']['VALUE'])) {
	$arResult['GOPRO'] = array(
		'BINDED_ELEMENTS' => $arResult['PROPERTIES']['BINDED_ELEMENTS']['VALUE'],
	);
}

// add cache keys
$cp = $this->__component;
if (is_object($cp)) {
	$cp->SetResultCacheKeys(array('GOPRO'));
}
