<pre>
<?
use \Bitrix\Main,
Bitrix\Main\Loader,
Bitrix\Sale,
Bitrix\Sale\Order;

if (!Loader::IncludeModule('sale'))
	die();
CModule::IncludeModule("iblock");

	$server_doc_root = $_SERVER['DOCUMENT_ROOT'];
	$order = Sale\Order::load($ORDER); // ЗАКАЗ
	$check_id = $order->getField('ACCOUNT_NUMBER');//номер заказа
	$check_data = $order->getDateInsert()->format("d.m.Y");//дата заказа

	/** 1. данные пользователя */
	$arUser = Bitrix\Main\UserTable::getList(
		array(
			"select" => array("ID", "NAME", "WORK_COMPANY", /*"UF_INN", "UF_ADRESS",*/ "WORK_PHONE", "EMAIL"),
			"filter" => array("ID" => $order->getUserId())
		)
	)->fetch();

	/** 2. свойства заказа */
	$propertyCollection = $order->getPropertyCollection();
	$arProperty = $propertyCollection->getArray();
	foreach ($arProperty["properties"] as $props)
		$propertyOrder[$props["CODE"]] = $props;

	/** 3. тип плательщика */
	$arTypePerson = $TAX; /*CSalePersonType::GetList(
		array(),
		array("ID" => $order->getPersonTypeId(), "LID"=>SITE_ID)
	)->Fetch();*/

	/** 4. реквизиты получателя */
	$res = CIBlockElement::GetList(
		array(), 
		array("IBLOCK_ID" => ID_REQUISITE, "CODE" => $arTypePerson/*$arTypePerson["CODE"]*/),
		false,
		false,
		array()
	);
	if ($obRequisite = $res->GetNextElement()) {
	   $arRequisite = $obRequisite->GetFields();
	   $arRequisite["PROPERTIES"] = $obRequisite->GetProperties();
	}

	$req_bank = $arRequisite["PROPERTIES"]["BANK_NAME"]["VALUE"];
	$req_bik = $arRequisite["PROPERTIES"]["BIK"]["VALUE"];
	$req_num1 = $arRequisite["PROPERTIES"]["NUMBER1"]["VALUE"];
	$req_num2 = $arRequisite["PROPERTIES"]["NUMBER2"]["VALUE"];
	$req_inn = $arRequisite["PROPERTIES"]["INN"]["VALUE"];
	$req_name = $arRequisite["NAME"];
	$req_kpp = $arRequisite["PROPERTIES"]["KPP"]["VALUE"];
	$req_exponent = $arRequisite["PROPERTIES"]["EXPONENT"]["VALUE"];

	/*
	$req_bayer_adress = implode(
		", ",
		array(
			$arUser["WORK_COMPANY"],
			"ИНН ". $arUser["UF_INN"],
			"КПП ",
			$arUser["UF_ADRESS"],
			" тел.: ". $arUser["WORK_PHONE"]
		)
	);
	*/
	$req_bayer_adress = implode(
		", ",
		array(
			current($propertyOrder["COMPANY"]["VALUE"]),
			"ИНН ". current($propertyOrder["INN"]["VALUE"]),
			"КПП ". current($propertyOrder["KPP"]["VALUE"]),
			current($propertyOrder["COMPANY_ADR"]["VALUE"]),
			" тел.: ". current($propertyOrder["PHONE"]["VALUE"])
		)
	);
