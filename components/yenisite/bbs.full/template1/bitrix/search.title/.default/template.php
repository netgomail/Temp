<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="span9">
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = 'detail'; trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
<div class="searchform">
	
	<form action="<?echo $arResult["FORM_ACTION"]?>">
		<input id="<?echo $INPUT_ID?>" placeholder="<?=GetMessage("CT_BST_SEARCH_PLACEHOLDER");?>" class="stxt span12" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" />&nbsp;
		<button name="s" type="submit"  class="b-action"><i class="sym">&#0035;</i><?=GetMessage("CT_BST_SEARCH_BUTTON");?></button>
		<!--<input name="s" type="submit" value="<?=GetMessage("CT_BST_SEARCH_BUTTON");?>" />-->
	</form>
	<!--<div class="recentsearches">Recent searches: <a href="#" class="border-dotted"><span class="dotted">rope and soap</span></a></div>-->
	
	
</div>	

<!--

				
-->
<?endif?>
<script type="text/javascript">
/*var jsControl = new JCTitleSearch({
	//'WAIT_IMAGE': '/bitrix/themes/.default/images/wait.gif',
	'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
	'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
	'INPUT_ID': '<?echo $INPUT_ID?>',
	'MIN_QUERY_LEN': 2
});*/
</script>

</div>	
