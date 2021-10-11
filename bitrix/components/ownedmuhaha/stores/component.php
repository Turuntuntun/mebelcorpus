<?
if ( $this->StartResultCache( 86400000 ) )
{
	CModule::IncludeModule( 'catalog' );
	
	
	
	$arSort = Array(
		'STORE_ID' => 'ASC'
	);
	$arFilter = Array(
		'PRODUCT_ID' => $arParams['ID']
	);
	
	
	switch ( $arParams['CITY_NAME'] )
	{
		case 'Санкт-Петербург':
			$arFilter['STORE_ID'] = 3;
			break;
			
		case 'Москва':
			$arFilter['STORE_ID'] = 4;
			break;
			
		case 'Краснодар':
			$arFilter['STORE_ID'] = 6;
			break;
	}
	
	
	
	$arSelect = Array(
		'STORE_NAME',
		'AMOUNT'
	);
	$dbStoresAmount = CCatalogStoreProduct::GetList( $arSort, $arFilter, false, false, $arSelect );
	while ( $arStoreAmount = $dbStoresAmount->Fetch() )
	{
		$arResult['STORES'][] = Array(
			'NAME' => $arStoreAmount['STORE_NAME'],
			'AMOUNT' => $arStoreAmount['AMOUNT'],
		);
	}
	
	
	
	$this->EndResultCache();
}



$this->IncludeComponentTemplate();