<?php 
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) 
{
    die();
}

$this->setFrameMode(true);

if (count($arResult['ITEMS']) > 0): 

    if (!empty($arParams['BLOCK_NAME']))
    {
        ?><h2 class="nice-block-title"><?=$arParams['BLOCK_NAME'] ?></h2><?
    }

    ?><div class="row no-gutter">
        <?php foreach ($arResult['ITEMS'] as $arItem): ?>
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-5rs">
            <div class="brand-collection-item">
                <div class="brand-collection-item__image-wrapper">
                    <a class="brand-collection-item__image-canvas" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <?php
                        if (isset($arItem['PREVIEW_PICTURE']['SRC'])): 
    
                            $sImagePath = $arItem['PREVIEW_PICTURE']['SRC'];
                            $sAlt = $arItem['PREVIEW_PICTURE']['ALT'];
                            $sTitle = $arItem['PREVIEW_PICTURE']['TITLE'];
    
                        ?>
                            <img src="<?=$sImagePath?>" alt="<?=$sAlt?>" title="<?=$sTitle?>" class="brand-collection-item__image">
                        <?php 
                        else: 
    
                            $sImagePath = $templateFolder.'/images/no_photo.png';
                            $sAlt = $arItem['NAME'];
                            $sTitle = $arItem['TITLE'];
    
                        ?>
                            <img src="<?=$sImagePath?>" alt="<?=$sAlt?>" title="<?=$sTitle?>" class="brand-collection-item__image"> 
                        <?php endif; ?>
                    </a>
                </div>
                
                <div class="brand-collection-item__head">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="brand-collection-item__title">
                        <?=$arItem['NAME']?>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div><?php
endif;