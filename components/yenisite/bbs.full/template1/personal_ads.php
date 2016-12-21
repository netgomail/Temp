<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
if(!CModule::IncludeModule("iblock"))
	return;

if($_POST['delete'] == 'Y')
{
	foreach($_POST as $key=>$value)
	{
		
		if(intval(strpos($key, 'element_')) == 0)
		{
			CIBlockElement::Delete($value);
		}
	}
}
?>

<?global $USER_ADS_FILTER ;
$USER_ADS_FILTER = array("CREATED_BY" => $USER->GetID());
?>
<?
/* RESIZER 2 */
$arSets = array();
$arSets['LIST_IMG'] = $arParams['LIST_IMG'];
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "personal_list", array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"SECTION_ID" => "",
	"SHOW_ALL_WO_SECTION" => "Y",
	"RESIZER_SETS" => $arSets,
	"ELEMENT_SORT_FIELD" => 'CREATED_DATE',
	"ELEMENT_SORT_ORDER" => 'DESC',
	"ELEMENT_SORT_FIELD2" => "id",
	"ELEMENT_SORT_ORDER2" => "desc",
	"FILTER_NAME" => "USER_ADS_FILTER",
	"BROWSER_TITLE" => "BROWSER_TITLE",
	"VARIABLES" => $arResult["VARIABLES"],
	"INCLUDE_SUBSECTIONS" => "Y",
	
	"HIDE_NOT_AVAILABLE" => "N",
	"PAGE_ELEMENT_COUNT" => "20",
	"LINE_ELEMENT_COUNT" => "3",
	"PROPERTY_CODE" =>$arParams["LIST_PROPERTY_CODE"],
	// "OFFERS_LIMIT" => "0",
	// "SECTION_URL" => "",
	// "DETAIL_URL" => "",
	// "BASKET_URL" => "/personal/basket.php",
	// "ACTION_VARIABLE" => "action",
	// "PRODUCT_ID_VARIABLE" => "id",
	// "PRODUCT_QUANTITY_VARIABLE" => "quantity",
	// "PRODUCT_PROPS_VARIABLE" => "prop",
	// "SECTION_ID_VARIABLE" => "SECTION_ID",
	// "AJAX_MODE" => "N",
	// "AJAX_OPTION_JUMP" => "N",
	// "AJAX_OPTION_STYLE" => "Y",
	// "AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_FILTER" => $arParams["CACHE_FILTER"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	//"META_KEYWORDS" => "-",
	//"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	//"ADD_SECTIONS_CHAIN" => "N",
	//"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "N",
	// "PRICE_CODE" => array(
	// ),
	// "USE_PRICE_COUNT" => "N",
	// "SHOW_PRICE_COUNT" => "1",
	// "PRICE_VAT_INCLUDE" => "Y",
	// "PRODUCT_PROPERTIES" => array(
	// ),
	// "USE_PRODUCT_QUANTITY" => "N",
	// "CONVERT_CURRENCY" => "N",
	
	"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
	"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
	"PAGER_TITLE" => $arParams["PAGER_TITLE"],
	"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
	"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
	"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
	"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
	"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
	//"AJAX_OPTION_ADDITIONAL" => "",
	
	//sef: 
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	"PATH_TO_EDIT_AD" => $arResult['PATH_TO_EDIT_AD'],
	),
	$component
);
?>
<?//echo '<pre>'; print_r($arResult); echo '</pre>'; ?>

<?//open in personal_header?>
	</div><!-- /tabs -->
</section><!-- /blc_cabinet -->