//pre(array($check_id, $arUser, $req_bayer_adress, $propertyOrder));

	$img = CFile::ResizeImageGet(
		$arRequisite["DETAIL_PICTURE"],
		array("width" => 110, "height" => 80),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
	$req_logo_img = $server_doc_root. $img["src"];//лого из реквизитов получателя

	$img = CFile::ResizeImageGet(
		$arRequisite["PROPERTIES"]["SIGNATURE_D"]["VALUE"],
		array("width" => 390, "height" => 120),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
	$req_signature_d_img = $server_doc_root. $img["src"];//подпись директора

	$img = CFile::ResizeImageGet(
		$arRequisite["PROPERTIES"]["SIGNATURE_B"]["VALUE"],
		array("width" => 390, "height" => 120),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
	$req_signature_b_img = $server_doc_root. $img["src"];//подпись бухгалтера

	$img = CFile::ResizeImageGet(
		$arRequisite["PROPERTIES"]["STAMP"]["VALUE"],
		array("width" => 364, "height" => 364),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
	$req_stamp_img = $server_doc_root. $img["src"];//печать


$html .= <<<EOT

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Payment invoice</title>
	<style>

	</style>
</head>
<body>
	<table width="600" border="0" style="font-size: 9px; text-size-adjust:100%; background: #fff" cellspacing="0" cellpadding="0">
		<tr>
			<td width="80"><br><br><img src="$req_logo_img" alt=""></td>
			<td width="10"></td>
			<td width="400">
				<table cellpadding="5" border="1" cellspacing="0" align="left">
					<tr>
						<td rowspan="2" colspan="2">$req_bank<br><small style="font-size: 7px;">Банк получателя</small></td>
						<td width="40">БИК</td>
						<td width="150" rowspan="2"><br><span>$req_bik</span><br><span>$req_num1</span></td>
					</tr>
					<tr>
						<td  >Сч. №</td>
					</tr>
					<tr>
						<td>ИНН <span>$req_inn</span></td>
						<td>КПП <span>$req_kpp</span></td>
						<td  rowspan="2">Сч. №</td>
						<td rowspan="2">$req_num2</td>
					</tr>
					<tr>
						<td colspan="2"><span>$req_name</span><br><small style="font-size: 7px;">Получатель </small></td>
					</tr>
					<tr>
						<td colspan="4"><span>Оплата по заказу клиента №$check_id</span><br><small style="font-size: 7px;">Назначение платежа </small></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" height="20"></td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 12px;font-weight: bold;">Счет на оплату № <span>$check_id</span> от <span>$check_data</span> г.</td>
		</tr>
		<tr>
			<td colspan="3" height="3"></td>
		</tr>
		<tr>
			<td colspan="3" style="background: #000" height="3"><hr height="2"></td>
		</tr>
		<tr>
			<td colspan="3">
				<table width="480" border="0" cellpadding="0" cellspacing="0" style="font-size: 9px">
					<tr>
						<td width="80" style="vertical-align: top;">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td>Поставщик</td>
								</tr>
								<tr>
									<td style="font-size: 7px;">(исполнитель):</td>
								</tr>
							</table>
						</td>
						<td width="5"></td>
						<td width="395" rowspan="2" style="font-weight: bold;">$req_exponent</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" height="5"></td>
		</tr>
		<tr>
			<td colspan="3">
				<table cellpadding="0" border="0" cellspacing="0" style="font-size: 9px">
					<tr>
						<td width="80" style="vertical-align: top;">
							<table  cellpadding="0">
								<tr>
									<td>Покупатель</td>
								</tr>
								<tr>
									<td style="font-size: 7px;">(заказчик):</td>
								</tr>
							</table>
						</td>
						<td width="5"></td>
						<td width="395" rowspan="2" style="font-weight: bold;">$req_bayer_adress</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" height="5"></td>
		</tr>
		<tr>
			<td colspan="3">
				<table width="480" border="1" cellpadding="5" cellspacing="0">
					<tr style="font-size: 9px;">
						<th width="20">№</th>
						<th width="200">Товар (Услуга)</th>
						<th width="70">Артикул</th>
						<th width="45">Кол-во</th>
						<th width="30">Ед.</th>
						<th width="55">Цена</th>
						<th width="55">Сумма</th>
					</tr>
EOT;

	/** 4. товары в корзине заказа */
	$basket = $order->getBasket();//корзина заказа
	$i = 0;
	foreach ($basket as $item)
	{
		$i++;
		$item_name = $item->getField('NAME');//название
		$item_price = number_format($item->getPrice(), 2, ',', ' ');//цена за единицу
		$item_quantity = $item->getQuantity();//количество
		$item_price_sum = number_format($item->getFinalPrice(), 2, ',', ' ');//сумма

		//свойства товара
		$arElement = CIBlockElement::GetByID($item->getProductId())->GetNext();
		$arProps = CIBlockElement::GetProperty($arElement["IBLOCK_ID"], $arElement["ID"], "sort", "asc", array("CODE" => "CML2_ARTICLE"))->Fetch();
		$item_artnumber = $arProps["VALUE"];


$html .= <<<EOT
					<tr style="font-size: 8px;">
						<td>$i</td>
						<td>$item_name</td>
						<td>$item_artnumber</td>
						<td>$item_quantity</td>
						<td>шт</td>
						<td align="right">$item_price</td>
						<td align="right">$item_price_sum</td>
					</tr>
EOT;

	}

		$price_all = $basket->getPrice();//итог цена с учетом скидок
		$price_all_format = number_format($price_all, 2, ',', ' ');
$html .= <<<EOT
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" height="10"></td>
		</tr>
		<tr>
			<td colspan="3">
				<table border="0" cellpadding="0" cellspacing="0" align="right" style="font-weight: bold;">
					<tr align="right">
						<td width="350">Итого:</td>
						<td width="125">$price_all_format</td>
					</tr>
EOT;


	if ($arRequisite["CODE"] == 'TAX')
	{
		$nds = ($price_all/6);
		$price_nds = number_format($nds, 2, ',', ' '); // НДС
$html .= <<<EOT
					<tr>
						<td>В т.ч. НДС(20%):</td>
						<td>$price_nds</td>
					</tr>
EOT;

	}
	else
	{

$html .= <<<EOT
					<tr>
						<td>Без налога НДС</td>
						<td>-</td>
					</tr>
EOT;
	}

		$req_footer_text = $arRequisite["DETAIL_TEXT"];
		$req_director = $arRequisite["PROPERTIES"]["DIRECTIOR"]["VALUE"];
		$req_boocker = $arRequisite["PROPERTIES"]["BOOCKER"]["VALUE"];
		$weight_all = $item->getWeight() > 0 ? number_format($item->getWeight(), 3, ',', ' ') : 0;//вес
		$price_all_cursive = substr(Number2Word_Rus($price_all, "N"), 0, -1). " рублей 00 копеек";//сумма прописью
		if ($arRequisite["CODE"] == 'TAX') {
			$price_all_cursive .= ", в том числе НДС ". strtolower(Number2Word_Rus($nds, "Y", 'RUB'));
		}
$html .= <<<EOT
					<tr>
						<td>Всего к оплате:</td>
						<td>$price_all_format</td>
					</tr>

				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" height="10"></td>
		</tr>
		<tr>
			<td colspan="3">Всего наименований <span>$i</span>, на сумму <span>$price_all_format</span> RUB</td>
		</tr>
		<tr>
			<td colspan="3" style="font-weight: bold;">$price_all_cursive</td>
		</tr>
		<tr>
			<td colspan="3" height="3"></td>
		</tr>
		<tr>
			<td colspan="3">$req_footer_text</td>
		</tr>
		<tr>
			<td colspan="3"></td>
		</tr>
		<tr>
			<td colspan="3"><hr height="2"></td>
		</tr>
		<tr>
			<td colspan="3"></td>
		</tr>
		<tr>
			<td colspan="3">
				<table cellpadding="0" border="0" cellspacing="0">
					<tr>
						<td rowspan="3" style="font-weight: bold;font-size: 10px">Руководитель</td>
						<td width="15"></td>
						<td align="center" width="130">
							<img src="$req_signature_d_img" alt="" style="max-width: 100%;">
						</td>
						<td width="15"></td>
						<td  width="200" style="vertical-align: bottom;"><br><br><br>&nbsp;&nbsp;$req_director</td>
					</tr>
					<tr>
						<td width="15"></td>
						<td>
							<table cellpadding="0" border="0" cellspacing="0">
								<tr><td><hr></td></tr>
							</table>
						</td>
						<td width="15"></td>
						<td >
							<table cellpadding="0" border="0" cellspacing="0">
								<tr><td><hr></td></tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="15"></td>
						<td width="130" align="center" style="font-size: 7px;">подпись</td>
						<td width="15"></td>
						<td width="200" align="center" style="font-size: 7px;">расшифровка подписи</td>
					</tr>
				</table>
			</td>
		</tr>        
		<tr>
			<td colspan="3">
				<table cellpadding="0" border="0" cellspacing="0">
					<tr>
						<td rowspan="3" style="font-weight: bold;font-size: 10px"><br><br>Бухгалтер</td>
						<td width="15"></td>
						<td align="center" width="130">
							<img src="$req_signature_b_img" alt="" style="max-width: 100%;">
						</td>
						<td width="15"></td>
						<td width="200" valign="bottom"><br><br><br>&nbsp;&nbsp;$req_boocker</td>
					</tr>
					<tr>
						<td width="15"></td>
						<td>
							<table cellpadding="0" border="0" cellspacing="0">
								<tr><td><hr></td></tr>
							</table>
						</td>
						<td width="15"></td>
						<td >
							<table cellpadding="0" border="0" cellspacing="0">
								<tr><td><hr></td></tr>
							</table>
						</td>
					</tr>
					<tr style="vertical-align: top">
						<td width="15"></td>
						<td width="130" align="center" style="font-size: 7px;">подпись</td>
						<td width="15"></td>
						<td width="200" align="center" style="font-size: 7px;vertical-align: top">расшифровка подписи</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center">М.П.</td>
		</tr>
		<tr>
			<td colspan="3" align="center"><img src="$req_stamp_img" alt="" align="center" width="135"></td>
		</tr>
	</table>
</body>
</html>
EOT;
?>