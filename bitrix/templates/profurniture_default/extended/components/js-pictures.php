<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();
$protocol = \Bitrix\Main\Context::getCurrent()->getRequest()->isHttps() ? "https://" : "http://";

$arPictures = array();

$params = array(
    'PAGE' => ($params['PAGE'] == 'list' ? 'list' : 'detail'),
);

if ($haveOffers && !empty($arItem['OFFERS'])) {
    foreach ($arItem['OFFERS'] as $arOffer) {
        $arPictures[$arOffer['ID']] = array();

        if ($params['PAGE'] == 'detail') {
            if (is_array($arOffer['DETAIL_PICTURE']['RESIZE'])) {
                $arPictures[$arOffer['ID']][] = array(
                    'SRC' => $arOffer['DETAIL_PICTURE']['RESIZE']['src'],
                    'ALT' => (!empty($arOffer['DETAIL_PICTURE']['ALT']) ? $arOffer['DETAIL_PICTURE']['ALT'] : ''),
                    'TITLE' => (!empty($arOffer['DETAIL_PICTURE']['TITLE']) ? $arOffer['DETAIL_PICTURE']['TITLE'] : ''),
                    'SRC_ORIGINAL' => $arOffer['DETAIL_PICTURE']['SRC'],
                );
                if (empty($templateData['imageOgOffer'])) {
                    $templateData['imageOgOffer'] = $protocol.SITE_SERVER_NAME.$arOffer['DETAIL_PICTURE']['SRC'];
                }
            }
        } else {
            if (is_array($arOffer['PREVIEW_PICTURE']['RESIZE'])) {
                $arPictures[$arOffer['ID']][] = array(
                    'SRC' => $arOffer['PREVIEW_PICTURE']['RESIZE']['src'],
                    'ALT' => (!empty($arOffer['PREVIEW_PICTURE']['ALT']) ? $arOffer['PREVIEW_PICTURE']['ALT'] : ''),
                    'TITLE' => (!empty($arOffer['PREVIEW_PICTURE']['TITLE']) ? $arOffer['PREVIEW_PICTURE']['TITLE'] : ''),
                    'SRC_ORIGINAL' => $arOffer['PREVIEW_PICTURE']['SRC'],
                );
            }
        }
        if (is_array($arOffer['PROPERTIES'][$arParams['PROP_SKU_MORE_PHOTO']]['VALUE'][0]['RESIZE'])) {
            foreach ($arOffer['PROPERTIES'][$arParams['PROP_SKU_MORE_PHOTO']]['VALUE'] as $arImage) {
                $arPictures[$arOffer['ID']][] = array(
                    'SRC' => $arImage['RESIZE']['src'],
                    'ALT' => (!empty($arOffer['NAME']) ? $arOffer['NAME'] : ''),
                    'TITLE' => (!empty($arOffer['NAME']) ? $arOffer['NAME'] : ''),
                    'SRC_ORIGINAL' => $arImage['SRC'],
                );
            }
            if ($params['PAGE'] == 'detail' && empty($templateData['imageOgOffer'])) {
                $templateData['imageOgOffer'] = $protocol.SITE_SERVER_NAME.$arOffer['PROPERTIES'][$arParams['PROP_SKU_MORE_PHOTO']]['VALUE'][0]['SRC'];
            }
        }
    }
}

// get _$strAlt_ and _$strTitle_
include(EXTENDED_PATH.'/img_alt_title.php');



$watermark = $arItem['PROPERTIES']['SIZES']['VALUE'];



