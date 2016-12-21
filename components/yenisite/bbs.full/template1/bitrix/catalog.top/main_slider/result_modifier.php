<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?

foreach($arResult['ITEMS'] as &$item)
{
	$nav = CIBlockSection::GetNavChain(IntVal($item['IBLOCK_ID']), IntVal($item['IBLOCK_SECTION_ID']));
	$item['CATEGORY_CHAIN'] = "";
	$nav->SetUrlTemplates("", $arParams["SECTION_URL"]);
	while ($arNav=$nav->GetNext()):
		if(!empty($item['CATEGORY_CHAIN']))
			$item['CATEGORY_CHAIN'].= ' &#8594; ';
			
		$arNav['LINK'] = $arNav['SECTION_PAGE_URL'];
		$item['CATEGORY_CHAIN'] .= '<a href="'.$arNav['LINK'].'">'.$arNav['NAME'].'</a>';
	  
	endwhile;
	
	$res = CIBlockElement::GetByID($item["ID"])->GetNext();
	$item['DETAIL_PICTURE'] = $res['DETAIL_PICTURE'];
  
	$picture = CYSBbs::getElementPicture($item);
		if (CModule::IncludeModule('yenisite.resizer2')) {
			$path = CFile::GetPath($picture);
			$item['PICTURE'] = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SET']);
		}
		else
		{
			$path = CFile::ResizeImageGet($picture, array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, false);
			$item['PICTURE'] = $path['src'];
		}
}

?>