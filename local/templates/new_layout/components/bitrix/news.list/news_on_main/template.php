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
<section class="main-news mb-90">
    <div class="container">
        <div class="main-news__header title-wb mb-60">
            <h2 class="main-news__title title-second"><?=GetMessage('CT_BNL_TITLE_NEWS')?></h2>
            <a class="main-news__more title-wb__link" href="/news/"><?=GetMessage('CT_BNL_LINK_NEWS')?></a>
        </div>
        <ul class="main-news__list news-cards">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <li class="news-cards__item"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a class="news-cards__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
            <img class="news-cards__img" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
            <div class="news-cards__text-wrap">
                <time class="news-cards__date" datetime="2020-12-10"><?=$arItem['DATE_CREATE']?></time>
                <div class="news-cards__caption"><?=$arItem['NAME']?></div>
                <p><?=$arItem['PREVIEW_TEXT']?></p>
            </div></a>
    </li>
<?endforeach;?>

        </ul>
    </div>
</section>