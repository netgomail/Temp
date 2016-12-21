<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//echo '<pre>'; print_r($arResult); echo '</pre>';

// set $arCurSection
include 'include/get_cur_section.php';
 ?>
<div class="blc_heading">
	<div class="item_navi">
		<div class="heading Breadcrumbs">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(),	false );?>
		</div>
	</div>
</div>
<section class="blc_toolbar clearfix">
	
	<?
	$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "section", Array(
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],	//  
		"CACHE_TIME" => $arParams['CACHE_TIME'],	//   (.)
		"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"TOP_DEPTH" => '1',
		"SECTION_ID" => $arCurSection['ID'],
		
		//sef: 
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	),
	$component
);?>
</section><!-- /blc_toolbar -->



<div class="heading"><h1><?=$APPLICATION->ShowTitle(false);?><!--<span class="indexTop">32</span>--></h1></div>

<?
$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "bbs-horizontal", array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"SECTION_ID" => $arCurSection['ID'],
	"FILTER_NAME" => $arParams["FILTER_NAME"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_FILTER" => $arParams["CACHE_FILTER"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	//"CACHE_GROUPS" => "Y",
	"SAVE_IN_SESSION" => "N",
	"GEO_PROP" => $arParams["GEO_PROP"],
	"INSTANT_RELOAD" => "Y",
	),
	$component
);?>
<?
// view
if (!empty($_REQUEST["view"])) {
	// If params is exist ( view?clear_cache=Y )
	if (strpos($_REQUEST["view"], '?') !== false) {
		$tmp = explode('?', $_REQUEST["view"]);
		$_REQUEST["view"] = $tmp[0];
	}

	if (in_array($_REQUEST["view"], array("block", "list", "table"))) {
		$view = htmlspecialchars($_REQUEST["view"]);
		$APPLICATION->set_cookie("view", $view);
	} else {
		define("ERROR_404", "Y");
	}
} else {
	$view = $APPLICATION->get_cookie("view") ? $APPLICATION->get_cookie("view") : $arParams["DEFAULT_VIEW"];
}
if(!in_array($view , array('block','list','table')))
	$view = 'block';

// pages
foreach ($_REQUEST as $k => $v) {
	if (strpos($k, 'PAGEN_') === 0) {
		if ($_REQUEST[$k] > 0) {
			$pagen_key = $k;

			if (strpos($_REQUEST[$k], '?') !== false) {
				$tmp = explode('?', $_REQUEST[$k]);
				$pagen = htmlspecialchars($tmp[0]);
			} else {
				$pagen = htmlspecialchars($_REQUEST[$k]);
			}

			$APPLICATION->set_cookie($k, $pagen);
		}
	}
}
// sort
$order = $_REQUEST['order'] ? htmlspecialchars($_REQUEST['order']) : $APPLICATION->get_cookie("order");
$by = $_REQUEST['by'] ? htmlspecialchars($_REQUEST['by']) : $APPLICATION->get_cookie("by");
// If params is exist ( asc?clear_cache=Y )
if (strpos($by, '?') !== false) {
	$tmp = explode('?', $by);
	$by = $tmp[0];

	// Need PHP 5.4
	// $by = explode('?', $by)[0];
}
if (!$order) {$order = $arParams["DEFAULT_ELEMENT_SORT_BY"] ? $arParams["DEFAULT_ELEMENT_SORT_BY"] : 'CREATED_DATE';}
if (!$by) {$by = $arParams["DEFAULT_ELEMENT_SORT_ORDER"] ? $arParams["DEFAULT_ELEMENT_SORT_ORDER"] : 'DESC';}

