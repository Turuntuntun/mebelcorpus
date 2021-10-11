<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$svgIsset = '<svg class="svg-icon isset"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-stores-available"></use></svg>';
$svgLow = $svgIsset;
$svgEmpty = '<svg class="svg-icon empty"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-stores-not-available"></use></svg>';

$tag = 'a';
if (count($arResult['STORES']) < 1 || $arParams['SHOW_GENERAL_STORE_INFORMATION'] == 'Y') {
	$tag = 'span';
}

$postfix = ($arParams['PAGE'] == 'detail' ? '.DETAIL' : '');
?>

<div class="b-stores js-stores" data-firstElement="<?=$arParams['FIRST_ELEMENT_ID']?>" data-page="<?=$arParams['PAGE']?>">
	<div class="b-stores__inner"><?
		?><?php if (is_array($arResult['JS']['SKU']) && count($arResult['JS']['SKU']) > 1): ?><?
			?><<?=$tag?> class="b-stores__genamount" data-src="#stores_<?=$arParams['~ELEMENT_ID']?>" href="#" title=""><?
				?><?php if ($arParams['GOPRO_USE_MIN_AMOUNT'] == 'Y'): ?><?
					?><?php if ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < 1): ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.EMPTY'.$postfix, array('#ICON#' => $svgEmpty))?></span><?
					?><?php elseif ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < $arParams['MIN_AMOUNT']): ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.LOW'.$postfix, array('#ICON#' => $svgLow))?></span><?
					?><?php else: ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.ISSET'.$postfix, array('#ICON#' => $svgIsset))?></span><?
					?><?php endif; ?><?
				?><?php else: ?><?
					?><span class="js-stores__value"><?=$arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']]?></span><?
				?><?php endif; ?><?
				?><?php if ($arParams['SHOW_GENERAL_STORE_INFORMATION'] != 'Y'): ?><?
					?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-filled-down"></use></svg><?
				?><?php endif; ?><?
			?></<?=$tag?>><?
		?><?php else: ?><?
			?><<?=$tag?> class="b-stores__genamount" href="#" title=""><?
				?><?php if ($arParams['GOPRO_USE_MIN_AMOUNT'] == 'Y'): ?><?
					?><?php if ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < 1): ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.EMPTY'.$postfix, array('#ICON#' => $svgEmpty))?></span><?
					?><?php elseif ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < $arParams['MIN_AMOUNT']): ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.LOW'.$postfix, array('#ICON#' => $svgLow))?></span><?
					?><?php else: ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.ISSET'.$postfix, array('#ICON#' => $svgIsset))?></span><?
					?><?php endif; ?><?
				?><?php else: ?><?
					?><span class="js-stores__value"><?=$arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']]?></span><?
				?><?php endif; ?><?
				?><?php if ($arParams['SHOW_GENERAL_STORE_INFORMATION'] != 'Y'): ?><?
					?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-filled-down"></use></svg><?
				?><?php endif; ?><?
			?></<?=$tag?>><?
		?><?php endif; ?><?
	?></div>
</div>

<script>
if (RSGoPro_STOCK == 'undefined')
    RSGoPro_STOCK = {};

RSGoPro_STOCK[<?=$arParams['~ELEMENT_ID']?>] = {
    'QUANTITY' : <?=json_encode($arParams['DATA_QUANTITY'])?>,
    'JS' : <?=CUtil::PhpToJSObject($arResult['JS'])?>,
    'USE_MIN_AMOUNT' : <?=($arParams['GOPRO_USE_MIN_AMOUNT']=='Y' ? 'true' : 'false')?>,
    'MIN_AMOUNT' : <?=(IntVal($arParams['MIN_AMOUNT']) > 0 ? $arParams['MIN_AMOUNT'] : 0)?>,
    'MESSAGE_ISSET' : <?=CUtil::PhpToJSObject(Loc::getMessage('GOPRO.STORES.QUANTITY.ISSET'.$postfix, array('#ICON#' => $svgIsset)))?>,
    'MESSAGE_LOW' : <?=CUtil::PhpToJSObject(Loc::getMessage('GOPRO.STORES.QUANTITY.LOW'.$postfix, array('#ICON#' => $svgLow)))?>,
    'MESSAGE_EMPTY' : <?=CUtil::PhpToJSObject(Loc::getMessage('GOPRO.STORES.QUANTITY.EMPTY'.$postfix, array('#ICON#' => $svgEmpty)))?>,
    'SHOW_EMPTY_STORE' : <?=($arParams['SHOW_EMPTY_STORE']=='Y' ? 'true' : 'false')?>
};
</script>
