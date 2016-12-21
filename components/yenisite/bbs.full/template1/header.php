<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<section class="blc_toolbar clearfix">
		<!-- GEO.IP -->
		<?
		if($arParams['GEOLOCATIONS_ENABLE'] === 'Y')
		{
			if ( CModule::IncludeModule('yenisite.geoip') )
			{
				$template = $arParams['SHOW_GEOIP'] == 'Y' ? 'bbs' : 'empty';
				$APPLICATION->IncludeComponent("yenisite:geoip.city", $template, array(
					"CACHE_TYPE" => $arParams['CACHE_TYPE'],
					"CACHE_TIME" => $arParams['CACHE_TIME'],
					"AUTOCONFIRM" => "Y",
					"DISABLE_CONFIRM_POPUP" => "Y"
					),
					$component
				);			
			}		
			include 'include/geo_location.php';
		}
		?>
		<!-- SEARCH -->
		

		<div class="row-fluid">
			<?$APPLICATION->IncludeComponent("bitrix:search.title", ".default", array(
				"NUM_CATEGORIES" => "1",
				"TOP_COUNT" => "5",
				"ORDER" => "date",
				"USE_LANGUAGE_GUESS" => "Y",
				"CHECK_DATES" => "N",
				"SHOW_OTHERS" => "N",
				"PAGE" => $arResult['PATH_TO_SEARCH_PAGE'],
				//"CATEGORY_0_TITLE" => "ADS",
				"CATEGORY_0" => array(
					0 => "iblock_".$arParams['IBLOCK_TYPE'],
				),
				"CATEGORY_0_iblock_".$arParams['IBLOCK_TYPE'] => array(
					0 => $arParams['IBLOCK_ID'],
				),
				"SHOW_INPUT" => "Y",
				"INPUT_ID" => "title-search-input",
				"CONTAINER_ID" => "title-search"
				),
				$component
			);?>

			<div class="span3">
				<a href="<?=$arResult['PATH_TO_ADD_AD']?>" class="button b-request b-request-header"> <i class="sym">&#193;</i> <?=GetMessage('BTN_ADD')?></a>
			</div>
		</div>
		<!-- /SEARCH -->
</section><!-- /blc_toolbar -->

<?// echo "<pre>";	print_r($arResult);	echo "</pre>";?>