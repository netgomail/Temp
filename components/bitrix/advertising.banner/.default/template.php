<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult["BANNER"] = str_replace('<noindex>','<!--noindex-->',$arResult["BANNER"]);
$arResult["BANNER"] = str_replace('</noindex>','<!--/noindex-->',$arResult["BANNER"]);

$frame = $this->createFrame()->begin("");
    echo $arResult["BANNER"];
$frame->end();