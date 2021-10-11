<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>

<div class="b-iblockdetail clearfix" id="<?=$arResult['ID']?>" itemscope itemtype="http://schema.org/NewsArticle"><?
	?><meta itemprop="name headline" content="<?=$arResult['NAME']?>"><?

	?><div class="row"><?

		?><div class="col-sm-12 clearfix"><?
			if ($arParams["DISPLAY_PICTURE"] != 'N' && is_array($arResult["DETAIL_PICTURE"])) {
				?><div class="b-iblockdetail__pic" itemprop="image" itemscope itemtype="https://schema.org/ImageObject"><?
					?><img <?
						?>src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" <?
						?>alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" <?
						?>title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>" <?
						?>itemprop="contentUrl url" <?
					?>/><?
					?><meta itemprop="width" content="<?=$arResult['DETAIL_PICTURE']['WIDTH']?>"><?
					?><meta itemprop="height" content="<?=$arResult['DETAIL_PICTURE']['HEIGHT']?>"><?
				?></div><?
			}
			?><div class="b-iblockdetail__text" itemprop="description articleBody"><?
				if ($arResult["NAV_RESULT"]) {
					if($arParams["DISPLAY_TOP_PAGER"]) { ?><?=$arResult["NAV_STRING"];?><? }
					?><?=$arResult["NAV_TEXT"];?><?
					if($arParams["DISPLAY_BOTTOM_PAGER"]) { ?><?=$arResult["NAV_STRING"];?><? }
				} elseif (strlen($arResult["DETAIL_TEXT"]) > 0) {
					?><?=$arResult["DETAIL_TEXT"];?><?
				} else {
					?><?=$arResult["PREVIEW_TEXT"];?><?
				}
			?></div><?
		?></div><?

		?><div class="col-sm-12"><?
			?><div class="b-iblockdetail__ya-share"><?
			// yandex share
			if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/ya-share.php', $getTemplatePathPartParams))) {
				include($path);
			}
			?></div><?
		?></div><?

		?><div class="col-sm-12"><?
			?><div class="b-iblockdetail__bot"><?
				?><div class="b-iblockdetail__back"><?
					?><a class="b-iblockdetail__fullback" href="<?=$arParams['IBLOCK_URL']?>">&larr; <?=GetMessage('GO_BACK')?></a><?
				?></div><?
				if ($arParams['DISPLAY_DATE']!='N' && $arResult['DISPLAY_ACTIVE_FROM']) {
					?><div class="b-iblockdetail__date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></div><?
				}
			?></div><?
		?></div><?

	?></div><?
	/* schema.org additional */
	?><div class="b-article-detail__additional-items"><?
		/* author */
		if (isset($arResult['MICRODATA']['AUTHOR'])):
			?><link class="additional-items__author" itemprop="author" content="<?=$arResult['MICRODATA']['AUTHOR']['FULL_NAME']?>"><?
		endif;
		/* /author */

		/* publisher */
		if (isset($arParams['PUBLISHER_TYPE']) && isset($arResult['MICRODATA']['AUTHOR'])):
			?><div class="additional-items__publisher"><?
				if ($arParams['PUBLISHER_TYPE'] == 'person'):
					?><div itemprop="publisher" itemscope itemtype="http://schema.org/Person"><?
						?><link itemprop="name" content="<?=$arResult['MICRODATA']['AUTHOR']['NAME']?>"><?
						?><link itemprop="familyName" content="<?=$arResult['MICRODATA']['AUTHOR']['LAST_NAME']?>"><?
					?></div><?
				endif;
				if ($arParams['PUBLISHER_TYPE'] == 'organization'):
					?><div itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><?
						?><link itemprop="name" content="<?=$arResult['MICRODATA']['AUTHOR']['FULL_NAME']?>"><?
						if (isset($arResult['MICRODATA']['ORGANIZATION']['IMAGE_URL']) && strlen($arResult['MICRODATA']['ORGANIZATION']['IMAGE_URL']) > 0):
							?><span itemprop="logo" itemscope itemtype="http://schema.org/ImageObject"><?
								//$logoUrl = CHTTP::URN2URI($arResult['MICRODATA']['ORGANIZATION']['IMAGE_URL']);
								?><link itemprop="url contentUrl" href="<?=$arResult['MICRODATA']['ORGANIZATION']['IMAGE_URL']?>"><?
							?></span><?
						endif;
						if (isset($arResult['MICRODATA']['ORGANIZATION']['ADDRESS']) && strlen($arResult['MICRODATA']['ORGANIZATION']['ADDRESS']) > 0):
							?><link itemprop="address" content="<?=$arResult['MICRODATA']['ORGANIZATION']['ADDRESS']?>"><?
						endif;
						if (isset($arResult['MICRODATA']['ORGANIZATION']['PHONE']) && strlen($arResult['MICRODATA']['ORGANIZATION']['PHONE']) > 0):
							?><link itemprop="telephone" content="<?=$arResult['MICRODATA']['ORGANIZATION']['PHONE']?>"><?
						endif;
					?></div><?
				endif;
			?></div><?
		endif;
		/* /publisher */

		/* date published */
		if (isset($arResult['DATE_CREATE']) && strlen($arResult['DATE_CREATE']) > 0):
			?><link class="additional-items__date-published" itemprop="datePublished" content="<?=date("Y-m-d", strtotime($arResult['DATE_CREATE']))?>"><?
		endif;
		/* /date published */
		
		/* date modifier */
		if (isset($arResult['TIMESTAMP_X']) && strlen($arResult['TIMESTAMP_X']) > 0):
			?><link class="additional-items__date-modified" itemprop="dateModified" content="<?=date("Y-m-d", strtotime($arResult['TIMESTAMP_X']))?>"><?
		endif;
		/* /date modifier */
	?></div><?
	/* /schema.org additional */
?></div><?
