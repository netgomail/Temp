<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
$APPLICATION->SetPageProperty("title", $arResult[$arParams['BROWSER_TITLE']]);
$APPLICATION->SetTitle($arResult[$arParams['BROWSER_TITLE']]);
?>