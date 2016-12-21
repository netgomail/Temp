<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
$APPLICATION->SetTitle(GetMessage('BBS_ORDER_TITLE'));
$APPLICATION->SetPageProperty("title", GetMessage('BBS_ORDER_TITLE'));
?>
<!--<div class="heading"><h1><?$APPLICATION->ShowTitle();?></h1></div>-->



<?
// CREATE NEW ORDER
$bbs_freeAD = false;
if($_REQUEST['add_order_for_ad']=='Y') //&& check_bitrix_sessid())
{
	if(!$USER->IsAuthorized())
	{
		$APPLICATION->AuthForm("");
		return;
	}
	if(!CModule::IncludeModule("catalog") ||!CModule::IncludeModule("sale") || !CModule::IncludeModule("iblock"))
		return;
		
	$IBLOCK_ID = CIBlockElement::GetIBlockByID( intval($_REQUEST['ad_id'])	);
	$res = CIBlockElement::GetProperty($IBLOCK_ID,  intval($_REQUEST['ad_id']), Array("sort"=>"asc"), array("CODE" => "STATUS"))->Fetch();
	
	//clear basket for current User	
	CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
	
	if($res['VALUE_XML_ID'] != 'F')
	{
		$arTarif = CIBlockElement::GetByID(intval($_REQUEST['tarif']))->GetNext();
		
		$arTarif['PRICE'] = CCatalogProduct::GetOptimalPrice(intval($_REQUEST['tarif']), 1, $USER->GetUserGroupArray());

		if ($arTarif['PRICE']['PRICE']['PRICE'] <= 0) {
			CYSBbs::SetAdvertisementStatus($_REQUEST['ad_id'], $IBLOCK_ID, 'F');
			$bbs_freeAD = true;

		} else {
			$name = str_replace('#TARIF_NAME#', $arTarif['NAME'] ,GetMessage('BBS_ORDER_NAME'));
			$name = str_replace('#AD_ID#', intval($_REQUEST['ad_id']), $name);
			$arFields = array(
				"PRODUCT_ID" => $arTarif['ID'],
				"PRODUCT_PRICE_ID" => intval($_REQUEST['ad_id']),
				"PRICE" => $arTarif['PRICE']['PRICE']['PRICE'],
				"CURRENCY" => $arTarif['PRICE']['PRICE']['CURRENCY'],
				"QUANTITY" => 1,
				"LID" => LANG,
				"NAME" => $name,
			);	
			CSaleBasket::Add($arFields);
		}
	}
	
	if (is_array($_REQUEST['options']) && count($_REQUEST['options']) > 0) {
		$bbs_freeAD = false;
		foreach ($_REQUEST['options'] as $optionId) {
			$arOption = CIBlockElement::GetByID(intval($optionId))->GetNext();
			
			$arOption['PRICE'] = CCatalogProduct::GetOptimalPrice(intval($optionId), 1, $USER->GetUserGroupArray());

			$name = GetMessage('BBS_ORDER_OPTION', array('#OPTION_NAME#' => $arOption['NAME'], '#AD_ID#' => intval($_REQUEST['ad_id'])));
			$arFields = array(
				"PRODUCT_ID" => $arOption['ID'],
				"PRODUCT_PRICE_ID" => intval($_REQUEST['ad_id']),
				"PRICE" => $arOption['PRICE']['PRICE']['PRICE'],
				"CURRENCY" => $arOption['PRICE']['PRICE']['CURRENCY'],
				"QUANTITY" => 1,
				"LID" => LANG,
				"NAME" => $name,
			);
			CSaleBasket::Add($arFields);
		}
	}
}

?>
<?if($bbs_freeAD):?>
	<div class="pathway">
		<ul>
			<li class="done"><span class="unit"><span class="ins"><?=GetMessage("BBS_NEW_AD")?></span></span></li>
			<li class="done"><span class="unit"><span class="ins"><?=GetMessage("BBS_SELECT_OPTIONS")?></span></span></li>
			<li class="done"><span class="unit"><span class="ins"><?=GetMessage("BBS_PAYMENT")?></span></span></li>
		</ul>
	</div>
	<div class="blc_alert">
		<div class="row-fluid">
			<div class="span8 offset2">
				<div class="alert alert-success">
					<p><?=GetMessage('BBS_SUCCESS_ADD');?></p>
				<?if(!empty($_REQUEST['ad_id']) && is_numeric($_REQUEST['ad_id'])):
					$resElementDB = CIBlockElement::GetByID($_REQUEST['ad_id']);
					$resElementDB->SetUrlTemplates($arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"], $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"]);
					$arElementDB = $resElementDB->GetNext();?>
					<p><a href="<?=$arElementDB['DETAIL_PAGE_URL']?>"><?=GetMessage('BBS_SUCCESS_ADD_LINK');?></a></p>
				<?endif?>
				</div>
			</div>
		</div>
	</div>
<?else:?>
<?
$pta = SITE_DIR."auth.php";

$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "visual_bbs", array(
	"PAY_FROM_ACCOUNT" => "Y",
	"COUNT_DELIVERY_TAX" => "N",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"ONLY_FULL_PAY_FROM_ACCOUNT" => "Y",
	"ALLOW_AUTO_REGISTER" => "N",
	"SEND_NEW_USER_NOTIFY" => "Y",
	"DELIVERY_NO_AJAX" => "N",
	"DELIVERY_NO_SESSION" => "N",
	"TEMPLATE_LOCATION" => ".default",
	"DELIVERY_TO_PAYSYSTEM" => "p2d",
	"USE_PREPAYMENT" => "N",
	"PROP_1" => array(
	),
	"PROP_2" => array(
	),
	"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
	"PATH_TO_BASKET" => $arResult['PATH_TO_BASKET'],
	"PATH_TO_PERSONAL" => $arResult['PATH_TO_PERSONAL_ADS'],
	"PATH_TO_PAYMENT" => $arResult['PATH_TO_PAYMENT'],
	"PATH_TO_AUTH" => $pta,
	"SET_TITLE" => "Y",
	"DISPLAY_IMG_WIDTH" => "90",
	"DISPLAY_IMG_HEIGHT" => "90"
	),
	$component
);?>
<?endif?>