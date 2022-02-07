<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>
<div class="product-card">
    <a class="product-card__link" href="<?=$arResult['ITEM']['DETAIL_PAGE_URL']?>">
        <img class="product-card__img" src="<?=$arResult['ITEM']['PREVIEW_PICTURE']['SRC']?>" alt="">
        <div class="product-card__info"><span class="product-card__caption"><?=$arResult['ITEM']['NAME']?></span>
            <div class="product-card__wrap">
                <div class="product-card__row"><span class="product-card__term"><?=GetMessage('UF_ITEM_SIZE_TEXT')?> </span><span class="product-card__value"><?=$arResult['ITEM']['PROPERTIES']['SIZES']['VALUE']?> <?=GetMessage('UF_ITEM_SIZE_TEXT_BACK')?></span></div>
<!--                <div class="product-card__row"><span class="product-card__term">Остаток на складе: </span><span class="product-card__value product-card__value--weight">12 шт</span></div>-->
            </div>
            <div class="product-card__bot">
                <?php if ($arResult['ITEM']['PRICES']) : ?>
                    <?php
                        $retail_price_type = $GLOBALS['UF_USER_REGION']['PROPS']['RETAIL_PRICE_TYPE_CODE']['VALUE'];
                        $opt_price_type = $GLOBALS['UF_USER_REGION']['PROPS']['OPT_PRICE_TYPE_CODE']['VALUE'];
                        $user_groups = \Bitrix\Main\Engine\CurrentUser::get()->getUserGroups();

                        $is_opt_user = false;
                        if ( in_array('10', $user_groups) ) {
                            $is_opt_user = true;
                        }

                        if ( $is_opt_user ) {
                            if ( isset($arResult['ITEM']['PRICES'][$opt_price_type]) ) {
                                $active_price = $opt_price_type;
                            } elseif (isset($arResult['ITEM']['PRICES']['Opt'])) {
                                $active_price = 'Opt';
                            } else {
                                $active_price = 'BASE';
                            }
                        } else {
                            if ( isset($arResult['ITEM']['PRICES'][$retail_price_type]) ) {
                                $active_price = $retail_price_type;
                            } else {
                                $active_price = 'BASE';
                            }
                        }
                    ?>
                    <div class="product-card__price"><?=$arResult['ITEM']['PRICES'][$active_price]['PRINT_DISCOUNT_VALUE']?></div>
                    <!-- <div class="product-card__price"><?=$arResult['ITEM']['ITEM_PRICES'][0]['PRINT_RATIO_PRICE']?></div> -->
                <?php endif; ?>
                <?php if ($arResult['ITEM']['PROPERTIES']['UF_OUT_OF']['VALUE'] != 'Y') : ?>
                    <?php if (isset($arResult['ITEM']['OFFERS']) && $arResult['ITEM']['OFFERS']) :?>
                        <a class="product-card__btn button" href="<?=$arResult['ITEM']['DETAIL_PAGE_URL']?>">
                            <span>Подробнее</span>
                        </a>
                    <?php else:?>
                    <button data-modal-trigger="addincart-success" class="product-card__btn button" data-add-to-basket-item="<?=$arResult['ITEM']['ID']?>"   data-add-to-basket-color="<?=$arResult['ITEM']['PROPERTIES']['COLORS']['VALUE'][0]?>">
                        <svg width="21" height="21">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#cart"></use>
                        </svg><span><?=GetMessage('UF_ITEM_BUTTON_SUBMIT')?></span>
                    </button>
                    <?php endif;?>
                <?php endif; ?>
            </div>
        </div></a>
    <button class="product-card__like-btn" aria-label="Добавить в избранное" data-fav-id="<?=$arResult['ITEM']['ID']?>">
        <svg width="20" height="20">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#heart"></use>
        </svg>
    </button>
</div>
