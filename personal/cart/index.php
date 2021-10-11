<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>

<div class="pmenu">
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personal", 
	array(
		"ROOT_MENU_TYPE" => "personal",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"SEPARATORS_PLACE" => array(
			0 => "2",
			1 => "5",
			2 => "",
		),
		"COMPONENT_TEMPLATE" => "personal"
	),
	false
);?>
</div>

<div class="pcontent">
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	"sunduk", 
	array(
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "PRICE",
			5 => "QUANTITY",
			6 => "SUM",
		),
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"USE_PREPAYMENT" => "N",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"ACTION_VARIABLE" => "action",
		"OFFERS_PROPS" => array(
			0 => "COLOR",
		),
		"PROP_ARTICLE" => "CML2_ARTICLE",
		"PROP_SKU_ARTICLE" => "CML2_ARTICLE",
		"AJAX_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "sunduk",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CORRECT_RATIO" => "N",
		"AUTO_CALCULATION" => "Y",
		"ACCESSORIES_IBLOCK" => "-",
		"PROP_ACCESSORIES" => "-",
		"USE_GIFTS" => "Y",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"CATALOG_LINK" => "/catalog/",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"DEFERRED_REFRESH" => "N",
		"USE_DYNAMIC_SCROLL" => "Y",
		"SHOW_FILTER" => "Y",
		"SHOW_RESTORE" => "N",
		"COLUMNS_LIST_EXT" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "PROPS",
			3 => "DELETE",
			4 => "DELAY",
			5 => "TYPE",
			6 => "SUM",
		),
		"COLUMNS_LIST_MOBILE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "PROPS",
			3 => "DELETE",
			4 => "DELAY",
			5 => "TYPE",
			6 => "SUM",
		),
		"TOTAL_BLOCK_DISPLAY" => array(
			0 => "bottom",
		),
		"DISPLAY_MODE" => "extended",
		"PRICE_DISPLAY_MODE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
		"USE_PRICE_ANIMATION" => "Y",
		"LABEL_PROP" => array(
		),
		"COMPATIBLE_MODE" => "N",
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "",
		"ADDITIONAL_PICT_PROP_7" => "-",
		"ADDITIONAL_PICT_PROP_8" => "-",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"EMPTY_BASKET_HINT_PATH" => "/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ADDITIONAL_PICT_PROP_19" => "-",
		"ADDITIONAL_PICT_PROP_20" => "-",
		"ADDITIONAL_PICT_PROP_29" => "-",
		"ADDITIONAL_PICT_PROP_37" => "-",
		"ADDITIONAL_PICT_PROP_39" => "-"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"incart", 
	array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "50",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "/search/",
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0" => array(
			0 => "no",
		),
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "incart-search-input",
		"CONTAINER_ID" => "incart-search",
		"IBLOCK_ID" => array(
			0 => "29",
		),
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "N",
		"OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "CML2_LINK",
			2 => "",
		),
		"CONVERT_CURRENCY" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quan",
		"COMPONENT_TEMPLATE" => "inheader",
		"START_HIDDEN" => "N",
		"SHOW_SEARCHBAR" => "N",
		"JS_OPENER" => "N",
		"JS_OPENER_MOBILE" => "N",
		"SHOW_PREVIEW" => "Y"
	),
	false
);?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>