$by_for_btn = ($by=='DESC') ? 'ASC' : 'DESC';
?>
<div class="wdt_filter">
<form name="sort_form">
	<?if (!empty($_REQUEST["set_filter"])):?>
		<?foreach ($_REQUEST as $k => $v):?>
			<?if (strpos($k, $arParams["FILTER_NAME"]) !== false):?>
				<input type='hidden' value='<?=$v?>' name='<?=$k?>' />
			<?endif;?>
		<?endforeach;?>
	<?endif?>
	<?$arFilterParams = array('del_filter', 'set_filter');?>
	<?foreach ($arFilterParams as $filter_param):?>
		<?if(isset ($_GET[$filter_param])):?>
			<input type='hidden' value='<?=htmlspecialchars($_GET[$filter_param]);?>' name='<?=$filter_param;?>' />
		<?endif;?>
	<?endforeach;?>
	<?if(!empty($order)):?>	<input id='order_field' type='hidden' value='<?=$order?>' name='order' /><?endif;?>
	<?if(!empty($by)):?><input id='by_field' type='hidden' value='<?=$by?>' name='by' /> <?endif;?>
	<?if(!empty($view)):?><input id='view_field' type='hidden' value='<?=$view?>' name='view' /> <?endif;?>
	<?if($pagen>0):?> <input id='PAGEN_field' type='hidden' value='<?=$pagen?>' name='<?=$pagen_key?>' /><?endif;?>
	
	
		<div class="row-fluid">
			<div class="left">
				<span><?=GetMessage('SORT');?>:</span>
				<button onclick="setSortFields('CREATED_DATE', '<?=$by_for_btn?>'); return false;" class="button <?=($order=='CREATED_DATE')?"b-request":"b-gray";?> sorting"><?=GetMessage('PO_DATE');?> <i class="sym"><?=($by=='DESC')?"&#0123;":"&#0125;";?></i></button>
				<button onclick="setSortFields('<?=$arParams['LIST_PRICE_SORT'];?>', '<?=$by_for_btn?>'); return false;" class="button <?=($order==$arParams['LIST_PRICE_SORT'])?"b-request":"b-gray";?> sorting"><?=GetMessage('PO_PRICE');?> <i class="sym"><?=($by=='DESC')?"&#0123;":"&#0125;";?></i></button>
			</div>
			<div class="right">
				<span><?=GetMessage('VIEW');?>:</span>
				<button class="button <?=($view=='block')?"b-request":"b-gray";?> square" onclick="setViewField('block');"><i class="sym">&#0065;</i></button>
				<button class="button <?=($view=='list')?"b-request":"b-gray";?> square" onclick="setViewField('list');"><i class="sym">&#0066;</i></button>
				<button class="button <?=($view=='table')?"b-request":"b-gray";?> square" onclick="setViewField('table');"><i class="sym">&#0067;</i></button>
			</div>
		</div>
	
</form>	
</div><!-- /wdt_filter -->

<?
/* RESIZER 2 */
$arSets = array();
$arSets['BLOCK_IMG'] = $arParams['BLOCK_IMG'];
$arSets['LIST_IMG'] = $arParams['LIST_IMG'];
$arSets['TABLE_IMG'] = $arParams['TABLE_IMG'];

/* TOP BLOCK */
global ${$arParams["FILTER_NAME"]};
if (CModule::IncludeModule('sale') && CModule::IncludeModule('yenisite.bbs')):
	${$arParams["FILTER_NAME"]}['PROPERTY_TOP_VALUE'] = 'Y';
	?>

	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		$view,
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arCurSection['ID'],
			"SHOW_ALL_WO_SECTION" => "Y",
			"RESIZER_SETS" => $arSets,
			"ELEMENT_SORT_FIELD" => $order,
			"ELEMENT_SORT_ORDER" => $by,
			"PROPERTY_CODE" =>$arParams["LIST_PROPERTY_CODE"],
			"BANNER_TYPE" =>$arParams["BANNER_TYPE_SECTION"],
			"BROWSER_TITLE" => "BROWSER_TITLE",
			"VARIABLES" => $arResult["VARIABLES"],
			"INCLUDE_SUBSECTIONS" => "Y",
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			//sef: 
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			// "BY_LINK" => "Y",
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"TOP_BLOCK" => "Y"
		),
		$component
	);
	?>

	<?
	/* MAIN COMPONENT */
	unset(${$arParams["FILTER_NAME"]}['PROPERTY_TOP_VALUE']);
	${$arParams["FILTER_NAME"]}['!PROPERTY_TOP_VALUE'] = 'Y';
endif;
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	$view,
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arCurSection['ID'],
		"SHOW_ALL_WO_SECTION" => "Y",
		"RESIZER_SETS" => $arSets,
		"ELEMENT_SORT_FIELD" => $order,
		"ELEMENT_SORT_ORDER" => $by,
		"PROPERTY_CODE" =>$arParams["LIST_PROPERTY_CODE"],
		"BANNER_TYPE" =>$arParams["BANNER_TYPE_SECTION"],

		"BROWSER_TITLE" => "BROWSER_TITLE",
		"VARIABLES" => $arResult["VARIABLES"],
		"INCLUDE_SUBSECTIONS" => "Y",

		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		//sef: 
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

	),
	$component
);
?>
<div class="section-description">
	<?=$arCurSection['DESCRIPTION']?>
</div>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>