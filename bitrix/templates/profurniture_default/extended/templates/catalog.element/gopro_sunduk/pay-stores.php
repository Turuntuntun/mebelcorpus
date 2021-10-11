<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

?>

<div id="ownd-available">
	<?=$arResult['PROPERTIES']['AVAILABLE']['VALUE']?>
</div>

<?if($USER->IsAuthorized()){?>
<!-- pay && stores -->
<div class="detail__pay-stores">
    <div class="detail__pay">
    <?php
    // pay
    $params = array(
		'SHOW_BUY1CLICK' => 'N',//($arParams['OFF_BUY1CLICK'] == 'Y' ? 'N' : 'Y'),
    );
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_BLOCKS.'/pay_sunduk.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
    </div>
</div>

<?php if ($arParams['USE_STORE'] == 'Y'): ?>
    <div class="detail__stores">
    <?php
    // stores
    $params = array(
        'PAGE' => 'detail',
    );
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_BLOCKS.'/stores_sunduk.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
    </div>
    <?php endif; ?>
<!-- /pay && stores -->

<?}?>