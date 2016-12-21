<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$bTop = (array_key_exists('TOP_BLOCK', $arParams) && $arParams['TOP_BLOCK'] == 'Y');
if ($bTop && count($arResult['ITEMS']) < 1) return?>


<div class="blc_products blc_list<?=$bTop?' top':''?>">
<?if($bTop):?>
<div class="top_wrapper">
	<div class="top_header"><?=GetMessage('TOP_BLOCK_HEADER')?></div>
<?endif?>
	<?
	$row = 1;
	?>
	<?foreach($arResult['ITEMS'] as $item):?>
		<?if($row == 8 && !$bTop):?>
			<div class="row-fluid banner">
				<?if(CModule::IncludeModule("advertising")):?>
					<?$APPLICATION->IncludeComponent("bitrix:advertising.banner", ".default", array(
						"TYPE" => $arParams['BANNER_TYPE'],
						"NOINDEX" => "Y",
						"CACHE_TYPE" => $arParams['CACHE_TYPE'],
						"CACHE_TIME" => $arParams['CACHE_TIME'],
						),
						false
					);?>
				<?endif;?>
			</div>
		<?endif;?>
		<div class="announcement<?=($row%2==0)?' second':''?><?=($item['PROPERTIES']['HIGHLIGHT']['VALUE']=='Y')?' highlight':''?>">
			<div class="row-fluid">
				<div class="span8">
					<div class="date"><?=$item['DATE_CREATE_DATE'].', '.$item['DATE_CREATE_TIME']?></div>
					<div class="tit"><a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a> <?=HTMLToTxt($item['PREVIEW_TEXT'])?></div>
				</div>
				<div class="span2">
					<div class="address"><?if(!empty($item['PROPERTIES']['ADDRESS']['VALUE'])):?><i class="sym">&#0117;</i> <?=$item['PROPERTIES']['ADDRESS']['VALUE']?><?endif;?></div>
					<?foreach($item['DISPLAY_PROPERTIES'] as $arProp):?>
						<div class="address"><?=$arProp['NAME']?> : <?=(is_array($arProp['DISPLAY_VALUE'])) ? implode(' / ', $arProp['DISPLAY_VALUE']) : $arProp['DISPLAY_VALUE']?></div>
					<?endforeach;?>
				</div>
				<div class="span2">
					<div class="price"><?if($item['PROPERTIES']['PRICE']['VALUE']>0):?><?=$item['PROPERTIES']['PRICE']['VALUE']?> <?=$item['PROPERTIES']['CURRENCY']['VALUE']?><?endif?></div>
				</div>
				<?if ($item['PROPERTIES']['URGENT']['VALUE'] == 'Y'):?>
					<img class="urgent_icon" src="<?=SITE_TEMPLATE_PATH.'/img/announcement-buttons/lightning.png'?>" alt="<?=GetMessage('URGENT_TITLE')?>" title="<?=GetMessage('URGENT_TITLE')?>"/>
				<?endif?>
			
			<?$row++;?>
			</div>
		</div>
	<?endforeach;?>
<?if($bTop):?>
	</div><!-- .top_wrapper -->
<?endif?>
</div><!-- /blc_products -->


<?=$arResult["NAV_STRING"]?>
<?
//echo "<pre>";	print_r($arResult);	echo "</pre>";
?>
