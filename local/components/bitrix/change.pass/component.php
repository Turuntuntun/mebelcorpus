<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $USER;

if(!$USER->IsAuthorized())
    die();

if($_POST['submit-change-pass']) {

    $arAuthResult = $USER->Login($USER->GetLogin(), $_POST['OLD_PASSWORD'], "Y");
    $arResult['ERROR'] = '';
    if($arAuthResult['TYPE']=='ERROR') {
        $arResult['ERROR'] .= GetMessage('PASSWORD_WRONG')."<br />";
    }

    if ($_POST['NEW_PASSWORD']!=$_POST['NEW_PASSWORD_CONFIRM']) {
        $arResult['ERROR'] .= GetMessage('NOT_THE_SAME')."<br />";
    }

    if ($_POST['NEW_PASSWORD']=='') {
        $arResult['ERROR'] = GetMessage('PASSWORD_EMPTY')."<br />";
    }

    if ($_POST['NEW_PASSWORD_CONFIRM']=='') {
        $arResult['ERROR'] = GetMessage('CONFIRM_PASSWORD_EMPTY')."<br />";
    }



    if ($arResult['ERROR']=='') {
        $fields = Array(
            "PASSWORD"          => $_POST['NEW_PASSWORD'],
            "CONFIRM_PASSWORD"  => $_POST['NEW_PASSWORD_CONFIRM'] ,
        );

        $res = $USER->Update($USER->GetID(), $fields);
        $strError = $USER->LAST_ERROR;
        if($res)
            $arResult['SUCCESS'] = 'Y';
        else
            $arResult['ERROR'] = $strError.'<br>';

    }
}


$this->IncludeComponentTemplate();

?>
