<?
require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );


$lang = htmlspecialcharsbx( $_POST['LANG'] );

$APPLICATION->set_cookie( 'SUNDUK_LANG', $lang );


require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php' );
?>