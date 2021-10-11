<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$params = array(
    'SHOW_BUY1CLICK' => ($params['SHOW_BUY1CLICK'] == 'Y' ? true : false),
);
?>

<!--noindex-->
<div class="b-pay">
    <form class="b-pay__form js-pay__form js-buyform<?=$arItem['ID']?> js-synchro<?if(!$product['CAN_BUY']):?> cantbuy<?endif;?> clearfix" name="add2basketform">
        <input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="ADD2BASKET">
        <input type="hidden" name="<?=$arParams['PRODUCT_ID_VARIABLE']?>" class="js-add2basketpid" value="<?=$product['ID']?>">
        <span class="b-pay__inner">
            <span class="b-pay__quantity">
            <?php
            // quantity
            include(EXTENDED_PATH_COMPONENTS.'/quantity.php');
            ?>
            </span>
            <span class="b-pay__buttons">
                <a onClick="addColor( <?=$arItem['ID']?> );" <?
                    ?>rel="nofollow"<?
                    ?>class="b-pay__button b-pay__add2basket js-add2basket js-submit btn-primary" <?
                    ?>href="#"<?
                    ?>title="<?=Loc::getMessage('BLOCKS.PAY.ADD2BASKET.TITLE')?>"<?
                    if($arParams["YM_USE_TARGETS"] == 'Y' && strlen($arParams['YM_TARGET_NAME_ADD2BASKET']) > 0):?> onclick="ym(<?=$arParams['YM_COUNTER_NUMBER']?>, 'reachGoal', '<?=$arParams['YM_TARGET_NAME_ADD2BASKET']?>', goalParams); return true; "<?endif;
                    ?>><?=Loc::getMessage('BLOCKS.PAY.ADD2BASKET')?></a>
                <?php
                // quantity
                include(EXTENDED_PATH_COMPONENTS.'/subscribe.php');
                include(EXTENDED_PATH_BLOCKS.'/pro_store_location.php');
                ?>
                <a rel="nofollow" class="b-pay__button b-pay__inbasket js-inbasket btn-primary-darken" href="<?=$arParams['BASKET_URL']?>" title="<?=Loc::getMessage('BLOCKS.PAY.INBASKET.TITLE')?>"><?=Loc::getMessage('BLOCKS.PAY.INBASKET')?></a>
                <?php if ($params['SHOW_BUY1CLICK']): ?><?
                $arBuy1click = array(
                    'RS_ORDER_IDS' => $product['ID']
                );
                ?>
                <a <?
                    ?>rel="nofollow" <?
                    ?>class="b-pay__button b-pay__buy1click js-buy1click fancyajax fancybox.ajax btn-default" <?
                    ?>href="<?=SITE_DIR?>include/popup/buy1click/" <?
                    ?>title="<?=Loc::getMessage('BLOCKS.PAY.BUY1CLICK.TITLE')?>" <?
                    ?>data-insertdata="<?=htmlspecialcharsbx(\Bitrix\Main\Web\Json::encode($arBuy1click))?>"<?
                ?>><?=Loc::getMessage('BLOCKS.PAY.BUY1CLICK')?></a>
                <?php endif; ?>
            </span>
        </span>
        <input type="submit" name="submit" class="nonep" value="" />
    </form>
</div>


<script>
function addColor( itemId )
{
	if ( $( '.ownd-colors' ).length )
	{
		var colorName = $( '.ownd-color.active .ownd-color-name' ).text();
		
		setTimeout(
			function ()
			{
				$.post(
					'/_ajax/add_color.php',
					{
						ID: itemId,
						COLOR_NAME: colorName
					}
				);
			},
			2000
		);
	}
}
</script>
<!--/noindex-->
