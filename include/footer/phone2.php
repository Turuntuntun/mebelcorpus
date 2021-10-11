<?php
//получить телефон выбранного города
$APPLICATION->IncludeComponent("redsign:location.main", "phone_geo", Array(
	"PHONE" => 2
	),
	false
);
?>