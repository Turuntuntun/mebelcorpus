<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>
<script id="basket-item-template" type="text/html">
	<li class="cart-list__item"
		id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        <div class="cart-list__col">
            <img class="cart-list__img" src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}" alt="{{NAME}}">
            <div class="cart-list__info">
                {{#COLUMN_LIST}}
                    <span class="cart-list__text cart-list__text--light"
                      data-column-property-code="{{CODE}}"
                      data-entity="basket-item-property-column-value">
                        {{NAME}}:{{VALUE}}
                    </span>
                {{/COLUMN_LIST}}
                <a class="cart-list__name" href="{{DETAIL_PAGE_URL}}">{{NAME}}</a>
<!--                <span class="cart-list__text">Цвет: Светлый дуб</span>-->
            </div>
        </div>

        <div class="cart-list__range"
             data-entity="basket-item-quantity-block">
            <button class="cart-list__decrease-btn" type="button" aria-label="Уменьшить количество" data-entity="basket-item-quantity-minus">
                <svg width="16" height="16">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#minus-square"></use>
                </svg>
            </button>

            <input type="text" value="{{QUANTITY}}"
                   {{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
            data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
            id="basket-item-quantity-{{ID}}">

            <button class="cart-list__increase-btn" type="button" aria-label="Увеличить количество" data-entity="basket-item-quantity-plus">
                <svg width="16" height="16">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#plus-square"></use>
                </svg>
            </button>

            {{#SHOW_LOADING}}
            <div class="basket-items-list-item-overlay"></div>
            {{/SHOW_LOADING}}
        </div>

        <div class="cart-list__price">
            {{{PRICE_FORMATED}}}
        </div>
        {{#SHOW_LOADING}}
        <div class="basket-items-list-item-overlay"></div>
        {{/SHOW_LOADING}}

        <button class="cart-list__delete-button basket-item-block-actions" type="button" id="basket-item-height-aligner-{{ID}}">
            <svg width="16" height="16">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#trash-can"></use>
            </svg><span class="basket-item-actions-remove d-block d-md-none" data-entity="basket-item-delete">Удалить</span>
            {{#SHOW_LOADING}}
            <div class="basket-items-list-item-overlay"></div>
            {{/SHOW_LOADING}}
        </button>
        <div class="basket-item-block-actions">
            <span class="basket-item-actions-remove" data-entity="basket-item-close-restore-button"></span>
        </div>
	</li>
</script>