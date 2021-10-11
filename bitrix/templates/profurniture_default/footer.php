<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $isAjax;

if ($isAjax)
{
	?></div></div><?
	die();
}

?>

				</div>
				
				
				<?
				if ( SITE_ID == 'sm' )
				{
					CModule::IncludeModule( 'iblock' );
					
					$url = $APPLICATION->GetCurDir();
					
					
					$arFilter = Array(
						'IBLOCK_ID' => 40,
						'ACTIVE' => 'Y',
						'CODE' => $url
					);
					$arSelect = Array(
						'PREVIEW_TEXT'
					);
					$dbItem = CIBlockElement::GetList( Array(), $arFilter, false, false, $arSelect );
					if ( $arItem = $dbItem->Fetch() )
					{
						?>
							<div id="ownd-text">
								<div>
									<?=$arItem['PREVIEW_TEXT']?>
								</div>
								<a href="javascript:;">Читать дальше</a>
							</div>
							
							<script>
							$( document ).ready(
								function ()
								{
									var textHeight = $( '#ownd-text' ).height();
									
									if ( textHeight > 50 )
									{
										$( '#ownd-text' ).addClass( 'closed' );
									}
									
									
									$( '#ownd-text a' ).click(
										function ()
										{
											$( '#ownd-text' ).removeClass( 'closed' );
										}
									);
								}
							);
							</script>
						<?
					}	
				}
				?>
				
				
			</div>
		</div><!-- /content -->
	</div><!-- /body -->

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/header/footer.before.php",
	array(),
	array("MODE"=>"html")
);?>

	<div id="footer" class="footer"><!-- footer -->
		<div class="centering">
			<div class="centeringin line1 clearfix">
				<div class="block one">
					<div class="logo">
						<a href="<?=SITE_DIR?>">
							<?$APPLICATION->IncludeFile(
								SITE_DIR."include/company_logo.php",
								Array(),
								Array("MODE"=>"html")
							);?>
						</a>
					</div>
					<div class="contacts clearfix">
						<div class="phone1">
							<a class="fancyajax fancybox.ajax recall" href="<?=SITE_DIR?>include/popup/recall/?AJAX_CALL=Y" title="<?=Loc::getMessage('RSGOPRO.RECALL')?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-mobile-phone"></use></svg><?=Loc::getMessage('RSGOPRO.RECALL')?></a>
							<div class="phone">
								<?$APPLICATION->IncludeFile(
									SITE_DIR."include/footer/phone1.php",
									Array(),
									Array("MODE"=>"html")
								);?>
							</div>
						</div>
						<div class="phone2">
							<a class="fancyajax fancybox.ajax feedback" href="<?=SITE_DIR?>include/popup/feedback/?AJAX_CALL=Y" title="<?=Loc::getMessage('RSGOPRO.FEEDBACK')?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-dialog"></use></svg><?=Loc::getMessage('RSGOPRO.FEEDBACK')?></a>
							<div class="phone">
								<?$APPLICATION->IncludeFile(
									SITE_DIR."include/footer/phone2.php",
									Array(),
									Array("MODE"=>"html")
								);?>
							</div>
						</div>
					</div>
				</div>
				<div class="block two hidden-print">
					<?$APPLICATION->IncludeFile(
						SITE_DIR."include/footer/catalog_menu.php",
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				<div class="block three hidden-print">
					<?$APPLICATION->IncludeFile(
						SITE_DIR."include/footer/menu.php",
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				<div class="block four hidden-print">
					<div class="sovservice">
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/footer/socservice.php",
							Array(),
							Array("MODE"=>"html")
						);?>
					</div>
					<div class="subscribe">
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/footer/subscribe.php",
							Array(),
							Array("MODE"=>"html")
						);?>
					</div>
				</div>
			</div>
		</div>

		<div class="line2 hidden-print">
			<div class="centering">
				<div class="centeringin clearfix">
					<div class="sitecopy">
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/footer/law.php",
							Array(),
							Array("MODE"=>"html")
						);?>
					</div>
					<div class="developercopy hidden-xs"><?
						?><?php
						/****************************************************************************************/
						/* #REDSIGN_COPYRIGHT# */ 
						/* do not remove developer copyright or you lose support */ 
						/****************************************************************************************/
						?><?
						?>Powered by <a href="https://www.redsign.ru/templates/store/<?=GOPRO_MODULE_ID?>/" target="_blank" rel="nofollow">ALFA Systems</a><?
						?><?php
						/****************************************************************************************/
						/* do not remove developer copyright or you lose support */ 
						/****************************************************************************************/
						?><?
					?></div>
				</div>
			</div>
		</div>
	</div><!-- /footer -->

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/header/footer.after.php",
	array(),
	array("MODE"=>"html")
);?>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/footer/easycart.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?php include(EXTENDED_PATH.'/footer_inc.php'); ?>

<script type="text/javascript">RSGoPro_SetSet();</script>

<div style="display:none;">AlfaSystems GoPro GP261D21</div>

<script>$('#svg-icons').setHtmlByUrl({url:SITE_TEMPLATE_PATH + '/assets/img/icons.svg?version=<?=$arTemplate['GOPRO_VERSION']?>'});</script>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/tuning/component.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/footer/body_end.php",
	Array(),
	Array("MODE"=>"html")
);?>
<?$APPLICATION->IncludeFile(
	SITE_DIR."include/footer/modal_price.php",
	Array(),
	Array("MODE"=>"html")
);?>


<?if($_COOKIE['BITRIX_SM_RS_MY_LOCATION'] =='' && !isset($_COOKIE['BITRIX_SM_RS_MY_LOCATION'])){//Если город не выбран то принудительно показываем выбор города?>
	<script type="text/javascript">
		$(function () {
			$('#topline-location .b-topline-location__link').click();	
		});
	</script>
<?}?>
<script type="text/javascript">
if($('#location_confirm .btn.btn-primary.waves-effect')){
	$('#location_confirm .btn.btn-primary.waves-effect').click();
}
</script>


</body>
</html>
