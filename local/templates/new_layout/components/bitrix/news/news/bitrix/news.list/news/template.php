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
<section class="news mb-90">
    <div class="container">
        <h1 class="news__title title-first mb-60"><?=GetMessage('CTL_TITLE_NEWS')?></h1>
        <ul class="news__list news-list" data-discount-contatainer>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <li class="news-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a class="news-cards__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
            <img class="news-cards__img" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
            <div class="news-cards__text-wrap">
                <time class="news-cards__date" datetime="2020-12-10"><?=$arItem['DATE_CREATE']?></time>
                <div class="news-cards__caption"><?=$arItem['NAME']?></div>
                <p><?=$arItem['PREVIEW_TEXT']?></p>
            </div></a></li>
<?endforeach;?>
        </ul>
        <div class="news__pagination">
            <div class="pagination" data-paggination>
                <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                    <?=$arResult["NAV_STRING"]?>
                <?endif;?>
            </div>
        </div>
    </div>
</section>
