<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Мы всегда на связи");
?><?php
echo '<link href="'.SITE_DIR.'include/popup/nasvyazi/style.css?'.randString(10, array('1234567890')).'" type="text/css" rel="stylesheet" />';
?>
<div class="nasvyazi">
	<div class="block left">
 <span style="font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">КОНТАКТ ЦЕНТР</span><br>
 <a href="tel:+7(812)-309-31-54">+7 (812) 309 31 54</a><br>
 <br>
 <span style="font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">ЗАКАЗАТЬ ЗВОНОК</span><br>
 <a href="/include/popup/recall/">ПЕРЕЗВОНИТЕ МНЕ</a><br>
<br>
 <span style="font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">НАПИСАТЬ НАМ</span><br>
 <a href="mailto:info@mebelcorpus.ru">info@mebelcorpus.ru</a><br>
форма <a href="#">обратной связи</a><br>
 <br>
 <span style="line-height:25px;font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">ПРИСОЕДИНЯЙСЯ</span><br>
 <a href="#facebook"><img src="/include/icon_fb.png" border="0" alt=""></a> &nbsp; <a href="#vkontakte"><img src="/include/icon_vk.png" border="0" alt=""></a> &nbsp; <a href="#twitter"><img src="/include/icon_tw.png" border="0" alt=""></a> &nbsp;
	</div>
	<div class="block center">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.store.list",
	"nasvyazi",
	Array(
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"MAP_TYPE" => $arParams["MAP_TYPE"],
		"MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
		"PATH_TO_ELEMENT" => $arResult["PATH_TO_ELEMENT"],
		"PATH_TO_LISTSTORES" => $arResult["PATH_TO_LISTSTORES"],
		"PHONE" => $arParams["PHONE"],
		"SCHEDULE" => $arParams["SCHEDULE"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"TITLE" => $arParams["TITLE"]
	)
);?>
	</div>
	
</div>
 <br><?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>