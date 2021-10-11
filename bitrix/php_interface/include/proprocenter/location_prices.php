<?
/**
 * Обработчик события, вызываемое в методе CCatalogProduct::GetOptimalPrice.
 * Позволяет заменить стандартный метод выборки наименьшей цены для товара 
 *
 * Применяет товару тип цены @param $base_price
 * (c) 2019
*/

AddEventHandler("catalog", "OnGetOptimalPrice", "ProGetOptimalPrice");


function ProGetOptimalPrice( $intProductID, $quantity = 1, $arUserGroups = array(), $renewal = "N", $arPrices = array(), $siteID = false, $arDiscountCoupons = false )
{
    //выбирает тип Цены от Местоположения
	if (CSite::InDir('/bitrix/admin/'))
		$arBaseGroup = CCatalogGroup::GetBaseGroup();
	else
		$arBaseGroup = ProGetLocalPrice();
    $base_price = $arBaseGroup["ID"];

   global $USER;
   $arActualPrice = array();
   $min = 0;

   //Выбирает цену товара в соответствии с выбраным типом цен
   $dbProductPrice = CPrice::GetListEx( array(), array( "PRODUCT_ID" => $intProductID, "CATALOG_GROUP_ID" => $base_price), false, false, array());
   if ($arProducPrice = $dbProductPrice->GetNext())
   {
      $arActualPrice = $arProducPrice; 
   }


   // Ищем скидки и высчитываем стоимость с учетом найденных
   //$arDiscounts = CCatalogDiscount::GetDiscountByPrice( $arActualPrice["ID"], $USER->GetUserGroupArray(), "N", SITE_ID );
   $discountPrice = CCatalogProduct::CountPriceWithDiscount( $arActualPrice["PRICE"], $arActualPrice["CURRENCY"], $arDiscounts );

   return array(
      'PRICE' => array(
         'CATALOG_GROUP_ID' => $base_price,
         'PRICE' =>  $discountPrice,
         'CURRENCY' => $arActualPrice["CURRENCY"],
      )
   );
}
?>