<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");


if($arResult["NavPageNomer"] == 1)
	$prev = 1;
elseif($arResult["NavPageNomer"] == 0)
	$prev = 1;
else $prev = $arResult["NavPageNomer"] - 1;

if($arResult["NavPageNomer"] == $arResult["NavPageCount"])
	$next = $arResult["NavPageCount"];
elseif($arResult["NavPageNomer"] > $arResult["NavPageCount"])
	$next = $arResult["NavPageCount"];
else 
	$next = $arResult["NavPageNomer"]+1;


?>
<div class="blc_pagination">
	<div class="row-fluid">
		<div class="pagination">
		  <ul>
				<?if($arResult['NavPageNomer'] != $arResult['nStartPage']):?>
					<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$prev?>" ><button class="button b-gray next"> <?=GetMessage('nav_prev');?> <i class="sym">&#212;</i> </button></a></li>
				<?endif;?>
				<?if ($arResult["NavPageNomer"] > 1):?>
					<?//here button of start?>
				<?endif;?>
				<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

					<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
						<li><button class="button b-request square"><?=$arResult["nStartPage"]?></button></li>
					<?else:?>
						<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" ><button class="button b-gray square"> <?=$arResult["nStartPage"]?> </button></a></li>
					<?endif?>
					<?$arResult["nStartPage"]++?>
				<?endwhile?>
				<?if($arResult['NavPageNomer'] != $arResult['nEndPage']):?>
					<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$next?>" ><button class="button b-gray next"> <?=GetMessage('nav_next');?> <i class="sym">&#215;</i> </button></a></li>
				<?endif;?>
		  </ul>
		</div>
	</div>
</div><!-- /blc_pagination --><?/*
					

<?if($arResult["bDescPageNumbering"] === true):?>

	<div class="pager">

	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_begin")?></a>
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>
			<?//if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
			<?//else:?>
			<?//endif?>
		<?endif?>
	<?else:?>
		<a class="nav-hidden" href="#"><?=GetMessage("nav_begin")?></a>
	<?endif?>

	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<a href="#" class='active'><?=$NavRecordGroupPrint?></a>
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
		<?endif?>

		<?$arResult["nStartPage"]--?>
	<?endwhile?>



	<?if ($arResult["NavPageNomer"] > 1):?>
		
	
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_end")?></a>
	<?else:?>
		<a class="nav-hidden" href="#"><?=GetMessage("nav_end")?></a>
	<?endif?>

<?else:?>
	<div class="pager">

	<?if ($arResult["NavPageNomer"] > 1):?>

		<?if($arResult["bSavePage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_begin")?></a>
		
		
		
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>
			
			<?if ($arResult["NavPageNomer"] > 2):?>
				
			<?else:?>
				
			<?endif?>
			
		<?endif?>

	<?else:?>
		<a class="nav-hidden" href="#"><?=GetMessage("nav_begin")?></a>
	<?endif?>

	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<a href="#" class='active'><?=$arResult["nStartPage"]?></a>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
	

	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_end")?></a>
	<?else:?>
		<a class="nav-hidden" href="#"><?=GetMessage("nav_end")?></a>
	<?endif?>

<?endif?>

</div>

*/
//echo "<pre>";print_r($arResult);echo "</pre>";

?>