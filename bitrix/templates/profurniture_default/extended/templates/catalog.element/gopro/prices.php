<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\Loc;

?>
1111111111111
<?php 
//if (isset($product['MIN_PRICE']) && $product['MIN_PRICE']): 
if ($USER->IsAuthorized())
{
	?>
    <!-- prices -->
    <div class="detail__prices">
        <span class="detail__prices__title"><?=Loc::getMessage('SOLOPRICE_PRICE')?></span>
		<?php
		// prices
		$params = array(
			'PAGE' => 'detail',
			'VIEW' => 'list',
			'SHOW_MORE' => 'N',
			'USE_ALONE' => 'Y',
			'MAX_SHOW' => 15,
			'SHOW_DISCOUNT_NAME' => 'Y',
			'SHOW_DISCOUNT_DIFF' => 'N',
			'SHOW_OLD_PRICE' => 'Y',
		);
		if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/prices.php', $getTemplatePathPartParams))) {
			include($path);
		}
		?>
    </div>
    <!-- /prices -->
	<?php 
}
else
{
	include(EXTENDED_PATH_COMPONENTS.'/prices_auth.php');
}
//endif;
