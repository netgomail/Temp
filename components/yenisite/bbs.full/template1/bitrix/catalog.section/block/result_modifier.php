<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
$arServiceProp = array('PRICE', 'ADDRESS', 'CURRENCY', 'URGENT', 'HIGHLIGHT');
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
			$item['PICTURE'] = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['BLOCK_IMG']);
		}
		else
		{
			$path = CFile::ResizeImageGet($picture, array('width'=>200, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, false);
			$item['PICTURE'] = $path['src'];
		}
		
	/* DISPLAY_PROPERTIES */
	foreach($arServiceProp as $propCode)
	{
		if(isset($item['DISPLAY_PROPERTIES'][$propCode]))
			unset($item['DISPLAY_PROPERTIES'][$propCode]);
	}
}
 if($arParams['VARIABLES']['USER_ID']) {
	 
	 $arUser = CUser::GetByID($arParams['VARIABLES']['USER_ID'])->Fetch();
	 $arResult[$arParams['BROWSER_TITLE']] = GetMessage('ADS_FROM')."- {$arUser['NAME']} {$arUser['LAST_NAME']}";
 }
 // elseif($arParams['VARIABLES']['SECTION_ID'])
	// $arResult[$arParams['BROWSER_TITLE']] = $arResult['NAME'];

$obRes = CIBlockElement::GetList(array('sort'=>'asc'), array('IBLOCK_CODE' => 'bbsoptions', 'CODE' => 'ad-opt-urgent'));
if ($arRes = $obRes->Fetch()) {
	$arResult['URGENT_PICTURE'] = CFile::GetPath($arRes['DETAIL_PICTURE']);
}
?>