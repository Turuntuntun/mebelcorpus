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


<?
$citySerialized = $APPLICATION->get_cookie( 'RS_MY_LOCATION' );
$arCity = unserialize( $citySerialized );
$cityName = $arCity['NAME'];
?>

<?$APPLICATION->IncludeComponent(
	'ownedmuhaha:stores',
	'',
	Array(
		'ID' => $arItem['ID'],
		'CITY_NAME' => $cityName
	),
	$component
)?>