<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

ShowMessage($arParams["~AUTH_RESULT"]);

?>
<section class="blc_login">

	<div class="heading"><h1><?$APPLICATION->ShowTitle();?></h1></div>
	
<form class="form-horizontal" name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
	
	<div class="important">
		<p>	<?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></p>
	</div>
	
	<div class="control-group">
		<div class="controls">
			<b><?=GetMessage("AUTH_GET_CHECK_STRING")?></b>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="USER_LOGIN"><?=GetMessage("AUTH_LOGIN")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_LOGIN" class="input-xlarge" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />&nbsp;<?=GetMessage("AUTH_OR")?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="USER_EMAIL"><?=GetMessage("AUTH_EMAIL")?><em>*</em>:</label>
		<div class="controls">
			<input id="USER_EMAIL" class="input-xlarge" type="text" name="USER_EMAIL" maxlength="255" />
		</div>
	</div>
	
	<div class="important"><i class="sym">&#0092;</i> <?=GetMessage("BBS_IMPORTANT")?></div>
	
	<div class="control-group">
		<div class="controls">
			<input class="b-action" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
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

</section>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
