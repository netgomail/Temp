<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "orders", array(
	"PROP_1" => array(
	),
	"PROP_2" => array(
	),
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/",
	"ORDERS_PER_PAGE" => "20",
	"PATH_TO_PAYMENT" => $arResult['PATH_TO_PAYMENT'],
	"PATH_TO_BASKET" => $arResult['PATH_TO_BASKET'],
	"SET_TITLE" => "N",
	"SAVE_IN_SESSION" => "Y",
	"NAV_TEMPLATE" => ""
	),
	$component
);?>

<?//open in personal_header?>
	</div><!-- /tabs -->
</section><!-- /blc_cabinet -->