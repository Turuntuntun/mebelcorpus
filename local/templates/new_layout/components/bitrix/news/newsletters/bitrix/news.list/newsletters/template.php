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
<section class="info-letters mb-90">
    <div class="container">
        <h2 class="info-letters__title title-second mb-60"><?=GetMessage('CTL_BLOCK_NEWSLETTERS_TITLE')?></h2>
        <ul class="info-letters__list news-cards">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <li class="news-cards__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a class="news-cards__link news-cards__link--nohover" href="<?=$arItem['DETAIL_PAGE_URL']?>">
            <img class="news-cards__img news-cards__img--br" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
            <div class="news-cards__text-wrap news-cards__text-wrap--woborder">
                <div class="news-cards__caption"><?=$arItem['NAME']?></div>
                <p><?=$arItem['PREVIEW_TEXT']?></p>
            </div>
        </a>
    </li>

<?endforeach;?>
        </ul>
    </div>
</section>


