<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<?php
if ($arParams['PROP_ARTICLE'] == 'ID' || $arParams['PROP_SKU_ARTICLE'] == 'ID') {
    ?><span class="c-article js-article" data-article-from-id="Y"><?
        ?><span class="c-article__title"><?=Loc::getMessage('ARTICLE')?>:</span><?
        ?><span class="c-article__value js-article__value" <?
            ?>data-prodarticle="<?=$product['ID']?>"><?
            ?><?=$product['ID']?><?
        ?></span><?
    ?></span><?
} elseif (!empty($product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE']) || !empty($product['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'])) {
    if ($product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE'] != '' || $product['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'] != '') {
        ?><span class="c-article js-article"><?
            ?><span class="c-article__title"><?=Loc::getMessage('ARTICLE')?>:</span><?
            ?><span class="c-article__value js-article__value" <?
                ?>data-prodarticle="<?=($product['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'] != '' ? $product['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'] : '' )?>"><?
                ?><?=($product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE'] != '' ? $product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE'] : $product['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'])?><?
            ?></span><?
        ?></span><?
    }
} else {
    ?><span class="c-article js-article js-article-invisible"><?
        ?><span class="c-article__title"><?=Loc::getMessage('ARTICLE')?>:</span><?
        ?><span class="c-article__value js-article__value"></span><?
    ?></span><?
}
