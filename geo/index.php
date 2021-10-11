<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>

<?$APPLICATION->IncludeComponent(
	"redsign:buy1click", 
	"gopro", 
	array(
		"ALFA_EMAIL_TO" => "",
		"SHOW_FIELDS" => array(
			0 => "20",
			1 => "21",
			2 => "22",
		),
		"REQUIRED_FIELDS" => array(
			0 => "20",
			1 => "21",
			2 => "22",
		),
		"ALFA_USE_CAPTCHA" => "Y",
		"ALFA_MESSAGE_AGREE" => "Ваша заявка принята! В ближайшее время с вами свяжется наш консультант.",
		"DATA" => "",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "gopro",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"YM_USE_TARGETS" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ALFA_SALE_PERSON" => "3",
		"ALFA_SITE_ID" => "sm"
	),
	false
);?>

<pre>
<?
/*
use \Bitrix\Main\Localization\Loc;
use \Redsign\DevFunc\Sale\Location\Location;

\Bitrix\Main\Loader::includeModule('sale');


$arMyLocation = Location::getMyCity();
$locationId = $arMyLocation["ID"];

$arVal = CSaleLocation::GetByID($locationId, LANGUAGE_ID);
print_r($arVal);
*/

/*
CModule::IncludeModule("catalog");
$arBaseGroup = CCatalogGroup::GetBaseGroup();
$arNewBaseGroup = ProGetLocalPrice();

//выбирает все товары
$db_res = CCatalogProduct::GetList(array(),array(),false, false, array("ID"));
while ($ar_res = $db_res->Fetch())
{
    $arProduct[$ar_res["ID"]] = $ar_res["ID"];

   //выбирает все цены товара
   $arPriceTable = array();
   $dbPrice = CPrice::GetListEx(
      array("QUANTITY_FROM" => "asc"), 
      array(
         "PRODUCT_ID" => $ar_res["ID"], 
         "CATALOG_GROUP_ID" => $arBaseGroup["ID"]
      ),
      false,
      false,
      array()
   );
   while ($tablePrice = $dbPrice->Fetch()) {
      $arPriceTable[] = $tablePrice;//сохраняет цену
   }

   $arPrice = array_shift($arPriceTable);//новая цена
   $arLoadPrice = array(
      "PRODUCT_ID" => $arPrice["PRODUCT_ID"],
      "CATALOG_GROUP_ID" => $arNewBaseGroup["ID"],
      "PRICE" => $arPrice["PRICE"],
      "CURRENCY" => $arPrice["CURRENCY"],
   );
	//CPrice::Add($arLoadPrice);//создает цену без ограничения по количеству
	echo "ID=".$ar_res["ID"]." добавлена цена =".$arPrice["PRICE"]."<br>";

}
*/
?>

<pre>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>