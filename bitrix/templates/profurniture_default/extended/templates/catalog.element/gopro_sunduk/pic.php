<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\Loc;
?>

<!-- picture -->
<div class="detail__pic">

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
        if ( $val ){?><span class="c-stickers__sticker c-stickers__sticker-standart c-stickers__discount js-discount-value ownd-discount-sticker ownd-discount-sticker-detail">-<span class="js-discount-value"><?=$val?></span>%</span><?}?><?
    ?><?php endif; ?>

    <div class="detail__stickers ownd-detail__stickers">
    <?php
    // stickers
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/stickers_sunduk.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
    </div>
    <div class="detail__pic__inner">
        <div class="detail__pic__carousel js-picslider">
            <?php
            // js-pictures
            if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/js-pictures.php', $getTemplatePathPartParams))) {
                include($path);
            }
            ?>
        </div>
    </div>
    <div class="detail__pic__zoom hidden-xs hidden-print"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg><?=Loc::getMessage('ZOOM')?></div>
    <div class="detail__pic__preview js-scroll scrollbar-inner"><div class="detail__pic__dots js-detail-dots"></div></div>
</div>
<!-- /picture -->
