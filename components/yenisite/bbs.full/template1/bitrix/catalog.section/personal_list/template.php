<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$bSale = (CModule::IncludeModule('sale') && CModule::IncludeModule('catalog') && CModule::IncludeModule('yenisite.bbs'))?>

		<section id="cab_ads">
			<form method="POST" action="<?$APPLICATION->GetCurUri();?>">
			<div class="wdt_buttons">
				<!--<button name="activate" value="Y" class="b-gray button6"><i class="sym green-color">&#222;</i> <?=GetMessage('ACTIVATE');?> </button> -->
				<button name="delete" value="Y" class="b-gray button6"><i class="sym red-color">&#205;</i> <?=GetMessage('DELETE');?></button>
			</div>
			<div class="blc_th">
				<div class="row-fluid">
					<div class="span6">
						<div class="checkboxTD">
							<input name="" type="checkbox" value="" id="checkboxesID"><label for="checkboxesID"></label>
						</div>
						<div class="date"><!--<a href="#"><?=GetMessage('DATE');?> <i class="sym">{</i></a>--><?=GetMessage('DATE');?> <i class="sym">{</i></div>
						<div class="photo"><?=GetMessage('PHOTO');?></div>
						<div class="name"><?=GetMessage('TIT');?><a href="#"></a></div>
					</div>
					<div class="span2"><?=GetMessage('PRICE');?></div>
					<!--<div class="span1"><?=GetMessage('MESSAGE');?></div>-->
					
					<div class="span3">
						<!--<div class="view"><?=GetMessage('VIEW_COUNT');?></div>-->
						<div class="status"><?=GetMessage('STATUS');?></div>
					</div>
					
				</div>
			</div>
			<div class="blc_products">
				
				<?foreach($arResult['ITEMS'] as $item):?>
					
					<div class="announcement">
						<div class="row-fluid">
							<div class="span6">
								<div class="checkboxTD">
									<input name="element_<?=$item['ID']?>" type="checkbox" value="<?=$item['ID']?>" id="element_<?=$item['ID']?>"><label for="element_<?=$item['ID']?>"></label>
								</div>
								<div class="date">
									<div class="today"><?=$item['DATE_CREATE_DATE'];?></div>
									<div class="time"><?=$item['DATE_CREATE_TIME'];?></div>
								</div>
								<div class="photo"><a href="<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$item['PICTURE']?>" alt="<?=$item['NAME']?>"></a></div>
								<div class="name">
									<div class="tit"><a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a></div>
									<div class="category"><?=$item['CATEGORY_CHAIN']?></div>
									<div class="address"><?if(!empty($item['PROPERTIES']['ADDRESS']['VALUE'])):?><i class="sym">&#0117;</i> <?=$item['PROPERTIES']['ADDRESS']['VALUE']?><?endif;?></div>
									<div class="show"><a href="<?=$item['DETAIL_PAGE_URL']?>"><?=GetMessage('SHOW_DETAIL');?></a></div>
									<?if ($bSale):?>
									<div class="promotions">
										<div class="promotion edit">
											<button type="button" data-path-edit="<?=str_replace('#AD_ID#', $item['ID'], $arParams['PATH_TO_EDIT_AD']);?>" class="promote b-gray" title="<?=GetMessage('OPTION_EDIT')?>"><i class="sym">?</i></button>
										</div>
										<div class="promotion to-top<?if($item['PROPERTIES']['TOP']['VALUE'] == 'Y') echo' promoted'?>">
											<i class="promoted"></i>
											<span class="promoted"><?=GetMessage('OPTION_TOP')?>
											<?if (!empty($item['PROPERTIES']['TOP_DATE']['VALUE'])):?>
												<?=GetMessage('OPTION_TO')?> <?=$item['PROPERTIES']['TOP_DATE']['VALUE']?></span>
												<button type="button" class="promoted extend b-gray"><?=GetMessage('OPTION_EXTEND')?></button>
											<?else:?></span><?endif?>
											<button type="button" class="promote b-gray" title="<?=GetMessage('OPTION_TOP_ADD')?>"><i></i></button>
										</div>
										<div class="promotion urgent<?if($item['PROPERTIES']['URGENT']['VALUE'] == 'Y') echo' promoted'?>">
											<i class="promoted"></i>
											<span class="promoted"><?=GetMessage('OPTION_URGENT')?>
											<?if (!empty($item['PROPERTIES']['URGENT_DATE']['VALUE'])):?>
												<?=GetMessage('OPTION_TO')?> <?=$item['PROPERTIES']['URGENT_DATE']['VALUE']?></span>
												<button type="button" class="promoted extend b-gray"><?=GetMessage('OPTION_EXTEND')?></button>
											<?else:?></span><?endif?>
											<button type="button" class="promote b-gray" title="<?=GetMessage('OPTION_URGENT_ADD')?>"><i></i></button>
										</div>
										<div class="promotion markout<?if($item['PROPERTIES']['HIGHLIGHT']['VALUE'] == 'Y') echo' promoted'?>">
											<i class="promoted"></i>
											<span class="promoted"><?=GetMessage('OPTION_HIGHLIGHT')?>
											<?if (!empty($item['PROPERTIES']['HIGHLIGHT_DATE']['VALUE'])):?>
												<?=GetMessage('OPTION_TO')?> <?=$item['PROPERTIES']['HIGHLIGHT_DATE']['VALUE']?></span>
												<button type="button" class="promoted extend b-gray"><?=GetMessage('OPTION_EXTEND')?></button>
											<?else:?></span><?endif?>
											<button type="button" class="promote b-gray" title="<?=GetMessage('OPTION_HIGHLIGHT_ADD')?>"><i></i></button>
										</div>
										<div class="promotion lift">
											<i class="promoted"></i>
											<button type="button" class="promote b-gray" title="<?=GetMessage('OPTION_RAISE_ADD')?>"><i></i></button>
										</div>
									</div>
									<?endif?>
								</div>
							</div>
							<div class="span2">
								<div class="price"><?if($item['PROPERTIES']['PRICE']['VALUE']>0):?><?=$item['PROPERTIES']['PRICE']['VALUE']?> <?=$item['PROPERTIES']['CURRENCY']['VALUE']?><?endif?></div>
							</div>
							<!--
							<div class="span1">
								<div class="msg">343</div>
							</div>
							-->
							
							<div class="span3">
								<!--<button class="b-gray square"><span class="sym">&#0067;</span></button>
								<div class="view">1 234</div>-->
								<div class="status" title="<?=$item['PROPERTIES']['WRONG_AD']['VALUE']?>"><?=$item['PROPERTIES']['STATUS']['VALUE'].$item['Y_MESS']?></div>
							</div>
							
						</div>
					</div>
				<?endforeach;?>
			</div><!-- /blc_products -->
			<div class="blc_buttons">
				<!--<button name="activate" value="Y" class="b-gray button6"><i class="sym green-color">&#222;</i> <?=GetMessage('ACTIVATE');?> </button>-->
				<button name="delete" value="Y" class="b-gray button6"><i class="sym red-color">&#205;</i> <?=GetMessage('DELETE');?></button>
			</div>
			</form>
		</section><!-- /cab_message -->

			<?=$arResult["NAV_STRING"]?>
		<div class="row-fluid"></div>

<?
//echo "<pre>";	print_r($arResult);	echo "</pre>";
?>
