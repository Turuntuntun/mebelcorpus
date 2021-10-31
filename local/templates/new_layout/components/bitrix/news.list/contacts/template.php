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
$path = $templateFolder. '/ajax.php';

?>
<section class="contacts mb-90" data-component-link="<?=$path?>">
    <div class="container" >
        <h1 class="contacts__title title-first mb-60"><?=getMessage('CTL_CONTACTS_TITLE')?></h1>
        <div class="contacts__map">
            <div class="contacts__side">
                <div class="contacts__select">
                    <select name="map-select" data-contact-select>
                        <?foreach($arResult["ITEMS"] as $arItem):?>
                            <option data-contact-id="<?=$arItem['ID']?>" value="<?=$arItem['PROPERTIES']['SHOP_MAP_COORDS']['VALUE']?>"><?=$arItem['NAME']?></option>
                        <?endforeach;?>
                    </select>
                    <svg width="24" height="24">
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow-downward"></use>
                    </svg>
                </div>
                <div class="contacts__content">
                    <div class="contacts__item" >
                        <svg width="20" height="20">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#location"></use>
                        </svg>
                        <address class="contacts__address" data-contact-adress><?=$arResult['ITEMS'][0]['PROPERTIES']['UF_ADRESS']['VALUE']?></address>
                    </div>
                    <div class="contacts__item" >
                        <svg width="20" height="20">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#telephone-fill"></use>
                        </svg>
                        <div class="contacts__"><a class="contacts__tel" data-contact-phone href="tel:<?=$arResult['ITEMS'][0]['PROPERTIES']['UF_PHONE']['VALUE']?>"><?=$arResult['ITEMS'][0]['PROPERTIES']['UF_PHONE']['VALUE']?></a></div>
                    </div>
                    <div class="contacts__item" >
                        <svg width="20" height="20">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#email"></use>
                        </svg><a  data-contact-email href="mailto:<?=$arResult['ITEMS'][0]['PROPERTIES']['UF_EMAIL']['VALUE']?>"><?=$arResult['ITEMS'][0]['PROPERTIES']['UF_EMAIL']['VALUE']?></a>
                    </div>
                </div>
            </div>
            <div class="map" id="map"></div>
        </div>
    </div>
</section>
