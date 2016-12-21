<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<script type="text/javascript">
var bbs_path_to_order = "<?=$arResult['PATH_TO_ORDER']?>";
</script>

<?
// include JS
$APPLICATION->AddHeadScript($this->__folder.'/script_ajax.js');
$APPLICATION->AddHeadScript($this->__folder.'/script_ajax_handlers.js');


if($_REQUEST["rz_ajax"] !== "y")
{
	// ##### FOR AJAX
	$moduleCode = CYSBbs::getModuleId(); // !!!!!!!!
	$save_param = new CPHPCache();
	if($save_param->InitCache(86400*14, SITE_ID."_bbs", "/{$moduleCode}/ajax/bbs"))
		if($arParams != $save_param->GetVars())
			CPHPCache::Clean(SITE_ID."_bbs", "/{$moduleCode}/ajax/bbs");
	if($save_param->StartDataCache()):
		$save_param->EndDataCache($arParams);
	endif;
	unset($save_param);
	
	$arAjaxParams = array(
		"REQUEST_URI" => $_SERVER["REQUEST_URI"],
		"SCRIPT_NAME" => $_SERVER["SCRIPT_NAME"],
	);
	?><script type="text/javascript">
		$.extend(RZBBS.ajax.params, <?=CUtil::PhpToJSObject($arAjaxParams, false, true)?>);
		RZBBS.ajax.AddAdForm.Enable = '<?=$arParams['AJAX_ADD_AD']?>' === 'Y' ;
	</script><?
}

	
	
if ($this->__page !== "header" && $this->__page !== "personal_header"):
	$sTempatePage = $this->__page;
	$sTempateFile = $this->__file;
	$this->__component->IncludeComponentTemplate("header");
	$this->__page = $sTempatePage;
	$this->__file = $sTempateFile;
else:
	return true;
endif;	


if (is_numeric(strpos($this->__page , "personal_")) && $this->__page !== "personal_header"):
	$sTempatePage = $this->__page;
	$sTempateFile = $this->__file;
	$this->__component->IncludeComponentTemplate("personal_header");
	$this->__page = $sTempatePage;
	$this->__file = $sTempateFile;
else:
	return true;
endif;

//echo '<pre>'; print_r($this); echo '</pre>';

?>