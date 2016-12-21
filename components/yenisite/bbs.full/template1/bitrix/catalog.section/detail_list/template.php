<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>
<div class="head"><?=GetMessage('SIMILAR_ADS');?></div>
<div class="blc_products">
	<?foreach($arResult['ITEMS'] as $item):?>
		<div class="announcement">
			<div class="row-fluid">
				<div class="span1 date">
					<div class="today"><?=$item['DATE_CREATE_DATE'];?></div>
					<div class="time"><?=$item['DATE_CREATE_TIME'];?></div>
				</div>
				<div class="image span2"><a href="<?=$item['DETAIL_PAGE_URL']?>"><img class="mini" src="<?=$item['PICTURE']?>" alt="<?=$item['NAME']?>"></a></div>
				<div class="span6">
					<div class="tit"><a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a></div>
					<div class="category"><?=$item['CATEGORY_CHAIN']?></div>
				<div class="address"><?if(!empty($item['PROPERTIES']['ADDRESS']['VALUE'])):?><i class="sym">&#0117;</i> <?=$item['PROPERTIES']['ADDRESS']['VALUE']?><?endif;?></div>
				</div>
				<div class="span3">
					<div class="price"><?if($item['PROPERTIES']['PRICE']['VALUE']>0):?><?=$item['PROPERTIES']['PRICE']['VALUE']?> <?=$item['PROPERTIES']['CURRENCY']['VALUE']?><?endif?></div><br>
					<!--<button class="b-action hide"><i class="sym">&#0116;</i> Add to favorites</button>-->
				</div>
		
			<?$row++;?>
			</div>
		</div>
	<?endforeach;?>
</div><!-- /blc_products -->
<?endif;?>
<?
//echo "<pre>";	print_r($arResult);	echo "</pre>";
?>
