<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?php
//получить телефон выбранного города
$APPLICATION->IncludeComponent("redsign:location.main", "phone_geo", Array(
	"PHONE" => 1
	),
	false
);
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>