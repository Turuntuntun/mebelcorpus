<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<div class="modal modal--callback" id="callback">
    <div class="modal__container success" hidden>
        <h2 class="modal__title title-second"><?=$arParams['OK_TEXT']?></h2>
    </div>
    <div class="modal__container default">
        <h2 class="modal__title title-second"><?=$arParams['TITLE']?></h2>
        <button class="modal__close-btn button-close" type="button"  data-close="">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#close"></use>
            </svg>
        </button>

        <form class="modal__form form" action="<?=$templateFolder. '/ajax.php';?>" method="POST" data-component = 'callback-form'>
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="message_id" value="<?=$arParams['EVENT_MESSAGE_ID'][0]?>">
            <div class="form__item">
                <label class="form__label" >
                    <?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req"> *</span><?endif?>
                </label>
                <input class="form__input" type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>" <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?> required <?endif;?>
            </div>
            <div class="form__item">
                <label class="form__label">
                    <?=GetMessage("MFT_PHONE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req"> *</span><?endif?>
                </label>
                <input class="form__input" type="tel" name="user_phone" <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?> required <? endif;?>>
            </div>

            <div class="form__item">
                <label class="form__label">
                    <?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req"> *</span><?endif?>
                </label>
                <input class="form__input" type="text" name="MESSAGE" <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?> required <? endif;?>>
            </div>
            <input class="form__submit-btn button" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
        </form>
        <p class="modal__bot-text"><?=GetMessage("MFT_BOTTOM_TEXT")?></p>

    </div>
</div>