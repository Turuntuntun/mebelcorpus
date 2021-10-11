<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Loader,
    \Bitrix\Main\Localization\Loc;

if (!Loader::includeModule('redsign.devfunc'))
    return;

$myCity = \Redsign\DevFunc\Sale\Location\Location::getMyCity();

if (!empty($myCity)) {
    $isFind = false;
    foreach ($arResult['ITEMS'] as $index => $arItem) {
        if ($arItem['ID'] == $myCity['ID']) {
            unset($arResult['ITEMS'][$index]);
            $isFind = true;
        }
    }
    if (!$isFind && count($arResult['ITEMS']) >= $arParams['COUNT_ITEMS']) {
        array_pop($arResult['ITEMS']);
    }
}
?>
<script data-skip-moving>
if (!window.RSLocationChange) {
  function RSLocationChange(id) {
    if (RS.Location && id != RS.Location.getCityId()) {
      RS.Location.change(id);
	  if ($.fancybox && $.fancybox.getInstance()) {
		$.fancybox.getInstance().showLoading();
	  }
    }
  }
}
</script>
<div id="ownd-city-main">
	
	<?
	$arCities = Array(
		Array(
			'NAME' => 'Санкт-Петербург',
			'ID' => 85
		),
		Array(
			'NAME' => 'Москва',
			'ID' => 84
		),
		Array(
			'NAME' => 'Краснодар',
			'ID' => 1132
		),
		/*Array(
			'NAME' => 'Казань',
			'ID' => 1558
),*/
	);
	
	
	foreach ( $arCities as $arCity )
	{
		?>
			<a href="javascript:;" data-id="<?=$arCity['ID']?>"><?=$arCity['NAME']?></a>
		<?
	}
	?>
	
	<a href="javascript:;" class="ownd-city-other-button">Другой регион</a>
</div>
<div id="ownd-city-other">
<div class="b-locations-top">
    <div class="b-locations-top__title"><?=Loc::getMessage('RS_SELECT_CITY')?></div>
    <div class="row">
        <?php if (!empty($myCity)): ?>
        <div class="b-locations-top__item col-xs-12 col-sm-6 col-md-3 col-lg-5rs">
            <input class="custom-radio" type="radio" name="SELECT_CITY" id="SELECT_CITY_<?=$myCity['ID']?>" value="text" checked>
            <label for="SELECT_CITY_<?=$myCity['ID']?>"><?=$myCity['NAME']?></label>
        </div>
        <?php endif; ?>
        <?php
        foreach ($arResult['ITEMS'] as $index => $arItem):
        ?>
        <div class="b-locations-top__item col-xs-12 col-sm-6 col-md-3 col-lg-5rs">
            <input class="custom-radio" type="radio" name="SELECT_CITY" id="SELECT_CITY_<?=$arItem['ID']?>" value="text" onclick="RSLocationChange('<?=$arItem['ID']?>')">
            <label for="SELECT_CITY_<?=$arItem['ID']?>"><?=$arItem['LNAME']?></label>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="b-locations-top__line"></div>
</div>
<div class="b-locations-top__title"><?=Loc::getMessage('RS_SELECT_OR');?></div>
<div class="b-locations-top__bitrix-search">
<?$APPLICATION->IncludeComponent(
    "bitrix:sale.location.selector.search",
    "",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "ID" => $myCity['ID'],
        "CODE" => $myCity['CODE'],
        "INPUT_NAME" => "LOCATION",
        "PROVIDE_LINK_BY" => "id",
        "JS_CONTROL_GLOBAL_ID" => "",
        "JS_CALLBACK" => "RSLocationChange",
        "FILTER_BY_SITE" => "Y",
        "SHOW_DEFAULT_LOCATIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "FILTER_SITE_ID" => SITE_ID,
        "INITIALIZE_BY_GLOBAL_EVENT" => "",
        "SUPPRESS_ERRORS" => "N"
    )
);?>
</div>
</div>
