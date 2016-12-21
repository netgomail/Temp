<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?
foreach($arResult['SEARCH'] as $k=>&$item)
{
	
	$item['ITEM_ID'] = str_replace("S","",strtoupper($item['ITEM_ID']),$count);
	if($count > 0)
	{
		
	}
	else
	{
		$ar_props = CIBlockElement::GetProperty($item['PARAM2'], $item['ITEM_ID'], array("sort" => "asc"), Array("CODE"=>"STATUS"))->Fetch();
		if($ar_props['VALUE']!=$arParams['STATUS_ID'])
			unset($arResult['SEARCH'][$k]);
	}

}
?>