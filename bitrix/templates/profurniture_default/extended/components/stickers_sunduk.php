<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (empty($arParams['STICKERS_PROPS']) && $arParams['STICKERS_DISCOUNT_VALUE'] != 'Y')
    return;
?>



<div class="c-stickers"><?

    ?><span class="c-stickers__sticker c-stickers__da2"><?=Loc::getMessage('STICKERS.DA2')?></span><?
    ?><span class="c-stickers__sticker c-stickers__qb"><?=Loc::getMessage('STICKERS.QB')?></span><?

    ?><?php foreach ($arParams['STICKERS_PROPS'] as $propCode):
        $prop = $arItem['PROPERTIES'][$propCode];
        ?><?
        ?><?php if ($prop['VALUE'] != ''): ?><?
            ?><span class="c-stickers__sticker c-stickers__sticker-standart c-stickers__<?=$prop['VALUE']?>"<?php if ($prop['HINT'] != ''): ?>style="background-color: <?=$prop['HINT']?>;"<?php endif; ?>><?=$prop['NAME']?></span><?
        ?><?php endif; ?><?
    ?><?php endforeach; ?><?

    ?><?

?></div>
