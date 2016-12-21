<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['ITEMS'] as $key => $arItem)
{
	// delete GEO_PROP from filter
	if($arItem['CODE'] == $arParams['GEO_PROP'])
	{
		unset($arResult['ITEMS'][$key]);
		break;
	}
}