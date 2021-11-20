<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"discounts",
	Array(
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
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
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
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
		'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
	),
	$component
);?>

<?php
$element = CIBlockElement::getList(array(),array('CODE'=>$arResult["VARIABLES"]["ELEMENT_CODE"],'ACTIVE'=>'Y'))->getNextElement();
$props = $element->getProperties();
$needArray = $props['UF_GOODS']['VALUE'];
$GLOBALS['filterDiscount'] = array('ID'=>$needArray);
var_dump($needArray);
?>
<section class="cards mb-90">
	<div class="container">
		<div class="cards__header mb-60">
			<h2 class="title-second"><?=GetMessage('TITLE_LIST_ACTIONS_PRODUCTS')?></h2>
		</div>
		<?php
		$APPLICATION->IncludeComponent(
			'bitrix:catalog.section',
			'catalog-detail',
			array(

				'IBLOCK_TYPE' => 'catalog',
				'IBLOCK_ID' => 29,

				'PAGE_ELEMENT_COUNT' => 10,
				'LINE_ELEMENT_COUNT' => 10,

				'CACHE_TYPE' => $arParams['CACHE_TYPE'],
				'CACHE_TIME' => $arParams['CACHE_TIME'],
				'CACHE_FILTER' => $arParams['CACHE_FILTER'],
				'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

				'BY_LINK' => 'N',
				'DISPLAY_TOP_PAGER' => 'N',
				'DISPLAY_BOTTOM_PAGER' => 'N',
				'HIDE_SECTION_DESCRIPTION' => 'Y',
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
				'SHOW_ALL_WO_SECTION' => 'Y',

				'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
				'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
				'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
				'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],

				'FILTER_NAME' => 'filterDiscount',
				'SECTION_URL' => $arParams['SECTION_URL'],
				'DETAIL_URL' => $arParams['DETAIL_URL'],
				'BASKET_URL' => '/personal/cart/',
				'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
				'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
				'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],

				'SET_TITLE' => $arParams['SET_TITLE'],
				'PRICE_CODE' => $arParams['PRICE_CODE'],
				'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
				'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],

				'PROPERTY_CODE' => (isset($arParams['PROPERTY_CODE'][$iblockId]) ? $arParams['PROPERTY_CODE'][$iblockId] : ''),
				'PROPERTY_CODE_MOBILE' => (isset($arParams['PROPERTY_CODE_MOBILE']) ? $arParams['PROPERTY_CODE_MOBILE'] : ''),

				'OFFERS_FIELD_CODE' => (isset($arParams['OFFERS_FIELD_CODE']) ? $arParams['FIELD_CODE'] : ''),
				'OFFERS_PROPERTY_CODE' => (isset($arParams['PROPERTY_CODE'][$offerIblockId]) ? $arParams['PROPERTY_CODE'][$offerIblockId] : ''),
				'OFFERS_CART_PROPERTIES' => (isset($arParams['CART_PROPERTIES'][$offerIblockId]) ? $arParams['CART_PROPERTIES'][$offerIblockId] : ''),

				'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
				'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],

				'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
				'SLIDER_INTERVAL' => isset($arParams['SLIDER_INTERVAL']) ? $arParams['SLIDER_INTERVAL'] : '',
				'SLIDER_PROGRESS' => isset($arParams['SLIDER_PROGRESS']) ? $arParams['SLIDER_PROGRESS'] : '',

				'LABEL_PROP' => (isset($arParams['LABEL_PROP_MULTIPLE']) ? $arParams['LABEL_PROP_MULTIPLE'] : ''),
				'LABEL_PROP_MOBILE' => (isset($arParams['LABEL_PROP_MOBILE']) ? $arParams['LABEL_PROP_MOBILE'] : ''),
				'LABEL_PROP_POSITION' => (isset($arParams['LABEL_PROP_POSITION']) ? $arParams['LABEL_PROP_POSITION'] : ''),
				'ADD_PICT_PROP' => (isset($arParams['ADDITIONAL_PICT_PROP'][$iblockId]) ? $arParams['ADDITIONAL_PICT_PROP'][$iblockId] : ''),
				'OFFER_ADD_PICT_PROP' => (isset($arParams['ADDITIONAL_PICT_PROP'][$offerIblockId]) ? $arParams['ADDITIONAL_PICT_PROP'][$offerIblockId] : ''),
				'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS'][$offerIblockId]) ? $arParams['OFFER_TREE_PROPS'][$offerIblockId] : ''),

				'SHOW_DISCOUNT_PERCENT' => (isset($arParams['SHOW_DISCOUNT_PERCENT']) ? $arParams['SHOW_DISCOUNT_PERCENT'] : ''),
				'DISCOUNT_PERCENT_POSITION' => (isset($arParams['DISCOUNT_PERCENT_POSITION']) ? $arParams['DISCOUNT_PERCENT_POSITION'] : ''),
				'SHOW_OLD_PRICE' => (isset($arParams['SHOW_OLD_PRICE']) ? $arParams['SHOW_OLD_PRICE'] : ''),
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],

				'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
				'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
				'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
				'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),

				'ADD_TO_BASKET_ACTION' => 'action',
				'SHOW_CLOSE_POPUP' => (isset($arParams['SHOW_CLOSE_POPUP']) ? $arParams['SHOW_CLOSE_POPUP'] : ''),
				'DISPLAY_COMPARE' => (isset($arParams['DISPLAY_COMPARE']) ? $arParams['DISPLAY_COMPARE'] : ''),
				'COMPARE_PATH' => (isset($arParams['COMPARE_PATH']) ? $arParams['COMPARE_PATH'] : ''),

				'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
				'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
				'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY'],
			),
			$component,
			array('HIDE_ICONS' => 'Y')
		);
		?>
	</div>
</section>