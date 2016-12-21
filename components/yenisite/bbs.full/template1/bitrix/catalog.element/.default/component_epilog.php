<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
$APPLICATION->SetPageProperty("title", $arResult['NAME']);
$APPLICATION->SetTitle($arResult['NAME']);

$content = ob_get_clean(); //Start buffer in ../../../element.php
ob_start();

if ($arResult['CREATED_BY'] == $GLOBALS['USER']->GetID() && CModule::IncludeModule('catalog') && CModule::IncludeModule('yenisite.bbs')):?>
<?Bitrix\Main\Localization\Loc::loadLanguageFile(__FILE__)?>

<?$bActive = ($arResult['PROPERTIES']['TOP']['VALUE'] == 'Y' && empty($arResult['PROPERTIES']['TOP_DATE']['VALUE']))?>
<button class="b-gray button7<?=$bActive?' active" disabled="disabled':''?>"><span class="s i_top"></span>
	<?if($arResult['PROPERTIES']['TOP']['VALUE'] == 'Y'):?>
		<?=GetMessage('OPTION_TOP')?>
		<?if (!empty($arResult['PROPERTIES']['TOP_DATE']['VALUE'])):?>
			<?=GetMessage('OPTION_TO')?> <?=$arResult['PROPERTIES']['TOP_DATE']['VALUE']?> (<?=GetMessage('OPTION_EXTEND')?>)
		<?endif?>
	<?else:?>
		<?=GetMessage('BTN_PLACE_ON_TOP');?>
	<?endif?>
</button>

<?$bActive = ($arResult['PROPERTIES']['URGENT']['VALUE'] == 'Y' && empty($arResult['PROPERTIES']['URGENT_DATE']['VALUE']))?>
<button class="b-gray button7<?=$bActive?' active" disabled="disabled':''?>"><span class="s i_quickly"></span>
	<?if($arResult['PROPERTIES']['URGENT']['VALUE'] == 'Y'):?>
		<?=GetMessage('OPTION_URGENT')?>
		<?if (!empty($arResult['PROPERTIES']['URGENT_DATE']['VALUE'])):?>
			<?=GetMessage('OPTION_TO')?> <?=$arResult['PROPERTIES']['URGENT_DATE']['VALUE']?> (<?=GetMessage('OPTION_EXTEND')?>)
		<?endif?>
	<?else:?>
		<?=GetMessage('BTN_MAKE_URGENT');?>
	<?endif?>
</button>

<?$bActive = ($arResult['PROPERTIES']['HIGHLIGHT']['VALUE'] == 'Y' && empty($arResult['PROPERTIES']['HIGHLIGHT_DATE']['VALUE']))?>
<button class="b-gray button7<?=$bActive?' active" disabled="disabled':''?>"><span class="s i_pick"></span>
	<?if($arResult['PROPERTIES']['HIGHLIGHT']['VALUE'] == 'Y'):?>
		<?=GetMessage('OPTION_HIGHLIGHT')?>
		<?if (!empty($arResult['PROPERTIES']['HIGHLIGHT_DATE']['VALUE'])):?>
			<?=GetMessage('OPTION_TO')?> <?=$arResult['PROPERTIES']['HIGHLIGHT_DATE']['VALUE']?> (<?=GetMessage('OPTION_EXTEND')?>)
		<?endif?>
	<?else:?>
		<?=GetMessage('BTN_DISTINGUISH');?>
	<?endif?>
</button>

<button class="b-gray button7"><span class="s i_up"></span> <?=GetMessage('BTN_PICK_UP');?></button>
<?endif;

$replace = ob_get_clean();
//replace macros in template.php
echo str_replace('#BBS_ITEM_BUTTONS#', $replace, $content);
?>