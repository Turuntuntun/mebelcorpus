<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? use Bitrix\Main\Page\Asset;?>
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
                    <button class="header__location-btn">
                        <svg width="15" height="15">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#icon-gps-device"></use>
                        </svg><span>Санкт-Петербург</span>
                    </button>
                    <ul class="header__list">
                        <li class="header__item"><a class="header__link" href="#">Как купить </a></li>
                        <li class="header__item"><a class="header__link" href="#">Гарантии</a></li>
                        <li class="header__item"><a class="header__link" href="#">Скидки и акции</a></li>
                        <li class="header__item"><a class="header__link" href="#">Контакты</a></li>
                    </ul>
                    <div class="header__info">
                        <div class="header__graphic">
                            <div class="header__time"><span>Пн-Пт:</span> 09:00 – 18:00</div>
                            <div class="header__time"><span>Сб:</span> 10:00 – 13:00</div>
                        </div>
                        <div class="header__note">Прием заказов на сайте<span>круглосуточно</span></div>
                    </div><a class="header__tel" href="tel:+78123093154">
                        <svg width="18" height="18">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#telephone"></use>
                        </svg><span>+7 (812) 309-31-54</span></a>
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
                    <div class="header__user-menu"><a class="header__account" href="#">
                            <svg width="25" height="25">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#user-outlined"></use>
                            </svg><span>Личный кабинет</span></a><a class="header__cart" href="#">
                            <svg width="27" height="27">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#cart"></use>
                            </svg><sup>3</sup><span>Корзина</span></a>
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
                <ul class="header__menu header-menu">
                    <li class="header-menu__item"><a class="header-menu__link" href="#">О компании</a></li>
                    <li class="header-menu__item"><a class="header-menu__link" href="#">Услуги</a></li>
                    <li class="header-menu__item"><a class="header-menu__link" href="#">Новости</a></li>
                    <li class="header-menu__item"><a class="header-menu__link" href="#">Новинки</a></li>
                    <li class="header-menu__item"><a class="header-menu__link" href="#">Документы</a></li>
                    <li class="header-menu__item"><a class="header-menu__link" href="">Пресс-кит</a></li>
                    <li class="header-menu__item"><a class="header-menu__link" href="#">Снято с производства</a></li>
                </ul>
                <div class="header__mobile"><a class="header__tel" href="tel:+78123093154">
                        <svg width="18" height="18">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#telephone"></use>
                        </svg><span>+7 (812) 309-31-54</span></a>
                    <div class="header__info">
                        <div class="header__graphic">
                            <div class="header__time"><span>Пн-Пт:</span> 09:00 – 18:00</div>
                            <div class="header__time"><span>Сб:</span> 10:00 – 13:00</div>
                        </div>
                        <div class="header__note">Прием заказов на сайте<span>круглосуточно</span></div>
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
                    <div class="full-menu__wrap">
                        <ul class="full-menu__list">
                            <li class="full-menu__item full-menu__item--caption"><a class="full-menu__link" href="#">Мебель для гостинной</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Стенки</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Шкафы</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Журнальные столы</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Мягкая мебель</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Тумбы ТВ</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Стулья</a></li>
                        </ul>
                        <ul class="full-menu__list">
                            <li class="full-menu__item full-menu__item--caption"><a class="full-menu__link" href="#">Мебель для спальни</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Спальные гарнитуры</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Модульные спальни</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Кровати</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Матрасы</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Комоды</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Прикроватные тумбы</a></li>
                        </ul>
                        <ul class="full-menu__list">
                            <li class="full-menu__item full-menu__item--caption"><a class="full-menu__link" href="#">Мебель для кухни</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Модульные кухни</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Готовые решения</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Обеденные группы</a></li>
                            <li class="full-menu__item full-menu__item--caption" style="margin-top: 47px;"><a class="full-menu__link" href="#">Кабинет</a></li>
                        </ul>
                        <ul class="full-menu__list">
                            <li class="full-menu__item full-menu__item--caption"><a class="full-menu__link" href="#">Прихожие</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Модульные прихожие</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Готовые решения</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Обувницы</a></li>
                        </ul>
                        <ul class="full-menu__list">
                            <li class="full-menu__item full-menu__item--caption"><a class="full-menu__link" href="#">Детская мебель</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Модульные детские</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Готовые решения</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Компьютерные столы</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Компьютерные стулья</a></li>
                        </ul>
                        <ul class="full-menu__list">
                            <li class="full-menu__item full-menu__item--caption"><a class="full-menu__link" href="#">Мягкая мебель</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Диваны</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Модульные диваны</a></li>
                            <li class="full-menu__item"><a class="full-menu__link" href="#">Кресла</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>