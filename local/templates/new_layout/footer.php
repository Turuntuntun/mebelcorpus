<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
</main>
<footer class="footer">
    <div class="container">
        <div class="footer__grid">
            <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH.'/include/logo_footer.php'
                )
            );?>
            <div class="footer__contacts"><a class="footer__tel" href="tel:+78123093154">+7 (812) 309-31-54</a><a class="footer__tel" href="tel:+79602835951">+7 (960) 283-59-51</a></div>
            <button class="footer__btn button button--ghost" type="button" data-modal-trigger="callback">Заказать звонок</button>
        </div>
        <div class="footer__column">
            <span class="footer__caption">
                <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH.'/include/title_bot_menu_1.php'
                    )
                );?>
            </span>
            <?$APPLICATION->IncludeComponent("bitrix:menu", "bot_menu", Array(
                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "DELAY" => "N",	// Откладывать выполнение шаблона меню
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                "MENU_THEME" => "site",
                "ROOT_MENU_TYPE" => "bot_catalog",	// Тип меню для первого уровня
                "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                "COMPONENT_TEMPLATE" => "top_menu"
            ),
                false
            );?>
        </div>
        <div class="footer__column">
            <span class="footer__caption">
                <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH.'/include/title_bot_menu_2.php'
                    )
                );?>
            </span>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "bot_menu", Array(
        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
            "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
            "DELAY" => "N",	// Откладывать выполнение шаблона меню
            "MAX_LEVEL" => "1",	// Уровень вложенности меню
            "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "MENU_CACHE_TYPE" => "A",	// Тип кеширования
            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
            "MENU_THEME" => "site",
            "ROOT_MENU_TYPE" => "bot",	// Тип меню для первого уровня
            "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            "COMPONENT_TEMPLATE" => "top_menu"
        ),
        false
    );?>
        </div>
        <div class="footer__info">
            <div class="footer__wrap"><span class="footer__caption">Мы в социальных сетях</span>
                <ul class="footer__social social-list">
                    <li class="social-list__item"><a class="social-list__link" href="#" aria-label="facebook">
                            <svg width="16" height="30">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#facebook"></use>
                            </svg></a></li>
                    <li class="social-list__item"><a class="social-list__link" href="#" aria-label="vkontakte">
                            <svg width="30" height="18">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#vk"></use>
                            </svg></a></li>
                    <li class="social-list__item"><a class="social-list__link" href="#" aria-label="instagram">
                            <svg width="30" height="30">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#instagram"></use>
                            </svg></a></li>
                </ul>
            </div>
            <div class="footer__wrap"><span class="footer__caption">Мы принимаем оплату</span>
                <ul class="footer__pays pay-list">
                    <li class="pay-list__item">
                        <svg class="pay-list__logo" width="56" height="17">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#visa"></use>
                        </svg>
                    </li>
                    <li class="pay-list__item">
                        <svg class="pay-list__logo" width="54" height="16">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#mir"></use>
                        </svg>
                    </li>
                    <li class="pay-list__item">
                        <svg class="pay-list__logo" width="40" height="25">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#master-card"></use>
                        </svg>
                    </li>
                    <li class="pay-list__item">
                        <svg class="pay-list__logo" width="40" height="25">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#maestro"></use>
                        </svg>
                    </li>
                    <li class="pay-list__item">
                        <svg class="pay-list__logo" width="61" height="25">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#googlePay"></use>
                        </svg>
                    </li>
                    <li class="pay-list__item">
                        <svg class="pay-list__logo" width="45" height="29">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#applePay"></use>
                        </svg>
                    </li>
                </ul>
            </div>
            <div class="footer__wrap">
                <form class="footer__form subscription-form" action="#" method="post">
                    <label class="subscription-form__label footer__caption" for="subscription">Подписаться на новости</label>
                    <div class="subscription-form__wrap">
                        <input class="subscription-form__input" type="email" id="subscription" placeholder="Введите ваш e-mail">
                        <button class="subscription-form__btn button" type="submit" aria-label="Отправить">
                            <svg width="20" height="16">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#arrow"></use>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer__bot"><a class="footer__link" href="#">Пользовательское соглашение</a><a class="footer__link" href="#">Политика конфиденциальности</a></div>
    </div>
