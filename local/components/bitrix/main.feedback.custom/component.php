<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */


$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
    $arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");
if($USER->IsAuthorized())
{
    $arResult["AUTHOR_NAME"] = $USER->GetFormattedName(false);
}


$this->IncludeComponentTemplate();
