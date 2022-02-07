<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
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

if ($arResult['SECTIONS']) :?>
<section class="main-catalog mb-90">
    <div class="container">
        <h2 class="main-catalog__title title-second mb-60"><?=GetMessage('CT_BCSL_NAME_TITLE')?></h2>
        <ul class="main-catalog__list">
            <?php foreach ($arResult['SECTIONS'] as $key => $arItem) :?>
            <li class="main-catalog__item main-catalog__item--<?=$arItem['UFD_CLASS']?>">
                <a class="main-catalog__card" href="<?=$arItem['SECTION_PAGE_URL']?>">
                    <img class="main-catalog__img" src="<?=$arItem["PICTURE"]["SRC"]?>" alt="">
                    <div class="main-catalog__wrap">
                        <h3 class="main-catalog__caption title-third"><?=$arItem['NAME']?></h3>
                        <div class="main-catalog__btn button"><?=GetMessage('CT_BCSL_NAME_BUTTON')?></div>
                    </div></a></li>
                    <?php endforeach;?>
        </ul>
    </div>
</section>
<?php endif?>
