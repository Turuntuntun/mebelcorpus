<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class="footer__bot">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
		<a class="footer__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
<?endforeach?>

    </div>
<?endif?>