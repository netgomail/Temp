<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->SetTitle(GetMessage('BBS_SEARCH_PAGE_TITLE'));
$APPLICATION->SetPageProperty("title", GetMessage('BBS_SEARCH_PAGE_TITLE'));

$sort = $_REQUEST['by']?$_REQUEST['by']:'rank'; $sort = ($sort == 'rank')?$sort:'date';

$APPLICATION->IncludeComponent("bitrix:search.page", ".default", array(
	"RESTART" => "Y",
	"NO_WORD_LOGIC" => "N",
	"CHECK_DATES" => "N",
	"USE_TITLE_RANK" => "N",
	"DEFAULT_SORT" => "rank",
	"FILTER_NAME" => "",
	"arrFILTER" => array(
		0 => "iblock_".$arParams['IBLOCK_TYPE'],
	),
	"SHOW_WHERE" => "N",
	"SHOW_WHEN" => "N",
	"PAGE_RESULT_COUNT" => "20",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "N",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_FILTER" => $arParams["CACHE_FILTER"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
	"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
	"PAGER_TITLE" => $arParams["PAGER_TITLE"],
	"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
	"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
	"USE_LANGUAGE_GUESS" => "Y",
	"USE_SUGGEST" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	
	//sef: 
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	"STATUS_ID" => $arResult['STATUS']['ITEMS']['F']['ID'],
	),
	$component
);?>