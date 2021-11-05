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

<section class="catalog mb-90">
    <div class="container">
        <h1 class="title-first mb-60"><?=GetMessage('CT_BCSL_TITLE')?></h1>
        <ul class="catalog__list catalog-menu">
            <? foreach ($arResult['NEW_SECTIONS'] as $key => $arSection) :?>
            <li class="catalog-menu__item">
                <div class="main-catalog__card">
                    <img class="main-catalog__img" src="<?=$arSection['PICTURE']['SRC']?>" alt="">
                    <div class="main-catalog__wrap">
                        <h3 class="main-catalog__caption title-third"><?=$arSection['NAME']?></h3>
                        <ul class="catalog-menu__inner-list catalog-all">
                            <? foreach ($arSection['CHILDS'] as $key2 => $arChilds) :?>
                                <li class="catalog-all__item">
                                    <a class="catalog-all__link" href="<?=$arChilds['SECTION_PAGE_URL']?>"><?=$arChilds['NAME']?></a>
                                </li>
                            <? endforeach;?>
                        </ul>
                        <a class="main-catalog__btn button" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=GetMessage('CT_BCSL_BUTTON_ALL')?></a>
                    </div>
                </div>
            </li>
            <? endforeach;?>
        </ul>
    </div>
</section>
