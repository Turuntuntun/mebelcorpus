<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$arItem = &$arResult;

$areaIds = $this->GetEditAreaId($arItem['ID']);

$haveOffers = (is_array($arItem['OFFERS']) && count($arItem['OFFERS'])>0) ? true : false;
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

// anchor
include('template.anchor.php');
?>

<!-- detail -->
<div class="js-detail js-element js-elementid<?=$arItem['ID']?> <?
	if (isset($arItem['DAYSARTICLE2']) || isset($product['DAYSARTICLE2'])) { echo 'da2 '; }
	if (isset($arItem['QUICKBUY']) || isset($product['QUICKBUY'])) { echo 'qb '; }
    ?>detail <?
    ?>clearfix " <?
	?>data-elementid="<?=$arItem['ID']?>" <?
	?>id="<?=$areaIds?>" <?
	?>data-productid="<?=$product['ID']?>" <?
    ?>data-detail="<?=$arItem['DETAIL_PAGE_URL']?>" <?
    ?>data-elementname="<?=CUtil::JSEscape($arResult['NAME'])?>" <?
    ?>data-offersselected="<?=$arResult['OFFERS_SELECTED']?>" <?
    ?>>
    <div class="detail__inner js-element__shadow">

        <div class="detail__anchor js-detail-anchor hidden-xs">
            <?php
            echo $APPLICATION->GetViewContent('TABS_HTML_HEADERS_ANCHOR');
            ?>
            <?php if ($arParams['USE_REVIEW'] == 'Y' && IsModuleInstalled('forum')): ?>
            <a class="detail__anchor__link link-dashed js-easy-scroll" href="#review"><?=GetMessage('TABS_REVIEW')?><?=($arParams['DETAIL_REVIEW_SHOW_COUNT'] == 'Y' ? ' (<span class="js-detailelement-review-count">0</span>)' : '')?></a>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="<?=$detailParams['GRID']['BIG_LEFT']?>">

                <?php
                // pictures
                include('template.pic.php');
                ?>

            </div>
            <div class="<?=$detailParams['GRID']['BIG_RIGHT']?>">

                <!-- article & rating & brand -->
                <div class="detail__article-rating-brand">
                    <span class="detail__article">
                    <?php
					// article
					include(EXTENDED_PATH_COMPONENTS.'/article.php');
					?>
                    </span>
                    <span class="detail__rating">
                    <?php
                    // rating
                    include(EXTENDED_PATH_COMPONENTS.'/rating.php');
                    ?>
                    </span>
                    <span class="detail__brand">
                    <?php
                    // brand
                    include(EXTENDED_PATH_COMPONENTS.'/brand.php');
                    ?>
                    </span>
                </div>
                <!-- /article & rating & brand -->

                <!-- prices -->
                <div class="detail__prices">
                    <span class="detail__prices__title"><?=Loc::getMessage('SOLOPRICE_PRICE')?></span>
                <?php
                // prices
                $params = array(
                    'PAGE' => 'detail',
                    'VIEW' => 'list',
                    'SHOW_MORE' => 'N',
                    'USE_ALONE' => 'Y',
                    'MAX_SHOW' => 15,
                    'SHOW_DISCOUNT_NAME' => 'Y',
                    'SHOW_DISCOUNT_DIFF' => 'Y',
                    'SHOW_OLD_PRICE' => 'Y',
                );
                include(EXTENDED_PATH_COMPONENTS.'/prices.php');
                ?>
                </div>
                <!-- /prices -->

                <!-- prices note -->
                <div class="detail__prices-note">
                <?php
                // price note
                include(EXTENDED_PATH_COMPONENTS.'/prices-note.php');
                ?>
                </div>
                <!-- /prices note -->

                <!-- attributes -->
                <div class="detail__attributes">
                <?php
                // attributes
                $params = array(
                    // 'VIEW' => 'list'
                );
                include(EXTENDED_PATH_COMPONENTS.'/attributes.php');
                ?>
                </div>
                <!-- /attributes -->

                <!-- changelable props -->
                <div class="detail__changelable-props">
                <?php
                // changelable props
                include(EXTENDED_PATH_COMPONENTS.'/changelable_props.php');
                ?>
                </div>
                <!-- /changelable props -->

                <!-- preview text -->
                <?php if ($arParams['SHOW_PREVIEW_TEXT']=='Y' && $arResult['PREVIEW_TEXT'] != ''): ?>
                    <div class="detail__previewtext hidden-xs"><?
                        ?><?=$arResult['PREVIEW_TEXT']?><?
                        if ($arResult['TABS']['DETAIL_TEXT']) {
                            ?><div class="detail__previewtext__go-to"><a class="detail__previewtext__go-to__link js-easy-scroll" href="#detailtext" data-es-offset="-135"><?=GetMessage('GO2DETAILFROMPREVIEW')?></a></div><?
                        }
                    ?></div>
                <?php endif; ?>
                <!-- /preview text -->

                <!-- size table -->
                <div class="detail__size-table"></div>
                <!-- /size table -->

                <!-- pay && stores -->
                <div class="detail__pay-stores">
                    <div class="detail__pay">
                    <?php
                    // pay
                    $params = array(
                        'SHOW_BUY1CLICK' => 'Y',
                    );
                    include(EXTENDED_PATH_BLOCKS.'/pay.php');
                    ?>
                    </div>
                    <?php if ($arParams['USE_STORE'] == 'Y'): ?>
                    <div class="detail__stores">
                    <?php
                    // stores
                    $params = array(
                        'PAGE' => 'detail',
                    );
                    include(EXTENDED_PATH_BLOCKS.'/stores.php');
                    ?>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- /pay && stores -->

                <!-- compare && favorite && cheaper -->
                <div class="detail__compare-favorite-cheaper">

                    <?php if ($arParams['USE_COMPARE'] == 'Y'): ?>
                    <span class="detail__compare">
                        <a rel="nofollow" class="c-compare js-add2compare" href="<?=$arItem['COMPARE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-compare-small"></use></svg><span class="c-compare__title"><?=Loc::getMessage('ADD2COMPARE')?></span><span class="c-compare__title-in"><?=Loc::getMessage('ADD2COMPARE_IN')?></span></a>
                    </span>
                    <?php endif; ?>

                    <?php if ($arParams['USE_FAVORITE'] == 'Y'): ?>
                    <span class="detail__favorite">
                        <a rel="nofollow" class="c-favorite js-add2favorite" href="<?=$arItem['DETAIL_PAGE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-favorite-small"></use></svg><span class="c-favorite__title"><?=Loc::getMessage('FAVORITE')?></span><span class="c-favorite__title-in"><?=Loc::getMessage('FAVORITE_IN')?></span></a>
                    </span>
                    <?php endif; ?>

                    <?php if ($arParams['USE_CHEAPER'] == 'Y'): ?>
                    <span class="detail__cheaper">
                        <a rel="nofollow" class="c-cheaper js-cheaper fancyajax fancybox.ajax" href="<?=SITE_DIR?>include/popup/cheaper/" title="<?=Loc::getMessage('CHEAPER')?>"><?
                            ?><span class="c-cheaper__icon"><span class="c-cheaper__icon-in">%</span></span><?
                            ?><span class="c-cheaper__title"><?=GetMessage('CHEAPER')?></span><?
                        ?></a>
                    </span>
                    <?php endif; ?>

                </div>
                <!-- /compare && favorite && cheaper -->

                <!-- social -->
                <?php if ($arParams['USE_SHARE'] == 'Y' && !empty($arParams["SOC_SHARE_ICON"]) && $arParams['GOPRO']['OFF_YANDEX'] != 'Y'): ?>
                <div class="detail__social">
                    <div class="share">
                        <div class="ya-share2"
                            data-services="<?=implode(',', $arParams['SOC_SHARE_ICON'])?>"
                            data-lang="<?=LANGUAGE_ID?>"
                            data-size="s"
                            data-copy="first"
                        ></div>
                    </div>
                </div>
                <?php endif; ?>
                <!-- /social -->

                <!-- product in action -->
                <div class="detail__product-in-action"></div>
                <!-- /product in action -->

                <?php
                // delivery cost
                include('template.delivery_cost.php');
                ?>
                
                <!-- detail features -->
                <div class="detail__detail-features"></div>
                <!-- /detail features -->

            </div>
        </div>

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
include('template.tabs.php');
?>
