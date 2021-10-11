<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\loc;

if (empty($arParams['IMPORTANT_PROPS']))
    return;
?>

<div class="c-important-props hidden-xs hidden-sm">

    <div class="c-important-props__title"><?=loc::getMessage('TABS_PROPERTIES')?></div>
    <?php foreach ($arParams['IMPORTANT_PROPS'] as $code):
    if (empty($arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']))
        continue;
    
    $property = $arResult['DISPLAY_PROPERTIES'][$code];
    ?>
    <div class="c-important-props__prop">
        <div class="c-important-props__prop-name"><?=$property['NAME']?></div>
        <div class="c-important-props__prop-value"><?php
        if (is_array($property['DISPLAY_VALUE'])) {
            echo implode('&nbsp;/&nbsp;', $property['DISPLAY_VALUE']);
        } else {
            echo $property['DISPLAY_VALUE'];
        }
        ?></div>
    </div>
    <?php endforeach; ?>

    <?php if ($arParams['IMPORTANT_PROPS_LINK_TO_TAB'] == 'Y') :?>
    <div class="c-important-props__more-link"><a class="link-dashed m-color-primary js-easy-scroll" href="#properties" data-es-offset="-135"><?=Loc::getMessage('IMPORTANT_PROPS_MORE_LINK')?></a></div>
    <?php endif; ?>

</div>
