<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<span class="c-article"><?
    ?><span class="c-article__title"><?=GetMessage('ARTICLE')?>:</span><?
    if (isset($product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE']) || isset($arResult['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'])) {
        if ($product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE'] != '' || $arResult['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'] != '') {
            ?><span class="js-article" <?
                ?>data-prodarticle="<?=($arResult['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'] != '' ? $arResult['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'] : '' )?>"><?
                ?><?=($product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE'] != '' ? $product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE'] : $arResult['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'])?><?
            ?></span><?
        }
    } else {
        ?><span class="c-article js-article"></span><?
    }
?></span>
