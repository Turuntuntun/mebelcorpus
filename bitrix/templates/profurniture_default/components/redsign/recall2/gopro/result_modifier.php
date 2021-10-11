<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if ($arParams['YM_COUNTER_NUMBER_LOCATION'] == 'module') {
	$arResult['YM_COUNTER_NUMBER'] = \Bitrix\Main\Config\Option::get('redsign.profurniture', 'ym_counter_number');
}
else {
	$arResult['YM_COUNTER_NUMBER'] = $arParams['YM_COUNTER_NUMBER'];
}