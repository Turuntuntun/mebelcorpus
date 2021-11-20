<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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
                <div class="product-card__price"><?=$arResult['ITEM']['ITEM_PRICES'][0]['PRINT_RATIO_PRICE']?></div>
                <? if ($arResult['ITEM']['PROPERTIES']['COLORS']['VALUE']) :?>
                <button data-modal-trigger="addincart-success" class="product-card__btn button" data-add-to-basket-item="<?=$arResult['ITEM']['ID']?>"   data-add-to-basket-color="<?=$arResult['ITEM']['PROPERTIES']['COLORS']['VALUE'][0]?>">
                    <svg width="21" height="21">
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#cart"></use>
                    </svg><span><?=GetMessage('UF_ITEM_BUTTON_SUBMIT')?></span>
                </button>
                <? endif;?>
            </div>
        </div></a>
    <button class="product-card__like-btn" aria-label="Добавить в избранное">
        <svg width="20" height="20">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#heart"></use>
        </svg>
    </button>
</div>