<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

include(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/template.php');

if ($arParams['IS_AJAXPAGES'] != 'Y') {
    $arBigDataParams = array(
        'params' => array(
            'uid' => $_COOKIE['BX_USER_ID'],
            'aid' => \Bitrix\Main\Analytics\Counter::getAccountId(),
            'count' => max($arParams['PAGE_ELEMENT_COUNT'], 30),
        )
    );

    // BigData
    if (!empty($arResult['NAV_RESULT']))
    {
        $navParams =  array(
            'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
            'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
            'NavNum' => $arResult['NAV_RESULT']->NavNum
        );
    }
    else
    {
        $navParams = array(
            'NavPageCount' => 1,
            'NavPageNomer' => 1,
            'NavNum' => $this->randString()
        );
    }

    $obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));

    $signer = new \Bitrix\Main\Security\Sign\Signer;
    $signedTemplate = $signer->sign($templateName, 'catalog.section');
    $signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');

    $containerName = 'container-'.$navParams['NavNum'];
?>
<script>
var params = {
    siteId: '<?=CUtil::JSEscape(SITE_ID)?>',
    componentPath: '<?=CUtil::JSEscape($templateFolder)?>',
    navParams: <?=CUtil::PhpToJSObject($navParams)?>,
    deferredLoad: false, // enable it for deferred load
    initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
    bigData: <?=CUtil::PhpToJSObject($arBigDataParams)?>,
    template: '<?=CUtil::JSEscape($signedTemplate)?>',
    ajaxId: '<?=CUtil::JSEscape($arParams['AJAX_ID'])?>',
    parameters: '<?=CUtil::JSEscape($signedParams)?>',
    container: '<?=$containerName?>'
};
bigDataLoad(params);
</script>

<?php
}
