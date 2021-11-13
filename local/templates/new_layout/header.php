<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? use Bitrix\Main\Page\Asset;?>
<?php
if (CModule::IncludeModule("iblock")) {
    function getRegionUser()
    {
        global $USER;
        if ($USER->IsAuthorized()) {
            $elem = CIBlockElement::getById(UserCity::getCurrentCity($USER->getId()))->getNextElement();
        } else {
            $elem = CIBlockElement::getById(UserCity::getSessionCity())->getNextElement();
        }
        $result['PROPS'] = $elem-> GetProperties();
        $result['FIELDS'] =  $elem-> GetFields();
        return $result;
    }
    $GLOBALS['UF_USER_REGION'] = getRegionUser();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/fav.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/fav.png">
    <?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/styles/swiper-bundle.min.css");?>
    <?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/styles/accordion.min.css");?>
    <?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/styles/app.min.css");?>
    <?Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1/?apikey=3298e558-aff8-4488-95dc-510505f05ade&lang=ru_RU");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/imask.min.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/accordion.min.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/swiper-bundle.min.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/spotlight.bundle.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/map.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/main.js");?>
    <? $APPLICATION->ShowHead(); ?>
</head>
<body>
<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>
<div class="wrapper">
    <header class="header">
        <nav class="header__nav">
            <div class="header__top">
                <div class="container header-wrap">
                    <button class="header__location-btn" data-modal-trigger="select-city">
                        <svg width="15" height="15">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#icon-gps-device"></use>
                        </svg><span><?=$GLOBALS['UF_USER_REGION']['FIELDS']['NAME']?></span>
                    </button>
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "MENU_THEME" => "site",
                        "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    );?>
                    <div class="header__info">
                        <div class="header__graphic">
                            <div class="header__time"><?=$GLOBALS['UF_USER_REGION']['PROPS']['REGION_SCHEDULE']['VALUE']['TEXT']?></div>
                        </div>
                        <div class="header__note">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH.'/include/description_on_header.php'
                                )
                            );?>
                        </div>
                    </div><a class="header__tel" href="tel:+<?=preg_replace('/[^0-9]/', '', $GLOBALS['UF_USER_REGION']['PROPS']['REGION_PHONE']['VALUE'])?>">
                        <svg width="18" height="18">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#telephone"></use>
                        </svg><span><?=$GLOBALS['UF_USER_REGION']['PROPS']['REGION_PHONE']['VALUE']?></span></a>
                </div>
            </div>
            <div class="header__container container">
                <div class="header__primary header-wrap">
                    <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH.'/include/logo_header.php'
                        )
                    );?>
                    <button class="header__toggle-menu button" data-catalog-toggle>
                        <svg width="14" height="14">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#hamburger-button"></use>
                        </svg><span>Каталог</span>
                    </button>
                    <!-- форма поиска-->
                    <form class="header__search search-form" method="get" action="#">
                        <button class="search-form__btn" type="submit">
                            <svg width="20" height="20">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#icons-search"></use>
                            </svg>
                        </button>
                        <label>
                            <input class="search-form__input" type="search" placeholder="Поиск по сайту">
                        </label>
                    </form>
                    <!-- форма поиска конец-->
                    <div class="header__user-menu">
                        <a class="header__account"
                        <?if (!$USER->IsAuthorized()){
                            echo 'data-modal-trigger="login" href="#"';
                        } else {
                            echo 'href="/personal/"';
                        }
                        ?>>
                            <svg width="25" height="25">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#user-outlined"></use>
                            </svg>
                            <span>Личный кабинет</span>
                        </a>
                        <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "basket", Array(
                            "HIDE_ON_BASKET_PAGES" => "Y",	// Не показывать на страницах корзины и оформления заказа
                            "PATH_TO_AUTHORIZE" => "",	// Страница авторизации
                            "PATH_TO_BASKET" => SITE_DIR."personal/cart/",	// Страница корзины
                            "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",	// Страница оформления заказа
                            "PATH_TO_PERSONAL" => SITE_DIR."personal/",	// Страница персонального раздела
                            "PATH_TO_PROFILE" => SITE_DIR."personal/",	// Страница профиля
                            "PATH_TO_REGISTER" => SITE_DIR."login/",	// Страница регистрации
                            "POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
                            "SHOW_AUTHOR" => "N",	// Добавить возможность авторизации
                            "SHOW_EMPTY_VALUES" => "Y",	// Выводить нулевые значения в пустой корзине
                            "SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
                            "SHOW_PERSONAL_LINK" => "Y",	// Отображать персональный раздел
                            "SHOW_PRODUCTS" => "N",	// Показывать список товаров
                            "SHOW_REGISTRATION" => "N",	// Добавить возможность регистрации
                            "SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
                        ),
                            false
                        );?>
                        <button class="header__burger-btn" data-burger aria-label="Раскрыть меню"><span></span></button>
                    </div>
                </div>
                <div class="header__mobile">
                    <div class="header__btns"><a class="header__toggle-menu button" href="#">
                            <svg width="14" height="14">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#hamburger-button"></use>
                            </svg><span>Каталог</span></a>
                        <button class="header__location-btn">
                            <svg width="15" height="15">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#icon-gps-device"></use>
                            </svg><span>Санкт-Петербург</span>
                        </button>
                    </div>
                    <ul class="header__list">
                        <li class="header__item"><a class="header__link" href="#">Как купить </a></li>
                        <li class="header__item"><a class="header__link" href="#">Гарантии</a></li>
                        <li class="header__item"><a class="header__link" href="#">Скидки и акции</a></li>
                        <li class="header__item"><a class="header__link" href="#">Контакты</a></li>
                    </ul>
                </div>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", Array(
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                        0 => "",
                    ),
                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                    "MENU_THEME" => "site",
                    "ROOT_MENU_TYPE" => "main",	// Тип меню для первого уровня
                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                ),
                    false
                );?>
                <div class="header__mobile">
                    <a class="header__tel" href="tel:+78123093154">
                        <svg width="18" height="18">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#telephone"></use>
                        </svg><span>+7 (812) 309-31-54</span></a>
                    <div class="header__info">
                        <div class="header__graphic">
                            <div class="header__time"><span>Пн-Пт:</span> 09:00 – 18:00</div>
                            <div class="header__time"><span>Сб:</span> 10:00 – 13:00</div>
                        </div>
                        <div class="header__note">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH.'/include/description_on_header.php'
                                )
                            );?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__full-menu full-menu" data-full-menu>
                <div class="container">
                    <div class="full-menu__head">
                        <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH.'/include/logo_header.php'
                            )
                        );?>
                        <button class="full-menu__close-btn button-close" type="button" aria-label="Закрыть" data-close>
                            <svg width="20" height="20">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#close"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="full-menu__top">
                        <h2 class="full-menu__title title-second">Каталог</h2>
                        <form class="header__search search-form" method="get" action="#">
                            <button class="search-form__btn" type="submit">
                                <svg width="20" height="20">
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#icons-search"></use>
                                </svg>
                            </button>
                            <label>
                                <input class="search-form__input" type="search" placeholder="Поиск по сайту">
                            </label>
                        </form>
                    </div>
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "catalog", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "2",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "ROOT_MENU_TYPE" => "bot_catalog",	// Тип меню для первого уровня
                        "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    );?>
                </div>
            </div>
        </nav>
    </header>
    <main>
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(
        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "sn",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    );?>