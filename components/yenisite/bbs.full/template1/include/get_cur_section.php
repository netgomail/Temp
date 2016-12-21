<?
$arFilter = array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"ACTIVE" => "Y",
	"GLOBAL_ACTIVE" => "Y",
);
if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
{
	$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
}
elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
{
	$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
}

$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/bbs"))
{
	$arCurSection = $obCache->GetVars();
}
elseif ($obCache->StartDataCache())
{
	$arCurSection = array();
	if (\Bitrix\Main\Loader::includeModule("iblock"))
	{
		$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID", "DESCRIPTION"));
		if(defined("BX_COMP_MANAGED_CACHE"))
		{
			global $CACHE_MANAGER;
			$CACHE_MANAGER->StartTagCache("/iblock/bbs");

			if ($arCurSection = $dbRes->Fetch())
			{
				$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
			}
			$CACHE_MANAGER->EndTagCache();
		}
		else
		{
			if(!$arCurSection = $dbRes->Fetch())
				$arCurSection = array();
		}
	}
	$obCache->EndDataCache($arCurSection);
}