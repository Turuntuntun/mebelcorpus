var RSGoPro_Hider_called = false;
var RSGoPro_BigadataGalleryFlag = true;

// hide filter and sorter when goods is empty
function RSGoPro_Hider() {
	RSGoPro_Hider_called = true;
	$('.sidebar, .mix, .navi, .catalogsorter').hide();
	$('.catalog .prods').css('marginLeft','0px');
}

$(document).ready(function(){

	if( $('.prices_jscrollpane').length>0 ) {
		RSGoPro_ScrollInit('.prices_jscrollpane');
		$(window).resize(function(){
			RSGoPro_ScrollReinit('.prices_jscrollpane');
		});
	}
	
	// close open attributes (list view)
	$(document).on('mouseleave', '.view-showcase .js-element' ,function(){
		$(this).find('.js-attributes__prop.open').removeClass('open').addClass('close');
		return false;
	});

	if (add_hidder == true) {
		RSGoPro_Hider();
	}
	if (RSGoPro_Hider_called) {
		RSGoPro_Hider();
	}
	
});
