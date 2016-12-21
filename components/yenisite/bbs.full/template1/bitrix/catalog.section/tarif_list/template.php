<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(count($arResult['ITEMS'])<=0)
{
	ShowError(GetMessage('BBS_NO_TARIFS'));
	return;
}
?>

		
<section class="blc_tariff">
	<div class="errorList" style="display:none">
		<?=ShowError(GetMessage('BBS_NOT_SELECT_TARIF'));?>
	</div>	
	<div class="row-fluid">
		<!--
		<div class="span3">
			<div class="image"><a href="#"><img src="img/ad/a-top-ads.png" width="220" height="140" alt="Top ads"></a></div>
			<div class="node">
				<p>Advertisement will be placed in the unit Top ads in its category.</p>
				<div class="item"><i class="sym">&#245;</i> Increased display 4-20 times</div>
				<div class="item"><i class="sym">&#245;</i> Displays at the top of the category</div>
				<div class="item"><i class="sym">&#245;</i> Priority in search results</div>
			</div>
		</div>
		-->
		<div class="span9">
			<div class="blc_checkout">
				<form method="post" name="selectTarif" action="<?=$arParams['PATH_TO_ORDER']?>">
					<?=bitrix_sessid_post()?>
					<input type="hidden" value="<?=intval($_REQUEST['CODE'])?>" name="ad_id">
					<input type="hidden" value="Y" name="add_order_for_ad">
					<div class="cnt_tariff">
						<div class="wdt_addsumm"><?//in verstka here was class="wdt_time"?>
							<div class="tit"><?=GetMessage('BBS_SELECT_TARIF');?>:</div>
							
							<?foreach($arResult['ITEMS'] as $tarif):?>
								<div class="unit">
									<input name="tarif" type="radio" value="<?=$tarif['ID']?>" id="<?=$tarif['ID']?>">
									<label for="<?=$tarif['ID']?>"><?=$tarif['NAME']?> (<?=$tarif['PRICE']['PRINT_VALUE']?>)</label>
								</div>
							<?endforeach;?>
							
							<!--
							<div class="summ">
								<div class="inner">
									<div class="summa"><strong>49.00</strong> rubles</div>
									<p>including all taxes</p>
								</div>
							</div>
							-->
							<div class="clear"></div>
						</div>
						
					</div><!-- /cnt_tariff -->
					<div class="buttons">
						<!--
						<div class="agree">
							<input name="" type="checkbox" value="" id="agreeID">
							<label for="agreeID">I accept the terms of use</label>
						</div>
						-->
						<button class="b-action"><?=GetMessage('BBS_CONTINUE');?> <span class="sym">&#215;</span></button>
					</div>
				</form>
			</div><!-- /blc_checkout -->
		</div>
	</div>
</section><!-- /blc_add -->
<?//echo "<pre>";	print_r($arResult);	echo "</pre>";?>
