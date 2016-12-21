<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));?>


<a name="order_form"></a>

<div id="order_form_div" class="order-checkout">
<NOSCRIPT>
	<div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
</NOSCRIPT>

<?
if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
{
	if(!empty($arResult["ERROR"]))
	{
		foreach($arResult["ERROR"] as $v)
			echo ShowError($v);
	}
	elseif(!empty($arResult["OK_MESSAGE"]))
	{
		foreach($arResult["OK_MESSAGE"] as $v)
			echo ShowNote($v);
	}

	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
}
else
{
	?>
	<section class="blc_ordered">
	<div class="row-fluid">
		<div class="span12">
			<div class="pathway">
				<ul>
					<li class="done"><span class="unit"><span class="ins"><?=GetMessage("BBS_NEW_AD")?></span></span></li>
					<li class="done"><span class="unit"><span class="ins"><?=GetMessage("BBS_SELECT_OPTIONS")?></span></span></li>
					<li class="active"><span class="unit"><span class="ins"><?=GetMessage("BBS_PAYMENT")?></span></span></li>
				</ul>
			</div>
	<?
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
	{
		if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			?>
			<script type="text/javascript">
			window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';

			</script>
			<?
			die();
		}
		else
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
		}
	}
	else
	{
		?>
		<script type="text/javascript">
		function submitForm(val)
		{
			if(val != 'Y')
				BX('confirmorder').value = 'N';

			var orderForm = BX('ORDER_FORM');

			BX.ajax.submitComponentForm(orderForm, 'order_form_content', true);
			BX.submit(orderForm);

			return true;
		}

		function SetContact(profileId)
		{
			BX("profile_change").value = "Y";
			submitForm();
		}
		</script>
		
	
		<?if($_POST["is_ajax_post"] != "Y")
		{
			?><form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" class="form-horizontal">
			<div class="blc_info">
			<?=bitrix_sessid_post()?>
			<div id="order_form_content">
			<?
		}
		else
		{
			$APPLICATION->RestartBuffer();
		}
		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
		?><?
		if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
		{
			foreach($arResult["ERROR"] as $v)
				echo ShowError($v);

			?>
			<script type="text/javascript">
				top.BX.scrollToNode(top.BX('ORDER_FORM'));
			</script>
			<?
		}

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");

		if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
		}
		else
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
		}
		
		?>
			<br /><br />
			<div class="title"><?=GetMessage("SOA_TEMPL_SUM_ADIT_INFO")?></div>

			<table class="sale_order_table">
				<tr>
					<td class="order_comment">
						<div><?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?></div>
						<textarea name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
					</td>
				</tr>
			</table>		
		<?
		
		if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
			echo $arResult["PREPAY_ADIT_FIELDS"];
		?>
		<?if($_POST["is_ajax_post"] != "Y")
		{
			?>
				
				
				</div>	
					
				<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
				<input type="hidden" name="profile_change" id="profile_change" value="N">
				<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
				<?if(isset($_REQUEST['ad_id']) && $arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_ACCOUNT"] === false):?>
					<div class="important"><span class="sym">&#0092;</span><?=GetMessage('BBS_NOT_ENOUGH_MONEY');?>
						<a target="_blank" href="<?=SITE_DIR?>personal/payment/"><?=GetMessage('BBS_PERSONAL');?></a>
					</div>
				<?else:?>
						<div class="important"><span class="sym">&#0092;</span><?=GetMessage('BBS_IMPORTANT');?></div>
				<div class="control-group">
					<div class="controls">
							<input type="button" name="submitbutton" onClick="submitForm('Y');" value="<?=GetMessage("SOA_TEMPL_BUTTON")?>" class="b-action">
					</div>
				</div>
				<?endif?>
				</div><!-- /blc_info -->
			</form>
			<?
			if($arParams["DELIVERY_NO_AJAX"] == "N")
			{
				$APPLICATION->AddHeadScript("/bitrix/js/main/cphttprequest.js");
				$APPLICATION->AddHeadScript("/bitrix/components/bitrix/sale.ajax.delivery.calculator/templates/.default/proceed.js");
			}
		}
		else
		{
			?>
			<script type="text/javascript">
				top.BX('confirmorder').value = 'Y';
				top.BX('profile_change').value = 'N';
			</script>
			<?
			die();
		}
	
	}
	?>
		</div><!-- /span12 -->
		</div>	<!-- /row-fluid -->		
	</section><!-- /blc_ordered -->
	<?
}
?>
		

</div><!-- /order_form_div -->

