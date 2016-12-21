<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arServiceProp = array('PRICE', 'ADDRESS', 'CURRENCY', 'PHONE');

if (empty($arParams['RESIZER_SETS']['DETAIL_BIG_IMG'])) $arParams['DETAIL_BIG_IMG'] = 5;

/* DISPLAY_PROPERTIES */
foreach($arServiceProp as $propCode)
{
	if(isset($arResult['DISPLAY_PROPERTIES'][$propCode]))
		unset($arResult['DISPLAY_PROPERTIES'][$propCode]);
}
	
$arResult['ELEMENT_CHAIN'] = "";
	foreach ($arResult['SECTION']['PATH'] as $section):
		 
		if(!empty($arResult['ELEMENT_CHAIN']))
			$arResult['ELEMENT_CHAIN'].= ' &#8594; ';
		$section['LINK'] = $section['SECTION_PAGE_URL'];
		$arResult['ELEMENT_CHAIN'] .= '<a href="'.$section['LINK'].'">'.$section['NAME'].'</a>';
	endforeach;
	$arResult['ELEMENT_CHAIN'] .= ' &#8594; '.$arResult['NAME'];
	
	$arResult['PATH_TO_PARENT_SECTION'] = $arResult['SECTION']['SECTION_PAGE_URL'];
	
	$arResult['PATH_TO_EDIT_AD'] = str_replace('#AD_ID#', $arResult['ID'], $arParams['PATH_TO_EDIT_AD']);
	
	$arSelect = Array("ID", "DETAIL_PAGE_URL");
	$arFilter = Array(
		"IBLOCK_ID"=>IntVal($arResult['IBLOCK_ID']), 
		"SECTION_ID"=>IntVal($arResult['SECTION']['ID']), 
		"ACTIVE_DATE"=>"Y", 
		"ACTIVE"=>"Y"
	);
	global ${$arParams["FILTER_NAME"]};
	$arFilter = array_merge(${$arParams["FILTER_NAME"]} , $arFilter);
	$res = CIBlockElement::GetList(Array('id'=>'desc'), $arFilter, false, Array("nPageSize"=>1, 'nElementID'=>$arResult['ID']), $arSelect);
	$res->SetUrlTemplates($arParams["DETAIL_URL"]);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		if($arFields['ID']==$arResult['ID'])
			continue;
		if($arFields['ID']>$arResult['ID'])
		{
			$arResult['ELEMENT_NEXT']['ID'] = $arFields['ID'];
			$arResult['ELEMENT_NEXT']['LINK'] = $arFields['DETAIL_PAGE_URL'];
			continue;
		}
		if($arFields['ID']<$arResult['ID'])
		{
			$arResult['ELEMENT_PREV']['ID'] = $arFields['ID'];
			$arResult['ELEMENT_PREV']['LINK'] = $arFields['DETAIL_PAGE_URL'];
			continue;
		}
	}
	$res = CIBlockElement::GetByID($arResult["ID"])->GetNext();
	$arResult['SHOW_COUNTER'] = $res['SHOW_COUNTER'];
	
	
	
	$arResult['DATE_CREATE_DATE'] = date('d-m-Y', strtotime($arResult['DATE_CREATE']));
	$arResult['DATE_CREATE_TIME'] = date('G:i', strtotime($arResult['DATE_CREATE']));
	
	
	// USER:
	$arResult['USER'] = CUser::GetByID($arResult['CREATED_BY'])->Fetch();
	$arResult['USER']['DATE_REGISTER_DISPLAY'] = date('d/m/Y', strtotime($arResult['USER']['DATE_REGISTER']));
	$arResult['USER']['LINK_TO_USER_ADS'] = str_replace('#USER_ID#', $arResult['CREATED_BY'], $arParams['PATH_TO_USER_ADS']);
	
	
	// PICTURES:
	$arResult['PICTURES'] = array();
	
	if (CModule::IncludeModule('yenisite.resizer2')) {
		if(is_array($arResult['DETAIL_PICTURE']))
		{
			$path = CFile::GetPath($arResult['DETAIL_PICTURE']['ID']);
			$path_icon = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['DETAIL_ICON_IMG']);
			$path_medium = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['DETAIL_SMALL_IMG']);
			$path_big = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['DETAIL_BIG_IMG']);
						
			$arResult['PICTURES'][] = array(
				'ID'=>$arResult['DETAIL_PICTURE']['ID'],
				'DESCRIPTION'=>$arResult['DETAIL_PICTURE']['DESCRIPTION'],
				'SRC_ICON'=>$path_icon, 
				'SRC_MEDIUM'=>$path_medium,
				'SRC_BIG'=>$path_big,
			);
		}
		elseif(is_array($arResult['PREVIEW_PICTURE']))
		{
			$path = CFile::GetPath($arResult['PREVIEW_PICTURE']['ID']);
			$path_icon = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['DETAIL_ICON_IMG']);
			$path_medium = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['DETAIL_SMALL_IMG']);
			$path_big = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['DETAIL_BIG_IMG']);

			$arResult['PICTURES'][] = array(
				'ID'=>$arResult['PREVIEW_PICTURE']['ID'],
				'DESCRIPTION'=>$arResult['PREVIEW_PICTURE']['DESCRIPTION'],
				'SRC_ICON'=>$path_icon, 
				'SRC_MEDIUM'=>$path_medium,
				'SRC_BIG'=>$path_big,
			);
		}	
		foreach($arResult['MORE_PHOTO'] as $picture)
		{
			$path = CFile::GetPath($picture['ID']);
			$path_icon = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['DETAIL_ICON_IMG']);
			$path_medium = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['DETAIL_SMALL_IMG']);
			$path_big = CResizer2Resize::ResizeGD2($path, $arParams['RESIZER_SETS']['DETAIL_BIG_IMG']);

			$arResult['PICTURES'][] = array(
				'ID'=>$picture['ID'],
				'DESCRIPTION'=>$picture['DESCRIPTION'],
				'SRC_ICON'=>$path_icon, 
				'SRC_MEDIUM'=>$path_medium,
				'SRC_BIG'=>$path_big,
			);
		}
		if(count($arResult['PICTURES'])<1)
		{
			$arResult['PICTURES'][] = array(
				'SRC_ICON'=> CResizer2Resize::ResizeGD2('no_photo', $arParams['RESIZER_SETS']['DETAIL_ICON_IMG']), 
				'SRC_MEDIUM'=> CResizer2Resize::ResizeGD2('no_photo', $arParams['RESIZER_SETS']['DETAIL_SMALL_IMG']),
				'SRC_BIG'=> CResizer2Resize::ResizeGD2('no_photo', $arParams['RESIZER_SETS']['DETAIL_BIG_IMG']),
			);			
		}
		
		$arResult['USER']['AVIK'] = (IntVal($arResult['USER']['PERSONAL_PHOTO'])) ? CResizer2Resize::ResizeGD2(CFile::GetPath($arResult['USER']['PERSONAL_PHOTO']), $arParams['RESIZER_SETS']['DETAIL_ICON_IMG']) : CResizer2Resize::ResizeGD2($this->__component->__parent->__template->__folder.'/images/avik.gif', $arParams['RESIZER_SETS']['DETAIL_ICON_IMG']);
		
		
	}
	else
	{
		$icon = array('width'=>58 , 'height'=>58 );
		$medium = array('width'=>500 , 'height'=>500 );
		$big = array('width'=>1024 , 'height'=>768 );
		
		if(is_array($arResult['DETAIL_PICTURE']))
		{
			$path_icon = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>$icon['width'], 'height'=>$icon['height']), BX_RESIZE_IMAGE_PROPORTIONAL, false);
			$path_medium = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>$medium['width'], 'height'=>$medium['height']), BX_RESIZE_IMAGE_PROPORTIONAL, false);
			$path_big = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>$big['width'], 'height'=>$big['height']), BX_RESIZE_IMAGE_PROPORTIONAL, false);

			$arResult['PICTURES'][] = array(
				'ID'=>$arResult['DETAIL_PICTURE']['ID'],
				'DESCRIPTION'=>$arResult['DETAIL_PICTURE']['DESCRIPTION'],
				'SRC_ICON'=>$path_icon['src'], 
				'SRC_MEDIUM'=>$path_medium['src'],
				'SRC_BIG'=>$path_big['src'],
			);
			
			
		}
		elseif(is_array($arResult['PREVIEW_PICTURE']))
		{
			$path_icon = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], array('width'=>$icon['width'], 'height'=>$icon['height']), BX_RESIZE_IMAGE_PROPORTIONAL, false);
			$path_medium = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], array('width'=>$medium['width'], 'height'=>$medium['height']), BX_RESIZE_IMAGE_PROPORTIONAL, false);
			$path_big = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], array('width'=>$big['width'], 'height'=>$big['height']), BX_RESIZE_IMAGE_PROPORTIONAL, false);

			$arResult['PICTURES'][] = array(
				'ID'=>$arResult['PREVIEW_PICTURE']['ID'],
				'DESCRIPTION'=>$arResult['PREVIEW_PICTURE']['DESCRIPTION'],
				'SRC_ICON'=>$path_icon['src'], 
				'SRC_MEDIUM'=>$path_medium['src'], 
				'SRC_BIG'=>$path_big['src'],
			);
			
			
			
		}
		foreach($arResult['MORE_PHOTO'] as $picture)
		{
			$path_icon = CFile::ResizeImageGet($picture['ID'], array('width'=>$icon['width'], 'height'=>$icon['height']), BX_RESIZE_IMAGE_PROPORTIONAL, false);
			$path_medium = CFile::ResizeImageGet($picture['ID'], array('width'=>$medium['width'], 'height'=>$medium['height']), BX_RESIZE_IMAGE_PROPORTIONAL, false);
			$path_big = CFile::ResizeImageGet($picture['ID'], array('width'=>$big['width'], 'height'=>$big['height']), BX_RESIZE_IMAGE_PROPORTIONAL, false);

			$arResult['PICTURES'][] = array(
				'ID'=>$picture['ID'],
				'DESCRIPTION'=>$picture['DESCRIPTION'],
				'SRC_ICON'=>$path_icon['src'], 
				'SRC_MEDIUM'=>$path_medium['src'], 
				'SRC_BIG'=>$path_big['src'],
			);
			
		}
	}
	
	$cp = $this->__component; // component object
	if (is_object($cp)) {
		$cp->SetResultCacheKeys(array('CREATED_BY'));
	}
	
//echo "<pre>";	print_r($this);	echo "</pre>";
?>
<?
$obRes = CIBlockElement::GetList(array('sort'=>'asc'), array('IBLOCK_CODE' => 'bbsoptions'));
$arOptions = array();
while ($arOption = $obRes->Fetch()) {
	$arOptions[$arOption['CODE']] = $arOption['ID'];
}
?>
<script type="text/javascript">
var bbs_options = <?=CUtil::PhpToJSObject($arOptions)?>;
</script>