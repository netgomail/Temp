<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
 //echo "<pre>";print_r($arResult);echo "</pre>";
foreach($arResult['ITEMS'] as &$item)
{
	foreach($item['PRICES'] as $price)
	{
		if($price['VALUE']<$item['PRICE']['VALUE'] || empty($item['PRICE']['VALUE']))
		{
			$item['PRICE']['VALUE'] = $price['VALUE'];
			$item['PRICE']['PRINT_VALUE'] = $price['PRINT_VALUE'];
		}
	}
}

?>