<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */

?>
    <a class="header__cart" href="<?=$arParams['PATH_TO_BASKET']?>">
        <svg width="27" height="27">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#cart"></use>
        </svg><sup><?=$arResult['NUM_PRODUCTS']?></sup><span><?=GetMessage('TSB1_YOUR_CART')?></span></a>
<?php
