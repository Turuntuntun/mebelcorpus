<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

foreach($arResult["ITEMS"] as &$arItem) {
    if ($arItem['PROPERTIES']['UF_OPLATA_CHECK']['VALUE']) {
        $classTable = getClassHighload($arItem['PROPERTIES']['UF_OPLATA_CHECK']['USER_TYPE_SETTINGS']['TABLE_NAME']);
        foreach ($arItem['PROPERTIES']['UF_OPLATA_CHECK']['VALUE'] as $arElemPay) {
            $paySistem = $classTable::getList(array(
                "select" => array("*"),
                "order" => array("ID"=>"DESC"),
                "filter" => Array("UF_XML_ID"=>$arElemPay),
            ))->fetch();
            $arItem['PROPERTIES']['UF_FILE_PAY']["VALUE"][] = array(
                'SRC' =>CFile::getPath($paySistem['UF_FILE']),
                'WIDTH' => $paySistem['UF_WIDTH'],
                'HEIGTH' =>$paySistem['UF_HEIGTH'],
                'NAME' => $paySistem['NAME']
            );
        }
    }

}

