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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
    <button class="pagination__btn button" data-show-more data-next-page="<?=$arResult["NavPageNomer"]+1?>">Показать еще</button>
<?php endif?>
<ul class="pagination__list">

<?if($arResult["bDescPageNumbering"] === true):?>

	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>
    <li  class="pagination__item">
        <a class="pagination__nav pagination__nav--prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-back"></use>
            </svg>
        </a>
    </li>

		<?else:?>
			<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
    <li class="pagination__item">
        <a class="pagination__nav pagination__nav--prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-back"></use>
            </svg>
        </a>
    </li>

			<?else:?>
    <li class="pagination__item"><a class="pagination__nav pagination__nav--prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-back"></use>
            </svg>
        </a>
    </li>

			<?endif?>
		<?endif?>
	<?endif?>

	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
    <li class="pagination__item"><a class="pagination__link active"><?=$NavRecordGroupPrint?></a></li>
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
    <li class="pagination__item"><a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a></li>
		<?else:?>
    <li class="pagination__item"><a  class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a></li>
		<?endif?>

		<?$arResult["nStartPage"]--?>
	<?endwhile?>

	<?if ($arResult["NavPageNomer"] > 1):?>
    <li class="pagination__item">
        <a class="pagination__nav pagination__nav--next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-back"></use>
            </svg>
        </a>
    </li>
	<?endif?>

<?else:?>


	<?if ($arResult["NavPageNomer"] > 1):?>

		<?if($arResult["bSavePage"]):?>
    <li class="pagination__item">
        <a class="pagination__nav pagination__nav--prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?>
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-back"></use>
            </svg>
        </a>
    </li>

		<?else:?>
			<?if ($arResult["NavPageNomer"] > 2):?>
    <li class="pagination__item">
        <a class="pagination__nav pagination__nav--prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-back"></use>
            </svg>
        </a>
    </li>
			<?else:?>
    <li class="pagination__item"><a  class="pagination__nav pagination__nav--prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-back"></use>
            </svg>
        </a>
    </li>
			<?endif?>
		<?endif?>
	<?endif?>

	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
    <li class="pagination__item"><a class="pagination__link active"><?=$arResult["nStartPage"]?></a>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
    <li class="pagination__item"><a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
		<?else:?>
    <li class="pagination__item"><a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>

	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
    <li class="pagination__item">
        <a class="pagination__nav pagination__nav--next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-back"></use>
            </svg>
        </a>
    </li>
	<?endif?>

<?endif?>
</ul>
