<!-- Данные -->
    
    <?
    // Выведем все свойства заказа
    $db_props = CSaleOrderPropsValue::GetOrderProps($arOrder['ID']);
    while ($arProps = $db_props->Fetch())
        $arOrder["PROPS"][$arProps["CODE"]] = $arProps;


    //По ID заказа достаем содержимое корзины данного заказа
    $arBasketItems = array();
    $dbBasketItems = CSaleBasket::GetList(
        array(),
        array("ORDER_ID" => $arOrder['ID']),
        false,
        false,
        array()
    );
    while ($arItems = $dbBasketItems->Fetch())
    {
        $dbPropsList = CSaleBasket::GetPropsList(
            array(
                "SORT" => "ASC",
                "NAME" => "ASC"
            ),
            array("BASKET_ID" => $arItems["ID"])
            );
        while ($arPropsList = $dbPropsList->Fetch())
           $arItems["PROPERTIES"][$arPropsList["CODE"]] = $arPropsList;

        $arBasketItems[] = $arItems;
        $arIdTovar[] = $arItems['PRODUCT_ID']; //накапливаем ID товаров для дальнейших целей
    }

    //Достаем информацию о платежной системе
    $arPaySystem = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"]);

    //Достаем информацию о доставке
    $arDelivery = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);

    //Если автоматизированая доставка...То достаем ее отдельно
    if(!$arDelivery){
        $SID_DELIVERY = explode(':', $arOrder["DELIVERY_ID"]);
        
        if($SID_DELIVERY[0] !=''){
            CModule::IncludeModule('sale');
            $dbResult = CSaleDeliveryHandler::GetList(
                array('SORT' => 'ASC', 'NAME' => 'ASC'),
                array('ACTIVE' => 'Y',"SID" => $SID_DELIVERY[0])
            );

            while ($arResultdelivery = $dbResult->GetNext())
            {
                $arDelivery['NAME'] = $arResultdelivery['NAME'];
            }
        }
    }

    //Достаем инфу о бонусных считах пользователей
    if (CModule::IncludeModule("sale") && $arOrder['USER_ID'] > 0){
        $dbAccountCurrency = CSaleUserAccount::GetList(
            array(),
            array("USER_ID" => $arOrder['USER_ID']),
            false,
            false,
            array("CURRENT_BUDGET", "CURRENCY","USER_ID")
        );
        if($arAccountCurrency = $dbAccountCurrency->Fetch())
        {
            //сохраняем в общий массив
            $UserAcaunt = round($arAccountCurrency['CURRENT_BUDGET']);
        }
    }

    //ВСЮ информацию о товарах (поля и свойсва)
    if(CModule::IncludeModule("iblock")){
        $arSelect = array();
        $arFilter = Array("IBLOCK_ID" => ID_CATALOG, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", '=ID' => $arIdTovar);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        { 
            $arFields = $ob->GetFields();
            $arInfoElement[$arFields['ID']] = $arFields;  
            $arInfoElement[$arFields['ID']]['PROPERTIES'] = $ob->GetProperties();
        }
    }

    //получаем список групп даного пользователя
    if($arOrder['USER_ID'] > 0){
        $arUserGroup = CUser::GetUserGroup($arOrder['USER_ID']);

        $arOrder["USER"] = CUser::GetList(
            ($by="ID"),
            ($order="desc"),
            array(
                "ID" => $arOrder['USER_ID']
            ),
            array()
        )->Fetch();
    }
    ?>

<!-- Конец данных -->

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="format-detection" content="telephone=no">
    <title>Товарный чек 2020</title>
    <link rel="stylesheet" href="/bitrix/admin/reports/css/style.css?v=1.01">
</head>
<body>

