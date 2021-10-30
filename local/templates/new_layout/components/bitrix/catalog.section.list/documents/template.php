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
<section class="documents mb-90">
    <div class="container">
        <h1 class="documents__title title-first mb-60"><?=GetMessage('CTL_BCSL_ELEMENT_TITLE')?></h1>
        <? foreach ($arResult['SECTIONS'] as $key => $arElem) :?>
            <?
                $this->AddEditAction($arElem['ID'], $arElem['EDIT_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElem['ID'], $arElem['DELETE_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_DELETE"));
                ?>
            <div class="documents__block mb-90" id="<?=$this->GetEditAreaId($arElem['ID']);?>">
            <h2 class="documents__caption"><?=$arElem['NAME']?></h2>
            <ul class="documents__list download-list">
                <? foreach ($arElem['ITEMS'] as $document) :?>
                    <?
                    $this->AddEditAction($document['ID'], $document['EDIT_LINK'], CIBlock::GetArrayByID($document["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($document['ID'], $document['DELETE_LINK'], CIBlock::GetArrayByID($document["IBLOCK_ID"], "ELEMENT_DELETE"));
                    $this->AddEditAction($document['ID'], $document['ADD_LINK'], CIBlock::GetArrayByID($document["IBLOCK_ID"], "ELEMENT_ADD"));
                    ?>
                <li class="download-list__item"  id="<?=$this->GetEditAreaId($document['ID']);?>"><a class="download-list__card" download href="<?=$document['UF_FILE']?>"><span><?=$document['NAME']?></span>
                        <svg width="32" height="32">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#generate-pdf"></use>
                        </svg></a></li>
                <? endforeach;?>
            </ul>
        </div>
        <? endforeach;?>
    </div>
</section>
