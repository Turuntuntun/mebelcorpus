<?php
require($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');

ini_set("max_execution_time", "3600");

$IBLOCKID = 29;
$arSelect = Array("ID");
$res = CIBlockElement::GetList([], ['IBLOCK_ID' => $IBLOCKID], false, [], $arSelect);
$products_ids = [];

while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 array_push($products_ids, $arFields['ID']);
}


// foreach($products_ids as $products_id) {
// 	$product_infos = CCatalogProduct::GetByID($products_id);
// 	$el = new CIBlockElement;
// 	$PROP = [
// 		"SHIRINA"    => $product_infos["WIDTH"],
// 	  "VISOTA" => $product_infos["HEIGHT"],          
// 	  "GLUBINA"=> $product_infos["LENGTH"], //DLINA!!!!!
// 	  "VES"           => $product_infos["WEIGHT"],
// 	];

// 	$arLoadProductArray = Array(
// 	  "PROPERTY_VALUES" => $PROP,
// 	);
// 	$res = $el->Update($products_id, $arLoadProductArray);
// }


$offers = CCatalogSKU::getOffersList($products_ids,$IBLOCKID);
$new_products_prices = [];

foreach ($offers as $main_product_id => $product_offers) {
	// if ( $main_product_id != 135201 ) continue;
	foreach($product_offers as $product_offer) {
		$offer_id = $product_offer['ID'];
		$allProductPrices = \Bitrix\Catalog\PriceTable::getList([
		    "filter" => [
		        "PRODUCT_ID" => $offer_id,
		    ]
		])->fetchAll();
		foreach($allProductPrices as $product_price) {
			$new_products_prices[$main_product_id][$product_price['CATALOG_GROUP_ID']]['PRICE_ID'] = $product_price['CATALOG_GROUP_ID'];
			$new_products_prices[$main_product_id][$product_price['CATALOG_GROUP_ID']]['PRICE'] = $product_price['PRICE'];
		}
		// break;
	}
}

foreach($new_products_prices as $prodict_id => $prices) {
	foreach($prices as $price_id => $price_values) {
		$PRODUCT_ID = $prodict_id;
		$PRICE_TYPE_ID = $price_values['PRICE_ID'];

		$arFields = Array(
		    "PRODUCT_ID" => $PRODUCT_ID,
		    "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
		    "PRICE" =>(float) $price_values['PRICE'],
		    "CURRENCY"         => "RUB",
		);
		$res = CPrice::GetList(
	        array(),
	        array(
	                "PRODUCT_ID" => $PRODUCT_ID,
	                "CATALOG_GROUP_ID" => $PRICE_TYPE_ID
	            )
	    );
	    if ($arr = $res->Fetch())
		{
		    CPrice::Update($arr["ID"], $arFields);
		}
		else
		{
		    CPrice::Add($arFields);
		}
	}
}


?>