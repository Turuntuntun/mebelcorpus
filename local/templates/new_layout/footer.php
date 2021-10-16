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
            <button class="footer__btn button button--ghost" type="button">Заказать звонок</button>
        </div>
        <div class="footer__column"><span class="footer__caption">Каталог товаров</span>
            <ul class="footer__list">
                <li class="footer__item"><a class="footer__link" href="#">Мебель для спальни</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Прихожие</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Мебель для гостинной</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Мебель для кухни</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Шкафы</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Мягкая мебель</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Детская мебель</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Кухни на заказ</a></li>
            </ul>
        </div>
        <div class="footer__column"><span class="footer__caption">Информация</span>
            <ul class="footer__list">
                <li class="footer__item"><a class="footer__link" href="#">О компании</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Услуги</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Новости</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Новинки</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Документы</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Пресс-кит</a></li>
                <li class="footer__item"><a class="footer__link" href="#">Снято с производства</a></li>
            </ul>
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
</div>
</body>
</html>