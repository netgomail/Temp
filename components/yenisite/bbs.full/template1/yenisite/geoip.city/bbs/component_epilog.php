<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (CModule::IncludeModule("statistic")) {
	$APPLICATION->AddHeadScript($componentPath . "/js/jquery.textchange.min.js");

	?><script>
		YS.GeoIP.OrderProps = {	
			'PERSON_TYPE_1' : {
				'locationID' : <?=(!empty($arParams['P1_LOCATION_ID'])) ? $arParams['P1_LOCATION_ID'] : 5 ?>,
				'cityID' : <?=(!empty($arParams['P1_CITY_ID'])) ? $arParams['P1_CITY_ID'] : 6 ?>},
			'PERSON_TYPE_2' : {
				'locationID' : <?=(!empty($arParams['P2_LOCATION_ID'])) ? $arParams['P2_LOCATION_ID'] : 18 ?>,	
				'cityID' : <?=(!empty($arParams['P2_CITY_ID'])) ? $arParams['P2_CITY_ID'] : 17 ?>}
		};
		YS.GeoIP.AutoConfirm = <?if($arParams['AUTOCONFIRM'] == "Y"):?>true<?else:?>false<?endif?>;
	</script><?
	if (strlen($tmp) != 0) {
		$APPLICATION->AddHeadScript($componentPath . "/js/bitronic.js");
	} else {
		$APPLICATION->AddHeadScript($componentPath . "/js/eshop.js");
	}
}
?>