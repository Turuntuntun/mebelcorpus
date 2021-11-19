<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$colorEntire = getClassHighload($arResult['PROPERTIES']['COLORS']['USER_TYPE_SETTINGS']['TABLE_NAME']);
foreach ( $arResult['PROPERTIES']['COLORS']['VALUE'] as $key => &$value) {
    $elem = $colorEntire::getList(
        array(
            'filter' => array('UF_XML_ID'=>$value))
        )->Fetch();
    $arResult['PROPERTIES']['COLORS']['NEW_VALUES'][] = array(
        'CODE' => $elem['UF_XML_ID'],
        'TITLE' =>  $elem['UF_NAME'],
        'FILE' => CFile::getPath($elem['UF_FILE'])
    );
}
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();