<div class="center-bl">
    <div class="head-l">
        <a href="/" class="logo">
            <?/*<img src="/bitrix/admin/reports/img/sunduk_mebel-logo.png" alt="sunduk-mebel.ru"><span>sunduk-mebel.ru</span>*/?>
            <?include_once($_SERVER["DOCUMENT_ROOT"]."/include/company_logo.php");?>
        </a>
        <p>
            Исполнитель: ООО “Мебель СП”, ИНН 7805599492 , ОГРН 1127847460696,<br>
            г. Санкт-Петербург, ул. Зои Космодемьянской 16/24,<br>
            Телефон: 8-800-201-63-87, 8-812-987-63-87. E-mail: sunduk-office@yandex.ru
        </p>
    </div>
    <div class="article-t">Товарный чек № <?=$arOrder['ACCOUNT_NUMBER']?></div>
    <div class="text-with-border">
        <strong>
            <?=implode(", ", array_filter(array($arOrder["PROPS"]["FIO"]["VALUE"], $arOrder["PROPS"]["ADDRESS"]["VALUE"], $arOrder["PROPS"]["PHONE"]["VALUE"])))?>
        </strong>
    </div>
    <div class="input-article">
        <input type="text" value="<?=mb_strtolower(FormatDate('d F Y', MakeTimeStamp($arOrder['DATE_INSERT_FORMAT']), ''))?>">
    </div>
    <table class="table-main">
        <thead>
            <tr>
                <th style="width: 5%;">№</th>
                <th>Товары (услуги)</th>
                <th style="width: 10%;">Кол-во</th>
                <th style="width: 5%;">Ед.</th>
                <th style="width: 12%;">Цена</th>
                <th style="width: 12%;">Сумма</th>
            </tr>
        </thead>
        <tbody>

            <!-- Выводим товары -->
            <?foreach ($arBasketItems as $keyItem => $arItems){?>
                <tr>
                    <td><?=++$keyItem?></td>
                    <td><?=$arItems["PROPERTIES"]["ITEM_COLOR"]["VALUE"] ? $arItems['NAME']." ".$arItems["PROPERTIES"]["ITEM_COLOR"]["VALUE"] : $arItems['NAME']?></td>
                    <td><?=round($arItems['QUANTITY'])?></td>
                    <td>шт</td>
                    <td><?=SaleFormatCurrency(round($arItems['PRICE']), $arOrder["CURRENCY"], true);?></td>
                    <td><?=SaleFormatCurrency(round($arItems['QUANTITY']) * round($arItems['PRICE']), $arOrder["CURRENCY"], true);?></td>
                </tr>
            <?}?>
            <?if ($arOrder['PRICE_DELIVERY'] > 0) {?>
                <tr>
                    <td><?=++$keyItem?></td>
                    <td>Доставка</td>
                    <td>1</td>
                    <td>шт</td>
                    <td><?=SaleFormatCurrency(round($arOrder['PRICE_DELIVERY']), $arOrder["CURRENCY"], true);?></td>
                    <td><?=SaleFormatCurrency(round($arOrder['PRICE_DELIVERY']), $arOrder["CURRENCY"], true);?></td>
                </tr>
            <?}?>
        </tbody>
    </table>
    <div class="price-top">
        <div>Всего:</div>
        <div><?=SaleFormatCurrency(round($arOrder['PRICE']), $arOrder["CURRENCY"], true);?></div>
    </div>
    <div class="price-bottom">
        <div class="wr-p">
            <div>Итого к оплате:</div>
            <div><?=SaleFormatCurrency(round($arOrder['PRICE']), $arOrder["CURRENCY"], true);?></div>
        </div>
    </div>
    <div class="text-with-border">
        Всего наименований <?=count($arBasketItems)?>, на сумму <?=SaleFormatCurrency(round($arOrder['PRICE']), $arOrder["CURRENCY"], true);?> руб. <br>
        <strong>
            Получено (сумма прописью): <?=Number2Word_Rus(round($arOrder['PRICE']), "N")?> рублей 00 коп.
        </strong>
    </div>
    <div class="text-with-border smaller-t">
        При получении покупатель ОБЯЗАН вскрыть упаковку и визуально оценить качество товара на предмет наличия видимых недостатков, наличия схемы сборки и фурнитуры, а также соответствия основных характеристик полученного товара заказу. Обязательно убедитесь в отсутствии внешних дефектов и комплектности товара, прежде чем расписываться в товарном чеке. Претензии к внешнему виду доставленного Вам товара в соответствии со ст. 458 и 459 ГК РФ Вы можете предъявить только до передачи Вам товара продавцом. Ссылки на загрязненность товара, недостаточную освещенность помещения, поторапливания со стороны экспедиторов, работников склада (при осуществлении вами самовывоза) и прочие причины, не являются основанием для невыполнения Вами требований ст. 484 ГК РФ.
    </div>
    <div class="text-other">
        <div class="uppercase-box">
            ПЕРЕЧЕНЬ НЕПРОДОВОЛЬСТВЕННЫХ ТОВАРОВ НАДЛЕЖАЩЕГО КАЧЕСТВА, НЕ ПОДЛЕЖАЩИХ ВОЗВРАТУ ИЛИ ОБМЕНУ НА АНАЛОГИЧНЫЙ ТОВАР ДРУГИХ РАЗМЕРА, ФОРМЫ, ГАБАРИТА, ФАСОНА, РАСЦВЕТКИ ИЛИ КОМПЛЕКТАЦИИ
        </div>
        <div class="one-block">
            .. 8. Мебель бытовая (мебельные гарнитуры и комплекты) ...<br>
            ...11. Технически сложные товары бытового назначения, на которые установлены гарантийные сроки (станки металлорежущие и деревообрабатывающие бытовые; электробытовые машины и приборы; бытовая радиоэлектронная аппаратура; бытовая вычислительная и множительная техника; фото- и киноаппаратура; телефонные аппараты и факсимильная аппаратура; электромузыкальные инструменты; игрушки электронные, бытовое газовое оборудование и устройства) ...<br>
            Постановление Правительства РФ от 20.10.1998 N 1222, от 06.02.2002<br>
            <b>Согласно ГК РФ собранная мебель обмену и возврату не подлежит.</b><br>
            Сборка мебели осуществляется в течение 10 рабочих дней после получения товара покупателем. Для заказа звоните по телефону:
            <b> +7(812)987-63-87, +7(800)201-63-87</b>
        </div>
        <div class="one-block">
            По вопросам брака обращаться в отдел рекламации: &nbsp;&nbsp;&nbsp; <b>sunduk-office@yandex.ru, тел. +7 (812) 987-63-87, +7 (800) 201-63-87</b>
            (высылается фото поврежденной детали,название детали, фото этикетки коробки в которой находилась поврежденная деталь и описание дефекта или описание недостающей части, с контактной информацией.) В течение 4-х рабочих дней Вы получите ответ по телефону или эл.почте.<br>
            В случае обнаружения брака или некомплектности изделия, после отгрузки товара, замена бракованных или недостающих деталей осуществляется путем САМОВЫВОЗА со склада поставщика или доставляется на платной основе.
        </div>
        <div class="one-block">
            <b>
                В случае обнаружения брака или некомплектности изделия, после отгрузки товара, замена бракованных или недостающих деталей осуществляется путем САМОВЫВОЗА со склада поставщика или доставляется на платной основе.
            </b>
        </div>
        <div class="sign-document-top">
            ВНИМАНИЕ! Внешний вид и комплектность проверил, упаковки без повреждений, СТЕКЛА и ЗЕРКАЛА не разбиты, ФУРНИТУРА ПРИСУТСТВУЕТ. Цвет, цена и наименование соответствует заказанной мебели, претензий не имею.<br>
            Коробки с ярлыками от фабрики до окончания сборки не выбрасывать. Без ярлыков от коробок рекламация, в случае брака, приниматься не будет.
            <div class="sign-line">
                <img src="/bitrix/admin/reports/img/img1.png" alt="check">
                <span>(подпись покупателя)</span>
            </div>
        </div>
     </div>
    <!--div class="prew-line">
        <img src="/bitrix/admin/reports/img/img2.png" alt="Подпись">
    </div-->
    <div class="buyer-line">Продавец</div>
    <div class="stamp-line">М.П.</div>
</div>


</body>
</html>