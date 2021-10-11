<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\Loc;

?>

<!-- social -->
<?php if ($arParams['USE_SHARE'] == 'Y' && !empty($arParams["SOC_SHARE_ICON"]) && $arParams['GOPRO']['OFF_YANDEX'] != 'Y'): ?>
<div class="detail__social">
    <?php
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/ya-share.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
</div>
<?php endif; ?>
<!-- /social -->
