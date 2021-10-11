<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

global $APPLICATION, $JSON, $arrFilter;
?>

<div class="b-news">

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?$ElementID = $APPLICATION->IncludeComponent(
	'bitrix:news.detail',
	'gopro',
	Array(
		'DISPLAY_DATE'				=> $arParams['DISPLAY_DATE'],
		'DISPLAY_NAME'				=> $arParams['DISPLAY_NAME'],
		'DISPLAY_PICTURE'			=> $arParams['DISPLAY_PICTURE'],
		'DISPLAY_PREVIEW_TEXT'		=> $arParams['DISPLAY_PREVIEW_TEXT'],
		'IBLOCK_TYPE'				=> $arParams['IBLOCK_TYPE'],
		'IBLOCK_ID'					=> $arParams['IBLOCK_ID'],
		'FIELD_CODE'				=> $arParams['DETAIL_FIELD_CODE'],
		'PROPERTY_CODE'				=> $arParams['DETAIL_PROPERTY_CODE'],
		'DETAIL_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['detail'],
		'SECTION_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
		'META_KEYWORDS'				=> $arParams['META_KEYWORDS'],
		'META_DESCRIPTION'			=> $arParams['META_DESCRIPTION'],
		'BROWSER_TITLE'				=> $arParams['BROWSER_TITLE'],
		'DISPLAY_PANEL'				=> $arParams['DISPLAY_PANEL'],
		'SET_TITLE'					=> $arParams['SET_TITLE'],
		'SET_STATUS_404'			=> $arParams['SET_STATUS_404'],
		'INCLUDE_IBLOCK_INTO_CHAIN' => $arParams['INCLUDE_IBLOCK_INTO_CHAIN'],
		'ADD_SECTIONS_CHAIN'		=> $arParams['ADD_SECTIONS_CHAIN'],
		'ACTIVE_DATE_FORMAT'		=> $arParams['DETAIL_ACTIVE_DATE_FORMAT'],
		'CACHE_TYPE'				=> $arParams['CACHE_TYPE'],
		'CACHE_TIME'				=> $arParams['CACHE_TIME'],
		'CACHE_GROUPS'				=> $arParams['CACHE_GROUPS'],
		'USE_PERMISSIONS'			=> $arParams['USE_PERMISSIONS'],
		'GROUP_PERMISSIONS'			=> $arParams['GROUP_PERMISSIONS'],
		'DISPLAY_TOP_PAGER'			=> $arParams['DETAIL_DISPLAY_TOP_PAGER'],
		'DISPLAY_BOTTOM_PAGER'		=> $arParams['DETAIL_DISPLAY_BOTTOM_PAGER'],
		'PAGER_TITLE'				=> $arParams['DETAIL_PAGER_TITLE'],
		'PAGER_SHOW_ALWAYS'			=> 'N',
		'PAGER_TEMPLATE'			=> $arParams['DETAIL_PAGER_TEMPLATE'],
		'PAGER_SHOW_ALL'			=> $arParams['DETAIL_PAGER_SHOW_ALL'],
		'CHECK_DATES'				=> $arParams['CHECK_DATES'],
		'ELEMENT_ID'				=> $arResult['VARIABLES']['ELEMENT_ID'],
		'ELEMENT_CODE'				=> $arResult['VARIABLES']['ELEMENT_CODE'],
		'IBLOCK_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['news'],
		'USE_SHARE' 				=> $arParams['USE_SHARE'],
		'SHARE_HIDE' 				=> $arParams['SHARE_HIDE'],
		'SHARE_TEMPLATE' 			=> $arParams['SHARE_TEMPLATE'],
		'SHARE_HANDLERS' 			=> $arParams['SHARE_HANDLERS'],
		'SHARE_SHORTEN_URL_LOGIN'	=> $arParams['SHARE_SHORTEN_URL_LOGIN'],
		'SHARE_SHORTEN_URL_KEY'		=> $arParams['SHARE_SHORTEN_URL_KEY'],
		'ADD_ELEMENT_CHAIN'			=> (isset($arParams['ADD_ELEMENT_CHAIN']) ? $arParams['ADD_ELEMENT_CHAIN'] : ''),
		//microdata
		"PUBLISHER_TYPE" => $arParams["PUBLISHER_TYPE"],
	),
	$component
);?>
    </div>
</div>
<br><br>

<?php if ($arParams['USE_REVIEW'] == 'Y' && IsModuleInstalled('forum') && $ElementID): ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?$APPLICATION->IncludeComponent(
		'bitrix:forum.topic.reviews',
		'gopro',
		Array(
			'CACHE_TYPE'			=> $arParams['CACHE_TYPE'],
			'CACHE_TIME'			=> $arParams['CACHE_TIME'],
			'MESSAGES_PER_PAGE'		=> $arParams['MESSAGES_PER_PAGE'],
			'USE_CAPTCHA'			=> $arParams['USE_CAPTCHA'],
			'PATH_TO_SMILE'			=> $arParams['PATH_TO_SMILE'],
			'FORUM_ID'				=> $arParams['FORUM_ID'],
			'URL_TEMPLATES_READ'	=> $arParams['URL_TEMPLATES_READ'],
			'SHOW_LINK_TO_FORUM'	=> $arParams['SHOW_LINK_TO_FORUM'],
			'DATE_TIME_FORMAT'		=> $arParams['DETAIL_ACTIVE_DATE_FORMAT'],
			'ELEMENT_ID'			=> $ElementID,
			'AJAX_POST'				=> $arParams['REVIEW_AJAX_POST'],
			'IBLOCK_ID'				=> $arParams['IBLOCK_ID'],
			'URL_TEMPLATES_DETAIL'	=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['detail'],
		),
		$component,
		array('HIDE_ICONS' => 'Y')
	);?>
    </div>
</div>
<br><br>
<?php endif; ?>

<?php if (!empty($arrFilter['ID'])): ?>
<?php
$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	"tabs", 
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => "tabs",
		"AJAX_LOAD" => "Y",
		"TABS_COUNT" => "0",
		"PATH" => "/include/tabs/filtered/products.offers.php",
		"HIDE_TAB_IF_ONE" => "Y"
	),
	$component,
	array('HIDE_ICONS' => 'Y')
);
?>
<?php endif; ?>

</div>
