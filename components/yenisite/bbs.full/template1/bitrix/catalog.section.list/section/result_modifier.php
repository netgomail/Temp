<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
if (!empty($arResult['SECTIONS'])): 
	$column = 1;
	foreach($arResult['SECTIONS'] as $key => &$arItem): 
		$arResult['COLUMN_'.$column][] = $arItem;
		$column++;
		if($column>4)
			$column = 1;
	endforeach; 

endif; 
//
?>