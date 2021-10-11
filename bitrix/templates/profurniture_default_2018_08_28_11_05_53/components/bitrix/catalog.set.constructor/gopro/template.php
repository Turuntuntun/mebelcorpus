<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>

<?php
if (!function_exists('SetConstruktorShowItem')){
	function SetConstruktorShowItem($arItem, $params = array()) {
		?><div class="js-element js-elementid<?=$arItem['ID']?> simple scrollitem" <?
			?>data-elementid="<?=$arItem['ID']?>" <?
			?>data-price="<?=$arItem['PRICE_DISCOUNT_VALUE']?>" <?
			?>data-oldprice="<?=$arItem['PRICE_VALUE']?>" <?
			?>data-discount="<?=$arItem['PRICE_DISCOUNT_DIFFERENCE_VALUE']?>" <?
			?>data-elementname="<?=CUtil::JSEscape($arItem['NAME'])?>" <?
			?>data-quantity="<?=$arItem["BASKET_QUANTITY"]; ?>" <?
			?>><?

			if ($params['TYPE'] != 'ELEMENT') {
				?><a rel="nofollow" class="delete" href="#delset"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-close-button"></use></svg></a><?
				?><input <?
					?>class="addremove" <?
					?>id="<?=$params['PREFIX']?><?=$arItem['ID']?>" <?
					?>type="checkbox" <?
					?>name="<?=$params['PREFIX']?><?=$arItem['ID']?>" <?
					?>value="Y" <?
					echo (isset($params['IN']) && $params['IN'] == 'Y' ? 'checked="checked"' : '')
				?>><label class="addremove_label" for="<?=$params['PREFIX']?><?=$arItem['ID']?>">&nbsp;</label><?
			}

			?><span class="plusik"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use></svg></span><?
			?><div class="name"><?
				if(isset($arItem['DETAIL_PAGE_URL']))
				{
					?><a class="setitemlink" href="<?=$arItem['DETAIL_PAGE_URL']?>" target="_blank"><?
				}
					?><?=$arItem['NAME']?><?
				if(isset($arItem['DETAIL_PAGE_URL']))
				{
					?></a><?
				}
			?></div><?
			?><div class="pic clearfix"><?
				// PICTURE
				if(isset($arItem['DETAIL_PAGE_URL']))
				{
					?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" target="_blank"><?
				} else {
					?><span><?
				}
					if(isset($arItem['DETAIL_PICTURE']))
					{
						?><img src="<?=$arItem['DETAIL_PICTURE']['RESIZE']['src']?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" /><?
					} else {
						?><img src="<?=$arItem['NO_PHOTO']['src']?>" title="<?=$arItem['NAME']?>" alt="<?=$arItem['NAME']?>" /><?
					}
				if(isset($arItem['DETAIL_PAGE_URL']))
				{
					?></a><?
				} else {
					?></span><?
				}
			?></div><?
			// PRICE
			if( isset($arItem['PRICE_PRINT_DISCOUNT_VALUE']) )
			{
				?><div class="prices"><?=$arItem['PRICE_PRINT_DISCOUNT_VALUE']?></div><?
			}
			// ADD2BASKET
			// NOP
		?></div><?
		return true;
	}
}


