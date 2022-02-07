<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("История заказов");
?>
<section class="account mb-90">
        <div class="container">
            <h1 class="account__title title-first mb-60">История заказов</h1>
            <div class="account__wrap">
                <?$APPLICATION->IncludeComponent("bitrix:menu", "lk_menu", Array(
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                    "MENU_THEME" => "site",
                    "ROOT_MENU_TYPE" => "lk",	// Тип меню для первого уровня
                    "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "COMPONENT_TEMPLATE" => "lk"
                ),
                    false
                );?>

                <div class="account__content">
                    <?$APPLICATION->IncludeComponent(
						"bitrix:sale.personal.order",
						"list",
						Array(
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"ALLOW_INNER" => "N",
							"CACHE_GROUPS" => "Y",
							"CACHE_TIME" => "3600",
							"CACHE_TYPE" => "A",
							"CUSTOM_SELECT_PROPS" => array(""),
							"DETAIL_HIDE_USER_INFO" => array("0"),
							"DISALLOW_CANCEL" => "N",
							"HISTORIC_STATUSES" => array("F"),
							"NAV_TEMPLATE" => "",
							"ONLY_INNER_FULL" => "N",
							"ORDERS_PER_PAGE" => "20",
							"ORDER_DEFAULT_SORT" => "STATUS",
							"PATH_TO_BASKET" => "/personal/cart",
							"PATH_TO_CATALOG" => "/catalog/",
							"PATH_TO_PAYMENT" => "/personal/order/payment/",
							"PROP_3" => array(),
							"PROP_4" => array(),
							"REFRESH_PRICES" => "N",
							"RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
							"SAVE_IN_SESSION" => "Y",
							"SEF_MODE" => "N",
							"SET_TITLE" => "Y",
							"STATUS_COLOR_AA" => "gray",
							"STATUS_COLOR_DO" => "gray",
							"STATUS_COLOR_F" => "gray",
							"STATUS_COLOR_KC" => "gray",
							"STATUS_COLOR_KD" => "gray",
							"STATUS_COLOR_KO" => "gray",
							"STATUS_COLOR_MC" => "gray",
							"STATUS_COLOR_MD" => "gray",
							"STATUS_COLOR_MO" => "gray",
							"STATUS_COLOR_N" => "green",
							"STATUS_COLOR_NW" => "gray",
							"STATUS_COLOR_OJ" => "gray",
							"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
							"STATUS_COLOR_S" => "gray",
							"STATUS_COLOR_SC" => "gray",
							"STATUS_COLOR_SD" => "gray",
							"STATUS_COLOR_SO" => "gray",
							"STATUS_COLOR_X" => "gray",
							"STATUS_COLOR_XX" => "gray",
							"STATUS_COLOR_Y" => "gray",
							"STATUS_COLOR_ZK" => "gray"
						)
					);?>

                </div>
            </div>
        </div>
    </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>