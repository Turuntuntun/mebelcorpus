<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';


$strReturn .= '<div class="breadcrumbs container"> <ul class="breadcrumbs-list">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? ' <li class="breadcrumbs-list__item"><span>/</span></li>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{

		$strReturn .= $arrow.'
                <li class="breadcrumbs-list__item">
                    <a class="breadcrumbs-list__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
                        '.$title.'
                    </a>
				</li>
			';
	}
	else
	{
		$strReturn .= $arrow.'
				<li class="breadcrumbs-list__item"><span class="breadcrumbs-list__active">'.$title.'</span></li>
			';
	}
}

$strReturn .= '</ul></div>';

return $strReturn;
