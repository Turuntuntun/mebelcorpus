<?
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );


$basketItemId = intval( $_POST['BASKET_ITEM_ID'] );
$colorName = $_POST['COLOR_NAME'];



CModule::IncludeModule( 'sale' );



$arProps = Array(
	Array(
		'CODE' => 'ITEM_COLOR',
		'NAME' => 'Цвет',
		'VALUE' => $colorName
	)
);
CSaleBasket::Update( $basketItemId, Array( 'PROPS' => $arProps ) );
?>
done!