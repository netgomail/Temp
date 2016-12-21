<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS'])>0):?>


<div class="heading"><h2><?=GetMessage('BBS_OPTIONS_HEADER')?></h2></div>

<section class="blc_tariff">
	<div class="row-fluid"><?
	
	foreach ($arResult['ITEMS'] as $arItem):?>

		<div class="span3">
			<div class="image"><a href="" onclick="bbsAddOption(<?=$arItem['ID']?>, this);return false"><img src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" width="220" height="140" alt="<?=$arItem['NAME']?>"></a></div>
			<div class="tit"><a href="" onclick="bbsAddOption(<?=$arItem['ID']?>, this);return false"><?=$arItem['NAME']?></a></div>
			<div class="node">
				<?=$arItem['DETAIL_TEXT']?>
			</div>
			<div class="price"><?=$arItem['MIN_PRICE']['PRINT_VALUE']?></div>
			<a class="b-action" href="" onclick="bbsAddOption(<?=$arItem['ID']?>, this);return false"><?=htmlspecialcharsEx($arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'])?></a>
		</div><?
		
	endforeach?>

	</div>
	<div class="continious"></div>
</section>

<?endif;?>
<script>BX.message({BBS_OPTION_ADDED: '<?=GetMessage('BBS_OPTION_ADDED')?>'})</script>