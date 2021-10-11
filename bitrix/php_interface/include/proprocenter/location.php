<?
/**
 * Возвращает Тип цены для выбранного Местоположения
 *
 * @param поле "XML_ID" Типа цены = "ID" города в таблице Местоположений
 *
 * (c) 2019
*/

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\LoaderException;
use \Bitrix\Main\Application;
use \Bitrix\Main\Web\Cookie;

Loc::loadMessages(__FILE__);

\Bitrix\Main\Loader::includeModule('sale');
//компонент redsign.master сохраняет сюда выбранный город
const COOKIE_NAME = 'RS_MY_LOCATION';

// Определяет город, сохраненный в cookie, компонентом redsign.master
function getProRSMyCity()
{
    $arResult = [];
    $sCity = Application::getInstance()->getContext()->getRequest()->getCookie(COOKIE_NAME);
    $arResult = unserialize($sCity);
    return $arResult;
}


// Единый тип цены для выбранного Местоположения
function ProGetLocalPrice()
{

    $arBaseGroup = [];
    $arMyLocation = getProRSMyCity();

    if ( $arMyLocation["ID"] > 0)
    {
        $arMyLocationRegion = CSaleLocation::GetByID( $arMyLocation["ID"], LANGUAGE_ID );
        $myRegion = $arMyLocationRegion["REGION_ID"] > 0 ? $arMyLocationRegion["REGION_ID"] : $arMyLocationRegion["CITY_ID"];
        if ( $myRegion > 0 )
        {
            $dbPriceType = CCatalogGroup::GetList(array(), array("XML_ID" =>  $myRegion));
            if ($arPriceType = $dbPriceType->Fetch())
                $arBaseGroup = $arPriceType;
        }
    }

    if (empty($arBaseGroup))
        $arBaseGroup = CCatalogGroup::GetBaseGroup();

    return $arBaseGroup;
}


// Имя типа цены (для параметров компонента)
function ProGetLocalPriceName()
{
    $arBaseGroup = ProGetLocalPrice();
    return $arBaseGroup["NAME"];
}


// Список товаров, у которых нет локальной цены
// @param $arItems масив ID товаров
function ProСheckLocalPrice($arItems)
{
    $arResult = [];
    $arBaseGroup = ProGetLocalPrice();
    $base_price = $arBaseGroup["ID"];

    //Выбирает цену товаров в соответствии с выбраным типом цен
    $dbProductPrice = CPrice::GetListEx( array(), array( "PRODUCT_ID" => $arItems, "CATALOG_GROUP_ID" => $base_price), false, false, array());
    while ($arProducPrice = $dbProductPrice->GetNext())
        $arResult[$arProducPrice["PRODUCT_ID"]] = $arProducPrice["PRODUCT_ID"];

    return array_diff($arItems, $arResult);
}

// Список городов, у которых есть цена на выбранный товар
// @param $id товара
function ProIsLocalPriceName($id)
{
    $arResult = [];
    $arBaseGroup = CCatalogGroup::GetBaseGroup();

    $dbProductPrice = CPrice::GetListEx( 
        array(), 
        array(
            "PRODUCT_ID" => $id,
            "!CATALOG_GROUP_ID" => $arBaseGroup["ID"]
        ), 
        false, 
        false, 
        array()
    );
    while ($arProducPrice = $dbProductPrice->GetNext())
        $arPriceCatalogGroup[$arProducPrice["CATALOG_GROUP_ID"]] = $arProducPrice["CATALOG_GROUP_ID"];

    if (!empty($arPriceCatalogGroup))
    {
        $dbPriceType = CCatalogGroup::GetList(
            array(),
            array(
                "ID" => $arPriceCatalogGroup,
                "!XML_ID" => false
            )
        );
        while ($arPriceType = $dbPriceType->Fetch())
            $arResult[$arPriceType["ID"]] = $arPriceType["NAME_LANG"];
    }

    return $arResult;
}
?>