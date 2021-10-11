<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
	
use \Bitrix\Main\Localization\Loc;

$publisherTypes = array(
	'person' => Loc::getMessage('PUBLISHER_TYPE_PERSON'),
	'organization' => Loc::getMessage('PUBLISHER_TYPE_ORGANIZATION')
);
$arTemplateParameters['PUBLISHER_TYPE'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => Loc::getMessage('PUBLISHER_TYPE'),
	'TYPE' => 'LIST',
	'VALUES' => $publisherTypes
);
