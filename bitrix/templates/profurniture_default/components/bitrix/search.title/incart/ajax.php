<?php

// $APPLICATION->RestartBuffer();
header('Content-Type: application/json');
echo \Bitrix\Main\Web\Json::encode($arResult['ITEMS']);
die();