<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (empty($arParams['SOC_SHARE_ICON'])) {
    $arParams['SOC_SHARE_ICON'] = array('vkontakte', 'facebook', 'odnoklassniki', 'gplus', 'twitter', 'viber', 'telegram');
}

$params = array(
    'SOC_SHARE_ICON' => implode(',', $arParams['SOC_SHARE_ICON']),
    'SIZE' => (!empty($params['SIZE']) ? $params['SIZE'] : 's'),
);
?>

<div class="c-ya-share">
    <div class="ya-share2"
        data-services="<?=$params['SOC_SHARE_ICON']?>"
        data-lang="<?=LANGUAGE_ID?>"
        data-size="<?=$params['SIZE']?>"
        data-copy="first" <?
        if (!empty($templateData['imageOg'])) {
            ?>data-image="<?=\CHTTP::URN2URI($templateData['imageOg'])?>" <?
        } elseif (!empty($templateData['imageOgOffer'])) {
            ?>data-image="<?=\CHTTP::URN2URI($templateData['imageOgOffer'])?>" <?
        }
    ?>></div>
</div>
