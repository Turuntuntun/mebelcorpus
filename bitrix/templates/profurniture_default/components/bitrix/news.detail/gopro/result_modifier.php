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


//Schema.org additional
$arResult['MICRODATA']['ORGANIZATION']['NAME'] = \Bitrix\Main\Config\Option::get('redsign.profurniture', 'microdata_organization_name');
$arResult['MICRODATA']['ORGANIZATION']['IMAGE_URL'] = \Bitrix\Main\Config\Option::get('redsign.profurniture', 'microdata_organization_image_url');
$arResult['MICRODATA']['ORGANIZATION']['ADDRESS'] = \Bitrix\Main\Config\Option::get('redsign.profurniture', 'microdata_organization_address');
$arResult['MICRODATA']['ORGANIZATION']['PHONE'] = \Bitrix\Main\Config\Option::get('redsign.profurniture', 'microdata_organization_phone');

if (!isset($arParams['PUBLISHER_TYPE']))
	$arParams['PUBLISHER_TYPE'] = 'organization';

if ($arParams['PUBLISHER_TYPE'] == 'person') {
	if (isset($arResult['CREATED_BY'])) {
		$arUser = CUser::GetByID($arResult['CREATED_BY']);
		$user = $arUser->Fetch();
		$arResult['MICRODATA']['AUTHOR']["NAME"] = $user["NAME"];
		$arResult['MICRODATA']['AUTHOR']["LAST_NAME"] = $user["LAST_NAME"];
		$arResult['MICRODATA']['AUTHOR']['FULL_NAME'] = $user["NAME"].' '.$user["LAST_NAME"];
	}
}
else if ($arParams['PUBLISHER_TYPE'] == 'organization') {
	if (isset($arResult['MICRODATA']['ORGANIZATION']['NAME']) && strlen($arResult['MICRODATA']['ORGANIZATION']['NAME']) > 0) {
		$arResult['MICRODATA']['AUTHOR']['FULL_NAME'] = $arResult['MICRODATA']['ORGANIZATION']['NAME'];
	}
	else {
		$rsSites = CSite::GetByID(SITE_ID);
		if ($arSite = $rsSites->Fetch()) {
			$arResult['MICRODATA']['AUTHOR']['FULL_NAME'] = $arSite['SITE_NAME'];
		}
	}
}
?>