<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}

use \Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;

$arCustomFont = array();
$sCustomFontEmbed = Option::get($moduleId, 'google_font_embed_code');
if (!empty($sCustomFontEmbed))
{
    $cache = \Bitrix\Main\Data\Cache::createInstance();

    if ($cache->initCache(36000000, $sCustomFontEmbed, '/'.$moduleId.'/fonts/'))
    {
        $arCustomFont = $cache->getVars();
    }
    elseif ($cache->startDataCache())
    {
        $arPatterns = array(
            '`<link href=".+family=([^&:]+).*" .+>$`',
            '`\+`'
        );

        $arReplacements = array(
            '$1',
            ' '
        );

        $sFontName = preg_replace($arPatterns, $arReplacements, $sCustomFontEmbed);

        $arCustomFont['EMBED_CODE'] = $sCustomFontEmbed;

        $arCustomFont['INLINE_STYLES'] = include Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/extended/custom_font_inline_styles.php';
        $arCustomFont['INLINE_STYLES'] = trim(preg_replace('/\s\s+/', ' ', $arCustomFont['INLINE_STYLES']));

        $cache->endDataCache($arCustomFont);
    }
}

if (isset($arCustomFont['EMBED_CODE']))
{
    $asset->addString($arCustomFont['EMBED_CODE']);
    
    if (isset($arCustomFont['INLINE_STYLES'] ))
    {
        $asset->addString("<style id=\"font\">".$arCustomFont['INLINE_STYLES']."</style>");
    }
}
else
{
    $asset->addString('<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">');
}