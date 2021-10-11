<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog'))
{
    return;
}

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$fnIBlocks = function ($sIblockType) {
    $arIBlock = [];

    $iblockFilter = (
        !empty($sIblockType)
        ? ['TYPE' => $sIblockType, 'ACTIVE' => 'Y']
        : ['ACTIVE' => 'Y']
    );

    $rsIBlock = CIBlock::GetList(['SORT' => 'ASC'], $iblockFilter);

    while ($arr = $rsIBlock->Fetch())
    {
        $arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
    }

    return $arIBlock;
};


$arPrice = CCatalogIBlockParameters::getPriceTypesList();

$arTemplateParameters['CATALOG_IBLOCK_TYPE'] = array(
    'PARENT' => 'DATA_SOURCE',
    'NAME' => Loc::getMessage('RS_N_CATALOG_IBLOCK_TYPE'),
    "TYPE" => "LIST",
	"VALUES" => $arIBlockType,
	"REFRESH" => "Y",
);

$arTemplateParameters['CATALOG_IBLOCK_ID'] = array(
    'PARENT' => 'DATA_SOURCE',
	'NAME' => Loc::getMessage('RS_N_CATALOG_IBLOCK_ID'),
	'TYPE' => 'LIST',
	'ADDITIONAL_VALUES' => 'Y',
	'VALUES' => $fnIBlocks(isset($arCurrentValues['CATALOG_IBLOCK_TYPE']) ? $arCurrentValues['CATALOG_IBLOCK_TYPE'] : ''),
	'DEFAULT' => '',
	'REFRESH' => 'Y',
);

if (
    isset($arCurrentValues['CATALOG_IBLOCK_ID']) &&
    0 < $arCurrentValues['CATALOG_IBLOCK_ID']
)
{
    $arTemplateParameters['CATALOG_PRICE_CODE'] = array(
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('RS_N_CATALOG_PRICE_CODE'),
        "TYPE" => "LIST",
        "MULTIPLE" => "Y",
        "VALUES" => $arPrice,
    );
    
    
    $arTemplateParameters['CATALOG_FILTER_NAME'] = array(
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('RS_N_CATALOG_FILTER_NAME'),
        'TYPE' => 'STRING',
        'DEFAULT' => 'arrCatalogFilter'
    );
}

$arTemplateParameters['COLLECTION_IBLOCK_TYPE'] = array(
    'PARENT' => 'DATA_SOURCE',
    'NAME' => Loc::getMessage('RS_N_COLLECTION_IBLOCK_TYPE'),
    "TYPE" => "LIST",
	"VALUES" => $arIBlockType,
	"REFRESH" => "Y",
);

$arTemplateParameters['COLLECTION_IBLOCK_ID'] = array(
    'PARENT' => 'DATA_SOURCE',
	'NAME' => Loc::getMessage('RS_N_COLLECTION_IBLOCK_ID'),
	'TYPE' => 'LIST',
	'ADDITIONAL_VALUES' => 'Y',
	'VALUES' => $fnIBlocks(isset($arCurrentValues['COLLECTION_IBLOCK_TYPE']) ? $arCurrentValues['COLLECTION_IBLOCK_TYPE'] : ''),
	'DEFAULT' => '',
	'REFRESH' => 'Y',
);
