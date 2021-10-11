function rsGoProInitBasket() {
    var $basket = $('#basket_form');

    if ($basket.length > 0) {
        $basket.find('[name="COUPON"]').attr('placeholder', $basket.find('.bx_ordercart .bx_ordercart_coupon span').html());
        $basket.find('table.counter').parent().addClass('rsgopro-basket-quantity');
        $basket.find('table.counter td:last-child').wrapInner('<div class="rsgopro-basket-measure"></div>');
    }
}

$(document).on('rsGoPro.document.ready', function(){

    rsGoProInitBasket();

});
