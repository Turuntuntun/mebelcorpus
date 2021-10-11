<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();


?>

<?if($USER->IsAuthorized())
{
	?>
	<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
	<?
}
else
{

    if (count($arResult["ERRORS"]) > 0)
    {
        foreach ($arResult["ERRORS"] as $key => $error)
            if (intval($key) == 0 && $key !== 0) 
                $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
        ShowError(implode("<br />", $arResult["ERRORS"]));

	} elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y") {?>
			<p><font class="notetext"><?=GetMessage('AUTH_RESULT')?></font></p>
	<?}?>




	<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">

		<?if($arResult["BACKURL"] <> '') {?>
		    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?}?>
		<input type="hidden" name="REGISTER[LOGIN]" id="login" value="<?=$arResult["VALUES"]["EMAIL"]?>">

		<div class="line clearfix">
			<input type="text" name="REGISTER[NAME]" maxlength="50" value="<?=$arResult["VALUES"]["NAME"]?>" placeholder="<?=GetMessage("REGISTER_FIELD_NAME")?>*" />
		</div>

		<div class="line clearfix">
			<input type="text" name="REGISTER[SECOND_NAME]" maxlength="50" value="<?=$arResult["VALUES"]["SECOND_NAME"]?>" placeholder="<?=GetMessage("REGISTER_FIELD_SECOND_NAME")?>*" />
		</div>

		<div class="line clearfix">
			<input type="text" name="REGISTER[LAST_NAME]" maxlength="50" value="<?=$arResult["VALUES"]["LAST_NAME"]?>" placeholder="<?=GetMessage("REGISTER_FIELD_LAST_NAME")?>*" />
		</div>		

		<div class="line clearfix">
			<input type="text" name="REGISTER[EMAIL]" maxlength="50" id="email" value="<?=$arResult["VALUES"]["EMAIL"]?>" placeholder="<?=GetMessage("REGISTER_FIELD_EMAIL")?>*" />
		</div>

		<div class="line clearfix">
			<input type="text" name="REGISTER[PERSONAL_PHONE]" maxlength="50" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>" placeholder="<?=GetMessage("REGISTER_FIELD_PERSONAL_PHONE")?>*" />
		</div>


		<div class="line password clearfix">
			<input class="text" type="password" name="REGISTER[PASSWORD]" maxlength="50" value="<?//=$arResult['USER_PASSWORD']?>" placeholder="<?=GetMessage('AUTH_PASSWORD_REQ')?>*" />
		</div>
		
		<?php if ($arResult['SECURE_AUTH']): ?>
			<div class="line">
				<noscript><?php ShowError(GetMessage('AUTH_NONSECURE_NOTE')); ?></noscript>
			</div>
		<?php endif; ?>
		
		<div class="line clearfix">
			<input type="password" name="REGISTER[CONFIRM_PASSWORD]" maxlength="50" value="<?//=$arResult['USER_CONFIRM_PASSWORD']?>" placeholder="<?=GetMessage('AUTH_CONFIRM')?>*" />
		</div>


		<!-- // CAPTCHA -->
		<?php if ($arResult['USE_CAPTCHA'] == 'Y'): ?>
			<div class="line captcha clearfix">
				<input type="hidden" name="captcha_sid" value="<?=$arResult['CAPTCHA_CODE']?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA_CODE']?>" alt="CAPTCHA" style="width: 146px; height: 37px;" />
				<input class="text" type="text" name="captcha_word" maxlength="50" value="" placeholder="<?=GetMessage('CAPTCHA_REGF_PROMT')?>*" />
			</div>
		<?php endif; ?>
		<!-- // /CAPTCHA -->

		<?php
		global $licenseWorkLinkFull;
		echo $licenseWorkLinkFull;
		?>

		<div class="line buttons clearfix">
			<button class="btn btn-primary" type="submit"  name="register_submit_button" value="<?=GetMessage('AUTH_REGISTER')?>" /><?=GetMessage('AUTH_REGISTER')?></button>
		</div>

	</form>
	<?
}?>
<script type="text/javascript">
	const input = document.getElementById('email');
	const login = document.getElementById('login');
	input.addEventListener('input', function updateValue(e) {
		login.value = e.target.value;
		console.log(e.target.value);
	});
</script>