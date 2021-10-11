<?
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );


$itemId = intval( $_POST['ID'] );
$colorName = $_POST['COLOR_NAME'];



CModule::IncludeModule( 'sale' );



$arSort = Array(
	'ID' => 'DESC'
);
$arFilter = Array(
	'FUSER_ID' => CSaleBasket::GetBasketUserID(),
	'ORDER_ID' => 'NULL',
	'LID' => SITE_ID,
	'PRODUCT_ID' => $itemId
);
$arSelect = Array(
	'ID',
);
$dbBasketItem = CSaleBasket::GetList( $arSort, $arFilter, false, false, $arSelect );
if ( $arBasketItem = $dbBasketItem->Fetch() )
{
	$arProps = Array(
		Array(
			'CODE' => 'ITEM_COLOR',
			'NAME' => 'Цвет',
			'VALUE' => $colorName
		)
	);
	CSaleBasket::Update( $arBasketItem['ID'], Array( 'PROPS' => $arProps ) );
}
?>
done!