<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="full-menu__wrap">
    <? foreach ( $arResult['ITEMS'] as $key => $arItem) :?>
        <ul class="full-menu__list">
            <li class="full-menu__item full-menu__item--caption"><a class="full-menu__link" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a></li>
            <?  foreach($arItem['CHILDS'] as $arChild):
                if($arParams["MAX_LEVEL"] == 1 && $arChild["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                    <li class="full-menu__item"><a class="full-menu__link" href="<?=$arChild["LINK"]?>" class="selected"><?=$arChild["TEXT"]?></a></li>

            <?endforeach?>
        </ul>
    <? endforeach;?>
</div>

<?endif?>


