<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
$server_doc_root = $_SERVER['DOCUMENT_ROOT'];
$ORDER = $_REQUEST["order"];
$TAX = $_REQUEST["tax"];

if ($ORDER > 0 && $TAX)
{
	require_once( $_SERVER["DOCUMENT_ROOT"] .'/include/ajax/check.php' );//формирует бланк

	//создает документ .pdf

	require_once( $_SERVER["DOCUMENT_ROOT"] .'/include/ajax/libraries/tcpdf/tcpdf.php' );// библиотек для формирования ПДФ

	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8'); // убираем на всякий случай шапку и футер документа 
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false); 
	$pdf->SetMargins(20, 5, 5); // устанавливаем отступы (20 мм - слева, 25 мм - сверху, 25 мм - справа)
	$pdf->SetFont('dejavusans', '', 4); // устанавливаем имя шрифта и его размер
	$pdf->AddPage();
	$pdf->writeHTML($html);//пишем в ПДФ содержимое переменной
	ob_clean();
	$pdf->Output('N'. $check_id .'-'. $check_data .'.pdf', 'D');// вывод на просмотр (параметр I).
	exit;

}
else
{
	echo "Счет не найден";
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>