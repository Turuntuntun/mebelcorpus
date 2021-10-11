<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$arParams['AJAX_LOAD'] = 'Y';
$extTabCount = (float) $arParams['TABS_COUNT'];
$uniqTabPrefix = 'tab'.$this->randString();
?>

<!-- b-tab-component -> <?=$uniqTabPrefix?> -->
<div class="b-tab-component">

<ul class="<?
	?>nav <?
	?>nav-tabs <?
	?>js-tabs <?
	echo ($arParams['HIDE_TAB_IF_ONE'] == 'Y' && $extTabCount == 0 ? 'hide-first ' : '')
	?>" role="tablist" id="<?=$uniqTabPrefix?>" data-ajax-load="<?=$arParams['AJAX_LOAD']?>">
	<li role="presentation"><a class="js-tab-loaded" href="#<?=$uniqTabPrefix?>__main" role="tab" data-toggle="tab"><?=$arParams['MAIN_TAB_NAME']?></a></li>
	<?php if ($extTabCount > 0): ?>
		<?php for ($i = 0; $i < $extTabCount; $i++): ?>
		<li role="presentation"><a href="#<?=$uniqTabPrefix?>__<?=$i?>" role="tab" data-toggle="tab" data-tab-path="<?=$arParams['TAB_PATH_N'.$i]?>"><?=$arParams['TAB_NAME_N'.$i]?></a></li>
		<?php endfor; ?>
	<?php endif; ?>
</ul>

<div class="<?
	?>tab-content <?
	echo ($arParams['HIDE_TAB_IF_ONE'] == 'Y' && $extTabCount == 0 ? 'hide-first ' : '')
	?>">
	<div role="tabpanel" class="tab-pane" id="<?=$uniqTabPrefix?>__main"><div class="tab-pane-in"><div class="tab-pane-in2"><?php
		include($arResult['FILE']);
	?></div></div></div>
	<?php if ($extTabCount > 0): ?>
		<?php for ($i = 0; $i < $extTabCount; $i++): ?>
		<div role="tabpanel" class="tab-pane" id="<?=$uniqTabPrefix?>__<?=$i?>"><div class="tab-pane-in"><div class="tab-pane-in2 js-tabs__put-content">
			<div class="rs-tabs__preloader"><div class="area2darken"><i class="icon animashka"></i></div></div>
		</div></div></div>
		<?php endfor; ?>
	<?php endif; ?>
</div>

</div>

<script type="text/javascript">
$(document).on('rsGoPro.document.ready', function(){
	$('#<?=$uniqTabPrefix?> a:first').tab('show');
});
</script>
<!-- /b-tab-component -> <?=$uniqTabPrefix?> -->
