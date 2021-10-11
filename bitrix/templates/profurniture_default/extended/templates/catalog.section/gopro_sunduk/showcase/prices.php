<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-showcase__prices" style="margin: 0;">
	<?php
	if($USER->IsAuthorized())
	{
		// prices
		$params = array(
			'VIEW' => 'list',
			'SHOW_MORE' => 'Y',
			'USE_ALONE' => 'Y',
			'SHOW_OLD_PRICE' => (!empty($arParams['PRICE_CODE']) && count($arParams['PRICE_CODE']) == 1 ? 'Y' : 'N'),
		);
		include(EXTENDED_PATH_COMPONENTS.'/prices.php');
	}
	else
	{
		include(EXTENDED_PATH_COMPONENTS.'/prices_auth.php');
	}
	?>
</div>
