<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['SECTIONS'] as $key => $item) {
    $elems = CIBlockElement::GetList(array(),array('SECTION_ID'=>$item['ID']));
    while ($elem = $elems->GetNextElement()) {
        $fields = $elem->getFields();
        $props = $elem->getProperties();
        if ($props['UF_FILE']['VALUE']) {
            $arButtons = CIBlock::GetPanelButtons(
                $fields["IBLOCK_ID"],
                $fields["ID"],
                0,
                array("SECTION_BUTTONS"=>false, "SESSID"=>false)
            );
            $arResult['SECTIONS'][$key]['ITEMS'][] = array(
                "ADD_LINK" => $arButtons["edit"]["add_element"]["ACTION_URL"],
                "EDIT_LINK" => $arButtons["edit"]["edit_element"]["ACTION_URL"],
                "DELETE_LINK" => $arButtons["edit"]["delete_element"]["ACTION_URL"],
                'NAME' => $fields['NAME'],
                'ID' => $fields['ID'],
                'IBLOCK_ID' => $fields['IBLOCK_ID'],
                'UF_FILE' => CFile::getPath($props['UF_FILE']['VALUE'])
            );
        }
    }
}