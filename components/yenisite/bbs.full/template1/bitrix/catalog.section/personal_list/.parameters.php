<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$resizer_sets_list = array () ;
if(CModule::IncludeModule("yenisite.resizer2")){
	$arSets = CResizer2Set::GetList();
	while($arr = $arSets->Fetch())
	{
		$resizer_sets_list[$arr["id"]] = "[".$arr["id"]."] ".$arr["NAME"];
	}
}

$arComponentParameters = array(
	"GROUPS" => array(
		"RESIZER_SETS" => array(
			"NAME" => GetMessage("RESIZER_SETS"),
		),
	),

	"PARAMETERS" => array(
	
		"LIST_IMG" => array(
			"PARENT" => "RESIZER_SETS",
			"NAME" => GetMessage("LIST_IMG"),
			"TYPE" => "LIST",
			"VALUES" => $resizer_sets_list,
			"DEFAULT" => "3",
		),
	),
);

?>