<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult as $key=>$arItem):?>
	<a href="<?=$arItem['LINK']?>" ><?=$arItem['TEXT']?></a>
<?endforeach?>
