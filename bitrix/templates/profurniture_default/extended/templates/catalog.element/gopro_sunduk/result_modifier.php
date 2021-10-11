<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Loader,
	\Bitrix\Main\Config\Option,
	\Redsign\DevFunc\Sale\Location\Region;

if (!Loader::includeModule('redsign.devfunc'))
    return;

if (!Loader::includeModule('catalog'))
    return;

// multiregionality
if (Loader::includeModule('redsign.devfunc'))
{
	\Redsign\DevFunc\Sale\Location\Region::editCatalogResult($arResult);
	\Redsign\DevFunc\Sale\Location\Region::editCatalogItem($arResult);
}

$arParams['GOPRO'] = array(
	'OFF_YANDEX' => Option::get(GOPRO_MODULE_ID, 'off_yandex', 'N'),
);

$arParams['SHOW_SIZE_TABLE'] = isset($arParams['SHOW_SIZE_TABLE']) && $arParams['SHOW_SIZE_TABLE'] === 'Y' ? 'Y' : 'N';

$arParams['SIZE_TABLE_USER_FIELDS'] = isset($arParams['SIZE_TABLE_USER_FIELDS']) ? trim($arParams['SIZE_TABLE_USER_FIELDS']) : '';
if ($arParams['SIZE_TABLE_USER_FIELDS'] === '-')
{
	$arParams['SIZE_TABLE_USER_FIELDS'] = '';
}

$arParams['SIZE_TABLE_PROP'] = isset($arParams['SIZE_TABLE_PROP']) ? trim($arParams['SIZE_TABLE_PROP']) : '';
if ($arParams['SIZE_TABLE_PROP'] === '-')
{
	$arParams['SIZE_TABLE_PROP'] = '';
}

if (!isset($params['PROPS_ATTRIBUTES_SIZE']))
{
	$params['PROPS_ATTRIBUTES_SIZE'] = array();
}
elseif (!is_array($params['PROPS_ATTRIBUTES_SIZE']))
{
	$params['PROPS_ATTRIBUTES_SIZE'] = array($params['PROPS_ATTRIBUTES_SIZE']);
}

foreach ($params['PROPS_ATTRIBUTES_SIZE'] as $key => $value)
{
	$value = (string)$value;
	if ($value == '' || $value === '-')
	{
		unset($params['PROPS_ATTRIBUTES_SIZE'][$key]);
	}
}

