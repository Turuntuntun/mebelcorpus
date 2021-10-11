<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;

if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0) {

	// ajaxpages && sorterchange -> start
	include(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/template.start.php');

	$templateExtFolder = EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/';

	switch ($arParams['VIEW']) {
		case 'table':
			include($templateExtFolder.'/table.php');
			break;
		case 'gallery':
			include($templateExtFolder.'/gallery.php');
			break;
		default:
			include($templateExtFolder.'/showcase.php');
	}

	// ajaxpages && sorterchange -> start
	include(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/template.finish.php');

} elseif ($arParams['SHOW_ERROR_EMPTY_ITEMS'] == 'Y') {
	ShowError(Loc::getMessage('ERROR_EMPTY_ITEMS'));
}

$templateData['ADD_HIDER'] = false;
if (!is_array($arResult['ITEMS']) || count($arResult['ITEMS']) < 1 && $arParams['EMPTY_ITEMS_HIDE_FIL_SORT'] == 'Y' && empty($_REQUEST['set_filter']) ) {
	$templateData['ADD_HIDER'] = true;
}
