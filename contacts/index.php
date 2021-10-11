<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Контакты");
?><p><strong>ТД Андрей Санкт-Петербург</strong><br />
<a href="https://yandex.ru/maps/-/CCUmMWxgwA" target="_blank" title="Открыть в Яндекс Картах">Николаевский проезд, дом 37</a><br />
<a href="tel:+7(812)-309-31-54">+7 (812) 309 31 54</a><br />
(многоканальный)<br />
<a rel="nofollow" href="mailto:info@mebelcorpus.ru" class="">info@mebelcorpus.ru</a>
</p>

<p><strong>ТД Андрей Москва</strong><br />
<a href="https://yandex.ru/maps/-/CCUmM0QHxD" target="_blank" title="Открыть в Яндекс Картах">г. Мытищи ул. Силикатная дом 53 кор. 3</a><br />
<a href="tel:+7(495)-139-60-98">+7 (495) 139 60 98</a><br />
<a href="tel:-(968)-519-19-50">+7 (968) 519 19 50</a><br />
<a rel="nofollow" href="mailto:tdandrey.moskva@yandex.ru" class="">tdandrey.moskva@yandex.ru</a>
</p>

<p><strong>ТД Андрей Краснодар</strong><br />
<a href="https://yandex.ru/maps/-/CCUmMLUkPC" target="_blank" title="Открыть в Яндекс Картах">ул. Новороссийская дом 220 лит. Е</a>  <br />
<a href="tel:+7(861)-213-95-13">+7 (861) 213 95 13</a><br />
<a href="tel:+7(962)-860-05-65">+7 (962) 860 05 65</a><br />
<a rel="nofollow" href="mailto:tdandrey.yug@yandex.ru" class="">tdandrey.yug@yandex.ru</a>
</p>

<p>
	<b>Схема проезда:</b>
</p>
<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"gopro",
	Array(
		"CONTROLS" => array(0=>"ZOOM",1=>"SMALLZOOM",2=>"MINIMAP",3=>"TYPECONTROL",4=>"SCALELINE",),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:3:{s:10:\"yandex_lat\";s:7:\"55.7383\";s:10:\"yandex_lon\";s:7:\"37.5946\";s:12:\"yandex_scale\";i:10;}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "contacts",
		"MAP_WIDTH" => "750",
		"OPTIONS" => array(0=>"ENABLE_DBLCLICK_ZOOM",1=>"ENABLE_DRAGGING",)
	)
);?><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>