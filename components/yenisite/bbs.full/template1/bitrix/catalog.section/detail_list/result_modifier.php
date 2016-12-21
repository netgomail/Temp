<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
 //echo "<pre>";print_r($arResult);echo "</pre>";
foreach($arResult['ITEMS'] as &$item)
{
	$nav = CIBlockSection::GetNavChain(IntVal($item['IBLOCK_ID']), IntVal($item['~IBLOCK_SECTION_ID']));
	$nav->SetUrlTemplates("", $arParams["SECTION_URL"]);
	$item['CATEGORY_CHAIN'] = "";
	while ($arNav=$nav->GetNext()):
		 
		if(!empty($item['CATEGORY_CHAIN']))
			$item['CATEGORY_CHAIN'].= ' &#8594; ';
		$arNav['LINK'] = $arNav['SECTION_PAGE_URL'];
		$item['CATEGORY_CHAIN'] .= '<a href="'.$arNav['LINK'].'">'.$arNav['NAME'].'</a>';
	  
	endwhile;
	
	$picture = CYSBbs::getElementPicture($item);
		if (CModule::IncludeModule('yenisite.resizer2')) {
			$path = CFile::GetPath($picture);
			$item['PICTURE'] = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['LIST_IMG']);
		}
		else
		{
			$path = CFile::ResizeImageGet($picture, array('width'=>200, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, false);
			$item['PICTURE'] = $path['src'];
		}
		
	$item['DATE_CREATE_DATE'] = date('d-m Y', strtotime($item['DATE_CREATE']));
	$item['DATE_CREATE_TIME'] = date('G:i', strtotime($item['DATE_CREATE']));
}

?>