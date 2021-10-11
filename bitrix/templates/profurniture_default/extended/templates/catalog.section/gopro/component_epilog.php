<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if ($arParams['IS_AJAXPAGES'] == 'Y') {
    global $JSON;
    $JSON['METHOD'] = 'append';
    $JSON['IDENTIFIER'] = $arParams['AJAXPAGESID'];
    $JSON['HTMLBYCLASS'] = $templateData;
    $JSON['HTML']['catalogajaxpages'] = $templateData['catalogajaxpages'];

}

if ($arParams['IS_SORTERCHANGE'] == 'Y') {
    global $JSON;
    $JSON['HTMLBYID'] = $templateData;
}

if ($templateData['ADD_HIDER']) {
    ?><script>var add_hidder = true;</script><?
} else {
    ?><script>var add_hidder = false;</script><?    
}



/**
 * Сообщение про отсутствие цены
 * (с) 2019
*/

if (!empty($arResult["PRO_SHOW_PRICE"]))
{
    $arShowPrice = ProСheckLocalPrice($arResult["PRO_SHOW_PRICE"]);
    if (!empty($arShowPrice)) { ?>
        <script type="text/javascript">
            $(function(){
                <?foreach ($arShowPrice as $id) {?>
                    $('.list-element[data-productid=<?=$id?>]').find('.b-store__location').html('<span>Недоступен</span><br>в вашем городе').show();
                <?}?>
            });
        </script>
    <?}
}

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/components/bitrix/catalog.product.subscribe/gopro/script.js');
