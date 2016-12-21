<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
<!--
function ChangeGenerate(val)
{
	if(val)
	{
		document.getElementById("sof_choose_login").style.display='none';
	}
	else
	{
		document.getElementById("sof_choose_login").style.display='block';
		document.getElementById("NEW_GENERATE_N").checked = true;
	}

	try{document.order_reg_form.NEW_LOGIN.focus();}catch(e){}
}
//-->
</script>
<section class="blc_login">
<table class="order-auth">
	<tr>
		<td>
			<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
				<h3><b><?echo GetMessage("STOF_2REG")?></b></h3>
			<?endif;?>
		</td>
		<td>
			<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
				<h3><b><?echo GetMessage("STOF_2NEW")?></b></h3>
			<?endif;?>
		</td>
	</tr>
	<tr>
		<td>
			<form method="post" action="" name="order_auth_form" class="auth-form">
				<?=bitrix_sessid_post()?>
				<?
				foreach ($arResult["POST"] as $key => $value)
				{
				?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
				<?
				}
				?>
				<div class="control-group">
					<label class="control-label" for="USER_LOGIN"><?echo GetMessage("STOF_LOGIN")?><em>*</em>:</label>
					<div class="controls">
						<input id="USER_LOGIN" name="USER_LOGIN" maxlength="30" type="text" value="<?=$arResult["AUTH"]["USER_LOGIN"]?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="USER_PASSWORD"><?echo GetMessage("STOF_PASSWORD")?><em>*</em>:</label>
					<div class="controls">
						<input id="USER_PASSWORD" name="USER_PASSWORD" maxlength="30" type="password" value="<?=$arResult["AUTH"]["USER_LOGIN"]?>">
					</div>
				</div>
				
				<a href="<?=$arParams["PATH_TO_AUTH"]?>?forgot_password=yes&back_url=<?= urlencode($APPLICATION->GetCurPageParam()); ?>"><?echo GetMessage("STOF_FORGET_PASSWORD")?></a>
	
				<div class="important" style="margin-left:0px" ><i class="sym">&#0092;</i><?=GetMessage('BBS_IMPORTANT');?></div>
				<div class="control-group">
					<div class="controls">
						<div class="manage_buttons">
							<input class="b-action" type="submit" value="<?echo GetMessage("STOF_NEXT_STEP")?>">
							<input type="hidden" name="do_authorize" value="Y">
						</div>
					</div>
				</div>
			</form>
		</td>		
		<td>
			<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
				<form method="post" action="" name="order_reg_form" class="auth-form">
					<?=bitrix_sessid_post()?>
					<?
					foreach ($arResult["POST"] as $key => $value)
					{
					?>
					<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
					<?
					}
					?>
					
					<div class="control-group">
						<label class="control-label" for="NEW_NAME"><?echo GetMessage("STOF_NAME")?>:</label>
						<div class="controls">
							<input id="NEW_NAME" name="NEW_NAME" maxlength="30" type="text" value="<?=$arResult["AUTH"]["NEW_NAME"]?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="NEW_LAST_NAME"><?echo GetMessage("STOF_LASTNAME")?>:</label>
						<div class="controls">
							<input id="NEW_LAST_NAME" name="NEW_LAST_NAME" maxlength="30" type="text" value="<?=$arResult["AUTH"]["NEW_LAST_NAME"]?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="NEW_EMAIL">E-Mail<em>*</em>:</label>
						<div class="controls">
							<input id="NEW_EMAIL" name="NEW_EMAIL" maxlength="30" type="text" value="<?=$arResult["AUTH"]["NEW_EMAIL"]?>">
						</div>
					</div>
					<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
					<div class="control-group">
						<div class="controls">
							<input id="NEW_GENERATE_N" name="NEW_GENERATE" maxlength="30" type="radio" value="N" OnClick="ChangeGenerate(false)"<?if ($_POST["NEW_GENERATE"] == "N") echo " checked";?>>
							<label class="control-label" for="NEW_GENERATE_N"><?echo GetMessage("STOF_MY_PASSWORD")?>:</label>
						</div>
						<div class="controls">
							<input id="NEW_GENERATE_Y" name="NEW_GENERATE" maxlength="30" type="radio" value="Y" OnClick="ChangeGenerate(true)"<?if ($POST["NEW_GENERATE"] != "N") echo " checked";?>>
							<label class="control-label" for="NEW_GENERATE_Y"><?=GetMessage("STOF_SYS_PASSWORD")?></label>
							
						</div>
					</div>
					<?endif;?>
					<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
						<div id="sof_choose_login">
					<?endif;?>
					<div class="control-group">
						<label class="control-label" for="NEW_LOGIN"><?=GetMessage("STOF_LOGIN")?><em>*</em>:</label>
						<div class="controls">
							<input id="NEW_LOGIN" name="NEW_LOGIN" maxlength="30" type="text" value="<?=$arResult["AUTH"]["NEW_LOGIN"]?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="NEW_PASSWORD"><?=GetMessage("STOF_PASSWORD")?><em>*</em>:</label>
						<div class="controls">
							<input id="NEW_PASSWORD" name="NEW_PASSWORD" maxlength="30" type="password" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="NEW_PASSWORD_CONFIRM"><?=GetMessage("STOF_RE_PASSWORD")?><em>*</em>:</label>
						<div class="controls">
							<input id="NEW_PASSWORD_CONFIRM" name="NEW_PASSWORD_CONFIRM" maxlength="30" type="password" >
						</div>
					</div>
					
					<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
						</div>
					<?endif;?>
					<script language="JavaScript">
						<!--
						ChangeGenerate(<?= (($_POST["NEW_GENERATE"] != "N") ? "true" : "false") ?>);
						//-->
					</script>
					
					<?if($arResult["AUTH"]["captcha_registration"] == "Y"): //CAPTCHA?>
					<div class="control-group">
						<b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["AUTH"]["capCode"]?>">
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["AUTH"]["capCode"]?>" width="180" height="40" alt="CAPTCHA">
						
					</div>
					<div class="control-group">
						<label class="control-label" for="captcha_word"><?=GetMessage("CAPTCHA_REGF_PROMT")?><em>*</em>:</label>
						<div class="controls">
							<input id="captcha_word" name="captcha_word" maxlength="30" type="text" value="">
						</div>
					</div>
					<?endif;?>
					<div class="important" style="margin-left:0px" ><i class="sym">&#0092;</i><?=GetMessage('BBS_IMPORTANT');?></div>
					<div class="control-group">
						<div class="controls">
							<div class="manage_buttons">
								<input class="b-action" type="submit" value="<?echo GetMessage("STOF_NEXT_STEP")?>">
								<input type="hidden" name="do_register" value="Y">
							</div>
						</div>
					</div>
				</form>
			<?endif;?>
		</td>
	</tr>
</table>
</section>

