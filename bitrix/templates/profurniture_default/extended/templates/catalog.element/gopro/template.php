<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$arItem = &$arResult;

$areaIds = $this->GetEditAreaId($arItem['ID']);

$haveOffers = (is_array($arItem['OFFERS']) && count($arItem['OFFERS']) > 0) ? true : false;
if ($haveOffers)
    $product = &$arItem['OFFERS'][0];
else
    $product = &$arItem;

if($arItem['CATALOG_SUBSCRIBE'] == 'Y')
	$showSubscribeBtn = true;
else
	$showSubscribeBtn = false;

$canBuy = $product['CAN_BUY'];

if (!$arResult['OFFERS_SELECTED']) {
    $arResult['OFFERS_SELECTED'] = 0;
}

$detailParams = array(
	'GRID' => array(
		'BIG_LEFT' => 'col-xs-12 col-sm-6 col-md-5 col-lg-5',
		'BIG_RIGHT' => 'col-xs-12 col-sm-6 col-md-7 col-lg-7',
	),
);

$getTemplatePathPartParams = array('SHOW_HELP' => $arParams['CACHE_GROUPS'] == 'Y' ? 'Y' : 'N');

if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/start.php', $getTemplatePathPartParams))) {
    include($path);
}
?>
111111111
<script>
    var goalParams = 
    {
        ID:'<?=$arItem['ID']?>',
        NAME:'<?=$arItem['NAME']?>',
        CODE:'<?=$arItem['CODE']?>',
        <? 
        foreach ($arParams['YM_TARGET_PARAMETERS'] as $value) {
            echo $value . ":'" . $arItem['DISPLAY_PROPERTIES'][$value]['VALUE'] . "',";
        }
        ?>
    }
    console.log(goalParams);
</script>

