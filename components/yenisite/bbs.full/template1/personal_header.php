<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?
if(!$USER->IsAuthorized())
{
	$APPLICATION->AuthForm("");
	return;
}
?>
<?
$bSale = (CModule::IncludeModule('sale') && CModule::IncludeModule('yenisite.bbs'));

if($bSale) {
	$siteCurrency = CSaleLang::GetLangCurrency(SITE_ID);
	if(!$arUserAccount = CSaleUserAccount::GetByUserID($USER->GetID(), $siteCurrency)){
	   $arFields = Array("USER_ID" => $USER->GetID(), "CURRENCY" => $siteCurrency, "CURRENT_BUDGET" => 0);
	   CSaleUserAccount::Add($arFields);  
	   $arUserAccount['CURRENT_BUDGET'] = 0;
	   $arUserAccount['CURRENCY'] = $siteCurrency;
	}
	$arResult['USER_ACCOUNT'] = $arUserAccount;
	switch ($arResult['USER_ACCOUNT']['CURRENCY']) {
	    case $arResult['USER_ACCOUNT']['CURRENCY']:
			$arResult['USER_ACCOUNT']['DISPLAY_CURRENCY'] = GetMessage($arResult['USER_ACCOUNT']['CURRENCY']);
	        break;
	   
	    default:
	        $arResult['USER_ACCOUNT']['DISPLAY_CURRENCY'] = GetMessage('RUB');
	        break;
	}
}
?>
<?
$APPLICATION->SetTitle(GetMessage('BBS_PERSONAL_HEADER_TITLE'));
$APPLICATION->SetPageProperty("title", GetMessage('BBS_PERSONAL_HEADER_TITLE'));
?>
<div class="heading"><h1><?$APPLICATION->ShowTitle();?></h1></div>

<section class="blc_cabinet">
	<div id="tabs">
		<div class="tabhead">
			<div class="tabmenu">
				<ul><?$path=$APPLICATION->GetCurUri();?>
					<li <?if(is_numeric(strpos ($path,$arResult['PATH_TO_PERSONAL_ADS']))):?> class="active"<?endif?>><a href="<?=$arResult['PATH_TO_PERSONAL_ADS']?>"><?=GetMessage("BBS_PERSONAL_MY_ADS")?></a></li>
					<!--<li <?if(is_numeric(strpos ($path,$arResult['PATH_TO_PERSONAL_MESSAGE']))):?> class="active"<?endif?>><a href="<?=$arResult['PATH_TO_PERSONAL_MESSAGE']?>"><?=GetMessage("BBS_PERSONAL_MESSAGE")?></a></li>-->
					<?if ($bSale && CYSBbsInit::getEdition() == 'MASTER'):?>
					<li <?if(is_numeric(strpos ($path,$arResult['PATH_TO_PERSONAL_PAYMENT']))):?> class="active"<?endif?>><a href="<?=$arResult['PATH_TO_PERSONAL_PAYMENT']?>"><?=GetMessage("BBS_PERSONAL_PAYMENT")?></a></li>
					<?endif?>
					<li <?if(is_numeric(strpos ($path,$arResult['PATH_TO_PERSONAL_SETTINGS']))):?> class="active"<?endif?>><a href="<?=$arResult['PATH_TO_PERSONAL_SETTINGS']?>"><span class="sym">&#094;</span><?=GetMessage("BBS_PERSONAL_SETTINGS")?></a></li>
				</ul>
			</div>
			<?if ($bSale):?>
			<div class="schet">
				<div class="pay"><?=GetMessage('PERSONAL_ACCOUNT')?>: <strong><?="{$arResult['USER_ACCOUNT']['CURRENT_BUDGET']} {$arResult['USER_ACCOUNT']['DISPLAY_CURRENCY']}"?></strong></div>
				
				<a href="<?=$arResult['PATH_TO_ACCOUNT_PAY']?>" ><button class="b-action"><?=GetMessage('PERSONAL_UPDATE_ACCOUNT')?></button></a>
			</div>
			<?endif?>
			<div class="clear"></div>
		</div><!-- /tabhead -->

		
<?//		echo '<pre>'; print_r($arResult); echo '</pre>';  ?>