<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
if (!$USER->IsAuthorized()) {
    LocalRedirect('/');
}
$nameUser = $USER->GetFirstName();
?>
    <section class="account mb-90">
        <div class="container">
            <h1 class="account__title title-first mb-60">
                <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH.'/include/personal_title.php'
                    )
                );?>
            </h1>
            <? if ($nameUser) :?>
                <div class="account__subtitle mb-60"><?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH.'/include/personal_subtitle.php'
                        )
                    );?> <?=$nameUser?></div>
            <? endif;?>
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
                    <?$APPLICATION->IncludeComponent("bitrix:main.profile", "personal", Array(

                    ),
                        false
                    );?>
                    <!-- Форма смены пароля-->
                    <?$APPLICATION->IncludeComponent("bitrix:change.pass", "forgot_password", Array(

                    ),
                        false
                    );?>

                </div>
            </div>
        </div>
    </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>