<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$AUTH_RESULT = $APPLICATION->arAuthResult;	//Get result of all actions related to the authorization

?>
<div class="modal-header">
   	<button type="button" class="btn-icon close sym" data-dismiss="modal" aria-hidden="true">&#205;</button>
    <h3 class="head"><?=GetMessage('AUTH');?></h3>
</div>
<div class="modal-body">
	<?
	if(!empty($AUTH_RESULT["MESSAGE"]))
	{
		ShowError($AUTH_RESULT["MESSAGE"]);
	}
	?>
	<form class="auth-form" name="form_auth" id='form_auth' method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
		
		<input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />
        <?if (strlen($arResult["BACKURL"]) > 0):?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <?foreach ($arResult["POST"] as $key => $value):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endforeach?>
			
		<div class="input control-group">
			<input type="text" placeholder="<?=GetMessage("AUTH_LOGIN")?>" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>">
			<span class="help-inline"><?=GetMessage("NOT_FILLED")?></span>
		</div>
		<div class="input control-group">
			<input name="USER_PASSWORD" maxlength="255" type="password" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
			<span class="help-inline"><?=GetMessage("NOT_FILLED")?></span>
		</div>
		<?if($arResult["CAPTCHA_CODE"]):?>
            <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
            <label><?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<label><br/>
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />      
			<input class="txt" type="text" name="captcha_word" maxlength="50" value=""  /><br/><br/>
        <?endif;?>
			
		<input type="checkbox" id="USER_REMEMBER_POP" name="USER_REMEMBER" value="Y" /><label for="USER_REMEMBER_POP">&nbsp;<?=GetMessage("AUTH_REMEMBER_ME")?></label>
		<div class="login-controls">
			 			
			<button class="b-action login-btn"><?=GetMessage("AUTH_AUTHORIZE")?></button>
			<div class="login-links">
				<a href="<?=SITE_DIR?>auth/?forgot_password=yes" rel="nofollow" ><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a><br>
				<a href="<?=SITE_DIR?>auth/?register=yes" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>
			</div>
		</div>
		<!--
		<div class="social-controls">
			<hr>
			<div class="lined-header">или</div>
			<div class="social">
				<div class="name">Войдите через соцсети:
					<a href="#" class="sym i_facebook">&#228;</a>
					<a href="#" class="sym i_vk">&#230;</a>
					<a href="#" class="sym i_gplus">&#232;</a>
				</div>
			</div>
		</div>
		-->
	</form>
</div>
		
		
<div>
    
<?
   
    ?>
    
    <?/*
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "popup", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"CURRENT_SERVICE"=>$arResult["CURRENT_SERVICE"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);
*/?>
</div>


