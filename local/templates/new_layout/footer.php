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
            <div class="footer__contacts">
                <a class="footer__tel" href="tel:+<?=preg_replace('/[^0-9]/', '', $GLOBALS['UF_USER_REGION']['PROPS']['REGION_PHONE']['VALUE'])?>"><?=$GLOBALS['UF_USER_REGION']['PROPS']['REGION_PHONE']['VALUE']?></a>
                <a class="footer__tel" href="tel:+<?=preg_replace('/[^0-9]/', '', $GLOBALS['UF_USER_REGION']['PROPS']['REGION_PHONE2']['VALUE'])?>"><?=$GLOBALS['UF_USER_REGION']['PROPS']['REGION_PHONE2']['VALUE']?></a>
            </div>
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
            <div class="footer__wrap"><span class="footer__caption"><?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH.'/include/text_social.php'
                        )
                    );?>
                </span>
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
            <div class="footer__wrap"><span class="footer__caption"><?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH.'/include/text_oplata.php'
                        )
                    );?></span>
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
            <?$APPLICATION->IncludeComponent(
                "bitrix:sender.subscribe",
                "subscribe",
                array(
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CONFIRMATION" => "N",
                    "HIDE_MAILINGS" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_HIDDEN" => "N",
                    "USER_CONSENT" => "N",
                    "USER_CONSENT_ID" => "1",
                    "USER_CONSENT_IS_CHECKED" => "Y",
                    "USER_CONSENT_IS_LOADED" => "N",
                    "USE_PERSONALIZATION" => "N",
                    "COMPONENT_TEMPLATE" => "subscribe"
                ),
                false
            );?>
        </div>
        <?$APPLICATION->IncludeComponent("bitrix:menu", "document_menu", Array(
            "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
            "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
            "DELAY" => "N",	// Откладывать выполнение шаблона меню
            "MAX_LEVEL" => "1",	// Уровень вложенности меню
            "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "MENU_CACHE_TYPE" => "A",	// Тип кеширования
            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
            "MENU_THEME" => "site",
            "ROOT_MENU_TYPE" => "document",	// Тип меню для первого уровня
            "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            "COMPONENT_TEMPLATE" => "document_menu"
        ),
            false
        );?>
    </div>
</footer>
<!-- Выезжающее модальное окно-->
<?$APPLICATION->IncludeComponent(
    "bitrix:system.auth.form",
    "auth",
    array(
        "FORGOT_PASSWORD_URL" => "",
        "PROFILE_URL" => "/personal/",
        "REGISTER_URL" => "",
        "SHOW_ERRORS" => "Y",
        "COMPONENT_TEMPLATE" => "auth"
    ),
    false
);?>
<!-- Выезжающее модальное окно-->
<?php if (!$USER->IsAuthorized()) :?>
<div class="modal modal--account" id="registration" data-popup>
    <div class="modal__container">
        <h2 class="modal__title title-second">Зарегистрироваться</h2>
        <button class="modal__close-btn button-close" type="button" aria-label="Закрыть окно" data-close>
            <svg width="24" height="24">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/sprite.svg#close"></use>
            </svg>
        </button>

        <div class="toggle-form mb-60">
            <button class="toggle-form__btn" data-tab-id="toggle-reg" data-tab-control="fiz">Физическое лицо</button>
            <button class="toggle-form__btn" data-tab-id="toggle-reg" data-tab-control="ur">Юридическое лицо</button>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.register",
            "registr",
            array(
                'CODE_TAB' => 'fiz',
                "AUTH" => "N",
                "REQUIRED_FIELDS" => array(
                ),
                "SET_TITLE" => "N",
                "SHOW_FIELDS" => array(
                ),
                "SUCCESS_PAGE" => "",
                "USER_PROPERTY" => array(
                ),
                "USER_PROPERTY_NAME" => "",
                "USE_BACKURL" => "Y",
                "COMPONENT_TEMPLATE" => ".default"
            ),
            false
        );?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.register",
            "registr",
            array(
                    'CODE_TAB' => 'ur',
                "AUTH" => "N",
                "REQUIRED_FIELDS" => array(
                ),
                "SET_TITLE" => "N",
                "SHOW_FIELDS" => array(
                    'PERSONAL_PHONE',
                    'NAME',
                    'LAST_NAME',
                    'WORK_COMPANY',
                    'WORK_FAX'
                ),
                "SUCCESS_PAGE" => "",
                "USER_PROPERTY" => array(
                ),
                "USER_PROPERTY_NAME" => "",
                "USE_BACKURL" => "Y",
                "COMPONENT_TEMPLATE" => ".default"
            ),
            false
        );?>

        <p class="modal__bot-text">Уже зарегистрированы? <a href="#" data-modal-trigger="login">Войти</a></p>
    </div>
</div>
<?php endif?>
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
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "regions",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "N",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("",""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "35",
        "IBLOCK_TYPE" => "-",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("",""),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>
<div class="modal modal--account" id="logout" data-popup="">
    <div class="modal__container">
        <h2 class="modal__title title-second">Вы действительно<br> хотите выйти?</h2>
        <button class="modal__close-btn button-close" type="button" aria-label="Закрыть окно" data-close="">
            <svg width="24" height="24">
                <use xlink:href="assets/images/sprite.svg#close"></use>
            </svg>
        </button>
        <div class="modal__btn-wrap">
            <a class="modal__btn button button--ghost" href="/?logout=yes">Выйти</a>
            <button class="modal__btn button" data-cancel-btn="">Отмена</button>
        </div>
    </div>
</div>
</div>
<div class="overlay" aria-label="Закрыть окно"></div>
</body>
</html>