<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

global $APPLICATION;

// $templateData['imageOg'] && $templateData['imageOgOffer'] from "extended/components/js-pictures.php"
if (!empty($templateData['imageOg'])) {
    $APPLICATION->SetPageProperty("og:image", $templateData['imageOg']);
} elseif (!empty($templateData['imageOgOffer'])) {
    $APPLICATION->SetPageProperty("og:image", $templateData['imageOgOffer']);
}
?>


<?
/**
 * Сообщение про отсутствие цены
 * (с) 2019
*/
$arShowPrice = ProСheckLocalPrice(array($arResult["ID"]));
if (!empty($arShowPrice))
{ 
	$arPriceName = ProIsLocalPriceName($arResult["ID"]);
	if ( !empty( $arPriceName ) )
	{
		$message = "Извините, данный товар доступен только на складе в ";
		$message.= ( count($arPriceName) == 1 ) ? 'городе ' : 'городах:<br>';
		$message.= implode(", ", $arPriceName);
		print_r($message);
		?>
		<script type="text/javascript">
			$(function(){
				$('.detail__inner .b-pay .b-store__location').html('<?=$message?>').show();
			});
		</script>
		<?
	}
}
?>