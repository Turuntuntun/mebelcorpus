<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>

<div class="b-iblockdetail clearfix"><?
	?><div class="row"><?

		?><div class="col-sm-12 clearfix"><?
			if ($arParams["DISPLAY_PICTURE"] != 'N' && is_array($arResult["DETAIL_PICTURE"])) {
				?><div class="b-iblockdetail__pic"><?
					?><img <?
						?>src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" <?
						?>alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" <?
						?>title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>" <?
					?>/><?
				?></div><?
			}
			?><div class="b-iblockdetail__text"><?
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
?></div>
