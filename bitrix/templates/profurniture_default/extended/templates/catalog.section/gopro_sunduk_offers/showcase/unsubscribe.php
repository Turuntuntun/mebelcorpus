<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

$itemId = $arItem['ID'];
?>

<div class="list-showcase__unsubscribe">
	<!--a class="list-showcase__unsubscribe-detail btn-primary" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=GetMessage('CPSL_TPL_MESS_BTN_DETAIL')?></a-->
	<a <?
		?>class="list-showcase__unsubscribe-action js-product__unsubscribe btn-default" <?
		?>data-itemid="<?=$itemId?>" <?
		?>data-subscribe-id="<?=CUtil::PhpToJSObject($arParams['LIST_SUBSCRIPTIONS'][$itemId], false, true)?>" <?
		?>><?=GetMessage('CPSL_TPL_MESS_BTN_UNSUBSCRIBE');?></a>
</div>
