<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<section class="blc_login">
<div class="heading"><h1><?$APPLICATION->ShowTitle();?></h1></div>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<form class="form-horizontal" method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
	<?if (strlen($arResult["BACKURL"]) > 0): ?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<? endif ?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="CHANGE_PWD">
	
	<!--
	<div class="control-group">
		<div class="controls">
			<b><?=GetMessage("AUTH_CHANGE_PASSWORD")?></b>
		</div>
	</div>
	-->
	<div class="control-group">
		<label class="control-label" for="USER_LOGIN"><?=GetMessage("AUTH_LOGIN")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_LOGIN" class="input-xlarge" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="USER_CHECKWORD"><?=GetMessage("AUTH_CHECKWORD")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_CHECKWORD" class="input-xlarge" type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="USER_PASSWORD"><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_PASSWORD" class="input-xlarge" type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>"/>
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
		<label class="control-label" for="USER_CONFIRM_PASSWORD"><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_CONFIRM_PASSWORD" class="input-xlarge" type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" />
		</div>
	</div>
		
	<div class="important"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></div>
	
	<div class="important"><i class="sym">&#0092;</i> <?=GetMessage("BBS_IMPORTANT")?></div>		
	
	<div class="control-group">
		<div class="controls">
			<input class="b-action" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
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

<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
</section>