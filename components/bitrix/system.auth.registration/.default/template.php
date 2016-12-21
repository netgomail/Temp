<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<section class="blc_login">
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?else:?>

<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
<!--noindex-->

<div class="heading"><h1><?$APPLICATION->ShowTitle();?></h1></div>

<form class="form-horizontal" method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="REGISTRATION" />


	<div class="control-group">
		<label class="control-label" for="USER_NAME"><?=GetMessage("AUTH_NAME")?>:</label>
		<div class="controls">
			<input id="USER_NAME" type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="input-xlarge" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="USER_LAST_NAME"><?=GetMessage("AUTH_LAST_NAME")?>:</label>
		<div class="controls">
			<input id="USER_LAST_NAME" type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" class="input-xlarge" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="USER_LOGIN"><?=GetMessage("AUTH_LOGIN_MIN")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_LOGIN" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" class="input-xlarge" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="USER_PASSWORD"><?=GetMessage("AUTH_PASSWORD_REQ")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_PASSWORD" type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="input-xlarge" />
			<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
				<script type="text/javascript">
				document.getElementById('bx_auth_secure').style.display = 'inline-block';
				</script>
			<?endif?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="USER_CONFIRM_PASSWORD"><?=GetMessage("AUTH_CONFIRM")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_CONFIRM_PASSWORD" type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="input-xlarge" />
		</div>
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="USER_EMAIL"><?=GetMessage("AUTH_EMAIL")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_EMAIL" type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="input-xlarge" />
		</div>
	</div>
	
<?// ********************* User properties ***************************************************?>
<?/*if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<tr><td colspan="2"><?=strLen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<tr><td><?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif;?>
		<?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
	<?endforeach;?>
<?endif;*/?>
<?// ******************** /User properties ***************************************************

	/* CAPTCHA */
	if ($arResult["USE_CAPTCHA"] == "Y")
	{
		?>
		<div class="control-group">
			<label class="control-label" for="USER_EMAIL"><b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b></label>
			<div class="controls">
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="captcha_word"><?=GetMessage("CAPTCHA_REGF_PROMT")?><em>*</em>:</label>
			<div class="controls">
				<input id="captcha_word" type="text" name="captcha_word" maxlength="50" value="" class="input-xlarge" />
			</div>
		</div>
		<?
	}
	/* CAPTCHA */
	?>
	<div class="important"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></div>
	
	<div class="important"><i class="sym">&#0092;</i> <?=GetMessage("BBS_IMPORTANT")?></div>
	
	<div class="control-group">
		<div class="controls">
			<input class="b-action" type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" />
		</div>
	</div>


	<!--
	<div class="control-group">
		<div class="controls">
			<p>
				<a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a>
			</p>
		</div>
	</div>
	-->
</form>
<!--/noindex-->
<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>

<?endif?>

</section>