<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

// phone mast
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.maskedinput.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/timer.js');
?>

<style>
.catalogmenu2 li ul li.first ul
{
	margin-left: 0;
	position: static;
}

.catalogmenu2 li:hover ul.rs-show
{
	display: block;
}

.catalogmenu2 li.first ul .mrow:hover>a,
.catalogmenu2 li.first ul .mrow.selected
{
	background-color: #f5f5f5;
}

.catalogmenu2.hover ul.first
{
	box-shadow: none !important;
}

.catalogmenu2 li ul.first
{
	position: static;
}
</style>