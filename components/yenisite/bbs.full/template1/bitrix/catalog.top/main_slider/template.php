<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult['ITEMS'])>0):?>
<h3 class="head"><?=GetMessage("MAIN_SLIDER_TITLE")?></h3>

<div class="row-fluid">
	<?foreach($arResult['ITEMS'] as $item):?>
	<?//$item_section = CIBlockSection::GetByID($item['IBLOCK_SECTION_ID'])->GetNext();?>
	<?
		// echo "<pre>";
		// print_r($item);
		// echo "</pre>";
		
		
?>
	<div class="span2">
		<div class="item">
			<div class="product_item">
				<div class="image"><a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$item['PICTURE']?>" width="139" height="139" alt="@"></a></div>
				<div class="tit"><a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a></div>
				<div class="price"><?if($item['PROPERTIES']['PRICE']['VALUE']>0):?><?=$item['PROPERTIES']['PRICE']['VALUE']?> <?=$item['PROPERTIES']['CURRENCY']['VALUE']?><?endif?></div>
				<div class="category"><?=$item['CATEGORY_CHAIN']?></div>
				<div class="address"><?if(!empty($item['PROPERTIES']['ADDRESS']['VALUE'])):?><i class="sym">&#0117;</i> <?=$item['PROPERTIES']['ADDRESS']['VALUE']?><?endif;?></div>
			</div>
			<div class="product_popup">
				<div class="image"><a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$item['PICTURE']?>" width="139" height="139" alt="@"></a></div>
				<div class="tit"><a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a></div>
				<div class="price"><?if($item['PROPERTIES']['PRICE']['VALUE']>0):?><?=$item['PROPERTIES']['PRICE']['VALUE']?> <?=$item['PROPERTIES']['CURRENCY']['VALUE']?><?endif?></div>
				<div class="category"><?=$item['CATEGORY_CHAIN']?></div>
				<div class="address"><?if(!empty($item['PROPERTIES']['ADDRESS']['VALUE'])):?><i class="sym">&#0117;</i> <?=$item['PROPERTIES']['ADDRESS']['VALUE']?><?endif;?></div>
			</div>
		
		</div>
	</div>
	<?endforeach?>

	<div class="clear"></div>
</div>

<div class="navi">
	<a href="javascript: void(0);" class="sym navi_prev">&#212;</a>
	<a href="javascript: void(0);" class="sym navi_next">&#215;</a>
</div>
<?endif?>


<?
		// echo "<pre>";
		// print_r($arResult);
		// echo "</pre>";
?>
