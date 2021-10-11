<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

// is auth page
$isAuth = 'Y';
if (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'auth/') === false)
	$isAuth = 'N';

// is personal
$isPersonal = 'Y';
if (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'personal/') === false)
	$isPersonal = 'N';

?>

<div class="pcontent<?if($isAuth == 'Y' || $isPersonal == 'Y'):?> thisisauthpage<?endif;?>">

	<div class="someform register clearfix<?if($arResult['SECURE_AUTH']):?> secure<?endif;?>">
		
		<?//php ShowMessage($arParams['~AUTH_RESULT']); ?>

		<?php if ($arResult['USE_EMAIL_CONFIRMATION'] === 'Y' && is_array($arParams['AUTH_RESULT']) &&  $arParams['AUTH_RESULT']['TYPE'] === 'OK'): ?>
			<?php ShowMessage(GetMessage('AUTH_RESULT')); ?>
			<p><font class="notetext"><?=GetMessage('AUTH_RESULT')?></font></p>
		<?php endif; ?>

		<?$APPLICATION->IncludeComponent(
			"bitrix:main.register",
			"",
			Array(
				"AUTH" => "Y",
				"REQUIRED_FIELDS" => array("EMAIL", "NAME", "SECOND_NAME", "LAST_NAME", "PERSONAL_PHONE"),
				"SET_TITLE" => "Y",
				"SHOW_FIELDS" => array("EMAIL", "NAME", "SECOND_NAME", "LAST_NAME", "PERSONAL_PHONE"),
				"SUCCESS_PAGE" => "/auth/ok.php",
				"USER_PROPERTY" => array(),
				"USER_PROPERTY_NAME" => "",
				"USE_BACKURL" => "Y"
			)
		);?>

		<div class="line notes clearfix">
			<div><?=$arResult['GROUP_POLICY']['PASSWORD_REQUIREMENTS'];?></div>
			<div>* <?=GetMessage('AUTH_REQ')?></div>
			<div><a href="<?=$arResult['AUTH_AUTH_URL']?>" rel="nofollow"><?=GetMessage('AUTH_AUTH')?></a></div>
		</div>

	</div>

</div>


