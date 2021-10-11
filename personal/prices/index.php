<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избранные товары");
?>

<div class="pmenu">
<?$APPLICATION->IncludeComponent(
    "bitrix:menu", 
    "personal", 
    array(
        "ROOT_MENU_TYPE" => "personal",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(
        ),
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "SEPARATORS_PLACE" => array(
            0 => "3",
            1 => "7",
            2 => "",
        ),
        "COMPONENT_TEMPLATE" => "personal"
    ),
    false
);?>
</div>

<div class="pcontent">

    <h1>Изменение цен каталога</h1>
    <div style="width:100%;margin-bottom:15px;" class="clearfix"></div>

    <div id="ajaxpages_favorite" class="ajaxpages_favorite">
        <form class="form-inline">
            <div class="form-group">
                <label for="percent">наценка (%): </label>
                <input type="text" name="percent" class="form-control">
            </div>
            <button type="submit" class="btn btn-default">Выполнить</button>
        </form>
    </div>
    <div>
        <p>
            <?
            if (intval($_REQUEST["percent"]) > 0)
            {
                $db_res = CCatalogProduct::GetList(
                    [],
                    [
                        "ELEMENT_IBLOCK_ID" => 29,
						//"ID" => 64543,
                    ],
                    false,
                    false
                );
                while ($ar_res = $db_res->Fetch())
                    $result[$ar_res["ID"]] = $ar_res["ID"];

                $resPrice = CPrice::GetList([],["PRODUCT_ID" => $result]);
                $items_prices = 0;
                $items_prices_success = 0;
                while ($arPrice = $resPrice->Fetch())
                {
                    if ($arPrice["PRICE"] && $arPrice["PRICE"] > 0)
                    {
                        $items_prices++;
                        $price = round($arPrice["PRICE"] + (($arPrice["PRICE"] * intval($_REQUEST["percent"])) / 100));
						//print_r([$arPrice["ID"], $arPrice["PRICE"], intval($_REQUEST["percent"]), $price]);
						/*
                        $resultUpdate = \Bitrix\Catalog\Model\Price::update($arPrice["ID"], ["PRICE" => $price]);
                        if ($result->isSuccess())
                            $items_prices_success++;
*/
                    }
                }
                echo "Всего товаров: ".count($result)."</br>Всего цен: ".$items_prices."</br>Изменено цен: ".$items_prices_success;
            }
            ?>
        </p>
    </div>
    

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
