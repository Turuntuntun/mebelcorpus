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
<section class="discounts">
    <div class="container">
        <h1 class="discounts__title title-first mb-60"><?=GetMessage("CT_BNL_DISCOUNTS_TITLE")?></h1>
        <ul class="discounts__list discounts-list" data-discount-contatainer>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <li class="discounts-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a class="discounts-list__card" href="<?=$arItem['DETAIL_PAGE_URL']?>">
            <div class="discounts-list__img">
                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                <div class="discounts-list__wrap">
                    <div class="discounts-list__cap"><?=$arItem['PROPERTIES']['UF_TITLE']['~VALUE']['TEXT']?></div>
                    <div class="discounts-list__val"><?=$arItem['PROPERTIES']['UF_PERCENT']['~VALUE']['TEXT']?></div>
                </div>
            </div>
        </a>
            <div class="discounts-list__text-wrap">
                <div class="discounts-list__caption"><?=$arItem['NAME']?></div>
                <div class="discounts-list__desc"><?=$arItem['PREVIEW_TEXT']?></div>
                <a class="discounts-list__btn button button--ghost" href="<?=$arItem['DETAIL_PAGE_URL']?>">Перейти</a>
            </div></li>

        <?endforeach;?>

        </ul>

        <div class="discounts__pagination mb-90" data-paggination>
            <div class="pagination">
                <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                    <?=$arResult["NAV_STRING"]?>
                <?endif;?>

            </div>
        </div>
    </div>
</section>
