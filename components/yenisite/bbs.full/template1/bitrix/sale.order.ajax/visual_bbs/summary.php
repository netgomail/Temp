<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="blc_prodvice">
<div class="head"><?=GetMessage("SOA_TEMPL_SUM_TITLE")?></div>

<table>
	<tr>
		<th><?=GetMessage("SOA_TEMPL_SUM_NAME")?></th>
		<th><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?></th>
		<th><?=GetMessage("SOA_TEMPL_SUM_QUANTITY")?></th>
		<th><?=GetMessage("SOA_TEMPL_SUM_PRICE")?></th>
	</tr>
	<?
	foreach($arResult["BASKET_ITEMS"] as $arBasketItems)
	{
		?>
		<tr>
			<td><?=$arBasketItems["NAME"]?></td>
			<td><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
			<td><?=$arBasketItems["QUANTITY"]?></td>
			<td class="price"><?=$arBasketItems["PRICE_FORMATED"]?></td>
		</tr>
		<?
	}
	?>

	<tr class="summ">
		<td colspan="3"><span class="right"><?=GetMessage("SOA_TEMPL_SUM_SUMMARY")?></td>
		<td><strong><?=$arResult["ORDER_PRICE_FORMATED"]?></strong></td>
	</tr>
	<?
	if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
	{
		?>
		<tr class="summ">
			<td colspan="3"><span class="right"><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?><?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?> (<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)<?endif;?>:</td>
			<td><strong><?=$arResult["DISCOUNT_PRICE_FORMATED"]?></strong></td>
		</tr>
		<?
	}
	if(!empty($arResult["arTaxList"]))
	{
		foreach($arResult["arTaxList"] as $val)
		{
			?>
			<tr class="summ">
				<td colspan="3"><span class="right"><?=$val["NAME"]?> <?=$val["VALUE_FORMATED"]?>:</td>
				<td><strong><?=$val["VALUE_MONEY_FORMATED"]?></strong></td>
			</tr>
			<?
		}
	}
	
	if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0)
	{
		?>
		<tr class="summ">
			<td colspan="3"><span class="right"><?=GetMessage("SOA_TEMPL_SUM_PAYED")?></td>
			<td><strong><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?></strong></td>
		</tr>
		<?
	}
	?>
	<tr class="summ">
		<td colspan="3"><span class="right"><?=GetMessage("SOA_TEMPL_SUM_IT")?></td>
		<td><strong><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></strong></td>
	</tr>

</table>


</div>