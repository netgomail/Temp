<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul id="mainmenu"> 
<?foreach($arResult as $key=>$arItem):?>
	<?$is_parent = false;?>
	<?if (array_key_exists("ITEMS", $arItem) && count($arItem["ITEMS"]) > 0):?>
		<?$is_parent = true;?>
	<?endif;?>
	<li><a href="<?=$arItem['SECTION_PAGE_URL']?>" class="m m_<?=$arItem['CLASS']?>" <?if ($is_parent):?>data-toggle="dropdown"<?endif?>><?=$arItem['NAME']?></a>
	
	<?if ($is_parent):?>
		<ul class="dropdown-menu nav-pills columnize" data-columns="2">
		<?foreach ($arItem["ITEMS"] as $arSubItem):?>
			<?if($arSubItem['DEPTH_LEVEL']==2):?>
				<li><a href="<?=$arSubItem['SECTION_PAGE_URL']?>" ><?=$arSubItem['NAME']?><!--<span class="count">423</span>--></a></li>
			<?endif;?>
		<?endforeach?>
		</ul>
	<?endif;?>
	</li>
<?endforeach?>
</ul>