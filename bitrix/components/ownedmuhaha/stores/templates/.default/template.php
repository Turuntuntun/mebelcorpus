<?
if ( !empty( $arResult['STORES'] ) )
{
	?>
		<div class="ownd-stores">
			<div class="ownd-stores-title">
				Наличие на складах:
			</div>
			<table>
			
				<?
				foreach ( $arResult['STORES'] as $arStore )
				{
					?>
						<tr class="ownd-store">
							<td class="ownd-store-name">
								<?=$arStore['NAME']?>:
							</td>
							<td class="ownd-store-amount">
								<?=$arStore['AMOUNT']?>
							</td>
						</tr>
					<?
				}
				?>
			
			</table>
		</div>
	<?
}
?>
