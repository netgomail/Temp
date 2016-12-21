<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
if(!$USER->IsAuthorized())
{
	$APPLICATION->AuthForm("");
	return;
}
if(!CModule::IncludeModule("sale"))
	return;
	
//clear basket for current User	
CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());

$APPLICATION->IncludeComponent("bitrix:sale.account.pay", ".default", array(
	"SET_TITLE" => "Y",
	"PATH_TO_BASKET" => $arResult['PATH_TO_ORDER'],
	"REDIRECT_TO_CURRENT_PAGE" => "N",
	"SELL_AMOUNT" => array(
	),
	"SELL_CURRENCY" => "RUB",
	"VAR" => "buyMoney",
	"CALLBACK_NAME" => "PayUserAccountDeliveryOrderCallback"
	),
	$component
);?>

<?//echo '<pre>'; print_r($arResult); echo '</pre>';?>