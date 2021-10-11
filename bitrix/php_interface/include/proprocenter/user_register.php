<?
/*
 * Email вместо Логина.
*/
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserAdd", "OnBeforeUserUpdateHandler");

function OnBeforeUserUpdateHandler(&$arFields)
{
	$arFields["LOGIN"] = $arFields["EMAIL"];
	return $arFields;
}

?>