<?php 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Redsign\GoPro\BrandTools;

$arBrandInfo = BrandTools::getInfo($nBrandId);

if (isset($arBrandInfo['DETAIL_PAGE_URL']))
{
    $APPLICATION->AddChainItem($arBrandInfo['NAME'], $arBrandInfo['DETAIL_PAGE_URL']);
}
else
{
    $APPLICATION->AddChainItem($arBrandInfo['NAME'], $arBrandInfo['NAME']);
}

if (isset($arSection['NAME']))
{
    $APPLICATION->AddChainItem($arSection['NAME']);
}

$APPLICATION->SetTitle($arSection['NAME'].' '.$arBrandInfo['NAME']);


if (empty($arParams['AJAX_ID']) || strlen($arParams['AJAX_ID']) < 1)
{
	$arParams['AJAX_ID'] = CAjax::GetComponentID(
        $component->componentName, 
        $component->componentTemplate,
        $arParams['AJAX_OPTION_ADDITIONAL']
    );
}

$arBasePrice = Bitrix\Catalog\GroupTable::getRow(array(
    'filter' => array(
        'BASE' => 'Y'
    ),
    'select' => array(
        'ID'
    ),
    "cache" => array(
        "ttl" => 3600
    )
));

global ${$arParams['CATALOG_FILTER_NAME']};
${$arParams['CATALOG_FILTER_NAME']}['=PROPERTY_'.$arParams['CATALOG_BRAND_PROP']] = $sBrandValue;

$arCatalogParams = array(
    'IBLOCK_TYPE' => $arParams['CATALOG_IBLOCK_TYPE'],
    'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'],
    'PRICE_CODE' => $arParams['CATALOG_PRICE_CODE'],
    'FILTER_NAME' => $arParams['CATALOG_FILTER_NAME'],
    'BRAND_PROP' => $arParams['CATALOG_BRAND_PROP'],
    'BRAND_VALUE' => $sBrandValue,
    'AJAX_ID' => $arParams['AJAX_ID']
); 
?>
<div class="catalog clearfix" id="catalog">
    <div class="sidebar">
        <?php
        $APPLICATION->IncludeFile(
            SITE_DIR.'include/brands/filter.php',
            $arCatalogParams
        );
        ?>
    </div>
    <div class="prods" id="prods">
        
        <div class="mix clearfix">
            <?php 
            $APPLICATION->IncludeFile(
                SITE_DIR.'include/brands/sorter.php',
                $arCatalogParams + array(
                    'SORT_BY_NAME' => array('sort', 'name', 'CATALOG_PRICE_'.$arBasePrice['ID'])
                )
            );
            ?>
        </div>
        <div id="<?=$arParams['AJAX_ID']?>" class="ajaxpages_gmci clearfix">
            <?php
            global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput, $JSON;

            $isSorterChange = 'N';
            $isAjaxPages = 'N';

            if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST['sorterchange'] == $arParams['AJAX_ID']) 
            {
                $isSorterChange = 'Y';
                $JSON['TYPE'] = 'OK';
            }

            if ($_REQUEST['ajaxpages'] == 'Y' && $_REQUEST['ajaxpagesid'] == $arParams['AJAX_ID']) 
            {
                $isAjaxPages = 'Y';
                $JSON['TYPE'] = 'OK';
            }

            $APPLICATION->IncludeFile(
                SITE_DIR.'include/brands/section.php',
                $arCatalogParams + array(
                    'SORT_FIELD' => isset($alfaCSortType) ? $alfaCSortType : 'sort',
                    'SORT_ORDER' => isset($alfaCSortToo) ? $alfaCSortToo : 'asc',
                    'VIEW' => $alfaCTemplate,
                    'PAGE_ELEMENT_COUNT' => $alfaCOutput,
                    'SORT_FIELD2' => 'id',
                    'SORT_ORDER2' => 'desc',
                    'IS_SORTERCHANGE' => $isSorterChange,
                    'IS_AJAX_PAGES' => $isAjaxPages
                )
            );

            if ($isAjaxPages == 'Y' || $isSorterChange == 'Y') {
                $APPLICATION->RestartBuffer();
                echo \Bitrix\Main\Web\Json::encode($JSON);
                die();
            }
            ?>
        </div>
    </div>
</div>