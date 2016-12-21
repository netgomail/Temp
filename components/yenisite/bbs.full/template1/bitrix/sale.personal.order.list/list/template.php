<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section id="cab_payment">
	<div class="blc_th">
		<div class="row-fluid">
			<div class="span2"><?=GetMessage("SPOL_DATE")?></div>
			<div class="span1"><?=GetMessage("SPOL_T_F_ID")?></div>
			<div class="span3"><?=GetMessage("SPOL_TITLE")?></div>
			<div class="span2"><?=GetMessage("SPOL_T_PRICE")?></div>
			<div class="span2"><?=GetMessage("SPOL_T_PAY_SYS")?></div>
			<div class="span1"><?=GetMessage("SPOL_T_PAYED")?></div>
			<div class="span1"><?=GetMessage("SPOL_T_CANCELED")?></div>
		</div>
	</div>
	
	<div class="blc_products">
		<?foreach($arResult["ORDERS"] as $val):?>
		<div class="announcement">
			<div class="row-fluid">
				<div class="span2">
					<div class="date"><?=$val["ORDER"]["DATE_INSERT_FORMAT"]?></div>
				</div>
				<div class="span1">
					<div class="number"><?=$val["ORDER"]["ID"]?></div>
				</div>
				<div class="span3">
					<?foreach($val["BASKET_ITEMS"] as $vval):?>
					<div class="spine">
						<div class="tit">
						<?if (strlen($vval["DETAIL_PAGE_URL"])>0):?>
							<a href="<?=$vval["DETAIL_PAGE_URL"]?>"><?=$vval["NAME"]?></a>
						<?else:?>
							<?=$vval["NAME"]?>
						<?endif?>
						</div>
						<!--<p>Top ads until January 3</p>-->
					</div>
					<?endforeach?>
				</div>
				<div class="span2">
					<div class="price"><?=str_replace(GetMessage('RUB_REPLACE'), '<span class="rubl">'.GetMessage('RUB').'</span>',  $val["ORDER"]["FORMATED_PRICE"]);?></div>
				</div>
				<div class="span2">
					<?=$arResult["INFO"]["PAY_SYSTEM"][$val["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?>
				</div>
				<div class="span1">
					<?=(($val["ORDER"]["PAYED"]=="Y") ? GetMessage("SPOL_T_YES") : GetMessage("SPOL_T_NO"))?>
				</div>
				<div class="span1">
					<?=(($val["ORDER"]["CANCELED"]=="Y") ? GetMessage("SPOL_T_YES") : GetMessage("SPOL_T_NO"))?>
				</div>
			</div>
		</div>
		<?endforeach?>
	</div><!-- /blc_products -->
	
</section><!-- /cab_payment -->
