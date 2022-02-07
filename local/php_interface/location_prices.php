<?php
/**
 * Обработчик события, вызываемое в методе CCatalogProduct::GetOptimalPrice.
 * Позволяет заменить стандартный метод выборки наименьшей цены для товара
 *
 * Применяет товару тип цены @param $base_price
 * (c) 2019
*/

// require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/location_new.php');



if (CModule::IncludeModule("iblock")) {
    function getRegionUser()
    {
        $elem = CIBlockElement::getById(UserCity::getSessionCity())->getNextElement();

            $result['PROPS'] = $elem-> GetProperties();
            $result['FIELDS'] =  $elem-> GetFields();
        return $result;

    }
    $GLOBALS['UF_USER_REGION'] = getRegionUser();
}


AddEventHandler("catalog", "OnGetOptimalPrice", "ProGetOptimalPrice");

// Bitrix\Main\EventManager::getInstance()->addEventHandler('sale', 'OnSaleComponentOrderJsData', 'OnSaleComponentOrderJsDataHandler');

// function OnSaleComponentOrderJsDataHandler(&$arResult, &$arParams)
// {
//     echo "<pre>";
//     var_dump($arResult['JS_DATA']);
//     die();
// }

function ProGetOptimalPrice($intProductID, $quantity = 1, $arUserGroups = array(), $renewal = "N", $arPrices = array(), $siteID = false, $arDiscountCoupons = false)
{

    //выбирает тип Цены от Местоположения
    // if (CSite::InDir('/bitrix/admin/'))
    // 	$arBaseGroup = CCatalogGroup::GetBaseGroup();
    // else
    // 	$arBaseGroup = ProGetLocalPrice();
    //    $base_price = $arBaseGroup["ID"];

    // global $USER;
    $arActualPrice = array();
    // $min = 0;

    //  $city_prices = [
    //    '64460' => [
    //       'opt' => 14,
    //       'retail' => 13,
    //    ], //SPB
    //    '64459' => [
    //       'opt' => 16,
    //       'retail' => 15,
    //    ], //Moscow
    //    '64505' => [
    //       'opt' => 18,
    //       'retail' => 17,
    //    ], //Krasnodar
    // ];

    //  if (isset($city_prices[$GLOBALS['UF_USER_REGION']['FIELDS']['ID']])) {
    //      $prices = $city_prices[$GLOBALS['UF_USER_REGION']['FIELDS']['ID']];
    //  } else {
    //      return false;
    //  }

    $retail_price_type = $GLOBALS['UF_USER_REGION']['PROPS']['RETAIL_PRICE_TYPE_CODE']['VALUE'];
    $opt_price_type = $GLOBALS['UF_USER_REGION']['PROPS']['OPT_PRICE_TYPE_CODE']['VALUE'];
    $user_groups = \Bitrix\Main\Engine\CurrentUser::get()->getUserGroups();

    $is_opt_user = false;
    if ( in_array('10', $user_groups) ) {
        $is_opt_user = true;
    }

    $dbPriceType = CCatalogGroup::GetList();
    $price_types_map = [];



    while ($arPriceType = $dbPriceType->Fetch()) {
        $price_types_map[$arPriceType['ID']] = [
            'NAME' => $arPriceType['NAME'],
            'PRICE' => 0,
        ];
    }


    $price_result = CPrice::GetList(
        array(),
        array(
                "PRODUCT_ID" => $intProductID,
            )
    );
    while ($arPrices = $price_result->Fetch()) {
        $price_types_map[$arPrices['CATALOG_GROUP_ID']]['PRICE'] = $arPrices['PRICE'];
    }

    $new_price_types_map = [];
    foreach ($price_types_map as $ID => $price_type) {
        $new_price_types_map[$price_type['NAME']] = [
            'ID' => $ID,
            'PRICE' => $price_type['PRICE']
        ];
    }

    if ( $is_opt_user ) {
        if ( isset($new_price_types_map[$opt_price_type]) && $new_price_types_map[$opt_price_type]['PRICE'] ) {
            $active_price_id = $new_price_types_map[$opt_price_type]['ID'];
        } elseif (isset($new_price_types_map['Opt']) && $new_price_types_map['Opt']['PRICE']) {
            $active_price_id = $new_price_types_map['Opt']['ID'];
        } else {
            $active_price_id = $new_price_types_map['BASE']['ID'];
        }
    } else {
        if ( isset($new_price_types_map[$retail_price_type]) && $new_price_types_map[$retail_price_type]['PRICE'] ) {
            $active_price_id = $new_price_types_map[$retail_price_type]['ID'];
        } else {
            $active_price_id = $new_price_types_map['BASE']['ID'];
        }
    }

    // echo "<pre>";
    // var_dump($new_price_types_map[$opt_price_type]);


    // if (isset($new_price_types_map[$retail_price_type]) && $new_price_types_map[$retail_price_type]['PRICE']
    //     || isset($new_price_types_map[$opt_price_type]) && $new_price_types_map[$opt_price_type]['PRICE']) {
    //     $active_price_id = in_array('10', $user_groups) ? $new_price_types_map[$opt_price_type]['ID'] : $new_price_types_map[$retail_price_type]['ID'];
    // } else {
    //     $active_price_id = in_array('10', $user_groups) ? $new_price_types_map['opt']['ID'] : $new_price_types_map['BASE']['ID'];
    // }


    //Выбирает цену товара в соответствии с выбраным типом цен
    $dbProductPrice = CPrice::GetListEx(array(), array( "PRODUCT_ID" => $intProductID, "CATALOG_GROUP_ID" => $active_price_id), false, false, array());
    if ($arProducPrice = $dbProductPrice->GetNext()) {
        $arActualPrice = $arProducPrice;
    }


    // Ищем скидки и высчитываем стоимость с учетом найденных
    //$arDiscounts = CCatalogDiscount::GetDiscountByPrice( $arActualPrice["ID"], $USER->GetUserGroupArray(), "N", SITE_ID );
    $discountPrice = CCatalogProduct::CountPriceWithDiscount($arActualPrice["PRICE"], $arActualPrice["CURRENCY"], $arDiscounts);

    return array(
      'PRICE' => array(
         'CATALOG_GROUP_ID' => $prices['retail'],
         'PRICE' =>  $discountPrice,
         'CURRENCY' => $arActualPrice["CURRENCY"],
      )
   );
}
