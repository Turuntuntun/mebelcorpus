<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<?php if ($arParams['STICKERS_DISCOUNT_VALUE'] == 'Y'):
        if ($arParams['USE_PRICE_COUNT'] != 'Y') {
            $val = $product['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];
        } else {
            if (!empty($product['ITEM_PRICES'])) {
                $tmp = reset($product['ITEM_PRICES']);
                $val = $tmp['PERCENT'];
            } else {
                $val = 0;
            }
        }
        ?><?
        if ( $val ){?><span class="c-stickers__sticker c-stickers__sticker-standart c-stickers__discount js-discount-value ownd-discount-sticker">-<span class="js-discount-value"><?=$val?></span>%</span><?}?><?
    ?><?php endif; ?>
	

<div class="list-showcase__timer-stickers ownd-list-stickers">
	<div class="list-showcase__timer">
	<?php
	// timer
	include(EXTENDED_PATH_COMPONENTS.'/timer.php');
	?>
	</div>
	<div class="list-showcase__stickers">
	<?php
	// stickers
	include(EXTENDED_PATH_COMPONENTS.'/stickers_sunduk.php');
	?>
	</div>
</div>
