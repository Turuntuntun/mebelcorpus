<?php 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use \Redsign\GoPro\BrandTools;

$sCatalogBindingType = BrandTools::getBindingType(
    $arParams['CATALOG_IBLOCK_ID'], 
    $arParams['CATALOG_BRAND_PROP']
);

$sBrandValue = BrandTools::getValue(
    $nBrandId,
    $arParams['IBLOCK_ID'],
    $sCatalogBindingType,
    $arParams['BRAND_PROP']
);

$arBrandInfo = BrandTools::getInfo($nBrandId);

$arSections = BrandTools::getSections(
    $sBrandValue,
    $arParams['CATALOG_BRAND_PROP'],
    $arParams['CATALOG_IBLOCK_ID'], 
    $APPLICATION->GetCurPageParam("section=#SECTION_ID#", array('section'))
);

?><div class="brand-detail"><?
    if (count($arSections) > 0)
    {
        ?><div class="brand-detail__sections"><?
            foreach ($arSections as $arSection)
            {
                ?><a href="<?=$arSection['PAGE_URL']?>" class="btn btn-default brand-detail__sections-section"><?=$arSection['NAME']?></a><?
            } 
        ?></div><?
    }

    ?><div class="brand-detail__desc"><?
        $elementId = $APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "",
            array(
                "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                "DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
                "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
                "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "META_KEYWORDS" => $arParams["META_KEYWORDS"],
                "META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
                "BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
                "SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
                "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                "SET_LAST_MODIFIED" => 'N',//$arParams["SET_LAST_MODIFIED"],
                // on filter ajax request
                // Warning: Cannot modify header information - headers already sent by (output started at \bitrix\components\bitrix\catalog.smart.filter\component.php:902)
                // in \bitrix\modules\main\lib\httpresponse.php on line 99
                "SET_TITLE" => $arParams["SET_TITLE"],
                "MESSAGE_404" => $arParams["MESSAGE_404"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "SHOW_404" => $arParams["SHOW_404"],
                "FILE_404" => $arParams["FILE_404"],
                "INCLUDE_IBLOCK_INTO_CHAIN" => 'N',
                "ADD_SECTIONS_CHAIN" => 'N',
                "ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                "DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
                "PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
                "CHECK_DATES" => $arParams["CHECK_DATES"],
                "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
                "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
                "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                "USE_SHARE" => $arParams["USE_SHARE"],
                "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                "ADD_ELEMENT_CHAIN" => 'Y'
            ),
            $component
        );
    ?></div><?

    ?><div class="brands-backshare"><?

        ?><div class="brands-backshare__share"><?
            if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/ya-share.php', $getTemplatePathPartParams)))
            {
                include($path);
            }
        ?></div><?

        ?><div class="brands-backshare__back"><?
            ?><a href="<?=$arResult['FOLDER']?>"><?=Loc::getMessage('RS_N_BRAND_BACK')?></a><?
        ?></div><?
        
    ?></div><?

    ?><div class="brand-detail__collections"><?

        $sBindingType = BrandTools::getBindingType(
            $arParams['COLLECTION_IBLOCK_ID'], 
            $arParams['COLLECTION_BRAND_PROP']
        );

        global $arCollectionsFilter;
        $arCollectionsFilter = [];
        $arCollectionsFilter['=PROPERTY_'.$arParams['COLLECTION_BRAND_PROP']] = 
            ($sBindingType == BrandTools::BINDING_TYPE_HIGHLOAD ? $sBrandValue : $nBrandId);

        $APPLICATION->IncludeFile(
            SITE_DIR.'include/brands/collections.php',
            array(
                'IBLOCK_TYPE' => $arParams['COLLECTION_IBLOCK_TYPE'],
                'IBLOCK_ID' => $arParams['COLLECTION_IBLOCK_ID'],
                'PRICE_CODE' => $arParams['CATALOG_PRICE_CODE'],
                'BLOCK_NAME' => Loc::getMessage('RS_N_BRAND_COLLECTION', ["#BRAND_NAME#" => $arBrandInfo['NAME']])
            )
        );
    ?></div><?

?></div><?


global ${$arParams['CATALOG_FILTER_NAME']};
${$arParams['CATALOG_FILTER_NAME']} = [];
${$arParams['CATALOG_FILTER_NAME']}['=PROPERTY_'.$arParams['CATALOG_BRAND_PROP']] = $sBrandValue;

$APPLICATION->IncludeFile(
    SITE_DIR.'include/brands/popular.php',
    array(
        'IBLOCK_TYPE' => $arParams['CATALOG_IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'],
        'PRICE_CODE' => $arParams['CATALOG_PRICE_CODE'],
        'FILTER_NAME' => $arParams['CATALOG_FILTER_NAME'],
        'BLOCK_NAME' => Loc::getMessage('RS_N_BRAND_POPULAR', ["#BRAND_NAME#" => $arBrandInfo['NAME']])
    )
);