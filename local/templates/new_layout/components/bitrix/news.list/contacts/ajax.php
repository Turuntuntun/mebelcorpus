<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
if (isset($_POST['ID'])){
    $element = CIBlockElement::GetList(array(),array('ID'=>$_POST['ID']));
    $props = $element->GetNextElement()->GetProperties();

    $result = [
        'ADRESS' => $props['UF_ADRESS']['VALUE'],
        'EMAIL'  => $props['UF_EMAIL']['VALUE'],
        'PHONE'  => $props['UF_PHONE']['VALUE']
    ];
    echo json_encode($result);
}