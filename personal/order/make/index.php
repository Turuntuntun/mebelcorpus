<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?>

<div class="pmenu">
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personal", 
	array(
		"ROOT_MENU_TYPE" => "personal",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"SEPARATORS_PLACE" => array(
			0 => "3",
			1 => "7",
			2 => "",
		),
		"COMPONENT_TEMPLATE" => "personal"
	),
	false
);?>
</div>

<div class="pcontent">
<?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", ".default", Array(
	"PAY_FROM_ACCOUNT" => "Y",	// Разрешить оплату с внутреннего счета
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Разрешить оплату с внутреннего счета только в полном объеме
		"COUNT_DELIVERY_TAX" => "N",
		"ALLOW_AUTO_REGISTER" => "Y",	// Оформлять заказ с автоматической регистрацией пользователя
		"SEND_NEW_USER_NOTIFY" => "Y",	// Отправлять пользователю письмо, что он зарегистрирован на сайте
		"DELIVERY_NO_AJAX" => "N",	// Когда рассчитывать доставки с внешними системами расчета
		"DELIVERY_NO_SESSION" => "N",	// Проверять сессию при оформлении заказа
		"TEMPLATE_LOCATION" => "popup",	// Визуальный вид контрола выбора местоположений
		"DELIVERY_TO_PAYSYSTEM" => "d2p",	// Последовательность оформления
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"PROP_1" => "",
		"ALLOW_NEW_PROFILE" => "N",	// Разрешить множество профилей покупателей
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "N",	// Показывать изображения складов в окне выбора пункта выдачи
		"PATH_TO_BASKET" => "/personal/cart/",	// Путь к странице корзины
		"PATH_TO_PERSONAL" => "/personal/",	// Путь к странице персонального раздела
		"PATH_TO_PAYMENT" => "/personal/order/payment/",	// Страница подключения платежной системы
		"PATH_TO_AUTH" => "/auth/",	// Путь к странице авторизации
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"DISABLE_BASKET_REDIRECT" => "N",	// Оставаться на странице оформления заказа, если список товаров пуст
		"PRODUCT_COLUMNS" => "",
		"PROP_2" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"COMPATIBLE_MODE" => "Y",	// Режим совместимости для предыдущего шаблона
		"PRODUCT_COLUMNS_VISIBLE" => array(	// Выбранные колонки таблицы списка товаров
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
		),
		"ADDITIONAL_PICT_PROP_7" => "-",
		"ADDITIONAL_PICT_PROP_8" => "-",
		"BASKET_IMAGES_SCALING" => "standard",	// Режим отображения изображений товаров
		"CODE_PHONES" => "",
		"ALLOW_APPEND_ORDER" => "Y",	// Разрешить оформлять заказ на существующего пользователя
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",	// Отображение доставок с ошибками расчета
		"SPOT_LOCATION_BY_GEOIP" => "Y",	// Определять местоположение покупателя по IP-адресу
		"SHOW_VAT_PRICE" => "Y",	// Отображать значение НДС
		"USE_PRELOAD" => "Y",	// Автозаполнение оплаты и доставки по предыдущему заказу
		"ALLOW_USER_PROFILES" => "Y",	// Разрешить использование профилей покупателей
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"SHOW_ORDER_BUTTON" => "final_step",	// Отображать кнопку оформления заказа (для неавторизованных пользователей)
		"SHOW_TOTAL_ORDER_BUTTON" => "Y",	// Отображать дополнительную кнопку оформления заказа
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",	// Отображать названия в списке платежных систем
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",	// Отображать название в блоке информации по платежной системе
		"SHOW_DELIVERY_LIST_NAMES" => "Y",	// Отображать названия в списке доставок
		"SHOW_DELIVERY_INFO_NAME" => "Y",	// Отображать название в блоке информации по доставке
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",	// Показывать название родительской доставки
		"SKIP_USELESS_BLOCK" => "Y",	// Пропускать шаги, в которых один элемент для выбора
		"BASKET_POSITION" => "before",	// Расположение списка товаров
		"SHOW_BASKET_HEADERS" => "N",	// Показывать заголовки колонок списка товаров
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",	// Дополнительные услуги, которые будут показаны в пройденном (свернутом) блоке
		"SHOW_NEAREST_PICKUP" => "Y",	// Показывать ближайшие пункты самовывоза
		"DELIVERIES_PER_PAGE" => "9",	// Количество доставок на странице
		"PAY_SYSTEMS_PER_PAGE" => "9",	// Количество платежных систем на странице
		"PICKUPS_PER_PAGE" => "5",	// Количество пунктов самовывоза на странице
		"SHOW_PICKUP_MAP" => "Y",	// Показывать карту для доставок с самовывозом
		"SHOW_MAP_IN_PROPS" => "N",	// Показывать карту в блоке свойств заказа
		"PICKUP_MAP_TYPE" => "yandex",	// Тип используемых карт
		"SHOW_COUPONS" => "N",	// Отображать поля ввода купонов
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "Y",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"PROPS_FADE_LIST_3" => array(	// Свойства заказа, которые будут показаны в пройденном (свернутом) блоке (Физическое лицо)[sm]
			0 => "20",
			1 => "21",
			2 => "22",
			3 => "26",
		),
		"PROPS_FADE_LIST_2" => "",	// Свойства заказа, которые будут показаны в пройденном (свернутом) блоке (Юридическое лицо)[s1]
		"PROPS_FADE_LIST_4" => array(	// Свойства заказа, которые будут показаны в пройденном (свернутом) блоке (Юридическое лицо)[sm]
			0 => "27",
			1 => "29",
			2 => "30",
			3 => "32",
			4 => "33",
			5 => "38",
		),
		"USER_CONSENT" => "N",	// Запрашивать согласие
		"USER_CONSENT_ID" => "0",	// Соглашение
		"USER_CONSENT_IS_CHECKED" => "Y",	// Галка по умолчанию проставлена
		"USER_CONSENT_IS_LOADED" => "N",	// Загружать текст сразу
		"ACTION_VARIABLE" => "soa-action",	// Название переменной, в которой передается действие
		"EMPTY_BASKET_HINT_PATH" => "/",	// Путь к странице для продолжения покупок
		"USE_PHONE_NORMALIZATION" => "Y",	// Использовать нормализацию номера телефона
		"ADDITIONAL_PICT_PROP_19" => "-",
		"ADDITIONAL_PICT_PROP_20" => "-",
		"ADDITIONAL_PICT_PROP_29" => "-",	// Дополнительная картинка [Каталог Сундук Мебель]
		"ADDITIONAL_PICT_PROP_37" => "-",	// Дополнительная картинка [Варианты Сундук Мебель]
		"ADDITIONAL_PICT_PROP_39" => "-",	// Дополнительная картинка [Пакет предложений (Каталог Сундук Мебель)]
		"SERVICES_IMAGES_SCALING" => "adaptive",	// Режим отображения вспомагательных изображений
		"PRODUCT_COLUMNS_HIDDEN" => "",	// Свойства товаров отображаемые в свернутом виде в списке товаров
		"HIDE_ORDER_DESCRIPTION" => "N",	// Скрыть поле комментариев к заказу
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"USE_YM_GOALS" => "N",	// Использовать цели счетчика Яндекс.Метрики
		"USE_ENHANCED_ECOMMERCE" => "N",	// Отправлять данные электронной торговли в Google и Яндекс
		"USE_CUSTOM_MAIN_MESSAGES" => "N",	// Заменить стандартные фразы на свои
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",	// Заменить стандартные фразы на свои
		"USE_CUSTOM_ERROR_MESSAGES" => "N",	// Заменить стандартные фразы на свои
	),
	false
);?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
