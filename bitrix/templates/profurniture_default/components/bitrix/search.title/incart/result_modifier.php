<?php 
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
	die();
}

if (
	!\Bitrix\Main\Loader::includeModule('catalog') ||
	!\Bitrix\Main\Loader::includeModule('iblock')
)
{
	return;
}

if (!isset($arParams['CATALOG_ACTION_VARIABLE']))
{
    $arParams['CATALOG_ACTION_VARIABLE'] = 'action';
}


if (!isset($arParams['CATALOG_PRODUCT_ID_VARIABLE']))
{
    $arParams['CATALOG_PRODUCT_ID_VARIABLE'] = 'id';
}

$arCatalogs = [];
$rsCatalog = CCatalog::GetList(array(
	"sort" => "asc",
));

while($arCatalog = $rsCatalog->GetNext())
{
	$arCatalogs[$arCatalog['ID']] = $arCatalog;
}

$arResult['ITEMS'] = array();
foreach($arResult["CATEGORIES"] as $sCategoryId => $arCategory)
{
	foreach ($arCategory["ITEMS"] as $nIndex => $arItem) 
	{
		if (
			isset($arItem['ITEM_ID']) && 
			$arItem['MODULE_ID'] == 'iblock' &&
			substr($arItem["ITEM_ID"], 0, 1) !== "S"
		)
		{
			$nIblockId = $arItem["PARAM2"];

			if (array_key_exists($nIblockId, $arCatalogs))
			{
				$arResult['ITEMS'][$arItem['ITEM_ID']] = [
					'id' => $arItem['ITEM_ID'],
					'iblock' => $nIblockId,
					'phrase' => $arItem['NAME']
				];
			}
		}
	}

	unset($nIndex, $arItem);
}

if (count($arResult['ITEMS']) > 0)
{
    $sPreviewWidth = 75;
    $sPreviewHeight = 75;

	/* remove items without sku */
	$arOffersExist = CCatalogSKU::getExistOffers(array_keys($arResult['ITEMS']));
	if ($arOffersExist)
	{
		foreach ($arOffersExist as $nItemId => $hasOffers)
		{
            if (isset($arResult['ITEMS'][$nItemId]))
            {
                $arResult['ITEMS'][$nItemId]['hasOffers'] = $hasOffers;
            }

			if ($hasOffers)
			{
				// unset($arResult['ITEMS'][$nItemId]);
			}
		}
	}

    $arItemIds = array_keys($arResult['ITEMS']);
    
	$arConvertParams = array();
	if ('Y' == $arParams['CONVERT_CURRENCY'])
	{
		if (!CModule::IncludeModule('currency'))
		{
			$arParams['CONVERT_CURRENCY'] = 'N';
			$arParams['CURRENCY_ID'] = '';
		}
		else
		{
			$arCurrencyInfo = CCurrency::GetByID($arParams['CURRENCY_ID']);
			if (!(is_array($arCurrencyInfo) && !empty($arCurrencyInfo)))
			{
				$arParams['CONVERT_CURRENCY'] = 'N';
				$arParams['CURRENCY_ID'] = '';
			}
			else
			{
				$arParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
				$arConvertParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
			}
		}
    }
    
    $fnGetImage = function ($arItem) {
        if ($arItem["PREVIEW_PICTURE"] > 0)
        {
            return CFile::ResizeImageGet(
                $arItem['PREVIEW_PICTURE'],
                array(
                    'width' => $sPreviewWidth,
                    'height' => $sPreviewHeight
                ),
                BX_RESIZE_IMAGE_PROPORTIONAL, 
                true
            );
        }
        elseif ($arItem['DETAIL_PICTURE'] > 0)
        {
            return CFile::ResizeImageGet(
                $arItem['DETAIL_PICTURE'],
                array(
                    'width' => $sPreviewWidth,
                    'height' => $sPreviewHeight
                ),
                BX_RESIZE_IMAGE_PROPORTIONAL, 
                true
            );
        }

        return null;
    };

	if (is_array($arParams["PRICE_CODE"]))
	{
		$arPrices = CIBlockPriceTools::GetCatalogPrices(0, $arParams["PRICE_CODE"]);
	}
	else
	{
		$arPrices = array();
	}

	$arSelect = array(
		"ID",
		"NAME",
		"IBLOCK_ID",
		"PREVIEW_TEXT",
		"PREVIEW_PICTURE",
		"DETAIL_PICTURE",
        "DETAIL_PAGE_URL",
        "SECTION_PAGE_URL",
        "PROPERTY_CML2_LINK"
	);
	
	$arFilter = array(
		"IBLOCK_LID" => SITE_ID,
		"IBLOCK_ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"MIN_PERMISSION" => "R",
	);
	
	foreach($arPrices as $arPrice)
	{
		if (!$arPrice['CAN_VIEW'] && !$arPrice['CAN_BUY'])
		{
			continue;
		}

		$arSelect[] = $arPrice["SELECT"];
		$arFilter["CATALOG_SHOP_QUANTITY_".$arPrice["ID"]] = 1;
	}
	
	$arFilter["=ID"] = $arItemIds;

	$rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	while($arItem = $rsElements->GetNext())
	{
        $nItemId = $arItem['ID'];
        
		/* Get item name */ 
        $arResult['ITEMS'][$nItemId]['name'] = $arItem['~NAME'];
        
        // offer
        $arResult['ITEMS'][$nItemId]['isOffer'] = !empty($arItem['PROPERTY_CML2_LINK_VALUE']);
        if ($arResult['ITEMS'][$nItemId]['isOffer'])
        {
            $arResult['ITEMS'][$nItemId]['parentId'] = $arItem['PROPERTY_CML2_LINK_VALUE'];
        }

		/* Get item prices */
		$arItemPrices = CIBlockPriceTools::GetItemPrices(
			$arItem["IBLOCK_ID"], 
			$arPrices,
			$arItem, 
			$arParams['PRICE_VAT_INCLUDE'], 
			$arConvertParams
		);

		$arItemMinPrice = CIBlockPriceTools::getMinPriceFromList($arItemPrices);

		if ($arItemMinPrice)
		{
			$arResult['ITEMS'][$nItemId]['price'] = $arItemMinPrice['PRINT_DISCOUNT_VALUE'];
			$arResult['ITEMS'][$nItemId]['priceValue'] = $arItemMinPrice['DISCOUNT_VALUE'];
		}

		/* Detail page */
		$arResult['ITEMS'][$nItemId]['pageUrl'] = $arItem['DETAIL_PAGE_URL'];

        /* Get item picture */
        if ($arItem["PREVIEW_PICTURE"] > 0)
        {
            $arResult['ITEMS'][$nItemId]['picture'] = CFile::ResizeImageGet(
                $arItem['PREVIEW_PICTURE'],
                array(
                    'width' => $sPreviewWidth,
                    'height' => $sPreviewHeight
                ),
                BX_RESIZE_IMAGE_PROPORTIONAL, 
                true
            );
        }
        elseif ($arItem['DETAIL_PICTURE'] > 0)
        {
            $arResult['ITEMS'][$nItemId]['picture'] = CFile::ResizeImageGet(
                $arItem['DETAIL_PICTURE'],
                array(
                    'width' => $sPreviewWidth,
                    'height' => $sPreviewHeight
                ),
                BX_RESIZE_IMAGE_PROPORTIONAL, 
                true
            );
        }
	}
}