$arPictures[$arItem['ID']] = array();
if ($params['PAGE'] == 'detail') {
    if (is_array($arItem['DETAIL_PICTURE']['RESIZE'])) {

		
		if ( SITE_ID == 'sm' )
		{
			$fileId = $arItem['DETAIL_PICTURE']['ID'];
			
			$arFilters = Array(
				Array(
					'name' => 'watermark',
					'type' => 'image',
					'position' => 'mc',
					'size' => 'real',
					'file' => $_SERVER['DOCUMENT_ROOT'] . '/upload/watermark.png',
				)
			);
				
			$arPicBig = CFile::ResizeImageGet( $fileId, Array( 'width' => 9999, 'height' => 9999 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arFilters );
			$arItem['DETAIL_PICTURE']['SRC_BIG'] = $arPicBig['src'];
			
			if ( $watermark )
			{
				$arFilters[] = Array(
					'name' => 'watermark',
					'type' => 'image',
					'position' => 'bc',
					'size' => 'real',
					'file' => $_SERVER['DOCUMENT_ROOT'] . '/upload/wm.png',
				);
				
				$arFilters[] = Array(
					'name' => 'watermark',
					'type' => 'text',
					'position' => 'bc',
					'size' => 'small',
					'text' => $watermark,
					'font' => $_SERVER['DOCUMENT_ROOT'] . '/opensans.ttf',
					'color' => '000000'
				);
			}
			
			
			$arPic1 = CFile::ResizeImageGet( $fileId, Array( 'width' => 9999, 'height' => 9999 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arFilters );
			
			$arItem['DETAIL_PICTURE']['SRC'] = $arPic1['src'];
			
			
			
			$strTitle = $arItem['DETAIL_PICTURE']['DESCRIPTION'];
		}
		
		
        $arPictures[$arItem['ID']][] = array(
            'SRC' => $arItem['DETAIL_PICTURE']['RESIZE']['src'],
            'ALT' => (!empty($strAlt) ? $strAlt : ''),
            'TITLE' => (!empty($strTitle) ? $strTitle : ''),
            'SRC_ORIGINAL' => $arItem['DETAIL_PICTURE']['SRC'],
			'SRC_BIG' => $arItem['DETAIL_PICTURE']['SRC_BIG'],
        );
        $templateData['imageOg'] = $protocol.SITE_SERVER_NAME.$arItem['DETAIL_PICTURE']['SRC'];
    }
} else {
    if (is_array($arItem['PREVIEW_PICTURE']['RESIZE'])) {
        $arPictures[$arItem['ID']][] = array(
            'SRC' => $arItem['PREVIEW_PICTURE']['RESIZE']['src'],
            'ALT' => (!empty($strAlt) ? $strAlt : ''),
            'TITLE' => (!empty($strTitle) ? $strTitle : ''),
            'SRC_ORIGINAL' => $arItem['PREVIEW_PICTURE']['SRC'],
            'SRC_BIG' => $arItem['PREVIEW_PICTURE']['SRC_BIG'],
        );
    }
}
if (is_array($arItem['PROPERTIES'][$arParams['PROP_MORE_PHOTO']]['VALUE'][0]['RESIZE'])) {
    foreach ($arItem['PROPERTIES'][$arParams['PROP_MORE_PHOTO']]['VALUE'] as $arImage) {
		
		if ( SITE_ID == 'sm' )
		{
			$fileId = $arImage['ID'];
			
			$arFilters = Array(
				Array(
					'name' => 'watermark',
					'type' => 'image',
					'position' => 'mc',
					'size' => 'real',
					'file' => $_SERVER['DOCUMENT_ROOT'] . '/upload/watermark.png',
				)
			);
			
			$arFilters[] = Array(
				'name' => 'watermark',
				'type' => 'image',
				'position' => 'bl',
				'size' => 'real',
				'file' => $_SERVER['DOCUMENT_ROOT'] . '/upload/pixel.png',
			);

				
			$arPicBig2 = CFile::ResizeImageGet( $fileId, Array( 'width' => 9999, 'height' => 9999 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arFilters );
			$arImage['SRC_BIG'] = $arPicBig2['src'];
			
			if ( $watermark )
			{
				$arFilters[] = Array(
					'name' => 'watermark',
					'type' => 'image',
					'position' => 'bc',
					'size' => 'real',
					'file' => $_SERVER['DOCUMENT_ROOT'] . '/upload/wm.png',
				);
				
				$arFilters[] = Array(
					'name' => 'watermark',
					'type' => 'text',
					'position' => 'bc',
					'size' => 'small',
					'text' => $watermark,
					'font' => $_SERVER['DOCUMENT_ROOT'] . '/opensans.ttf',
					'color' => '000000'
				);
			}
			
			
			$arPic2 = CFile::ResizeImageGet( $fileId, Array( 'width' => 9999, 'height' => 9999 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, $arFilters );
			
			$arImage['SRC'] = $arPic2['src'];
			
			
			
			$strTitle = $arImage['DESCRIPTION'];
		}
		
		
        $arPictures[$arItem['ID']][] = array(
            'SRC' => $arImage['RESIZE']['src'],
            'ALT' => (!empty($strAlt) ? $strAlt : ''),
            'TITLE' => (!empty($strTitle) ? $strTitle : ''),
            'SRC_ORIGINAL' => $arImage['SRC'],
            'SRC_BIG' => $arImage['SRC_BIG'],
        );
    }
    if ($params['PAGE'] == 'detail' && empty($templateData['imageOg'])) {
        $templateData['imageOg'] = $protocol.SITE_SERVER_NAME.$arItem['PROPERTIES'][$arParams['PROP_MORE_PHOTO']]['VALUE'][0]['SRC'];
    }
}
?>
<script type="text/javascript">
console.log( <?=CUtil::PhpToJSObject($arPictures)?> );
RSGoPro_Pictures[<?=$arItem['ID']?>] = <?=CUtil::PhpToJSObject($arPictures)?>;
</script>
