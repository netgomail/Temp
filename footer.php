<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="ads_bottom clearfix">
	<?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/adv_bottom.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?>
</div>

</div>
<!-- #wrapper -->
</div>
<!-- #container -->


<!-- *************** Start of Footer *************** -->
<footer>
	<div class="container">
		<section class="blc_social">
			<div class="row-fluid">
				<div class="span9">
					<div class="name"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/share_text.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?></div>
					<div class="share"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/share_link.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?></div>
				</div>
				<div class="span3 social">
					<div class="name"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/soc_text.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?></div>
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/soc_icons.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?>
					
				</div>
			</div>
		</section><!-- /blc_social -->
		<section class="blc_menu">
			<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
				"ROOT_MENU_TYPE" => "bottom",	//     
				"MAX_LEVEL" => "1",	//   
				"CHILD_MENU_TYPE" => "",	//     
				"USE_EXT" => "N",	//      ._.menu_ext.php
				"MENU_CACHE_TYPE" => "A",	//  
				"MENU_CACHE_TIME" => "604800",	//   (.)
				"MENU_CACHE_USE_GROUPS" => "Y",	//   
				"MENU_CACHE_GET_VARS" => "",	//   
				),
				false
			);?>
		</section><!-- /blc_menu -->
		<section class="blc_footer">
			<div class="row-fluid finfo clearfix">
				<div class="span3">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/copy.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?>
				</div>
				<div class="span4">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/adress.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?>
				</div>
				<div class="span3 phone">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/phone.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?>
				</div>
				<!--
				<div class="span2 lang">
					<a href="#" class="en">in english  <i class="sym">{</i></a>
				</div>
				-->
			</div>
		
			<div class="row-fluid fdisc">
				<div class="span9">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/footer_text.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?>
					 
				</div>
				<div class="span3">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/count.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?>
				</div>
			</div>
		</section><!-- /blc_footer -->
	</div>
</footer>
<!-- *************** / End of Footer *************** -->

	<!-- LOGIN -->
	<div id="login" class="modal hide fade container authorization">
		<?$APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "popup", Array(), false);?>
	</div>
	<!-- /LOGIN -->
	<!-- SETTINGS -->
	<div id="setting" class="modal hide fade container authorization">
		<div class="modal-header">
	    	<button type="button" class="btn-icon close sym" data-dismiss="modal" aria-hidden="true">&#205;</button>
		    <h3 class="head"><?=GetMessage('SETTINGS_PANEL')?></h3>
		</div>
		<div class="modal-body">
			<form action="<?=$APPLICATION->GetCurUri()?>" method="post" class="auth-form">
				<h4><?=GetMessage('SETTINGS_COLOR_SCHEME')?></h4>
				<?=bitrix_sessid_post()?>
				<div class="input control-group">
					<input class="button b-action" style="background: linear-gradient(to bottom, #063076 0%, #063076 100%);" type="submit" name="color" value="royal">
				</div>
				<div class="input control-group">
					<input class="button b-action" style="background: linear-gradient(to bottom, #961E3C 0%, #961E3C 100%);" type="submit" name="color" value="cherry">
				</div>
				<div class="input control-group">
					<input class="button b-action" style="background: linear-gradient(to bottom, #5A322D 0%, #5A322D 100%);" type="submit" name="color" value="papaya">
				</div>
				<div class="input control-group">
					<input class="button b-action" style="background: linear-gradient(to bottom, #206658 0%, #206658 100%);" type="submit" name="color" value="fern">
				</div>
				<div class="input control-group">
					<input class="button b-action" style="background: linear-gradient(to bottom, #424549 0%, #424549 100%);" type="submit" name="color" value="swamp">
				</div>
				
			</form>
		</div>
	</div>
<?
	if(file_exists($_SERVER['DOCUMENT_ROOT'].SITE_DIR."include_areas/settings_demo.php")){
		include $_SERVER['DOCUMENT_ROOT'].SITE_DIR."include_areas/settings_demo.php";
		$showPanel = $isDemo;
	} else {
		global $USER;
		$showPanel = $USER->IsAdmin();
	}

	if ($showPanel):?>
	<a id="ys-settings-head" data-toggle="modal" href="#setting" >
		<button onClick="slideScreenUp();" class="button b-action" style="padding-top: 15px;">
			<i class="sym" style="font-size: 36px;" >&#094;</i>
		</button>
	</a>

	<?endif?>
	<!-- /SETTINGS -->
<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/flashmessage.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?>
</body>
</html>