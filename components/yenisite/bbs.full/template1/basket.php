<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?
$APPLICATION->SetTitle(GetMessage('BBS_BASKET_TITLE'));
$APPLICATION->SetPageProperty("title", GetMessage('BBS_BASKET_TITLE'));
?>
<div class="heading"><h1><?$APPLICATION->ShowTitle();?></h1></div>

<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", ".default", array(
	"COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "PRICE",
		//2 => "TYPE",
		3 => "QUANTITY",
		4 => "DELETE",
		//5 => "DELAY",
		//6 => "WEIGHT",
		7 => "DISCOUNT",
	),
	"PATH_TO_ORDER" => $arResult['PATH_TO_ORDER'],
	"HIDE_COUPON" => "N",
	"QUANTITY_FLOAT" => "N",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"USE_PREPAYMENT" => "N",
	"SET_TITLE" => "Y"
	),
	$component
);?>