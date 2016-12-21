<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section class="blc_intro clearfix"> 	 
  <div class="row-fluid"> 		 
    <div class="span9"> 
	<h1><?$APPLICATION->ShowTitle(false);?></h1>
	<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main", Array(
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],	//  
		"CACHE_TIME" => $arParams['CACHE_TIME'],	//   (.)
		"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"SECTION_USER_FIELDS" => array( 'UF_SECTION_TYPE'),
		
		//sef: 
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	),
	$component
);?>
	
    </div>
   			 		 
    <div class="span3"> 			 			 
		<div class="wdt_ads">
			<?if(CModule::IncludeModule("advertising")):?>
				<?$APPLICATION->IncludeComponent("bitrix:advertising.banner", ".default", array(
					"TYPE" => $arParams['BANNER_TYPE_MAIN_RIGHT'],
					"NOINDEX" => "Y",
					"CACHE_TYPE" => $arParams['CACHE_TYPE'],
					"CACHE_TIME" => $arParams['CACHE_TIME'],
					),
					false
				);?>
			<?endif;?>
		</div>
    </div>
  </div>
</section> 
<section class="blc_recentads clearfix">
<?$APPLICATION->IncludeComponent("bitrix:catalog.top", "main_slider", array(
	"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
	"IBLOCK_ID" => $arParams['IBLOCK_ID'],
	"FILTER_NAME" => $arParams["FILTER_NAME"],
	"ELEMENT_SORT_FIELD" => "CREATED_DATE",
	"ELEMENT_SORT_ORDER" => "desc",
	"ELEMENT_COUNT" => $arParams['ELEMENT_COUNT'],
	"LINE_ELEMENT_COUNT" => "3",
	"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
	"OFFERS_LIMIT" => "5",
	//sef: 
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"CACHE_TYPE" => $arParams['CACHE_TYPE'],
	"CACHE_TIME" => $arParams['CACHE_TIME'],
	"CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
	"CACHE_FILTER" => $arParams['CACHE_FILTER'],
	"DISPLAY_COMPARE" => "N",
	"PRICE_CODE" => array(
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
		0 => "DETAIL_PICTURE",
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"CONVERT_CURRENCY" => "N",
	
	"RESIZER_SET" => $arParams['SLIDER_IMG'],
	),
	$component
);?>
</section> 