<!-- detail -->
<div class="js-detail js-element js-elementid<?=$arItem['ID']?> <?
	if (isset($arItem['DAYSARTICLE2']) || isset($product['DAYSARTICLE2'])) { echo 'da2 '; }
	if (isset($arItem['QUICKBUY']) || isset($product['QUICKBUY'])) { echo 'qb '; }
    ?>detail <?
    ?>b-product-detail <?
    ?>clearfix " <?
	?>data-elementid="<?=$arItem['ID']?>" <?
	?>id="<?=$areaIds?>" <?
	?>data-productid="<?=$product['ID']?>" <?
    ?>data-detail="<?=$arItem['DETAIL_PAGE_URL']?>" <?
    ?>data-elementname="<?=CUtil::JSEscape($arResult['NAME'])?>" <?
    ?>data-offersselected="<?=$arResult['OFFERS_SELECTED']?>" <?
    ?>itemscope itemtype="http://schema.org/Product"<?
    if (strlen($arResult['DETAIL_TEXT']) > 0):
        ?>itemref="description"<?
    endif;
    ?>>
    <meta itemprop="name" content="<?=$arResult['NAME']?>" />
	<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />
    <meta itemprop="brand" content="<?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?>" />
    <?php
    if ($haveOffers) {
        $image = $arResult['OFFERS'][0]['DETAIL_PICTURE']['SRC'];
    }
    else {
        $image = $arResult['DETAIL_PICTURE']['SRC'];
    }
    ?>
	<link itemprop="image" href="<?=$image?>" />
    <?php
	if ($haveOffers)
	{
		foreach ($arResult['OFFERS'] as $offer)
		{
            $offerProperties = array_values($offer["DISPLAY_PROPERTIES"]);

            $skuProps = array();
			foreach ($offerProperties as $skuProp)
			{
				$skuProps[] = $skuProp['DISPLAY_VALUE'];
            }

			$offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
			?>
			<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<meta itemprop="sku" content="<?=htmlspecialcharsbx(implode('/', $skuProps))?>" />
				<meta itemprop="price" content="<?=$offerPrice['RATIO_PRICE']?>" />
				<meta itemprop="priceCurrency" content="<?=$offerPrice['CURRENCY']?>" />
                <link itemprop="url" href="<?=$APPLICATION->GetCurPage()?>" />
				<link itemprop="availability" href="http://schema.org/<?=($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
			</span>
			<?
		}

		unset($offerPrice, $currentOffersList);
	}
	else
	{
        $price = current($arResult['PRICES']);
		?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="price" content="<?=$price["VALUE"]?>" />
			<meta itemprop="priceCurrency" content="<?=$price['CURRENCY']?>" />
            <link itemprop="url" href="<?=$APPLICATION->GetCurPage()?>" />
			<link itemprop="availability" href="http://schema.org/<?=($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
		</span>
		<?
	}
	?>

    <div class="detail__inner js-element__shadow">

        <?php
        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/inelement.start.php', $getTemplatePathPartParams))) {
            include($path);
        }

        // anchor
        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/anchor.php', $getTemplatePathPartParams))) {
            include($path);
        }
        ?>

        <div class="row">
            <div class="<?=$detailParams['GRID']['BIG_LEFT']?> b-print__product-page__pictures">

                <?php
                if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/big-left.start.php', $getTemplatePathPartParams))) {
                    include($path);
                }

                // pictures
                if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/pic.php', $getTemplatePathPartParams))) {
                    include($path);
                }

                if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/big-left.finish.php', $getTemplatePathPartParams))) {
                    include($path);
                }
                ?>

            </div>
            <div class="<?=$detailParams['GRID']['BIG_RIGHT']?> b-print__product-page__info detail__static-xs">

                <div class="row">
                    <div class="col-xs-12 detail__static-xs">
                    <?php
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/big-right.start.php', $getTemplatePathPartParams))) {
                        include($path);
                    }

                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/article-rating-brand.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.article-rating-brand.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
                    ?>
                    </div>
                </div>

                <div class="row">
                    <?php if ($arResult['GOPRO_IMPORTANT_PROPS']): ?>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <?php else: ?>
                        <div class="col-xs-12">
                    <?php endif;?>
                    <?php
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/before.small_left_part.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/prices.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.prices.php', $getTemplatePathPartParams))) {
                        include($path);
                    }

                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/prices-note.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.prices-note.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
    
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/attributes.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.attributes.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
    
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/changelable_props.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.changelable_props.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
                    if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.small_left_part.php', $getTemplatePathPartParams))) {
                        include($path);
                    }
                    ?>
                    </div>
                    <?php if ($arResult['GOPRO_IMPORTANT_PROPS']): ?>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        <?php
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/before.small_right_part.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/important_props.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.small_right_part.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <?
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/previewtext.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.previewtext.php', $getTemplatePathPartParams))) {
                            include($path);
                        }

                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/size-table.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.size-table.php', $getTemplatePathPartParams))) {
                            include($path);
                        }

                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/pay-stores.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.pay-stores.php', $getTemplatePathPartParams))) {
                            include($path);
                        }

                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/compare-favorite-cheaper.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.compare-favorite-cheaper.php', $getTemplatePathPartParams))) {
                            include($path);
                        }

                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/social.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.social.php', $getTemplatePathPartParams))) {
                            include($path);
                        }

                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/product-in-action.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.product-in-action.php', $getTemplatePathPartParams))) {
                            include($path);
                        }

                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/delivery_cost.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.delivery_cost.php', $getTemplatePathPartParams))) {
                            include($path);
                        }

                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/detail-features.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/after.detail-features.php', $getTemplatePathPartParams))) {
                            include($path);
                        }

                        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/big-right.finish.php', $getTemplatePathPartParams))) {
                            include($path);
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>

        <?php
        if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/inelement.finish.php', $getTemplatePathPartParams))) {
            include($path);
        }
        ?>

    </div>
</div>
<!-- /detail -->

<script>
BX.message({
    RSGoPro_DETAIL_PROD_ID: '<?=GetMessageJS('RSGOPRO.DETAIL_PROD_ID')?>',
    RSGoPro_DETAIL_PROD_NAME: '<?=GetMessageJS('RSGOPRO.DETAIL_PROD_NAME')?>',
    RSGoPro_DETAIL_PROD_LINK: '<?=GetMessageJS('RSGOPRO.DETAIL_PROD_LINK')?>',
    RSGoPro_DETAIL_CHEAPER_TITLE: '<?=GetMessageJS('RSGOPRO.DETAIL_CHEAPER_TITLE')?>',
});
$(document).ready(function() {
    if ($(document).width()<670) {
        $(".add2review").css("margin-top", "10px");
        $(".add2review").css("margin-left", "0px");
    }
});
</script>

<?php
// tabs
if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/tabs.php', $getTemplatePathPartParams))) {
    include($path);
}

// finish
if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/finish.php', $getTemplatePathPartParams))) {
    include($path);
}
