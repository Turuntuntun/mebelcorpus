<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if ($arParams['IS_AJAXPAGES'] == 'Y' ||  $_REQUEST['sorterchange']) {

	$arCheck = ProСheckLocalPrice(array($arItem['ID']));
	if( !empty($arCheck) ) {?>
		<div class="b-store__location"><span>Недоступен</span><br>в вашем городе</div>
	<?}
}
else
{
	?>
	<div class="b-store__location" style="display: none;"></div>
	<?
}