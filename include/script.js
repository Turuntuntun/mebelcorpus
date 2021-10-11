$( document ).ready(
	function ()
	{
		$( '#ownd-lang select' ).change(
			function ()
			{
				var lang = $( this ).val();
				
				$.post(
					'/_ajax/change_lang.php',
					{
						LANG: lang
					},
					function ()
					{
						window.location.reload();
					}
				);
			}
		);
		
		
		$( 'body' ).on(
			'click',
			'.ownd-city-other-button',
			function ()
			{
				$( '#ownd-city-main' ).hide();
				$( '#ownd-city-other' ).show();
			}
		);
		
		
		$( 'body' ).on(
			'click',
			'#ownd-city-main a[data-id]',
			function ()
			{
				var cityId = $( this ).data( 'id' );
				
				$.post(
					'/bitrix/components/redsign/location.main/ajax.php',
					{
						action: 'change',
						id: cityId,
						siteId: 'sm',
						sessid: BX.bitrix_sessid()
					},
					function ()
					{
						window.location.reload();
					}
				);
			}
		);
	}
);