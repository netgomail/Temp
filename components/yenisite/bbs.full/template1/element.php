<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (isset($arResult["VARIABLES"]["ELEMENT_ID"])) $open = CYSBbsInit::checkOpenPage($arResult["VARIABLES"]["ELEMENT_ID"],$arParams['IBLOCK_ID'],$arParams['STATUS_ADD']);?>
<section class="blc_wrap clearfix">
<?
/* RESIZER 2 */
$arSets = array();
$arSets['DETAIL_ICON_IMG'] = $arParams['DETAIL_ICON_IMG'];
$arSets['DETAIL_SMALL_IMG'] = $arParams['DETAIL_SMALL_IMG'];
$arSets['DETAIL_BIG_IMG'] = $arParams['DETAIL_BIG_IMG'];
$arSets['LIST_IMG'] = $arParams['LIST_IMG'];
//$arSets['DETAIL_BIG_IMG'] = $arParams['DETAIL_BIG_IMG'];
?>

<?ob_start();//buffer ends in ./bitrix/catalog.element/.default/component_epilog.php?>
<?$ElementID=$APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"",
	Array(
 		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
 		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
 		"PROPERTY_CODE" => $arParams['DETAIL_PROPERTY_CODE'],
		"BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
 		
 		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
 		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
 		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
 		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		//sef: 
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"PATH_TO_USER_ADS" => $arResult['PATH_TO_USER_ADS'],
		"PATH_TO_EDIT_AD" => $arResult['PATH_TO_EDIT_AD'],
		"BANNER_TYPE_DETAIL" => $arParams['BANNER_TYPE_DETAIL'],
		//resizer :
		"RESIZER_SETS" => $arSets,
		
		//comments:
		"USE_COMMENTS" => $arParams['DETAIL_USE_COMMENTS'],
		"BLOG_USE" => $arParams['DETAIL_BLOG_USE'],
		"BLOG_URL" => $arParams['DETAIL_BLOG_URL'],
		"BLOG_EMAIL_NOTIFY" => $arParams['DETAIL_BLOG_EMAIL_NOTIFY'],
		"FB_USE" => $arParams['DETAIL_FB_USE'],
		"FB_APP_ID" => $arParams['DETAIL_FB_APP_ID'],
		"VK_USE" => $arParams['DETAIL_VK_USE'],
		"VK_API_ID" => $arParams['DETAIL_VK_API_ID'],
		'SHOW_AD' => $open,
		
	),
	$component
);?>
</section><!--/blc_wrap -->

<?// echo "<pre>";	print_r($arResult);	echo "</pre>";?>