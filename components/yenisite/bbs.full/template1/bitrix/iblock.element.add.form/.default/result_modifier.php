<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 

// echo "<pre style='text-align:left;'>";print_r($_REQUEST);echo "</pre>";
// echo "<pre style='text-align:left;'>";print_r($arResult);echo "</pre>";

// get & edit iblock sections list
$rsIBlockSectionList = CIBlockSection::GetList(
	array("left_margin"=>"asc"),
	array(
		"ACTIVE"=>"Y",
		"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
	),
	false,
	array("ID", "NAME", "DEPTH_LEVEL")
);
$arResult["SECTION_LIST"] = array();
$prevElem = 0;
$row = 0;
$rowCount = $rsIBlockSectionList->SelectedRowsCount();

while ($arSection = $rsIBlockSectionList->GetNext())
{
	if($arSection["DEPTH_LEVEL"] <= $prevElem["DEPTH_LEVEL"])
	{
		$strName = ($sectionName) ? $sectionName.'/'.$prevElem["NAME"] : $prevElem["NAME"];
		$arResult["SECTION_LIST"][$prevElem["ID"]] = array(
			"VALUE" => $strName
		);
		
		if($arSection["DEPTH_LEVEL"] < $prevElem["DEPTH_LEVEL"])
		{
			$arParentSections = explode('/',$sectionName);
			array_splice($arParentSections, $arSection["DEPTH_LEVEL"] - $prevElem["DEPTH_LEVEL"]);
			$sectionName = implode('/',$arParentSections);
		}
	}
	elseif($prevElem)
	{
		if($sectionName)
		{
			$sectionName .= '/';
		}
		$sectionName .= $prevElem["NAME"];
	}
	$bLast = ++$row == $rowCount;
	if($bLast)
	{
		$arResult["SECTION_LIST"][$arSection["ID"]] = array(
			"VALUE" => $sectionName.$arSection["NAME"]
		);
	}
	$prevElem = $arSection;
}
$arResult["PROPERTY_LIST_FULL"]['IBLOCK_SECTION']['ENUM'] = $arResult["SECTION_LIST"];


if(intval($arResult['ELEMENT']['ID']) > 0)
{
	$resElementDB = CIBlockElement::GetByID($arResult['ELEMENT']['ID']);
	$resElementDB->SetUrlTemplates($arParams["DETAIL_URL"], $arParams["SECTION_URL"]);
	$arElementDB = $resElementDB->GetNext();
	$arResult['ELEMENT']['DETAIL_PAGE_URL'] = $arElementDB['DETAIL_PAGE_URL'];
}
if(isset($_REQUEST['PROPERTY']['IBLOCK_SECTION']) && intval($_REQUEST['PROPERTY']['IBLOCK_SECTION']))
{
	$ibSection = intval($_REQUEST['PROPERTY']['IBLOCK_SECTION']);
	$arResult["PROPERTY_LIST_FULL"]['IBLOCK_SECTION']["ENUM"][$ibSection]['DEF'] = 'Y';
}
else
{
	$ibSection = 0;
}	

$arSectionProps = CIBlockSectionPropertyLink::GetArray($arParams['IBLOCK_ID'], $ibSection);




foreach($arResult["PROPERTY_LIST"] as $k => $propertyID)
{
	// skip iblock fields
	if(intval($propertyID) <= 0) continue;
	
	if(!array_key_exists($propertyID, $arSectionProps))
	{
		unset($arResult["PROPERTY_LIST"][$k]);
	}
}
	
