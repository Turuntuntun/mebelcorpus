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



<section class="press-kit mb-90">
    <div class="container">
        <? foreach ($arResult['SECTIONS'] as $key => $arElem) :?>
            <?
                $this->AddEditAction($arElem['ID'], $arElem['EDIT_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElem['ID'], $arElem['DELETE_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_DELETE"));
                ?>
                <div class="press-kit__head mb-90" id="<?=$this->GetEditAreaId($arElem['ID'])?>">
                    <h1 class="press-kit__title title-first mb-60"><?=GetMessage('CTL_BCSL_ELEMENT_TITLE')?></h1>
                    <p><?=$arElem['DESCRIPTION']?></p>
                </div>
                <? foreach ($arElem['ITEMS'] as $document) :?>
                    <?
                    $this->AddEditAction($document['ID'], $document['EDIT_LINK'], CIBlock::GetArrayByID($document["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($document['ID'], $document['DELETE_LINK'], CIBlock::GetArrayByID($document["IBLOCK_ID"], "ELEMENT_DELETE"));
                    $this->AddEditAction($document['ID'], $document['ADD_LINK'], CIBlock::GetArrayByID($document["IBLOCK_ID"], "ELEMENT_ADD"));
                    ?>
                    <div class="press-kit__block mb-60" id="<?=$this->GetEditAreaId($document['ID']);?>">
                        <h2 class="press-kit__caption documents__caption"><?=$document['NAME']?></h2>
                        <ul class="press-kit__list download-list">
                            <li class="download-list__item"  >
                                <a class="download-list__card" download href="<?=$document['UF_FILE']?>"><span><?=$document['UF_FILE_TEXT']?></span>
                                    <svg width="32" height="32">
                                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#file"></use>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                <? endforeach;?>

        <? endforeach;?>
        </div>

</section>
