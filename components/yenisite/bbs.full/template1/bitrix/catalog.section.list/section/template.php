<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult['SECTIONS'])): ?>
<div class="row-fluid announcements1">
<img src="<?=$templateFolder?>/img/triangle.png" alt="">

<?$columns = array(1,2,3,4);?>
<?foreach($columns as $cn):?>
	<div class="span3">
	<ul>
	<?foreach($arResult['COLUMN_'.$cn] as $key=>$arItem):?>
		<li><a href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a></li>
	<?endforeach?>
	</ul>
	</div>
<?endforeach?>

</div>
<?endif;?>
<?//echo "<pre>";	print_r($arResult);	echo "</pre>";?>