<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="blc_searchbar">
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="searchForm">

	<?foreach($arResult["HIDDEN"] as $arItem):?>
		<input
			type="hidden"
			name="<?echo $arItem["CONTROL_NAME"]?>"
			id="<?echo $arItem["CONTROL_ID"]?>"
			value="<?echo $arItem["HTML_VALUE"]?>"
		/>
	<?endforeach;?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?//echo '<pre>'; print_r($arItem); echo '</pre>'; ?>
		<div class="row-fluid check">		
		<?if($arItem["PROPERTY_TYPE"] == "N" || isset($arItem["PRICE"])):?>
			<?if(isset($arItem["VALUES"]["MIN"]["VALUE"]) && isset($arItem["VALUES"]["MAX"]["VALUE"]) &&
				($arItem["VALUES"]["MAX"]["VALUE"] > $arItem["VALUES"]["MIN"]["VALUE"])):?>
				<div class="span9">
					<label class="forSliderTitle"><span class="titleContent"><?=$arItem["NAME"]?>:</span></label>
						
						<!--<div class="min"><span id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>_Val"><?=$arItem["VALUES"]["MIN"]["VALUE"]?></span></div>
						
						<div class="max"><span id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>_Val"><?=$arItem["VALUES"]["MAX"]["VALUE"]?></span></div>-->
						<span class="titleContent"><?=GetMessage('CT_BCSF_FILTER_FROM');?></span>
						<input 
							type="text" 
							id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" 
							name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" 
							value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
							placeholder="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>">	
						<span class="titleContent"><?=GetMessage('CT_BCSF_FILTER_TO');?></span>						
						<input 
							type="text" 
							id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" 
							name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" 
							value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
							placeholder="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>">
						
					<div class="sliderCont">
						<div id="slider-<?=$arItem['ID']?>" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
							<div  class="ui-slider-range ui-widget-header uiSlid">
								<a class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a>
								<a class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a>
							</div>
						</div>
					</div>
				
						
				<script>
					var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($APPLICATION->GetCurPageParam())?>');
					//$(function() {
					var minprice = <?=$arItem["VALUES"]["MIN"]["VALUE"]?>;
					var maxprice = <?=$arItem["VALUES"]["MAX"]["VALUE"];?>;
					$( "#slider-<?=$arItem['ID']?>").slider({
						range: true,
						min: minprice,
						max: maxprice,
						values: [ <?=(empty($arItem["VALUES"]["MIN"]["HTML_VALUE"])) ? $arItem["VALUES"]["MIN"]["VALUE"] : $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>, <?=(empty($arItem["VALUES"]["MAX"]["HTML_VALUE"])) ? $arItem["VALUES"]["MAX"]["VALUE"] : $arItem["VALUES"]["MAX"]["HTML_VALUE"];?> ],
						slide: function( event, ui ) {
							$("#<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>").val(ui.values[0]);
							$("#<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>").val(ui.values[1]);
							
							smartFilter.keyup(BX("<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"));
						}
					});

					// $("#<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>").val(minprice);
					// $("#<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>").val(maxprice);

					//});
				</script>
				</div>
			<?endif;?>
			
		<?/*elseif($arItem["SHOW_TYPE"] == "SELECT"):?>
			<fieldset class="horiz">
				<b><?=$arItem["NAME"]?> : </b>
				<select onchange="smartFilter.change(this)" data-input="<?=$arItem["ID"]?>">
					<option 
						data-name="" 
						data-value="" 
						value=""
						><?=GetMessage('BBS_ALL')?></option>
					<?
					$checkedName = false;
					foreach($arItem["VALUES"] as $val => $ar):
						if($ar["CHECKED"])
						{
							$checkedName = $ar["CONTROL_NAME"];
						}?>
						<option 
							data-name="<?=$ar["CONTROL_NAME_ALT"]?>" 
							data-value="<?=$ar["HTML_VALUE_ALT"]?>" 
							value="Y"
							<?=$ar["CHECKED"]? 'selected="selected"': ''?>
							><?=$ar["VALUE"]?></option>
					<?endforeach;?>
				</select>
				<input id="<?=$arItem["ID"]?>" type="hidden" <?=($checkedName !== false) ? 'name="'.$checkedName.'" value="Y"' :''?>>
			</fieldset>
		<?*/else:?>
			<fieldset class="horiz">
				<?if(count($arItem["VALUES"])>0):?>
					<b><?=$arItem["NAME"]?> : </b>
					<?foreach($arItem["VALUES"] as $val => $ar):?>
					<!--<div class="span9">-->
						<input 
							type="checkbox" 
							name="<?=$ar["CONTROL_NAME"]?>" 
							id="<?=$ar["CONTROL_ID"]?>" 
							value="<?=$ar["HTML_VALUE"]?>"
							<?=$ar["CHECKED"]? 'checked="checked"': ''?>
							onclick="smartFilter.click(this)"
							/>
						<label class="checkChange" for="<?=$ar["CONTROL_NAME"]?>"><?=$ar["VALUE"]?></label>
					<!--</div>-->
					<?endforeach;?>
				<?/*else:?>
					
					<?foreach($arItem["VALUES"] as $val => $ar):?>
					<!--<div class="span9">-->
							
								<input 
									type="checkbox" 
									name="<?=$ar["CONTROL_NAME"]?>" 
									id="<?=$ar["CONTROL_ID"]?>" 
									value="<?=$ar["HTML_VALUE"]?>"
									<?=$ar["CHECKED"]? 'checked="checked"': ''?>
									onclick="smartFilter.click(this)"
									/>
								<label class="checkChange" for="<?=$ar["CONTROL_NAME"]?>"><?=$arItem["NAME"]?></label>
							
					<!--</div>-->
					<?endforeach;*/?>
				<?endif;?>
			</fieldset>
		<?endif;?>			
		</div>
	<?endforeach;?>
		
		
		

		

		<div class='row-fluid check' >
			<div class="span3" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
				<?=GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
				<a href="<?=$arResult["FILTER_URL"]?>" class="showchild"><?=GetMessage("CT_BCSF_FILTER_SHOW")?></a>
			</div>
			<div style="text-align: right;">
			<input class="button b-request" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
			<input class="button b-request" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />
			</div>
		</div>


</form>

</div><!-- /blc_searchbar -->

<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>');
</script>
<?//echo '<pre>'; print_r($arResult); echo '</pre>'; ?>