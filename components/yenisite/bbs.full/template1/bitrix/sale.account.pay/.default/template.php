<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(strlen($arResult["errorMessage"]) > 0)
	ShowError($arResult["errorMessage"]);

?>
<div class="heading"><h1><?=GetMessage("SAP_BUY_MONEY")?></h1></div>
<section class="blc_payments">
	<div class="row-fluid">
		<div class="span9">
			<div class="blc_checkout">
				
				<form method="post" name="buyMoney" action="#">
					<div class="cnt_tariff">
						<div class="wdt_addsumm">
							<div class="tit"><?=GetMessage("SAP_SUMM")?>:</div>
							<?foreach($arResult["AMOUNT_TO_SHOW"] as $v):?>	
								<div class="unit">
							
									<input id="<?=$arParams["VAR"].'_'.$v["ID"]?>" type="radio" name="<?=$arParams["VAR"]?>" value="<?=$v["ID"]?>">
									<label for="<?=$arParams["VAR"].'_'.$v["ID"]?>"><?=$v["NAME"]?></label>
								</div>
							<?endforeach?>
						</div>
					</div>
					<div class="buttons">
							
						<button name="button" type="submit" class="b-action"><?=GetMessage("SAP_BUTTON")?> <span class="sym">&#215;</span></button>
					</div>
				</form>

			</div><!-- /blc_checkout -->
		</div>
	</div>
</section><!-- /blc_cabinet -->