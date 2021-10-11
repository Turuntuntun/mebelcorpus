<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

if(isset($_REQUEST['link']) && trim($_REQUEST['link'])!='')
{
	foreach($arResult['FIELDS'] as $key => $arField)
	{
		if($arField['CONTROL_NAME']=='RS_LINK')
		{
			$arResult['FIELDS'][$key]['VALUE'] = $_REQUEST['link'];
			break;
		}
	}
}

if ($arParams['YM_COUNTER_NUMBER_LOCATION'] == 'module') {
	$arResult['YM_COUNTER_NUMBER'] = \Bitrix\Main\Config\Option::get('redsign.profurniture', 'ym_counter_number');
}
else {
	$arResult['YM_COUNTER_NUMBER'] = $arParams['YM_COUNTER_NUMBER'];
}