?><div class="js-set" <?
	?>data-iblockid="<?=$arParams['IBLOCK_ID']?>" <?
	?>data-ajaxpath="<?=$this->GetFolder();?>/ajax.php?via_ajax=Y" <?
	?>data-currency="<?=$arResult['ELEMENT']['PRICE_CURRENCY']?>" <?
	?>data-lid="<?=SITE_ID?>" <?
	?>data-setOffersCartProps="<?=CUtil::PhpToJSObject($arParams["OFFERS_CART_PROPERTIES"])?>" <?
	?>><?
	
	$prefix = "line1_set_construktor_";
	?><div <?
		?>class="items line1 scrollp horizontal js-line js-line1" <?
		?>data-prefix="<?=$prefix?>" <?
	?>><?
		?><a rel="nofollow" class="scrollbtn prev" href="#"><span><i class="icon pngicons"></i></span></a><?
		?><a rel="nofollow" class="scrollbtn next" href="#"><span><i class="icon pngicons"></i></span></a><?
		?><div class="set_jscrollpane scroll horizontal-only" id="set_scroll_<?=$arResult['ELEMENT']['ID']?>"><?
			?><div class="sliderin scrollinner clearfix"><?
				// ELEMENT
				$arItem = $arResult['ELEMENT'];
				unset($arItem['DETAIL_PAGE_URL']);
				$params = array(
					'TYPE' => 'ELEMENT',
					'IN' => 'Y',
					'PREFIX' => $prefix,
				);
				SetConstruktorShowItem($arItem, $params);
				
				// DEFAULT
				$params = array(
					'TYPE' => 'DEFAULT',
					'IN' => 'Y',
					'PREFIX' => $prefix,
				);
				foreach ($arResult['SET_ITEMS']['DEFAULT'] as $key => $arItem) {
					SetConstruktorShowItem($arItem, $params);
				}
			?></div><?
		?></div><?
	?></div><?
	
	// FULL PANEL
	?><div class="fullpanel clearfix"><?
		if( $arResult['SET_ITEMS']['PRICE']!='' )
		{
			?><div class="block prs"><?
				?><div class="prices"><?
					?><table><?
						?><tr><?
							?><td class="name"><?
								?><span class="title"><?=GetMessage('CATALOG_SET_SUM')?>:</span><?
							?></td><?
							?><td class="val"><?
								?><div class="allprs"><?
									if($arResult['SET_ITEMS']['OLD_PRICE'])
									{
										?> <span class="price old nowrap"><?=$arResult['SET_ITEMS']['OLD_PRICE']?></span><?
									}
									?> <span class="price new nowrap"><?=$arResult['SET_ITEMS']['PRICE']?></span><?
								?></div><?
								if($arResult['SET_ITEMS']['PRICE_DISCOUNT_DIFFERENCE'])
								{
									?><span class="arounddiscount x1"><span class="discount nowrap"><?=GetMessage("CATALOG_SET_DISCOUNT_DIFF", array("#PRICE#" => $arResult["SET_ITEMS"]["PRICE_DISCOUNT_DIFFERENCE"]))?></span></span><?
								}
							?></td><?
						?></tr><?
					?></table><?
				?></div><?
				if($arResult['SET_ITEMS']['PRICE_DISCOUNT_DIFFERENCE'])
				{
					?><span class="arounddiscount x2"><span class="discount nowrap"><?=GetMessage("CATALOG_SET_DISCOUNT_DIFF", array("#PRICE#" => $arResult["SET_ITEMS"]["PRICE_DISCOUNT_DIFFERENCE"]))?></span></span><?
				}
			?></div><?
			?><div class="block myset"><?
				?><a class="myset" href="#myset"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use></svg><?=GetMessage('CATALOG_SET_CONSTRUCT')?></a><?
			?></div><?
			?><div class="block buyset"><?
				?><noindex><form><?
					?><a rel="nofollow" class="btn1 massadd2basket nowrap" href="#"><?=GetMessage('CATALOG_SET_ADD2BASKET')?></a><?
					?><!--a rel="nofollow" class="btn2 buy1click set nowrap fancyajax fancybox.ajax" href="<?=SITE_DIR?>include/popup/buy1click/" title="<?=GetMessage('CATALOG_SET_BUY1CLICK')?>"><?=GetMessage('CATALOG_SET_BUY1CLICK')?></a--><?
				?></form><noindex><?
			?></div><?
		} else {
			?><div class="block prs"><?
				?><?=GetMessage('CATALOG_SET_CANT_BUY')?><?
			?></div><?
			?><div class="block myset"><?
				?><a class="myset" href="#myset"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use></svg><?=GetMessage('CATALOG_SET_CONSTRUCT')?></a><?
			?></div><?
		}
	?></div><?
	
	$prefix = "line2_set_construktor_";
	?><div <?
		?>class="items line2 scrollp horizontal noned js-line js-line2" <?
		?>data-prefix="<?=$prefix?>" <?
	?>><?
		?><a rel="nofollow" class="scrollbtn prev" href="#"><span><i class="icon pngicons"></i></span></a><?
		?><a rel="nofollow" class="scrollbtn next" href="#"><span><i class="icon pngicons"></i></span></a><?
		?><div class="set_jscrollpane scroll horizontal-only" id="set_scroll_<?=$arResult['ELEMENT']['ID']?>"><?
			?><div class="sliderin scrollinner clearfix"><?
				// DEFAULT
				$params = array(
					'TYPE' => 'DEFAULT',
					'IN' => 'Y',
					'PREFIX' => $prefix,
				);
				foreach ($arResult["SET_ITEMS"]["DEFAULT"] as $key => $arItem) {
					SetConstruktorShowItem($arItem,$params);
				}
				// OTHER
				$params = array(
					'TYPE' => 'OTHER',
					'PREFIX' => $prefix,
				);
				foreach ($arResult["SET_ITEMS"]["OTHER"] as $key => $arItem) {
					SetConstruktorShowItem($arItem,$params);
				}
			?></div><?
		?></div><?
	?></div><?
	
?></div><?
?><script>
	BX.message({
		RSGoPro_SET_PROD_ID: '<?=GetMessageJS('RSGOPRO.SET_PROD_ID')?>',
		RSGoPro_SET_PROD_NAME: '<?=GetMessageJS('RSGOPRO.SET_PROD_NAME')?>',
		RSGoPro_SET_PROD_LINK: '<?=GetMessageJS('RSGOPRO.SET_PROD_LINK')?>',
		RSGoPro_SET_NABOR: '<?=GetMessageJS('RSGOPRO.SET_NABOR')?>',
	});
</script>
