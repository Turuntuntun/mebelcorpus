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
$this->setFrameMode(true);?>

<form class="header__search search-form" action="<?=$arResult["FORM_ACTION"]?>">
    <button class="search-form__btn" type="submit">
        <svg width="20" height="20">
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#icons-search"></use>
        </svg>
    </button>
    <label>
        <input class="search-form__input" type="text" name="q" value="" size="15" maxlength="50" placeholder="Поиск по сайту">
    </label>
			<input name="s" type="hidden" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" />


</form>
