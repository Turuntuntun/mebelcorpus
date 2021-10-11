<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

$arTemplateParameters['YM_USE_TARGETS'] = array(
	'NAME' => GetMessage('YM_USE_TARGETS'),
	'TYPE' => 'CHECKBOX',
	'REFRESH' => 'Y',
);

if ($arCurrentValues['YM_USE_TARGETS'] == 'Y') {
	$arTemplateParameters['YM_COUNTER_NUMBER_LOCATION'] = array(
		'NAME' => GetMessage('YM_COUNTER_NUMBER_LOCATION'),
		'TYPE' => 'LIST',
		'VALUES' => array(
			'module' => GetMessage('YM_COUNTER_NUMBER_LOCATION_MODULE'),
			'component' => GetMessage('YM_COUNTER_NUMBER_LOCATION_COMPONENT'),
		),
		'REFRESH' => 'Y',
	);

	if ($arCurrentValues['YM_COUNTER_NUMBER_LOCATION'] == 'component') {
		$arTemplateParameters['YM_COUNTER_NUMBER'] = array(
			'NAME' => GetMessage('YM_COUNTER_NUMBER'),
			'TYPE' => 'STRING',
		);
	}

	$arTemplateParameters['YM_TARGET_NAME'] = array(
		'NAME' => GetMessage('YM_TARGET_NAME'),
		'TYPE' => 'STRING',
	);
}