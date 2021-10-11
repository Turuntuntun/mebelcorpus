<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$params = array(
	'PAGE' => ($params['PAGE'] == 'detail' ? 'detail' : 'list'),
);

$sReplaceString = '';
if (
	$params['PAGE'] == 'list' &&
	isset($arItem['DISPLAY_PROPERTIES'][$arParams['PROP_STORE_REPLACE_SECTION']]['DISPLAY_VALUE'])
) 
{
	$sReplaceString = $arItem['DISPLAY_PROPERTIES'][$arParams['PROP_STORE_REPLACE_SECTION']]['DISPLAY_VALUE'];
}
elseif (
	$params['PAGE'] == 'detail' &&
	isset($arItem['DISPLAY_PROPERTIES'][$arParams['PROP_STORE_REPLACE_DETAIL']]['DISPLAY_VALUE'])
)
{
	$sReplaceString = $arItem['DISPLAY_PROPERTIES'][$arParams['PROP_STORE_REPLACE_DETAIL']]['DISPLAY_VALUE'];
}
?>

<?$APPLICATION->IncludeComponent(
	'bitrix:catalog.store.amount',
	'gopro',
	array(
		"ELEMENT_ID" => $arItem['ID'],
		"STORE_PATH" => $arParams['STORE_PATH'],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000",
		"MAIN_TITLE" => GetMessage('GOPRO_TH_QUANTITY'),
		"USE_STORE_PHONE" => $arParams['USE_STORE_PHONE'],
		"SCHEDULE" => $arParams['USE_STORE_SCHEDULE'],
		"USE_MIN_AMOUNT" => "Y",
		"GOPRO_USE_MIN_AMOUNT" => $arParams['USE_MIN_AMOUNT'],
		"MIN_AMOUNT" => $arParams['MIN_AMOUNT'],
		"SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
		"SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
		"USER_FIELDS" => $arParams['USER_FIELDS'],
		"FIELDS" => $arParams['FIELDS'],
		// gopro
		'DATA_QUANTITY' => $arItem['DATA_QUANTITY'],
		'FIRST_ELEMENT_ID' => $product['ID'],
		'PAGE' => $params['PAGE'],
		// multiregionality
		'SITE_LOCATION_ID' => SITE_LOCATION_ID,
		'STORE_REPLACE_STRING' => $sReplaceString,
		'STORE_REPLACE_IF_NOT_AVAILABLE' => $arParams['STORE_REPLACE_IF_NOT_AVAILABLE']
	),
	$component,
	array('HIDE_ICONS' => 'Y')
);?>