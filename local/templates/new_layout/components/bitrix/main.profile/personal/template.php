<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>

<div class="account__block mb-60">
<div class="account__head">
    <h2 class="account__content-title"><?=GetMessage('MAIN_TITLE')?></h2>
    <button class="account__edit-btn" data-change-data="person"><?=GetMessage('CHANGE_DATA')?></button>
</div>
<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<form class="account__form form" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
    <div class="form__item">
        <label class="form__label" for="surname"> <?=GetMessage('LAST_NAME')?></label>
        <input class="form__input" id="surname" type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
    </div>
    <div class="form__item">
        <label class="form__label" for="name"><?=GetMessage('NAME')?></label>
        <input class="form__input" id="name" type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
    </div>

    <div class="form__item">
        <label class="form__label" for="patronymic"><?=GetMessage('SECOND_NAME')?></label>
        <input class="form__input" id="patronymic"  type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
    </div>
    <div class="form__item">
        <label class="form__label" for="form-tel"><?=GetMessage('USER_PHONE')?></label>
        <input class="form__input" id="form-tel" type="text" name="PERSONAL_PHONE" maxlength="50" value="<? echo $arResult["arUser"]["PERSONAL_PHONE"]?>" />
    </div>
    <div class="form__item">
        <label class="form__label" for="form-email"><?=GetMessage('EMAIL')?></label>
        <input class="form__input" id="form-email" type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
    </div>

    <label class="form__checkbox checkbox">
        <input class="checkbox__input visually-hidden" type="checkbox" name="" value=""><span class="checkbox__caption"><?=GetMessage("CHECKBOX_TEXT")?></span>
    </label>
    <div class="account__btns" data-change-block="person">
        <input class="account__save-btn button" type="submit" name="save" value="<?=GetMessage("SAVE")?>">
        <input class="account__save-btn button button--ghost" type="reset" value="<?=GetMessage('RESET');?>">
    </div>
</form>

</div>