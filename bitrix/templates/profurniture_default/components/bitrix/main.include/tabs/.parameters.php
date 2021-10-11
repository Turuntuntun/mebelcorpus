<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arTemplateParameters = array(
	'HIDE_TAB_IF_ONE' => array(
		'NAME' => Loc::getMessage('PARAMS.TABS.HIDE_TAB_IF_ONE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'MAIN_TAB_NAME' => array(
		'PARENT' => 'PARAMS',
		'NAME' => Loc::getMessage('PARAMS.TABS.MAIN_TAB_NAME'),
		'TYPE' => 'STRING',
	),
	'TABS_COUNT' => array(
		'NAME' => Loc::getMessage('PARAMS.TABS.TABS_COUNT'),
		'TYPE' => 'STRING',
		'REFRESH' => 'Y',
	),
);

$count = intval($arCurrentValues['TABS_COUNT']);

if ($count > 0) {
	for ($i = 0; $i < $count; $i++) {
		$arTemplateParameters['TAB_NAME_N'.$i] = array(
			'NAME' => Loc::getMessage('PARAMS.TABS.TAB_NAME_N').' #'.($i + 2),
			'TYPE' => 'STRING',
		);
		$arTemplateParameters['TAB_PATH_N'.$i] = array(
			'NAME' => Loc::getMessage('PARAMS.TABS.TAB_PATH_N').' #'.($i + 2),
			'TYPE' => 'STRING',
		);
	}
}
