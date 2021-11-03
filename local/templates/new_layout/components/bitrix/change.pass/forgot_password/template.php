<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

?>

<div class="account__block">
        <div class="account__head">
            <button class="account__edit-btn" data-change-data="password"><?=GetMessage('TITLE_CHANGE_DATA')?></button>
        </div>
    <div class="account__form-wrap" data-change-block="password">
<form class="account__form form" method="post" name="form2" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                <div class="form__item">
                    <label>
                        <input class="form__input" type="password" name="OLD_PASSWORD" placeholder="<?=GetMessage('OLD_PASS_PLACEHOLDER')?>" maxlength="50" value="" autocomplete="off">
                    </label>
                </div>
                <div class="form__item">
                    <label class="form__label">
                        <input class="form__input" placeholder="<?=GetMessage('NEW_PASS_PLACEHOLDER')?>" type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" />
                    </label>
                </div>
                <div class="form__item">
                    <label class="form__label">
                        <input type="password"  placeholder="<?=GetMessage('NEW_PASS_CONFIRM_PLACEHOLDER')?>" class="form__input" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
                    </label>
                </div>
    <div class="account__btns">
        <input class="account__save-btn button" type="submit" name="submit-change-pass" value="<?=GetMessage("SAVE_PASSWORD")?>">
        <input class="account__save-btn button button--ghost" type="reset" value="<?=GetMessage('RESET_PASSWORD');?>">
    </div>
</form>

    <? if ($arResult['ERROR']) :?>
        <div class="account__warning">
            <svg width="20" height="20">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#attention"></use>
            </svg>
            <p>
                <? echo $arResult['ERROR']; ?>
            </p>
        </div>
    <? elseif ($arResult['SUCCESS'] == 'Y'):?>
        <div class="account__warning">
            <p></p>
            <p>
                <?=GetMessage('SUCCESS_CHANGE_PASSWORD')?>
            </p>
        </div>
        <? endif;?>
    </div>
</div>