<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\Loc;

?>

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
<?}else{
	include(EXTENDED_PATH_COMPONENTS.'/prices_auth.php');
}
?>

<?
/*$arFilter = Array(
	'IBLOCK_ID' => 39,
	'ACTIVE' => 'Y',
	'PROPERTY_CML2_LINK' => $arResult['ID']
);
$arSelect = Array(
	'ID',
	'PROPERTY_COLOR',
	'DETAIL_PICTURE'
);
$dbOffers = CIBlockElement::GetList( Array(), $arFilter, false, false, $arSelect );
while ( $arOffer = $dbOffers->Fetch() )
{
	$arPicture['src'] = '';
	if ( $arOffer['DETAIL_PICTURE'] )
	{
		$arPicture = CFile::ResizeImageGet( $arOffer['DETAIL_PICTURE'], Array( 'width' => 495, 'height' => 465 ) );
	}
	
	$arColors[] = Array(
		'CODE' => $arOffer['PROPERTY_COLOR_VALUE'],
		'OFFER_ID' => $arOffer['ID'],
		'OFFER_PICTURE' => $arPicture['src']
	);
}*/

$arColorsCodes = $arResult['PROPERTIES']['COLORS']['VALUE'];


if ( !empty( $arColorsCodes ) )
{
	global $DB;
	
	$dbColors = $DB->Query( 'SELECT UF_NAME,UF_XML_ID,UF_FILE FROM gopro_color_reference' );
	while ( $arColor = $dbColors->Fetch() )
	{
		$arColorsData[$arColor['UF_XML_ID']] = Array(
			'NAME' => $arColor['UF_NAME'],
			'PICTURE' => CFile::GetPath( $arColor['UF_FILE'] ),
		);
	}
	?>
		<div class="ownd-colors">
				
			<?
			foreach ( $arColorsCodes as $colorCode )
			{
				$arColorData = $arColorsData[$colorCode];
				?>
					<div class="ownd-color" data-code="<?=$colorCode?>">
						<div class="ownd-color-img" style="background:url(<?=$arColorData['PICTURE']?>) no-repeat;"></div>
						<div class="ownd-color-name"><?=$arColorData['NAME']?></div>
					</div>
				<?
			}
			?>
			
		</div>
	<?
}
?>


<script>
$( document ).ready(
	function ()
	{
		$( '.ownd-color' ).click(
			function ()
			{
				
				$( '.ownd-color' ).removeClass( 'active' );
				$( this ).addClass( 'active' );
				
				var offerPicture = $( this ).data( 'offer-picture' );
				
				if ( offerPicture )
				{
					$( '.detail__pic__img' ).attr( 'src', offerPicture );
				}
			}
		);	
	}
);

$( window ).on(
	'load',
	function ()
	{
		setDefaultColor();
	}
);


function setDefaultColor()
{
	if ( $( '.ownd-color' ).length )
	{
		$( '.ownd-color' ).eq( 0 ).click();
	}
}
</script>