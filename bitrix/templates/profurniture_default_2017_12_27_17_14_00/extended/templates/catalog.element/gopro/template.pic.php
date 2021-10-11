<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
?>

<!-- picture -->
<div class="detail__pic">
    <div class="detail__stickers">
    <?php
    // stickers
    include(EXTENDED_PATH_COMPONENTS.'/stickers.php');
    ?>
    </div>
    <div class="detail__pic__inner">
        <div class="detail__pic__carousel js-picslider">
            <?php
            $arPictures = array();

            if ($haveOffers) {
                foreach ($arItem['OFFERS'] as $arOffer) {
                    $arPictures[$arOffer['ID']] = array();
                    if (is_array($arOffer['DETAIL_PICTURE']['RESIZE'])) {
                        $arPictures[$arOffer['ID']][] = array(
                            'SRC' => $arOffer['DETAIL_PICTURE']['RESIZE']['src'],
                            'ALT' => (!empty($arOffer['DETAIL_PICTURE']['ALT']) ? $arOffer['DETAIL_PICTURE']['ALT'] : '2'),
                            'TITLE' => (!empty($arOffer['DETAIL_PICTURE']['TITLE']) ? $arOffer['DETAIL_PICTURE']['TITLE'] : '2'),
                            'SRC_ORIGINAL' => $arOffer['DETAIL_PICTURE']['SRC'],
                        );
                    }
                    if (is_array($arOffer['PROPERTIES'][$arParams['PROP_SKU_MORE_PHOTO']]['VALUE'][0]['RESIZE'])) {
                        foreach($arOffer['PROPERTIES'][$arParams['PROP_SKU_MORE_PHOTO']]['VALUE'] as $arImage) {
                            $arPictures[$arOffer['ID']][] = array(
                                'SRC' => $arImage['RESIZE']['src'],
                                'ALT' => (!empty($arOffer['NAME']) ? $arOffer['NAME'] : '1'),
                                'TITLE' => (!empty($arOffer['NAME']) ? $arOffer['NAME'] : '1'),
                                'SRC_ORIGINAL' => $arImage['SRC'],
                            );
                        }
                    }
                }
            }

            // get _$strAlt_ and _$strTitle_
            include(EXTENDED_PATH.'/img_alt_title.php');

            $arPictures[$arItem['ID']] = array();
            if (is_array($arItem['DETAIL_PICTURE']['RESIZE'])) {
                $arPictures[$arItem['ID']][] = array(
                    'SRC' => $arItem['DETAIL_PICTURE']['RESIZE']['src'],
                    'ALT' => (!empty($strAlt) ? $strAlt : '3'),
                    'TITLE' => (!empty($strTitle) ? $strTitle : '3'),
                    'SRC_ORIGINAL' => $arItem['DETAIL_PICTURE']['SRC'],
                );
            }
            if (is_array($arItem['PROPERTIES'][$arParams['PROP_MORE_PHOTO']]['VALUE'][0]['RESIZE'])) {
                foreach ($arResult['PROPERTIES'][$arParams['PROP_MORE_PHOTO']]['VALUE'] as $arImage) {
                    $arPictures[$arItem['ID']][] = array(
                        'SRC' => $arImage['RESIZE']['src'],
                        'ALT' => (!empty($strAlt) ? $strAlt : '4'),
                        'TITLE' => (!empty($strTitle) ? $strTitle : '4'),
                        'SRC_ORIGINAL' => $arImage['SRC'],
                    );
                }
            }
            ?>
        </div>
    </div>
    <div class="detail__pic__zoom hidden-xs"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg><?=GetMessage('ZOOM')?></div>
    <div class="detail__pic__preview js-scroll scrollbar-inner"><div class="detail__pic__dots js-detail-dots"></div></div>
</div>

<script type="text/javascript">
RSGoPro_Pictures[<?=$arItem['ID']?>] = <?=CUtil::PhpToJSObject($arPictures)?>;
console.log('page');
</script>
<!-- /picture -->
