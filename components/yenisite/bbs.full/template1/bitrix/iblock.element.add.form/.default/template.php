<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<section class="blc_add">
<?
//echo "<pre>Template arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
//exit();
?>

<?if (count($arResult["ERRORS"])):?>
	<?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<?=ShowNote($arResult["MESSAGE"])?>
<?endif?>
<div class="row">
	<div class="span8 offset1">
	<form id="ad_add" class="form-horizontal" name="ad_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" onSubmit="if(!document.getElementById('checkPolicy').checked)return false;">
	<?=bitrix_sessid_post()?>
	<?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
	<?$arResult["PROPERTY_REQUIRED"][] = 'NAME';?>
	<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
		<?
		if (
			$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
			&&
			$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
		)
			$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
		elseif (
				(
				$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
				||
				$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
				)
				&&
				$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
			)
				$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
				
		if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["IS_REQUIRED"] == "Y")
			$arResult["PROPERTY_REQUIRED"][] = $propertyID;
		
		
		if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
		{
			$inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
			$inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
		}
		else
		{
			$inputNum = 1;
		}
		if($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"]=="F")	
			$add_class = 'add-photo';
		else
			$add_class = '';
		?>
		
		
		<div class="control-group ctrl-fullwidth <?=$add_class?>">
			<label class="control-label" for="PROPERTY_<?=$propertyID?>"><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif;?><?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><em>*</em><?endif;?>:</label>
			<div class="controls">
			<?
			$INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];
		
			switch ($INPUT_TYPE):
				case "HTML":
					$LHE = new CLightHTMLEditor;
					$LHE->Show(array(
						'id' => "PROPERTY_{$propertyID}",
						'width' => '100%',
						'height' => '200px',
						'inputName' => "PROPERTY[".$propertyID."][0]",
						'content' => $arResult["ELEMENT"][$propertyID],
						'bUseFileDialogs' => false,
						'bFloatingToolbar' => false,
						'bArisingToolbar' => false,
						'toolbarConfig' => array(
							'Bold', 'Italic', 'Underline', 'RemoveFormat',
							'CreateLink', 'DeleteLink', 'Image', 'Video',
							'BackColor', 'ForeColor',
							'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
							'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
							'StyleList', 'HeaderList',
							'FontList', 'FontSizeList',
						),
					));
					break;
				case "T":
					for ($i = 0; $i<$inputNum; $i++)
					{
						if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
						{
							$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
						}
						elseif ($i == 0)
						{
							$value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
						}
						else
						{
							$value = "";
						}
					?>
					<textarea id="PROPERTY_<?=$propertyID?>" cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]"><?=$value?></textarea>
						<?
					}
					break;
							
				case "S":
				case "N":
					for ($i = 0; $i<$inputNum; $i++)
					{
						if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
						{
							$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
						}
						elseif ($i == 0)
						{
							$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
						}
						else
						{
							$value = "";
						}
						?>
						<input id="PROPERTY_<?=$propertyID?>" type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25" value="<?=$value?>" /><br /><?
						if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
							$APPLICATION->IncludeComponent(
								'bitrix:main.calendar',
								'',
								array(
									'FORM_NAME' => 'ad_add',
									'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
									'INPUT_VALUE' => $value,
								),
								null,
								array('HIDE_ICONS' => 'Y')
							);
							?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
						endif
						?><br /><?
					}
					break;					
				case "F":
					for ($i = 0; $i<$inputNum; $i++)
					{
						$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
						?>
						<input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
						
						<input class="hide" type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" />
						<?
						if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
						{
							if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
							{
								?>
								<img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br /><?
							}
							else
							{
								?>
								<?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
								<?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
								[<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]<br /><?
							}
							?>
							<input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("IBLOCK_FORM_FILE_DELETE")?></label><br /><?
						}
						else
						{
						?>
							<button id="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" class="b-gray" onclick="addImage(this.getAttribute('id'));return false;"><i class="sym">&#193;</i></button>
						<?
						}
					}
					break;
				
				case "L":
					if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
						$type = ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" || count($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"])==1) ? "checkbox" : "radio";
					else
						if($propertyID == 'IBLOCK_SECTION')
							$type = "dropdown";
						else
							$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

					switch ($type):
						case "checkbox":
						case "radio":
							foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
							{
								$checked = false;
								if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
								{
									if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
									{
										foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
										{
											if ($arElEnum["VALUE"] == $key) {$checked = true; break;}
										}
									}
								}
								else
								{
									if ($arEnum["DEF"] == "Y") $checked = true;
								}
								?>
								<input type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label><br /><?
							}
							break;

						case "dropdown":
						case "multiselect":
							?>
							<select 
								id="PROPERTY_<?=$propertyID?>" 
								name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>"
								>
								<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
								<?
								if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
								else $sKey = "ELEMENT";

								foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
								{
									$checked = false;
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
										{
											if ($key == $arElEnum["VALUE"]) {$checked = true; break;}
										}
									}
									else
									{
										if ($arEnum["DEF"] == "Y") $checked = true;
									}
									?>
									<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option><?
								}
								?>
							</select>
							<?
							break;
					endswitch;
				break;
			endswitch;
		?>
		
			
				<!--<input type="text" id="inputTitle">-->
				<!--<div class="hint"><?=GetMessage("BBS_HINT")?></div>-->
			</div>
		</div>
	<?endforeach;?>
	<?endif;?>
		<div class="important"><i class="sym">&#0092;</i> <?=GetMessage("BBS_IMPORTANT")?></div>
		<div class="control-group">
			<div class="controls">
				<div class="policy">
					<input name="" type="checkbox" value="false" id="checkPolicy">
					<label for="checkPolicy">
						<?
						$includeFilePath = SITE_DIR."include_areas/check_policy.php";
						if(!file_exists($_SERVER["DOCUMENT_ROOT"].$includeFilePath))
						{
							if($fd = @fopen($_SERVER["DOCUMENT_ROOT"].$includeFilePath, "wb"))
							{
								fwrite($fd, GetMessage("BBS_CHECK_POLICY", array('#RULES_PAGE_URL#' => $arParams['RULES_PAGE_URL'])));
								fclose($fd);

								if(defined("BX_FILE_PERMISSIONS"))
									@chmod($includeFilePath, BX_FILE_PERMISSIONS);
							}
							else
							{
								echo GetMessage("BBS_CHECK_POLICY", array('#RULES_PAGE_URL#' => $arParams['RULES_PAGE_URL']));
							}
						}
						$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => $includeFilePath,	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"N"));?>
					</label>
				</div>
				
				<div class="manage_buttons">
					<?if(is_numeric($arResult['ELEMENT']['ID'])):?>
						<a class="button b-request" href="<?=$arResult['ELEMENT']['DETAIL_PAGE_URL']?>"><?=GetMessage("BBS_AD_VIEW")?></a>
					<?endif;?>
					<input class="b-action" type="submit" name="<?=(is_numeric($arResult['ELEMENT']['ID'])) ? 'iblock_submit' : 'iblock_apply'?>" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
				</div>
				
			</div>
			
		</div>
	</form>
	</div>
	<div class="span3">
		<div class="help"><?=GetMessage("BBS_HELP")?><span></span></div>
	</div>
</div>		
</section><!-- /blc_add -->
<?// echo "<pre>";	print_r($arResult);	echo "</pre>";?>