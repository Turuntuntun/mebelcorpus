<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class="account__side account-side">
        <ul class="account-side__list">
    <?
        foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>
        <? if ($arItem['LINK'] == '/exit') :?>
            <li  class="account-side__item"><a class="account-side__link" href="#" data-modal-trigger="logout"><?=$arItem["TEXT"]?></a></li>
        <? elseif($arItem["SELECTED"]):?>
            <li  class="account-side__item"><a class="account-side__link active" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
        <?else:?>
            <li  class="account-side__item"><a class="account-side__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
        <?endif?>

        <?endforeach?>
        </ul>
    </div>
<?endif?>