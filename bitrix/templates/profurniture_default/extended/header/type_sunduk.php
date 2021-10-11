<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<!-- header type1 -->
<div id="header" class="header js-header header-sunduk">
	<div class="centering">
		<div class="centeringin clearfix">
			<div class="logo column1">
				<div class="column1inner">
<a href="<?=SITE_DIR?>"><?
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/company_logo.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?><?
?></a>
				</div>
			</div>
			<div class="column1 nowrap">
				<div class="column1inner">
				
<div class="phone">
					<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-handphone"></use></svg>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/phone.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</div>

<div class="callback">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/nasvyazi.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</div>
				</div>
			</div>
			<div class="column1 nowrap hidden-print new">
				<div class="column1inner">

					<div class="worktime">
						<?$APPLICATION->IncludeFile( '/include/worktime.php' )?>
					</div>
					
					<div class="online">
						<?$APPLICATION->IncludeFile( '/include/online.php' )?>
					</div>
					
					<form action="/catalog/" class="search">
						<input type="text" name="q" value="" placeholder="Найти товар">
						<button type="submit" name="s" value="">
							<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg>
						</button>
					</form>

				</div>
			</div>
			<div class="favorite column1 nowrap hidden-print">
				<div class="column1inner">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/favorite.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
				</div>
			</div>
			<div class="basket column1 nowrap hidden-print">
				<div class="column1inner">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/basket_small.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /header type1 -->