// /Get sorted properties
if (!empty($arResult))
{
    $arElementsIDs = array($arResult['ID']);
    
    if (is_array($arResult['OFFERS']) && count($arResult['OFFERS']) > 0) {
        foreach ($arResult['OFFERS'] as $iOfferKey => $arOffer) {
			// USE_PRICE_COUNT fix
            if (!in_array($arOffer['ID'], $arElementsIDs)) {
                $arElementsIDs[] = $arOffer['ID'];
            } else {
              unset($arResult['OFFERS'][$iOfferKey]);  
            }
        }
    }
    
	if (is_array($arResult['OFFERS']) && count($arResult['OFFERS']) > 0) {
		// Get sorted properties
		$arResult['OFFERS_EXT'] = RSDevFuncOffersExtension::GetSortedProperties($arResult['OFFERS'],$arParams['PROPS_ATTRIBUTES']);
	}
	
	// compare URL fix
	$arResult['COMPARE_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPageParam('action=ADD_TO_COMPARE_LIST&id='.$arItem['ID'], array('action', 'id', 'ajaxpages', 'ajaxpagesid')));
	if ($arParams['USE_PRICE_COUNT']) {
		$arPriceTypeID = array();
		foreach ($arResult['CAT_PRICES'] as $value) {
			$arPriceTypeID[] = $value['ID'];
		}
    }
    
	// get other data
	$params = array(
		'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
		'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
		'MAX_WIDTH' => 90,
		'MAX_HEIGHT' => 90,
		'PAGE' => 'detail',
		'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
		'FILTER_PRICE_TYPES' => $arPriceTypeID,
		'CURRENCY_PARAMS' => $arResult['CONVERT_CURRENCY'],
	);
    
	$arItems = array(0 => &$arResult);
	RSDevFunc::GetDataForProductItem($arItems, $params);
	
	// get no photo
	$arResult['NO_PHOTO'] = RSDevFunc::GetNoPhoto(array('MAX_WIGHT' => 210, 'MAX_HEIGHT' => 140));
	
	// quantity for bitrix:catalog.store.amount
	$arQuantity[$arResult['ID']] = $arResult['CATALOG_QUANTITY'];
	foreach ($arResult['OFFERS'] as $key => $arOffer) {
		$arQuantity[$arOffer['ID']] = $arOffer['CATALOG_QUANTITY'];
	}
	$arResult['DATA_QUANTITY'] = $arQuantity;
	
	// get SKU_IBLOCK_ID
	$arResult['OFFERS_IBLOCK'] = 0;
	$arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
	if (!empty($arSKU) && is_array($arSKU)) {
		$arResult['OFFERS_IBLOCK'] = $arSKU['IBLOCK_ID'];
	}
	
	// QB and DA2
	$arResult['HAVE_DA2'] = 'N';
	$arResult['HAVE_QB'] = 'N';
	if (is_array($arResult['OFFERS']) && count($arResult['OFFERS']) > 0) {
		foreach ($arResult['OFFERS'] as $arOffer) {
			if (isset($arOffer['DAYSARTICLE2'])) {
				$arResult['HAVE_DA2'] = 'Y';
			}
			if (isset($arOffer['QUICKBUY'])) {
				$arResult['HAVE_QB'] = 'Y';
			}
			
		}
	}
	if (isset($arResult['DAYSARTICLE2'])) {
		$arResult['HAVE_DA2'] = 'Y';
	}
	if (isset($arResult['QUICKBUY'])) {
		$arResult['HAVE_QB'] = 'Y';
	}
	// /QB and DA2
}


// tabs
$arResult['TABS'] = array(
	'DETAIL_TEXT' => false,				// description
	'DISPLAY_PROPERTIES' => false,		// grouped props
	'SET' => false,						// set
	'PROPS_TABS' => false,				// tabs from properties
	'DELIVERY_COST' => false,			// delivery cost
	'STOCKS' => false,					// stocks
);
if ($arResult['HAVE_SET']) {
	$arResult['TABS']['SET'] = true;
}
$arResult['OFFERS_PROP'] = array();
if (is_array($arResult['OFFERS']) && count($arResult['OFFERS']) > 0) {
	foreach ($arResult['OFFERS'] as $arOffer) {
		foreach ($arOffer['DISPLAY_PROPERTIES'] as $key1 => $arProp) {
			$arResult['OFFERS_PROP'][$key1] =  $arProp;
		}
		if ($arOffer['HAVE_SET']) {
			$arResult['TABS']['SET'] = true;
			break;
		}
	}
}

// tab - detail text
if ($arResult['DETAIL_TEXT'] != '')  {
	$arResult['TABS']['DETAIL_TEXT'] = true;
}

// tab - properties
$arTemp = array();
if (is_array($arParams['PROPS_TABS']) && count($arParams['PROPS_TABS']) > 0) {
    foreach ($arParams['PROPS_TABS'] as $sPropCode) {
        $arTemp[$sPropCode] = $sPropCode;
    }
}
if (is_array($arParams['STICKERS_PROPS']) && count($arParams['STICKERS_PROPS']) > 0) {
    foreach ($arParams['STICKERS_PROPS'] as $sPropCode) {
         $arTemp[$sPropCode] = $sPropCode;
     }
}
if ($arParams['PROP_STORE_REPLACE_SECTION'] != '') {
    $arTemp[$arParams['PROP_STORE_REPLACE_SECTION']] = $arParams['PROP_STORE_REPLACE_SECTION'];
}
if ($arParams['PROP_STORE_REPLACE_DETAIL'] != '') {
     $arTemp[$arParams['PROP_STORE_REPLACE_DETAIL']] = $arParams['PROP_STORE_REPLACE_DETAIL'];
}
if ($arParams['PROP_BRAND'] != '') {
	$arTemp[$arParams['PROP_BRAND']] = $arParams['PROP_BRAND'];
}
$arDisplyProps = array_diff_key($arResult['DISPLAY_PROPERTIES'], $arTemp);
if (!empty($arDisplyProps)) {
	$arResult['TABS']['DISPLAY_PROPERTIES'] = true;
}

// tab - delivery cost
if ($arParams['USE_DELIVERY_COST_TAB'] == 'Y') {
	$arResult['TABS']['DELIVERY_COST'] = true;
}

// tab - stocks
if ($arParams['USE_STORE'] == 'Y' && $arParams['SHOW_GENERAL_STORE_INFORMATION'] != 'Y') {
	$arResult['TABS']['STOCKS'] = true;
}

// tab - properties like tabs
if (is_array($arParams['PROPS_TABS']) && count($arParams['PROPS_TABS']) > 0)
{
	$arDiff = array(
		$arParams['PROP_BRAND'],
		$arParams['RATING_PROP_COUNT'],
		$arParams['RATING_PROP_SUM'],
		$arParams['STICKERS_PROPS'],
		$arParams['PROP_PRICES_NOTE'],
		$arParams['PROP_STORE_REPLACE_SECTION'],
		$arParams['PROP_STORE_REPLACE_DETAIL'],
	);
	$arParams['PROPS_TABS'] = array_diff($arParams['PROPS_TABS'], $arDiff);
	foreach ($arParams['PROPS_TABS'] as $sPropCode) {
		if (
			$sPropCode != '' &&
			(
				(isset($arResult['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE'])) ||
				($arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE'] == 'F' && isset($arResult['PROPERTIES'][$sPropCode]['VALUE'])) ||
				($arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE'] == 'E' && isset($arResult['PROPERTIES'][$sPropCode]['VALUE']))
			)
		) {
			$arResult['TABS']['PROPS_TABS'] = true;
			if ($arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE'] == 'F') {
				if (is_array($arResult['PROPERTIES'][$sPropCode]['VALUE'])) {
					foreach ($arResult['PROPERTIES'][$sPropCode]['VALUE'] as $keyF => $fileID) {
						$rsFile = CFile::GetByID($fileID);
						if ($arFile = $rsFile->Fetch()) {
							$arResult['PROPERTIES'][$sPropCode]['VALUE'][$keyF] = $arFile;
							$arResult['PROPERTIES'][$sPropCode]['VALUE'][$keyF]['FULL_PATH'] = '/upload/'.$arFile['SUBDIR'].'/'.$arFile['FILE_NAME'];
							$tmp = explode('.', $arFile['FILE_NAME']);
							$tmp = end($tmp);
							$type = 'undefined';
							$type2 = '';
							switch ($tmp) {
								case 'docx':
									$type = 'docx';
									break;
								case 'doc':
									$type = 'doc';
									break;
								case 'pdf':
									$type = 'pdf';
									break;
								case 'xls':
									$type = 'xls';
									break;
								case 'xlsx':
									$type = 'xlsx';
									break;
							}
							$arResult['PROPERTIES'][$sPropCode]['VALUE'][$keyF]['TYPE'] = $type;
							$arResult['PROPERTIES'][$sPropCode]['VALUE'][$keyF]['SIZE'] = CFile::FormatSize($arFile['FILE_SIZE'],1);
						}
					}
				} else {
					$fileID = $arResult['PROPERTIES'][$sPropCode]['VALUE'];
					$rsFile = CFile::GetByID($fileID);
					if ($arFile = $rsFile->Fetch()) {
						$arResult['PROPERTIES'][$sPropCode]['VALUE'] = array();
						$arResult['PROPERTIES'][$sPropCode]['VALUE'][0] = $arFile;
						$arResult['PROPERTIES'][$sPropCode]['VALUE'][0]['FULL_PATH'] = '/upload/'.$arFile['SUBDIR'].'/'.$arFile['FILE_NAME'];
						$tmp = explode('.', $arFile['FILE_NAME']);
						$tmp = end($tmp);
						$type = 'other';
						$type2 = '';
						switch($tmp){
							case 'doc':
							case 'docx':
								$type = 'doc';
								break;
							case 'xls':
							case 'xlsx':
								$type = 'excel';
								break;
							case 'pdf':
								$type = 'pdf';
								break;
						}
						$arResult['PROPERTIES'][$sPropCode]['VALUE'][0]['TYPE'] = $type;
						$arResult['PROPERTIES'][$sPropCode]['VALUE'][0]['SIZE'] = CFile::FormatSize($arFile['FILE_SIZE'],1);
					}
				}
			}
		}
	}
}

// social icons
$shareIcons = '';
foreach ($arParams['SOC_SHARE_ICON'] as $arShare) {
	$shareIcons .= $arShare.',';
}
$arResult['SHARE_SOC'] = $shareIcons;

// brands
if (!empty($arParams['PROP_BRAND']) && !empty($arResult['PROPERTIES'][$arParams['PROP_BRAND']]['VALUE']))
{
	$iblockBrands = (float) $arParams['BRAND_IBLOCK_BRANDS'];
	if ($arParams['BRAND_DETAIL_SHOW_LOGO'] == 'Y' && $iblockBrands > 0 && !empty($arParams['BRAND_IBLOCK_BRANDS_PROP_BRAND'])) {
		$maxWidthSize = (!empty($arParams['BRAND_DETAIL_IMG_SIZE_W']) ? $arParams['BRAND_DETAIL_IMG_SIZE_W'] : 50);
		$maxHeightSize = (!empty($arParams['BRAND_DETAIL_IMG_SIZE_H']) ? $arParams['BRAND_DETAIL_IMG_SIZE_H'] : 50);
		$arFilter = array(
			'IBLOCK_ID' => $iblockBrands,
			'ACTIVE' => 'Y',
			'=PROPERTY_'.$arParams['BRAND_IBLOCK_BRANDS_PROP_BRAND'] => $arResult['PROPERTIES'][$arParams['PROP_BRAND']]['VALUE'],
		);
		$arSelect = array('ID', 'IBLOCK_ID', 'ACTIVE', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_'.$arParams['BRAND_IBLOCK_BRANDS_PROP_BRAND'], 'DETAIL_PAGE_URL');
		$resBrands = \CIBlockElement::GetList(array(), $arFilter, false, array('nTopCount' => 1), $arSelect);
		if ($arBrandFields = $resBrands->GetNext()) {
			$arResult['RS_GOPRO_BRAND'] = array(
				'DETAIL_PAGE_URL' => $arBrandFields['DETAIL_PAGE_URL'],
				'IMAGE' => \CFile::ResizeImageGet(
					$arBrandFields['PREVIEW_PICTURE'],
					array('width' => $maxWidthSize, 'height' => $maxHeightSize),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true
				),
			);
		}
	}
}

$arResult['GOPRO_IMPORTANT_PROPS'] = false;
if (!empty($arParams['IMPORTANT_PROPS'])) {
	foreach ($arParams['IMPORTANT_PROPS'] as $code) {
		if (!empty($arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE'])) {
			$arResult['GOPRO_IMPORTANT_PROPS'] = true;
			break;
		}
	}
}

// size table
if ($arParams['SHOW_SIZE_TABLE'] == 'Y')
{
	if ($arParams['SIZE_TABLE_PROP'] != '' && !empty($arResult['PROPERTIES'][$arParams['SIZE_TABLE_PROP']]['VALUE']))
	{
		$arResult['SIZE_TABLE'] = (int)$arResult['PROPERTIES'][$arParams['SIZE_TABLE_PROP']]['VALUE'];
	}
	elseif ($arParams['SIZE_TABLE_USER_FIELDS'] != '' && !empty($arResult['SECTION']['PATH']))
	{
		$arSections = array();
		foreach ($arResult['SECTION']['PATH'] as $key => $arSection)
		{
			$arSections[$arSection['ID']] = &$arResult['SECTION']['PATH'][$key];
		}
		unset($key, $arSection);

		if (count($arSections) > 0)
		{
			$sectionIterator = \CIBlockSection::GetList(
				array(
					'DEPTH_LEVEL' => 'DESC',
				),
				array(
					'IBLOCK_ID' => $arResult['SECTION']['IBLOCK_ID'],
					'ID' => array_keys($arSections),
				),
				false,
				array(
					'ID',
					'NAME	',
					'DEPTH_LEVEL',
					$arParams['SIZE_TABLE_USER_FIELDS'],
				)
			);

			while ($arSection = $sectionIterator->GetNext())
			{
				if (!empty($arSection[$arParams['SIZE_TABLE_USER_FIELDS']]))
				{
					$arResult['SIZE_TABLE'] = (int)$arSection[$arParams['SIZE_TABLE_USER_FIELDS']];
					break;
				}
			}
			unset($sectionIterator, $arSection);
		}
	}

	if ($arResult['SIZE_TABLE'] > 0)
	{
		$elementIterator = \CIBlockElement::GetList(
			array(),
			array(
				// 'IBLOCK_ID' => $this->arParams['LINK_IBLOCK_ID'],
				'IBLOCK_ACTIVE' => 'Y',
				'ACTIVE_DATE' => 'Y',
				'ACTIVE' => 'Y',
				'CHECK_PERMISSIONS' => 'Y',
				// 'IBLOCK_TYPE' => $this->arParams['LINK_IBLOCK_TYPE'],
				'=ID' => $arResult['SIZE_TABLE'],
				'!PREVIEW_TEXT' => '',
			),
			false,
			false,
			array(
				'ID',
				'IBLOCK_ID',
				'NAME',
				'PREVIEW_TEXT',
				'DETAIL_PAGE_URL',
			)
		);

		if ($arElement = $elementIterator->GetNext())
		{
			$arResult['SIZE_TABLE'] = $arElement;
		}
		unset($elementIterator, $arElement);
	}

	if (empty($arResult['SIZE_TABLE']['PREVIEW_TEXT']))
	{
		unset($arResult['SIZE_TABLE']);
	}
}

// add cache keys
$cp = $this->__component;
if (is_object($cp)) {
	$cp->SetResultCacheKeys(array('PREVIEW_PICTURE', 'DETAIL_PICTURE', 'RS_GOPRO_BRAND', 'GOPRO_IMPORTANT_PROPS'));
}
