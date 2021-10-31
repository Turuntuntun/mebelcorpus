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

$buttonId = $this->randString();
?>

<div class="footer__wrap"  id="sender-subscribe">
<?

?>
    <form class="footer__form subscription-form" id="bx_subscribe_subform_<?=$buttonId?>" role="form" method="post" action="<?=$arResult["FORM_ACTION"]?>">
        <?=bitrix_sessid_post()?>
        <label class="subscription-form__label footer__caption" for="subscription"><?=GetMessage('subscr_form_title')?> </label>
        <input type="hidden" name="sender_subscription" value="add">
        <span data-subsctribe-sucess hidden><?=GetMessage('subscr_form_success')?></span>
        <div class="subscription-form__wrap">
            <input class="subscription-form__input" type="email" name="SENDER_SUBSCRIBE_EMAIL" value="" placeholder="<?=htmlspecialcharsbx(GetMessage('subscr_form_placeholder_email'))?>">
            <button class="subscription-form__btn button" id="bx_subscribe_btn_<?=$buttonId?>" data-subscribe-submit>
                <svg width="20" height="16">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow"></use>
                </svg>
            </button>
        </div>
    </form>
</div>