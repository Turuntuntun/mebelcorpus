<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;
if (isset($_POST['FAVOURITE_ID'])) {
    $favId = Application::getInstance()->getContext()->getRequest()->getCookie("FAVOURITE_ID");
    if ($_POST['METHOD'] = 'add') {
        $favId[] = $_POST['FAVOURITE_ID'];
    } elseif ($_POST['METHOD'] == 'delete') {
        foreach ($favId as $key => $item) {
            if ($item == $_POST['FAVOURITE_ID']) {
                unset($favId[$key]);
            }
        }
    }
    Application::getInstance()->getContext()->getResponse()->addCookie(array("FAVOURITE_ID"=>$favId));
    json_encode($favId);
}