</footer>
<!-- Выезжающее модальное окно-->
<div class="modal modal--account" id="login">
    <div class="modal__container">
        <h2 class="modal__title title-second">Войти в личный кабинет</h2>
        <p class="modal__warning">Неверный логин или пароль</p>
        <button class="modal__close-btn button-close" type="button" aria-label="Закрыть окно" data-close>
            <svg width="24" height="24">
                <use xlink:href="assets/images/sprite.svg#close"></use>
            </svg>
        </button>
        <form class="modal__form form" action="#" method="post">
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="email" name="email" placeholder="Email">
                </label>
            </div>
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="password" name="password" placeholder="Пароль">
                </label>
            </div>
            <button class="form__submit-btn button" type="submit">Войти</button>
        </form>
        <p class="modal__bot-text">Нет аккаунта? <a href="#" data-modal-trigger="registration">Зарегистрироваться</a></p>
    </div>
</div>
<!-- Выезжающее модальное окно-->
<div class="modal modal--account" id="registration">
    <div class="modal__container">
        <h2 class="modal__title title-second">Зарегистрироваться</h2>
        <button class="modal__close-btn button-close" type="button" aria-label="Закрыть окно" data-close>
            <svg width="24" height="24">
                <use xlink:href="assets/images/sprite.svg#close"></use>
            </svg>
        </button>
        <div class="toggle-form mb-60">
            <button class="toggle-form__btn" data-tab-id="toggle-reg" data-tab-control="fiz">Физическое лицо</button>
            <button class="toggle-form__btn" data-tab-id="toggle-reg" data-tab-control="ur">Юридическое лицо</button>
        </div>
        <form class="modal__form form" action="#" method="post" data-tab-id="toggle-reg" data-tab-block="fiz">
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="email" name="email" placeholder="Email">
                </label>
            </div>
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="password" name="password" placeholder="Пароль">
                </label>
            </div>
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="password" name="password" placeholder="Повторите пароль">
                </label>
            </div>
            <button class="form__submit-btn button" type="submit">Регистрация</button>
        </form>
        <form class="modal__form form" action="#" method="post" data-tab-id="toggle-reg" data-tab-block="ur">
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="text" name="name" placeholder="ИНН организации">
                </label>
            </div>
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="text" name="name" placeholder="Название организации">
                </label>
            </div>
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="text" name="name" placeholder="Фамилия и имя">
                </label>
            </div>
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="tel" name="tel" placeholder="Телефон">
                </label>
            </div>
            <div class="form__item">
                <label class="form__label">
                    <input class="form__input" type="email" name="email" placeholder="E-mail">
                </label>
            </div>
            <button class="form__submit-btn button" type="submit">Подать заявку</button>
        </form>
        <p class="modal__bot-text">Уже зарегистрированы? <a href="#" data-modal-trigger="login">Войти</a></p>
    </div>
</div>
<!-- Выезжающее модальное окно-->
<?$APPLICATION->IncludeComponent(
    "bitrix:main.feedback.custom",
    "popup_callback",
    array(
        "EVENT_MESSAGE_ID" => array(
            234
        ),
        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
        "REQUIRED_FIELDS" => array(
            0 => "NAME",
            1 => "PHONE",
        ),
        "USE_CAPTCHA" => "Y",
        "COMPONENT_TEMPLATE" => "popup_callback",
        "TITLE" => "Заказ звонка"
    ),
    false
);?>
<!-- Попап окно; добавляем класс active чтобы окно открывалось по умолчанию-->
<div class="popup" id="select-city">
    <div class="popup__container">
        <h2 class="popup__title">Выберите город</h2>
        <button class="popup__close-btn button-close" type="button" aria-label="Закрыть окно" data-close>
            <svg width="24" height="24">
                <use xlink:href="assets/images/sprite.svg#close"></use>
            </svg>
        </button>
        <form class="search-form" method="get" action="#">
            <label>
                <input class="search-form__input" type="search" placeholder="Введите название города">
            </label>
            <button class="search-form__btn" type="button">
                <svg width="20" height="20">
                    <use xlink:href="assets/images/sprite.svg#icons-search"></use>
                </svg>
            </button>
        </form>
        <ul class="popup__list city-list">
            <li class="city-list__item"><a class="city-list__link active" href="#">Санкт-Петербург</a></li>
            <li class="city-list__item"><a class="city-list__link" href="#">Москва</a></li>
            <li class="city-list__item"><a class="city-list__link" href="#">Краснодар</a></li>
        </ul>
    </div>
</div>
</div>
<div class="overlay" aria-label="Закрыть окно"></div>
</body>
</html>