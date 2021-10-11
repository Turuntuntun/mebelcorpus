<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

//delayed function must return a string
if (empty($arResult))
	return '';

$strReturn .= '<ul class="rsbreadcrumb list-unstyled" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if ($index > 0)
		$strReturn .= '<li class="rsbreadcrumb__free"><span>/</span></li>';

	$child = ($index > 0 ? ' itemprop="child"' : '');

	if ($arResult[$index]["LINK"] <> '' && $index != $itemSize - 1) {
		$strReturn .= '<li';
		if ($index == ($itemSize - 1)) {
			$strReturn .= ' class="last"';
		}

		$strReturn .= ' id="bx_breadcrumb_'.$index.'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<meta itemprop="position" content="'.($index + 1).'">
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item"><span itemprop="name">'.$title.'</span></a>
			</li>';
	} else {
		$strReturn .= '<li>'.$title.'</li>';
	}
}

$strReturn .= '</ul>';

return $strReturn;
