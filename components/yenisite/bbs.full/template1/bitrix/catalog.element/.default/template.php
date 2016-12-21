<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!CModule::IncludeModule('yenisite.resizer2')) die ('please install yenisite.resizer2');
if($arParams['SHOW_AD']):?>
	<div class="row-fluid">
		<div class="span9">
			<div class="blc_heading">
				<div class="item_navi">
					<div class="buttons">
						<button onclick="document.location.href='<?=$arResult['PATH_TO_PARENT_SECTION'];?>'" class="b-gray button6"><i class="sym">&#212;</i> <?=GetMessage('CATALOG_BACK');?> </button>
					</div>
					<div class="heading Breadcrumbs">
						<?=$arResult['ELEMENT_CHAIN'];?>
					</div>
				</div><!-- /item_navi -->
				<div class="item_title">
					<div class="navis">
					<?if($arResult['ELEMENT_PREV']['LINK']):?>
						<div class="item"><i class="sym">&#212;</i> <a href="<?=$arResult['ELEMENT_PREV']['LINK']?>"><?=GetMessage('CATALOG_PREV');?></a></div>
					<?endif;?>
					<?if($arResult['ELEMENT_NEXT']['LINK']):?>
						<div class="item"><i class="sym">&#215;</i> <a href="<?=$arResult['ELEMENT_NEXT']['LINK']?>"><?=GetMessage('CATALOG_NEXT');?></a></div>
					<?endif;?>
					</div>
					<h1><?=$arResult['NAME']?></h1>
				</div>
				<div class="item_meta">
					<div class="data">
						<span class="item"><?if(!empty($arResult['PROPERTIES']['ADDRESS']['VALUE'])):?><i class="sym">&#0117;</i> <?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?><?endif;?></span>
						<span class="item"><?if(!empty($arResult['SHOW_COUNTER'])):?><i class="sym">X</i> <?=$arResult['SHOW_COUNTER']?><?endif;?></span>
						<span class="item"><?=GetMessage('DATE_CREATE');?>: <?=$arResult['DATE_CREATE_TIME'];?>, <?=$arResult['DATE_CREATE_DATE'];?></span>
						<span class="item"><?=GetMessage('NUMBER');?>: <?=$arResult['ID'];?></span>
					</div>
					<?if($arResult['CREATED_BY']==$USER->GetID()):?>
						<div class="buttons">
						<form class="hide" name="edit_ad" method="POST" action="<?=$arResult['PATH_TO_EDIT_AD'];?>">
							<input type="hidden" name="CODE" value="<?=$arResult['ID'];?>">
						</form>
							<button class="b-gray button6" onclick="document.forms['edit_ad'].submit();" ><i class="sym">&#0063;</i> <?=GetMessage('BTN_CHANGE');?></button>
							<!--<button class="b-gray button6"><i class="sym">&#0109;</i> <?=GetMessage('BTN_LEAFLET');?></button>-->
						</div>
					<?endif;?>
				</div>
				<div class="item_buttons">
					#BBS_ITEM_BUTTONS#<?//Replace macros in component_epilog.php?>
				</div>

			</div><!-- /blc_heading -->
			<div class="blc_ditail">
				<div class="row-fluid">
					<div class="span8">
						<div class="gallery">
							<div class="node">
								<a class="yenisite-zoom" href="<?=$arResult['PICTURES'][0]['SRC_BIG']?>">
									<img class="yenisite-detail" src="<?=$arResult['PICTURES'][0]['SRC_MEDIUM']?>"
										 alt="<?=$arResult['PICTURES'][0]['DESCRIPTION']?$arResult['PICTURES'][0]['DESCRIPTION']:$arResult['NAME']?>">
								</a></div>
							<?if(count($arResult['PICTURES'])>1):?>
							<div class="thumbs">
							<?$active = true;?>
								<?foreach($arResult['PICTURES'] as $picture)://class="active"?>

								<a data-big-img="<?=$picture['SRC_BIG'];?>" href="<?=$picture['SRC_MEDIUM'];?>" <?=($active)?'class="active"':''?>><img src="<?=$picture['SRC_ICON'];?>" alt="<?=$picture['DESCRIPTION']?$picture['DESCRIPTION']:$arResult['NAME']?>"> <span></span></a>
								<?$active = false;?>
								<?endforeach?>
							</div>

							<div class="navi">
								<a href="javascript:void(0);" class="sym navi_prev">&#212;</a>
								<a href="javascript:void(0);" class="sym navi_next">&#215;</a>
							</div>
							<?endif;?>
						</div>
					</div>
					<div class="span4">
						<div class="wdt_desc">
							<dl>
								<?foreach($arResult['DISPLAY_PROPERTIES'] as $arProp):?>
									<dt><?=$arProp['NAME']?>:</dt>
									<dd>
										<?//<a href="#">?>
										<?=(is_array($arProp['DISPLAY_VALUE'])) ? implode(' / ', $arProp['DISPLAY_VALUE']) : $arProp['DISPLAY_VALUE']?>
										<?//</a>?>
									</dd>
								<?endforeach?>
							</dl>
							<div class="desc"><?=$arResult['DETAIL_TEXT']?></div>
						</div>
					</div>
				</div>
			</div><!-- /blc_ditail -->

			<?if ('Y' == $arParams['USE_COMMENTS']):?>
				<div class="blc_related blc_comments">
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:catalog.comments",
						"bbs_detail", // there is in /bitrix/components/bitrix/catalog.comments/templates/
						array(
							"ELEMENT_ID" => $arResult['ID'],
							"ELEMENT_CODE" => "",
							"IBLOCK_ID" => $arParams['IBLOCK_ID'],
							"URL_TO_COMMENT" => "",
							"WIDTH" => "",
							"COMMENTS_COUNT" => "5",
							"BLOG_USE" => $arParams['BLOG_USE'],
							"FB_USE" => $arParams['FB_USE'],
							"FB_APP_ID" => $arParams['FB_APP_ID'],
							"VK_USE" => $arParams['VK_USE'],
							"VK_API_ID" => $arParams['VK_API_ID'],
							"CACHE_TYPE" => $arParams['CACHE_TYPE'],
							"CACHE_TIME" => $arParams['CACHE_TIME'],
							'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
							"BLOG_TITLE" => "",
							"BLOG_URL" => $arParams['BLOG_URL'],
							"PATH_TO_SMILE" => "",
							"EMAIL_NOTIFY" => $arParams['BLOG_EMAIL_NOTIFY'],
							"AJAX_POST" => "Y",
							"SHOW_SPAM" => "N",
							"SHOW_RATING" => "N",
							"FB_TITLE" => "",
							"FB_USER_ADMIN_ID" => "",
							"FB_COLORSCHEME" => "light",
							"FB_ORDER_BY" => "reverse_time",
							"VK_TITLE" => "",
							"TEMPLATE_THEME" => $arParams['~TEMPLATE_THEME']
						),
						$component,
						array("HIDE_ICONS" => "Y")
					);?>
				</div><!-- /blc_related -->
			<?endif?>
			<div class="blc_related">

				<?
				global $DETAIL_LIST_FILTER , ${$arParams["FILTER_NAME"]};
				$DETAIL_LIST_FILTER = array_merge(array("!ID" => $arResult['ID']), ${$arParams["FILTER_NAME"]});
				?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"detail_list",
					Array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"SECTION_ID" => $arResult['SECTION']['ID'],
						"RESIZER_SETS" => $arSets,
						"ELEMENT_SORT_FIELD" => "rand",
						"ELEMENT_SORT_ORDER" => "asc",
						"PROPERTY_CODE" => $arParams['PROPERTY_CODE'],
						"BANNER_TYPE" =>$arParams["BANNER_TYPE_SECTION"],
						"INCLUDE_SUBSECTIONS" => "Y",
						"FILTER_NAME" => "DETAIL_LIST_FILTER",
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_FILTER" => $arParams["CACHE_FILTER"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"PAGE_ELEMENT_COUNT" => 5,

						//sef:
						"SECTION_URL" => $arParams["SECTION_URL"],
						"DETAIL_URL" => $arParams["DETAIL_URL"],
						"RESIZER_SETS" => $arParams['RESIZER_SETS'],

					),
					$component->__parent
				);
				?>
			</div><!-- /blc_related -->

		</div>
		<div class="span3">
			<div class="wdt_price">
				<div class="price"><span><?if($arResult['PROPERTIES']['PRICE']['VALUE']>0):?><?=$arResult['PROPERTIES']['PRICE']['VALUE']?> <?=$arResult['PROPERTIES']['CURRENCY']['VALUE']?><?else:?><?=GetMessage('FREE');?><?endif?></span></div>
				<!--<div class="torg"><i class="sym">&#245;</i> Price negotiating is possible</div>-->
			</div>
			<!--
			<div class="wdt_favorite">
				<button class="b-action"><i class="sym">&#0116;</i> Liked</button>
			</div>
			-->

			<div class="wdt_account">
				<div class="wdt_profile">
					<div class="user"><img src="<?=$arResult['USER']['AVIK']?>" alt="<?=$arResult['USER']['NAME']?> <?=$arResult['USER']['LAST_NAME']?>"> <?=$arResult['USER']['NAME']?> <?=$arResult['USER']['LAST_NAME']?></div>
					<div class="online"><?=GetMessage('ON_SITE_SINCE');?><?=$arResult['USER']['DATE_REGISTER_DISPLAY']?></div>
					<div class="all"><a href="<?=$arResult['USER']['LINK_TO_USER_ADS'];?>"><?=GetMessage('ALL_AUTHOR_ADS');?></a></div>
					<!--
					<div class="phone">
						<div class="input-append">
							<input class="span11" id="appendedInputButton" size="16" type="text" placeholder="+790X XXX XXXX"><button class="btn" type="button"><i class="sym">&#0118;</i></button>
						</div>
					</div>
					<button class="b-request"><i class="sym">&#0056;</i> contact</button>
					-->
				</div>
				<div class="wdt_address">
					<?if(!empty($arResult['PROPERTIES']['ADDRESS']['VALUE'])):?>
						<div class="tit"><?=GetMessage('ADDRESS');?>:</div>
						<p><?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?></p>
					<?endif;?>
					<?if(!empty($arResult['PROPERTIES']['PHONE']['VALUE'])):?>
						<div class="tit"><?=GetMessage('PHONE');?>:</div>
						<p><?=$arResult['PROPERTIES']['PHONE']['VALUE']?></p>
					<?endif;?>
					<!--<div class="address_link"><a href="#"><span class="sym">&#0117;</span> View on map</a></div>-->
				</div>
			</div>
			<!--
			<div class="wdt_buttons">
				<div class="btn-control"><button class="b-gray button6"><span class="s i_print"></span> Print</button></div>
				<div class="btn-control"><button class="b-gray button6"><span class="s i_feedback"></span> complaint</button></div>
			</div>
			-->
			<div class="wdt_ads">
				<?if(CModule::IncludeModule("advertising")):?>
					<?$APPLICATION->IncludeComponent("bitrix:advertising.banner", ".default", array(
						"TYPE" => $arParams['BANNER_TYPE_DETAIL'],
						"NOINDEX" => "Y",
						"CACHE_TYPE" => $arParams['CACHE_TYPE'],
						"CACHE_TIME" => $arParams['CACHE_TIME'],
						),
						false
					);?>
				<?endif;?>
			</div>

		</div>
	</div>
<?else:?>
	<p class="no-moderation"><?=GetMessage('ADD_CREAT_BUT_NOT_PUBLISH')?></p>
<?endif;?>


<?// echo "<pre>";	print_r($arResult);	echo "</pre>";?>