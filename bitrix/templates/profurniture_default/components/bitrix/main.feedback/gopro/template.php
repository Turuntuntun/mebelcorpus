<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<script type="text/javascript">
	RSGoPro_SetSet();
</script>

<div class="someform clearfix">

	<?php if (!empty($arResult['ERROR_MESSAGE'])): ?>
		<?php foreach ($arResult['ERROR_MESSAGE'] as $v): ?>
			<?php ShowError($v); ?>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if (strlen($arResult['OK_MESSAGE']) > 0): ?>
		<?php ShowMessage(array('MESSAGE' => $arResult['OK_MESSAGE'], 'TYPE' => 'OK')); ?>
		<script type="text/javascript">
			setTimeout(function(){
				$.fancybox.close();
			}, 2500);
		</script>
	<?php endif; ?>

	<form action="<?=POST_FORM_ACTION_URI?>" method="POST"<?if($arParams['YM_USE_TARGETS'] == 'Y' && strlen($arParams['YM_TARGET_NAME']) > 0):?> onsubmit="ym(<?=$arResult['YM_COUNTER_NUMBER']?>, 'reachGoal', '<?=$arParams['YM_TARGET_NAME']?>'); return true;"<?endif;?>>
		
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="PARAMS_HASH" value="<?=$arResult['PARAMS_HASH']?>">
		
		<div class="line clearfix">
			<input type="text" name="user_name" value="<?=$arResult['AUTHOR_NAME']?>" placeholder="<?=GetMessage('MFT_NAME')?><?if(empty($arParams['REQUIRED_FIELDS']) || in_array('NAME', $arParams['REQUIRED_FIELDS'])):?>*<?endif;?>:" />
		</div>
		
		<div class="line clearfix">
			<input type="text" name="user_email" value="<?=$arResult['AUTHOR_EMAIL']?>" placeholder="<?=GetMessage('MFT_EMAIL')?><?if(empty($arParams['REQUIRED_FIELDS']) || in_array('EMAIL', $arParams['REQUIRED_FIELDS'])):?>*<?endif;?>:" />
		</div>
		
		<div class="line clearfix">
			<textarea name="MESSAGE" placeholder="<?=GetMessage('MFT_MESSAGE')?><?if(empty($arParams['REQUIRED_FIELDS']) || in_array('MESSAGE', $arParams['REQUIRED_FIELDS'])):?>*<?endif;?>:"><?=$arResult['MESSAGE']?></textarea>
		</div>
		
		<!-- // CAPTCHA -->
		<?php if ($arParams['USE_CAPTCHA'] == 'Y'): ?>
			<div class="line captcha clearfix">
				<input type="hidden" name="captcha_sid" value="<?=$arResult['capCode']?>">
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['capCode']?>" width="180" height="40" alt="CAPTCHA">
				<input type="text" name="captcha_word" size="30" maxlength="50" value="" placeholder="<?=GetMessage('MFT_CAPTCHA_CODE')?>*" />
			</div>
		<?php endif; ?>
		<!-- // /CAPTCHA -->

		<?php
		global $licenseWorkLinkFull;
		echo $licenseWorkLinkFull;
		?>
		
		<div class="line buttons clearfix">
			<button class="btn-primary" type="submit" name="submit" value="<?=GetMessage('MFT_SUBMIT')?>"><?=GetMessage('MFT_SUBMIT')?></button>
		</div>
		
	</form>
	
</div>
