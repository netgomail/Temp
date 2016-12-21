<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if(empty($_REQUEST['CODE'])) $_REQUEST['CODE'] = (!empty($arResult['VARIABLES']['AD_ID']))? $arResult['VARIABLES']['AD_ID']:'';?>

<?
$title = GetMessage("BBS_EDIT_AD").$_REQUEST['CODE'];
$APPLICATION->SetPageProperty("title", $title);
$APPLICATION->SetTitle($title);
?>



<?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", ".default", array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"ELEMENT_ID" => Intval($_REQUEST['CODE']),
	"USE_CAPTCHA" => "N",
	"DEFAULT_INPUT_SIZE" => "30",
	"PROPERTY_CODES" => $arParams['EDIT_PROPERTY_CODE'],
	"PROPERTY_CODES_REQUIRED" => $arParams['EDIT_PROPERTY_CODE_REQUIRED'],
	"CACHE_TYPE" => $arParams['CACHE_TYPE'],
	"CACHE_TIME" => $arParams['CACHE_TIME'],
	"CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
	"CACHE_FILTER" => $arParams['CACHE_FILTER'],
	"GROUPS" => array(1,2),
	"STATUS_NEW" => 'N',
	"STATUS" => 'ANY',
	"ELEMENT_ASSOC" => "CREATED_BY",
	"LEVEL_LAST" => "Y",
	"MAX_FILE_SIZE" => "0",
	"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
	"DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
	"SEF_MODE" => "N",
	//sef: 
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	"RULES_PAGE_URL" => $arParams["RULES_PAGE_URL"],
	),
	$component
);?>



<?// echo "<pre>";	print_r($arResult);	echo "</pre>";?>