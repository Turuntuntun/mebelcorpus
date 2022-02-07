<?php
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\LoaderException;
use \Bitrix\Main\Application;
use \Bitrix\Main\Web\Cookie;

class UserCity
{
    public $cityId;
    public $userId;
    public $user;
    public $post;
    public $page;
    public $application;
    public $userEntity;
    const defaultId  = '64460';

    public function __construct()
    {
        global $USER;
        global $APPLICATION;
        $this->user = $USER;
        $this->application = $APPLICATION;
        $this->userEntity    = new CUser;
    }

    public static function getSessionCity()
    {
        $cityId = Application::getInstance()->getContext()->getRequest()->getCookie("setCityId");
        if ($cityId) {
            return $cityId;
        }
        return  self::defaultId;
    }

    public static function getCurrentCity($userId)
    {
        $arFilter = array("ID" => $userId);
        $arParams["SELECT"] = array("UF_CITY");
        $arRes = CUser::GetList($by,$desc,$arFilter,$arParams);

        if ($res = $arRes->Fetch()) {
            if ($res["UF_CITY"]) {
                return $res["UF_CITY"];
            }
        }
        return  self::defaultId;
    }

    public function setCity($cityId)
    {
        if ($this->userId) {
            $this->setBaseCity($cityId);
            $this->setSessoinCity($cityId);
        } else {
            $this->setSessoinCity($cityId);
        }
    }

    public function setBaseCity($cityID)
    {
        $arFields = array('UF_CITY'=>$cityID);
        $this->user->update($this->userId,$arFields);
    }
    
    public function setSessoinCity($cityID)
    {
        $this->application->set_cookie("setCityId", $cityID);
        $this->application->set_cookie("isCitySet", true);
    }

    public function init()
    {
        $this->page = $this->application->getCurPage();
        $this->userId = $this->checkLogin();
        $newCityId = $this->getCityIdFromRequest();
        if ($newCityId) {
            $this->setCity($newCityId);
            LocalRedirect($this->page);
        }

    }

    public function getCityIdFromRequest()
    {
        $request = Application::getInstance()->getContext()->getRequest();
        return $request->getQuery('setCityId');
    }

    public function checkLogin()
    {
        if ($this->user->IsAuthorized()) {
            return $this->user->getId();
        }
        return false;
    }

    public static function autorizedUser($userId)
    {
        $request = Application::getInstance()->getContext()->getRequest()->getCookie("setCityId");
    }
}

function initCity()
{
    $citi = new UserCity();
    $citi->init();
}
