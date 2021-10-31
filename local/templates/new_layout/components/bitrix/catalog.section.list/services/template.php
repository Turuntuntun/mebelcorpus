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




<!--<li class="services__item"><span>Доставка до подъезда без подъема в квартиру</span><span>1 000 руб.</span></li>-->
<!--                   -->
<section class="services mb-90">
    <div class="container">
        <div class="container__narrow">
        <h1 class="services__title title-first mb-60"><?=GetMessage('CTL_BCSL_ELEMENT_TITLE')?></h1>
        <? foreach ($arResult['SECTIONS'] as $key => $arElem) :?>
            <?
                $this->AddEditAction($arElem['ID'], $arElem['EDIT_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElem['ID'], $arElem['DELETE_LINK'], CIBlock::GetArrayByID($arElem["IBLOCK_ID"], "ELEMENT_DELETE"));
                ?>
            <div class="services__block mb-60" id="<?=$this->GetEditAreaId($arElem['ID']);?>">
            <div class="services__caption"><?=$arElem['NAME']?></div>
            <p><?=$arElem['DESCRIPTION']?></p>
            <ul class="services__list">
                <li class="services__item services__item--head"><span><?=GetMessage('CTL_BCSL_ELEMENT_NAME_TITLE')?></span><span><?=GetMessage('CTL_BCSL_ELEMENT_PRICE_TITLE')?></span></li>
                <? foreach ($arElem['ITEMS'] as $arItem) :?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
                    $this->AddEditAction($arItem['ID'], $arItem['ADD_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_ADD"));
                    ?>
                    <li class="services__item"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <span><?=$arItem['NAME']?></span>
                            <span><?=$arItem['UF_PRICE']?></span>
                    </li>
                <? endforeach;?>
            </ul>
        </div>
        <? endforeach;?>
        </div>
    </div>
</section>
