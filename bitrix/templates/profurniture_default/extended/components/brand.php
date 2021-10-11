<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (empty($arParams['PROP_BRAND']) || empty($arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']))
    return;
?>

<?php if (empty($arResult['RS_GOPRO_BRAND']) || !isset($arResult['RS_GOPRO_BRAND']['IMAGE']['src'])): ?>
    <?php if ($arParams['BRAND_DETAIL_ADD_DETAIL_PAGE_URL'] == 'Y'): ?>
        <a class="c-brand" href="<?=$arResult['RS_GOPRO_BRAND']['DETAIL_PAGE_URL']?>"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?></a>
    <?php else: ?>
        <span class="c-brand"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?></span>
    <?php endif; ?>
<?php else: ?>
    <?php if ($arParams['BRAND_DETAIL_ADD_DETAIL_PAGE_URL'] == 'Y'): ?>
        <a class="c-brand is-image" href="<?=$arResult['RS_GOPRO_BRAND']['DETAIL_PAGE_URL']?>"><img <?
            ?>src="<?=$arResult['RS_GOPRO_BRAND']['IMAGE']['src']?>" <?
            ?>alt="<?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?>" <?
            ?>title="<?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?>"<?
        ?>></a>
    <?php else: ?>
        <span class="c-brand is-image"><img <?
            ?>src="<?=$arResult['RS_GOPRO_BRAND']['IMAGE']['src']?>" <?
            ?>alt="<?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?>" <?
            ?>title="<?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?>"<?
        ?>></span>
    <?php endif; ?>
<?php endif; ?>
