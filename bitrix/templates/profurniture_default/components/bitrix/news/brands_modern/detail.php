<?php 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) 
{
    die();
}

use \Bitrix\Main\Localization\Loc;
use \Redsign\GoPro\BrandTools;


$nBrandId = '';
if (isset($arResult['VARIABLES']['ELEMENT_ID']))
{
    $nBrandId = (int) $arResult['VARIABLES']['ELEMENT_ID'];
}
elseif (isset($arResult['VARIABLES']['ELEMENT_CODE']))
{
    $nBrandId = BrandTools::getIdByCode(
        $arResult['VARIABLES']['ELEMENT_CODE'],
        $arParams['IBLOCK_ID']
    );
}

$fnSet404 = function ($sMessage) use ($APPLICATION, $arParams) {
    \Bitrix\Iblock\Component\Tools::process404(
        $sMessage404,
        $arParams["SET_STATUS_404"] === "Y",
        $arParams["SET_STATUS_404"] === "Y",
        $arParams["SHOW_404"] === "Y",
        $arParams["FILE_404"]
    );
};

if (0 < $nBrandId)
{
    $request =  \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

    if ($request->get('section'))
    {
        $nSectionId = $request->get('section');

        $rsSection = CIBlockSection::GetById($nSectionId);
        $arSection = $rsSection->GetNext();

        if ($arSection)
        {
            include $_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder().'/include/section.php';
        }
        else
        {
           $fnSet404(Loc::getMessage('RS_N_SECTION_NOT_FOUND'));
        }

    }
    else
    {
        include $_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder().'/include/detail.php';
    }
}
else
{
    $fnSet404(Loc::getMessage('RS_N_BRAND_NOT_FOUND'));
}