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
<section class="news-item mb-90">
    <div class="container">
        <div class="container__narrow container__narrow--center">
            <h1 class="news-item__title title-first mb-60"><?=$arResult['NAME']?></h1>
            <div class="news-item__block">
                <div class="news-item__banner">
                    <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>"></div>
                    <?= $arResult['PROPERTIES']['UF_TEXT_TOP']['~VALUE']['TEXT']?>
                </div>
            <div class="news-item__block">
                <? if ($arResult['PROPERTIES']['UF_IMAGES']['VALUE']):?>
                <div class="news-item__slider slider-withone">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <? foreach ($arResult['PROPERTIES']['UF_IMAGES']['VALUE'] as $key => $item) :?>
                            <div class="swiper-slide">
                                <div class="news-item__slide"><img src="<?=$item?>" alt=""></div>
                            </div>
                            <? endforeach;?>
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <? endif?>
                <?= $arResult['PROPERTIES']['UF_TEXT_BOT']['~VALUE']['TEXT']?>
            </div>
        </div>
    </div>
</section>