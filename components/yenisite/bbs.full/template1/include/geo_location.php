<?
$arResult['GEO_PROP_LIST'] = CYSBbs::getEnumListPropByCode($arParams['GEO_PROP'], $arParams["IBLOCK_ID"]);
$currentLocation = CYSBbsGeo::getCurLocation($arResult['GEO_PROP_LIST']);
$arResult['GEO_PROP_LIST'][$currentLocation]['CHECKED'] = true;
?>	
<div class="wdt_city">
	<?=(strlen($arParams['GEOLOCATIONS_TEXT']) > 0) ? $arParams['GEOLOCATIONS_TEXT'] : GetMessage('BBS_CURRENT_REGION')?>
	<a href="#select-regions-geo-prop" data-toggle="modal" class="border-dotted"><span class="dotted">
		<?=$arResult['GEO_PROP_LIST'][$currentLocation]['VALUE']?>
	</span> <i class="sym">{</i></a>
</div><!-- /wdt_city -->
<div id="select-regions-geo-prop" class="modal hide fade container row geolocation">
	<?if(method_exists($this, 'createFrame')) $frame = $this->createFrame()->begin('Loading...'); ?>
  	<div class="modal-header">
    	<button type="button" class="btn-icon close sym" data-dismiss="modal" aria-hidden="true">&#205;</button>
	    <h4 class="head"><?=GetMessage('BBS_GEO_PROP_POPUP_TITLE')?></h4>
	</div>
	<?
	$dirLink = ($arParams['GEOLOCATIONS_REDIRECT_ENABLE'] == 'Y' && !empty($arParams['GEOLOCATIONS_REDIRECT_LINK']) ? $arParams['GEOLOCATIONS_REDIRECT_LINK'] : $APPLICATION->GetCurPage())
	?>
	<div class="modal-body tab-content">
		<ul class='districts columnize tab-pane active' data-columns="4">
			<?foreach($arResult['GEO_PROP_LIST'] as $k => $city):?>
				<li class="<?=($city["CHECKED"] ? ' active' : '')?>">
					<a href="<?=$dirLink.'?'.CYSBbsGeo::getCookieLocationName().'='.$city["ID"]?>"><?=$city["VALUE"]?></a>
				</li>
			<?endforeach?>
		</ul>
	</div>
	<?if(method_exists($this, 'createFrame')) $frame->end();?>
</div>
	<?/*
	<div class=" row-fluid check">
	<fieldset class="horiz geolocation">
		<form method='post' action="<?=SITE_DIR?>" class="inline">
			<select onchange="this.form.submit()" name="<?=CYSBbsGeo::getCookieLocationName()?>">
				<?foreach($arResult['GEO_PROP_LIST'] as $val => $ar):?>
					<option 
						value="<?=$ar['ID']?>"
						<?=$ar["CHECKED"]? 'selected="selected"': ''?>
						><?=$ar["VALUE"]?></option>
				<?endforeach;?>
			</select>
		</form>
	</fieldset>
	</div>
	*/
/********************************************************************
		ADD FILTER ON ADS
********************************************************************/
global ${$arParams["FILTER_NAME"]};
if($arResult['COMPONENT_PAGE'] != 'user_ads' || $arParams['SHOW_ALL_ON_USER_ADS'] == 'N')
{
	if($arParams['SHOW_AD_WO_GEO_PROP'] == 'Y')
	{
		$arGeoFilter = array(
			array(
				"LOGIC" => "OR",
				array('=PROPERTY_'.$arParams['GEO_PROP'] => $currentLocation),
				array('=PROPERTY_'.$arParams['GEO_PROP'] => false),
			)
		);
	}
	else
	{
		$arGeoFilter = array(
			'=PROPERTY_'.$arParams['GEO_PROP'] => $currentLocation
		);
	}
	
	${$arParams["FILTER_NAME"]} = array_merge(${$arParams["FILTER_NAME"]} , $arGeoFilter);
}
