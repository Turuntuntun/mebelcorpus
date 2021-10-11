<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-showcase__prices">
<?php
// prices
$params = array(
	'VIEW' => 'list',
	'SHOW_MORE' => 'Y',
	'USE_ALONE' => 'Y',
);
include(EXTENDED_PATH_COMPONENTS.'/prices.php');
?>
</div>
