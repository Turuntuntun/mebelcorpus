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
<div class="popup" id="select-city" data-popup>
    <div class="popup__container">
        <h2 class="popup__title">Выберите город</h2>
        <button class="popup__close-btn button-close" type="button" aria-label="Закрыть окно" data-close="">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#close"></use>
            </svg>
        </button>
        <ul class="popup__list city-list">
            <? foreach ($arResult['ITEMS'] as $key => $arItem) :?>
                <li class="city-list__item">
                    <a class="city-list__link <? if ($GLOBALS['UF_USER_REGION']['FIELDS']['ID'] == $arItem['ID']) echo 'active'?>" href="<?=$APPLICATION->getCurPAge()?>?setCityId=<?=$arItem['ID']?>">
                        <?=$arItem['NAME']?>
                    </a>
                </li>
            <? endforeach;?>
        </ul>
    </div>
</div>
