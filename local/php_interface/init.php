<?php
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\EventManager;

AddEventHandler("main", "OnEpilog", "Redirect404");
AddEventHandler("main", "OnBeforeProlog", "initCity");
function Redirect404() {
    if(defined("ERROR_404") ) {
        LocalRedirect("/404.php", "404 Not Found");
    }
}

function transformMonthInText($monthNumber)
{
    $arrayMonth = [
        '0' => 'января',
        '00' => 'января',
        '1' => 'февраля',
        '01' => 'февраля',
        '2' => 'марта',
        '02' => 'марта',
        '3' => 'апреля',
        '03' => 'апреля',
        '4' => 'мая',
        '04' => 'мая',
        '5' => 'июня',
        '05' => 'июня',
        '6' => 'июля',
        '06' => 'июля',
        '07' => 'августа',
        '7' => 'августа',
        '8' => 'сентября',
        '08' => 'сентября',
        '9' => 'октября',
        '09' => 'октября',
        '10' => 'ноября',
        '11' => 'декабря',
    ];

    return $arrayMonth[$monthNumber];
}

function getClassHighload($tableName)
{
    if (CModule::IncludeModule("highloadblock")) {

        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList([
            'filter' => ['=TABLE_NAME' => $tableName]
        ])->fetch();
        if(!$hlblock){
            return false;
        }

        $hlClassName = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock)->getDataClass();
        return $hlClassName;
    }
    return false;
}

 require_once __DIR__ . "/location_new.php";
