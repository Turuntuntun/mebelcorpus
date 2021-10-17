<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="header__menu header-menu">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
		<li class="header-menu__item"><a class="header-menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?endforeach?>

</ul>
<?endif?>