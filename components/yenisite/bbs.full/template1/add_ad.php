<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? //echo "<pre>";	print_r($_REQUEST);	echo "</pre>";?>
<?//if(!empty($_REQUEST['CODE'])) LocalRedirect(str_replace('#AD_ID#', IntVal($_REQUEST['CODE']), $arResult['PATH_TO_EDIT_AD']));?>
<?
if(!$USER->IsAuthorized() || (is_array($arParams['GROUPS_ADD']) && !empty($arParams['GROUPS_ADD']) && count(array_intersect($USER->GetUserGroupArray(), $arParams["GROUPS_ADD"])) <= 0 && !$USER->IsAdmin()))
	{
		$APPLICATION->AuthForm(GetMessage("BBS_NEW_AD_TITLE_DENIED"));
		return;
	}
?>
<?if($arParams['PAID_ADS']=='Y'):?>
<div class="pathway">
	<ul>
		<li <?if(empty($_REQUEST['CODE'])):?>class="active"<?else:?>class="done"<?endif?>><span class="unit"><span class="ins"><?=GetMessage("BBS_NEW_AD")?></span></span></li>
		<li <?if(!empty($_REQUEST['CODE']) && is_numeric($_REQUEST['CODE'])):?>class="active"<?endif?>><span class="unit"><span class="ins"><?=GetMessage("BBS_SELECT_OPTIONS")?></span></span></li>
		<li><span class="unit"><span class="ins"><?=GetMessage("BBS_PAYMENT")?></span></span></li>
	</ul>
</div>
<?endif?>
<div class="heading"><h1><?$APPLICATION->ShowTitle();?></h1></div>

<?
$title = GetMessage("BBS_NEW_AD_TITLE");
$APPLICATION->SetPageProperty("title", $title);
$APPLICATION->SetTitle($title);

$bSale = (CModule::IncludeModule('yenisite.bbs') && CModule::IncludeModule('sale') && CModule::IncludeModule('catalog'));
?>

<?if(empty($_REQUEST['CODE'])):?>
<?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", ".default", array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"USE_CAPTCHA" => "N",
	"DEFAULT_INPUT_SIZE" => "30",
	"PROPERTY_CODES" => $arParams['EDIT_PROPERTY_CODE'],
	"PROPERTY_CODES_REQUIRED" => $arParams['EDIT_PROPERTY_CODE_REQUIRED'],
	"CACHE_TYPE" => $arParams['CACHE_TYPE'],
	"CACHE_TIME" => $arParams['CACHE_TIME'],
	"CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
	"CACHE_FILTER" => $arParams['CACHE_FILTER'],
	"GROUPS" => $arParams['GROUPS_ADD'],
	"STATUS_NEW" => 'N',
	"STATUS" => 'ANY',
	"ELEMENT_ASSOC" => "CREATED_BY",
	"LEVEL_LAST" => "Y",
	"MAX_FILE_SIZE" => "0",
	"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
	"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
	"SEF_MODE" => "N",
	//sef: 
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	"RULES_PAGE_URL" => $arParams["RULES_PAGE_URL"],
	),
	$component
);?>

<?else:?>
	<?if(!empty($_REQUEST['CODE']) && is_numeric($_REQUEST['CODE']) && $arParams['PAID_ADS']=='Y'):?>
		<?if(!CModule::IncludeModule("sale"))
			return;?>
		<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"tarif_list",
		Array(
			"IBLOCK_TYPE" => $arParams["TARIF_IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["TARIF_IBLOCK_ID"],
			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SHOW_ALL_WO_SECTION" => "Y",
			"PATH_TO_ORDER" => $arResult['PATH_TO_ORDER'],
			"RESIZER_SETS" => $arSets,
			"ELEMENT_SORT_FIELD" => $order,
			"ELEMENT_SORT_ORDER" => $by,
			"PROPERTY_CODE" =>$arParams["LIST_PROPERTY_CODE"],
			"BANNER_TYPE" =>$arParams["BANNER_TYPE_SECTION"],
			"BROWSER_TITLE" => "BROWSER_TITLE",
			"VARIABLES" => $arResult["VARIABLES"],
			"INCLUDE_SUBSECTIONS" => "Y",
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"PRICE_CODE" => $arParams["TARIF_PRICE_CODE"],
			
			"PAGE_ELEMENT_COUNT" => 20,
			
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
	<?else:?>
		<div class="blc_alert">
			<div class="row-fluid">
				<div class="span8 offset2">
					<div class="alert alert-success">
						<p><?if($arParams['MODERATION_ADS'] != 'N'):?>
								<?=GetMessage('BBS_ADD_ON_MODERATION');?>
							<?else:?><?=GetMessage('BBS_SUCCESS_ADD');?><?endif?></p>
					<?if(!empty($_REQUEST['CODE']) && is_numeric($_REQUEST['CODE']) && $bSale):
						$resElementDB = CIBlockElement::GetByID($_REQUEST['CODE']);
						$resElementDB->SetUrlTemplates($arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"], $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"]);
						$arElementDB = $resElementDB->GetNext();?>
						<p><a href="<?=$arElementDB['DETAIL_PAGE_URL']?>"><?=GetMessage('BBS_SUCCESS_ADD_LINK');?></a></p>
					<?endif?>
					</div>
				</div>
			</div>
		</div>
	<?endif?>

	<?if ($bSale):?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"option_list",
			Array(
				"IBLOCK_TYPE" => $arParams["OPTIONS_IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["OPTIONS_IBLOCK_ID"],
				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SHOW_ALL_WO_SECTION" => "Y",
				"PATH_TO_ORDER" => $arResult['PATH_TO_ORDER'],
				"RESIZER_SETS" => $arSets,
				"ELEMENT_SORT_FIELD" => 'sort',
				"ELEMENT_SORT_ORDER" => 'asc',
				"PROPERTY_CODE" =>$arParams["LIST_PROPERTY_CODE"],
				"BANNER_TYPE" =>$arParams["BANNER_TYPE_SECTION"],
				"BROWSER_TITLE" => "BROWSER_TITLE",
				"VARIABLES" => $arResult["VARIABLES"],
				"INCLUDE_SUBSECTIONS" => "Y",
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"PRICE_CODE" => $arParams["OPTIONS_PRICE_CODE"],
				
				"PAGE_ELEMENT_COUNT" => 20,
				
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
	<?endif?>
	<?if (!empty($_REQUEST['CODE']) && is_numeric($_REQUEST['CODE']) && $arParams['PAID_ADS'] != 'Y' && $bSale):
		$resElementDB = CIBlockElement::GetByID($_REQUEST['CODE']);
		$resElementDB->SetUrlTemplates($arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"], $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"]);
		$arElementDB = $resElementDB->GetNext();?>
		<div class="blc_alert">
			<div class="row-fluid">
				<div class="span8 offset2">
					<div class="alert">
						<form action="/personal/order/" method="post" style="display:none">
							<?=bitrix_sessid_post()?>
							<input type="hidden" name="ad_id" value="<?=intval($_REQUEST['CODE'])?>" />
							<input type="hidden" name="add_order_for_ad" value="Y" />
							<button class="b-action"><?=GetMessage('BBS_PAY_CONTINUE')?></button>
						</form>
						<a href="<?=$arElementDB['DETAIL_PAGE_URL']?>"><?=GetMessage('BBS_FREE_CONTINUE')?></a> <?=GetMessage('BBS_FREE_CONTINUE2')?>
					</div>
				</div>
			</div>
		</div>
	<?endif?>
<?endif?>

<?// echo "<pre>";	print_r($arParams);	echo "</pre>";?>