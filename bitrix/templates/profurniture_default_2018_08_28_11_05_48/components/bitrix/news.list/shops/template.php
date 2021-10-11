<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);

$templateData['GOPRO'] = $arParams['GOPRO'];
?>

<?php if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0): ?>
	<div class="shops">
		<div class="cell items">
			<div id="lovekids_shops">
				<?php foreach ($arResult['ITEMS'] as $arItem):
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="shop_item" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<input type="checkbox" value="1" id="rs_shop_<?=$arItem['ID']?>" name="shop_id[]" class="check" data-coords="<?=$arItem['PROPERTIES']['SHOP_MAP_COORDS']['VALUE']?>" data-zoom="<?=$arItem['PROPERTIES']['SHOP_MAP_ZOOM']['VALUE']?>">
						<label for="rs_shop_<?=$arItem['ID']?>">
						<?php if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
							<strong><?=$arItem['NAME'];?></strong>
						<?php endif; ?>
						</label>
						<?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
							<p class="descr"><?=$arItem["PREVIEW_TEXT"];?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="cell map">
			<div id="rsGoproShops"></div>
		</div>
	</div>
<?php endif; ?>
