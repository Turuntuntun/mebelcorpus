<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();

?>

<div class="modal modal--account <?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) echo 'active'?>" id="login">
    <div class="modal__container">
        <h2 class="modal__title title-second"><?=GetMessage("AUTH_TITLE_TEXT")?></h2>
        <?
        if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) :?>
            <p class="modal__warning"><?=GetMessage("AUTH_ERROR")?></p>
        <? endif; ?>

        <button class="modal__close-btn button-close" type="button" aria-label="Закрыть окно" data-close="">
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#close"></use>
            </svg>
        </button>
        <?if($arResult["FORM_TYPE"] == "login"):?>

            <form name="system_auth_form<?=$arResult["RND"]?>" class="modal__form form" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <?if($arResult["BACKURL"] <> ''):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <?foreach ($arResult["POST"] as $key => $value):?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach?>
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />

                    <div class="form__item">
                        <label class="form__label">
                            <input class="form__input" placeholder="Email" name="USER_LOGIN" maxlength="50" value="" size="17">
                        </label>
                    </div>
                <script>
                    BX.ready(function() {
                        var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                        if (loginCookie)
                        {
                            var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                            var loginInput = form.elements["USER_LOGIN"];
                            loginInput.value = loginCookie;
                        }
                    });
                </script>

                <div class="form__item">
                    <label class="form__label">
                        <input class="form__input" type="password" name="USER_PASSWORD" maxlength="255" size="17" autocomplete="off" placeholder="Пароль">
                    </label>
                </div>
                <?if($arResult["SECURE_AUTH"]):?>
                            <span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                <div class="bx-auth-secure-icon"></div>
                            </span>
                            <noscript>
                            <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                            </span>
                            </noscript>
            <script type="text/javascript">
            document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
            </script>
            <?endif?>

                <?if ($arResult["CAPTCHA_CODE"]):?>


                            <?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
                            <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
                            <input type="text" name="captcha_word" maxlength="50" value="" />

                <?endif?>
                <input class="form__submit-btn button" type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
            </form>
            <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
                <noindex>
                    <p class="modal__bot-text"><?=GetMessage("AUTH_NOT_HAVE")?>
                        <a href="#" data-modal-trigger="registration" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?>
                        </a>
                </noindex>
            <?endif?>
        <? endif;?>
    </div>
</div>

