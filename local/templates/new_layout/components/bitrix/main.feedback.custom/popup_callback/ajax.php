<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$eventName = CEventMessage::GetByID($_POST['message_id'])->getNext()['EVENT_NAME'];
$arFields = [
    'AUTHOR' => $_POST['user_name'],
    'AUTHOR_PHONE' => $_POST['user_phone'],
    'AUTHOR_TEXT' => $_POST['MESSAGE']
];
$id = CEvent::Send($eventName,SITE_ID,$arFields,'N',$_POST['message_id']);
if ($id) {
    echo json_encode(array('status'=>'ok'));
} else {
    echo json_encode(array('status'=>'error'));
}