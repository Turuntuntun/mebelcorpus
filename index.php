<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "ТД Андрей — продажа мебели оптом. Федеральная сеть оптовых складов и производственных площадок.");?>

<?
$APPLICATION->SetPageProperty('NOT_SHOW_NAV_CHAIN', 'Y');
//$APPLICATION->SetTitle("ТД Андрей — продажа мебели оптом. Федеральная сеть оптовых складов и производственных площадок.");
$tuning = \Redsign\Tuning\TuningCore::getInstance();
$showblockFichi = $tuning->getOptionValue('SWITCH_FICHI')?:'Y';
$showblockNewsAndSection = $tuning->getOptionValue('SWITCH_NEWS_AND_SECTIONS')?:'Y';
$showblockBestProducts = $tuning->getOptionValue('SWITCH_BEST_PRODUCTS')?:'Y';
$showblockGallery = $tuning->getOptionValue('SWITCH_GALLERY')?:'Y';
$showblockBrands = $tuning->getOptionValue('SWITCH_BRANDS')?:'Y';
$showblockShops = $tuning->getOptionValue('SWITCH_SHOPS')?:'Y';
?><!-- banner -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/index/banner.php"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?>
<!-- /banner -->
<!-- banner -->
<?/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/index/fichi.php"
	),
false,
Array(
	'ACTIVE_COMPONENT' => '={($showblockFichi=='Y'?'Y':'N')}'
)
);*/?>
<!-- /banner -->
<!-- best.offers -->



<?/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/index/best.offers.php"
	),
false,
Array(
	'ACTIVE_COMPONENT' => '={($showblockBestProducts=='Y'?'Y':'N')}'
)
);*/?>
<!-- /best.offers -->


<!-- section.list -->
<?/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/index/section.list.php"
	),
false,
Array(
	'ACTIVE_COMPONENT' => '={($showblockNewsAndSection=='Y'?'Y':'N')}'
)
);*/?>
<!-- /section.list -->
<!-- news -->
<?/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/index/news.php"
	),
false,
Array(
	'ACTIVE_COMPONENT' => '={($showblockNewsAndSection=='Y'?'Y':'N')}'
)
);?>
<!-- /news -->
<!-- brands -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/index/gallery.php"
	),
false,
Array(
	'ACTIVE_COMPONENT' => '={($showblockGallery=='Y'?'Y':'N')}'
)
);?>
<!-- /brands -->
<!-- brands -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/index/brands.php"
	),
false,
Array(
	'ACTIVE_COMPONENT' => '={($showblockBrands=='Y'?'Y':'N')}'
)
);*/?>
<!-- /brands -->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>