<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<!doctype html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?// new string ?>
    <?IncludeTemplateLangFile(__FILE__);?>
    <?$APPLICATION->ShowHead()?>
    <title><?$APPLICATION->ShowTitle()?></title>

<!-- Commit -->
<?if(!CModule::IncludeModule("yenisite.bbs") && !CModule::IncludeModule('yenisite.bbslite'))
{
	return false;
}
?>
<?include $_SERVER['DOCUMENT_ROOT'].SITE_DIR."include_areas/settings_demo.php";
global $USER;
$showPanel = ($isDemo ? true : $USER->IsAdmin());
?>
<?
	if( in_array($_POST['color'], array('royal', 'cherry', 'papaya', 'fern', 'swamp')) && check_bitrix_sessid()
		&& $showPanel)
	{
		CYSBbs::SetColorSheme($_POST['color']);
		unset($_POST['color']);
	}
?>
 <?/*
   <link rel="stylesheet/less" type="text/css" href="./bootstrap/bootstrap.min.css">
<!-- <link rel="stylesheet/less" type="text/css" href="bootstrap/less/responsive.less"> -->
<link rel="stylesheet/less" type="text/css" href="bootstrap/bootstrap-responsive.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet/less" type="text/css" href="less/styles.less">
<script src="js/lib/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="js/lib/jquery-migrate-1.1.1.min.js"></script>
<script src="js/lib/bootstrap.min.js"></script>
<script src="js/lib/less-1.3.3.min.js"></script>
<script src="js/lib/jquery.jcarousel.min.js"></script>
<script src="js/script.js"></script>
*/?>
<?$APPLICATION->AddHeadString('<link rel="stylesheet/less" type="text/css" href="'.SITE_TEMPLATE_PATH.'/bootstrap/bootstrap.min.css">');?>
<!-- <link rel="stylesheet/less" type="text/css" href="bootstrap/less/responsive.less"> -->
<?$APPLICATION->AddHeadString('<link rel="stylesheet/less" type="text/css" href="'.SITE_TEMPLATE_PATH.'/bootstrap/bootstrap-responsive.css">');?>
<?$APPLICATION->AddHeadString('<link rel="stylesheet/less" type="text/css" href="'.SITE_TEMPLATE_PATH.'/css/style.css">');?>
<?$APPLICATION->AddHeadString('<link rel="stylesheet/less" type="text/css" href="'.SITE_TEMPLATE_PATH.'/less/styles.less?'.filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/less/styles.less').'">');?>

<?
CJSCore::Init(array('jquery'));
$APPLICATION->AddHeadScript("http://code.jquery.com/ui/1.10.3/jquery-ui.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/lib/bootstrap.min.js");
$APPLICATION->AddHeadString('<script src="'.SITE_TEMPLATE_PATH.'/js/lib/less-1.3.3.min.js" data-skip-moving="true"></script>');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/lib/jquery.jcarousel.min.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/lib/jquery-migrate-1.2.1.min.js");
?>

</head>

<body>
<div class="panel"><?$APPLICATION->ShowPanel();?></div>

<div id="ads_top"><div class="container-fluid"><?
if(CModule::IncludeModule("advertising"))
{
	$APPLICATION->IncludeComponent("bitrix:advertising.banner", ".default", array(
		"TYPE" => "top",
		"NOINDEX" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
		),
		false
	);
}?>
		</div></div>
<div id="site"></div>
<div class="container">

<!-- *************** Start of Header *************** -->
	<header>
		<a data-toggle="modal" href="<?=SITE_DIR?>" id="logo" class="ir">advertique</a>
		<h2><?$APPLICATION->IncludeComponent("bitrix:main.include", "",
		Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/right_logo.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false);?></h2>
		<div class="wdt_user navbar">
			<?global $USER;
			if(!$USER->IsAuthorized()):?>
				<div class="signin">
					<a class="button b-login" data-toggle="modal" href="#login"><i class="sym">&#0046;</i><?=GetMessage('LOGIN')?></a>
				</div>
			<?else:?>
				<div class="login show">
					<a href="#" class="uid" data-toggle="dropdown"><i class="sym">&#0046;</i><span class="name"><?=$USER->GetFullName()." [".$USER->GetLogin()."]"?></span> <span class="sym">{</span></a>
					<ul class="user_menu dropdown-menu nav-pills">
						<!--<li><a href="<?=SITE_DIR?>personal/profile/"><i class="sym">&#0046;</i><?=GetMessage('PROFILE')?></a></li>-->
						<li><a href="<?=SITE_DIR?>personal/my_ads/"><i class="sym">&#0066;</i><?=GetMessage('ADS')?></a></li>
						<?if(CYSBbsInit::getEdition() == 'MASTER'):?>
							<li><a href="<?=SITE_DIR?>personal/payment/"><i class="sym">&#0089;</i><?=GetMessage('PAYMENT')?></a></li>
						<?endif?>
						<!--<li><a href="<?=SITE_DIR?>personal/message/"><i class="sym">&#0056;</i><?=GetMessage('MESSAGES')?></a></li>-->
						<!--<li><a href="<?=SITE_DIR?>personal/favorites/"><i class="sym">&#0116;</i><?=GetMessage('FAVORITES')?></a></li>-->
						<li><a href="<?=SITE_DIR?>personal/settings/"><i class="sym fs13">&#094;</i><?=GetMessage('SETTINGS')?></a></li>
						<li><a href="?logout=yes"><i class="sym fs15">&#0096;</i><?=GetMessage('EXIT')?></a></li>
					</ul>
				</div>
			<?endif;?>
		</div>
	</header>
<!-- *************** / End of Header *************** -->
<div id="wrapper">
