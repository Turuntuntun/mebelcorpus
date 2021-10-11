<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>

<?
$bShowSections = false;
if (
	$arParams['SECTIONS_CODE'] != '' &&
	is_array($arResult['SECTIONS']) &&
	count($arResult['PROPERTIES'][$arParams['SECTIONS_CODE']]['VALUE']) > 0 &&
	IntVal($arResult['SECOND_IBLOCK_ID']) > 0
	) {
	$bShowSections = true;
	?><?$APPLICATION->IncludeComponent(
		'bitrix:catalog.section.list',
		'brand_menu',
		array(
			'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
			'IBLOCK_ID' => $arResult['SECOND_IBLOCK_ID'],
			'CACHE_TYPE' => $arParams['CACHE_TYPE'],
			'CACHE_TIME' => $arParams['CACHE_TIME'],
			'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
			'COUNT_ELEMENTS' => 'N',
			'TOP_DEPTH' => '10',
			'SECTION_URL' => '',
			'IDS' => $arResult['SECTIONS'],
			'FILTER_CONTROL_NAME' => $arResult['FILTER_CONTROL_NAME'],
		),
		$component,
		array('HIDE_ICONS'=>'Y')
	);?><?

?><div class="pcontent"><?
}
	
	?><div class="b-brandsdetail"><?
		?><div class="row"><?

			?><div class="col-sm-12"><?
				?><div class="clearfix"><?
					if (isset($arResult['DETAIL_PICTURE'])) {
						?><div class="b-brandsdetail__img"><?
							?><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>" /><?
						?></div><?
					}
					?><div class="b-brandsdetail__description"><?
						?><?=$arResult['DETAIL_TEXT']?><?
					?></div><?
				?></div><?
			?></div><?

			?><div class="col-sm-12"><?
				?><div class="b-iblockdetail__ya-share"><?
				// yandex share
				if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/ya-share.php', $getTemplatePathPartParams))) {
					include($path);
				}
				?></div><?
			?></div><?

			?><div class="col-sm-12"><?
				?><div class="b-brandsdetail__bot clearfix"><?
					?><div class="b-brandsdetail__back"><?
						?><a class="b-brandsdetail__fullback" href="<?=$arParams['IBLOCK_URL']?>">&larr; <?=GetMessage('GO_BACK')?></a><?
					?></div><?
				?></div><?
			?></div><?

		?></div><?
	?></div><?
	
if ($bShowSections) {
	if($arParams['SHOW_BOTTOM_SECTIONS']=='Y') {
		?><?$APPLICATION->IncludeComponent(
			'bitrix:catalog.section.list',
			'brand_big',
			array(
				'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
				'IBLOCK_ID' => $arResult['SECOND_IBLOCK_ID'],
				'CACHE_TYPE' => $arParams['CACHE_TYPE'],
				'CACHE_TIME' => $arParams['CACHE_TIME'],
				'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
				'COUNT_ELEMENTS' => 'N',
				'TOP_DEPTH' => '10',
				'SECTION_URL' => '',
				'IDS' => $arResult['SECTIONS'],
				'FILTER_CONTROL_NAME' => $arResult['FILTER_CONTROL_NAME'],
			),
			$component,
			array('HIDE_ICONS'=>'Y')
		);?><?
	}
?></div><?
}
