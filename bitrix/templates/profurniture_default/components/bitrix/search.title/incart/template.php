<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

\Bitrix\Main\UI\Extension::load('ui.vue');

$this->addExternalJS($templateFolder.'/js/component.js');
$this->addExternalJS($templateFolder.'/js/main.js');
$this->addExternalJS('https://unpkg.com/vue-toasted');

$sInputId = empty($arParams['INPUT_ID']) ? "title-search-input" : $arParams['INPUT_ID'];
$sContainerId = empty($arParams['CONTAINER_ID']) ? "title-search" : $arParams['CONTAINER_ID'];
$sAjaxPath = CUtil::JSEscape(POST_FORM_ACTION_URI);

$basket = \Bitrix\Sale\Basket::loadItemsForFUser(
    Bitrix\Sale\Fuser::getId(), 
    Bitrix\Main\Context::getCurrent()->getSite()
);

if (count($basket->getBasketItems()) > 0):
?>

<div class="suggestion-items-container">
    <div id="<?=$sContainerId?>"></div>
</div>

<script>

    BX.message({
        'RS_GOPRO_INCART_SEARCH_INPUT_PLACEHOLDER': '<?=Loc::getMessage('RS_GOPRO_INCART_SEARCH_INPUT_PLACEHOLDER')?>',
        'RS_GOPRO_INCART_SEARCH_BUTTON_TITLE': '<?=Loc::getMessage('RS_GOPRO_INCART_SEARCH_BUTTON_TITLE')?>',
        'RS_GOPRO_INCART_SEARCH_ADD_ITEMS': '<?=Loc::getMessage('RS_GOPRO_INCART_SEARCH_ADD_ITEMS')?>',
        'RS_GOPRO_INCART_SEARCH_ADD_SUCCESS': '<?=Loc::getMessage('RS_GOPRO_INCART_SEARCH_ADD_SUCCESS')?>',
        'RS_SUGGEST_ITEMS_PRICE':  '<?=Loc::getMessage('RS_SUGGEST_ITEMS_PRICE')?>',
        'RS_SUGGEST_ITEMS_NOT_FOUND': '<?=Loc::getMessage('RS_SUGGEST_ITEMS_NOT_FOUND');?>'
    });

    new GoproIncartSearchItems(
        document.getElementById('<?=$sContainerId?>'),
        {
            ajaxPath: '<?=$sAjaxPath?>',
            inputId: '<?=$sInputId?>',
            minLength: 2,
            actionVariable: '<?=$arParams['CATALOG_ACTION_VARIABLE']?>',
            productIdVariable: '<?=$arParams['CATALOG_PRODUCT_ID_VARIABLE']?>'
        }
    );
    
</script> 
<?php endif; 