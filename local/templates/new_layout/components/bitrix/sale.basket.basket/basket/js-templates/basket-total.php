<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<div class="basket-checkout-container" data-entity="basket-checkout-aligner">
        <div class="cart-side__top">
            <div class="cart-side__wrap">
                <span class="cart-side__"><?=Loc::getMessage('SBB_TOTAL')?> ({{{COUNT_ITEMS}}}):</span>
                <span class="cart-side__price" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</span>
            </div>
            <p class="cart-side__info">Дата и стоимость доставки определяются при оформлении заказа</p>
        </div>

        <div class="cart-side__bot">
            <div class="cart-side__wrap cart-side__wrap--summary">
                <span>Итого</span><span>{{{PRICE_FORMATED_TWO}}}</span>
            </div>
            <button class="cart-side__btn button"
                    data-entity="basket-checkout-button">
                <?=Loc::getMessage('SBB_ORDER')?>
            </button>
        </div>


	</div>
</script>