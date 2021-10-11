<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<!-- tpanel1 -->
<div id="tpanel" class="tpanel js-tpanel mod-background hidden-print">
	<div class="tline"></div>

	<div class="centering">
		<div class="centeringin clearfix">

<div class="authandlocation nowrap">


<?
if ( SITE_ID == 'sm' )
{
	$lang = $APPLICATION->get_cookie( 'SUNDUK_LANG' );
	?>
		<div id="ownd-lang">
			<select>
				<option value="ru">Ru</option>
				<option value="en" <?=( $lang == 'en' ? 'selected' : '' )?>>En</option>
			</select>
		</div>
	<?
}
?>


<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/location.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/auth.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/topline_menu.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>

		</div>
	</div>
</div>
<!-- /tpanel1 -->
