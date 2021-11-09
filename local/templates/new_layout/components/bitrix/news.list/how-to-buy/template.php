<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<section class="payment mb-90">
    <div class="container">
        <div class="payment__content container__narrow">
            <h1 class="payment__title title-first mb-60"><?=GetMessage('CT_BNL_TITLE')?></h1>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="payment__item"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="payment__caption"><?=$arItem['PROPERTIES']['UF_TITLE']['VALUE']?></div>
        <?=$arItem['PROPERTIES']['UF_TEXT']['~VALUE']['TEXT']?>
        <? if ($arItem['PROPERTIES']['UF_FILE_PAY']['VALUE']) :?>
        <ul class="payment__list pay-list">
            <? foreach ($arItem['PROPERTIES']['UF_FILE_PAY']['VALUE'] as $filePay) :?>
            <li class="pay-list__item"><img src="<?=$filePay['SRC']?>" width="<?=$filePay['UF_WIDTH']?>" height="<?=$filePay['UF_HEIGTH']?>" alt="<?=$filePay['NAME']?>"></li>
            <? endforeach;?>
        </ul>
        <? endif;?>
    </div>
<?endforeach;?>
</div>
        </div>
</section>
