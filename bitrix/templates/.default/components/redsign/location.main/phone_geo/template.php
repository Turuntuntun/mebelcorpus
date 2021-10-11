<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}?>

<?
//достаем всю информацию о городах с инфоблока
$IBLOCK_REGION = 35;// ID инфблока с городами

$arSelect = Array("ID", "IBLOCK_ID", "NAME");
$arFilter = Array("IBLOCK_ID" => $IBLOCK_REGION, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()){ 
	$arFields = $ob->GetFields();  
	$arProps = $ob->GetProperties();
	$arResult['INFO_REGION'][$arFields['NAME']]['FILDS'] = $arFields;
	$arResult['INFO_REGION'][$arFields['NAME']]['PROPERTY'] = $arProps;
	//Дефаулт телефон
	if($arProps['LOCATION_DEFAULT']['VALUE'] !=''){
		$arResult['DEF_PHONE_1'] = $arProps['REGION_PHONE']['VALUE'];
		$arResult['DEF_PHONE_2'] = $arProps['REGION_PHONE2']['VALUE'];
	}
}

//вся логика по выбору телефона для города\
foreach ($arResult['INFO_REGION'] as $nameCity => $arItemCity){
	if($arResult['NAME'] !=''){
		//город есть находим его, если нет то показываем по умолчанию
		if(isset($arResult['INFO_REGION'][$arResult['NAME']])){
			$arResult['PHONE_1'] = $arResult['INFO_REGION'][$arResult['NAME']]['PROPERTY']['REGION_PHONE']['VALUE'];
			$arResult['PHONE_2'] = $arResult['INFO_REGION'][$arResult['NAME']]['PROPERTY']['REGION_PHONE2']['VALUE'];
		}else{
			//выбраного города нет, показываем по умолчанию
			$arResult['PHONE_1'] = $arResult['DEF_PHONE_1'];
			$arResult['PHONE_2'] = $arResult['DEF_PHONE_2'];
		}
	}else{
		//выбраного города нет, показываем по умолчанию
		$arResult['PHONE_1'] = $arResult['DEF_PHONE_1'];
		$arResult['PHONE_2'] = $arResult['DEF_PHONE_2'];
	}
}


if($arParams['PHONE'] == 1){
	echo '<a href="tel:'.$arResult['PHONE_1'].'"><b>'.$arResult['PHONE_1'].'</b></a>';
}
if($arParams['PHONE'] == 2){
	echo '<a href="tel:'.$arResult['PHONE_2'].'"><b>'.$arResult['PHONE_2'].'</b></a>';
}
?>
