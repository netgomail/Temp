<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(method_exists($this, 'setFrameMode')) $this->setFrameMode(true);

if(CModule::IncludeModule('statistic')):?>

	<?if(method_exists($this, 'createFrame')) $frame = $this->createFrame()->begin('Loading...');?>
	<div class="wdt_city"><?=GetMessage('BBS_YOUR_CITY')?>: <a href="#select-regions1" data-toggle="modal" class="border-dotted"><span class="dotted">
			<?
			if (!empty($arResult['CITY_INLINE']))
			{
				echo $arResult['CITY_INLINE'];
			} 
			else
			{
				echo GetMessage('BBS_CHOOSE_CITY');
			}
			?>
		</span> <i class="sym">{</i></a></div><!-- /wdt_city -->
	<?if(method_exists($this, 'createFrame')) $frame->end();?>

	<!-- Modal -->
	<?//$this->SetViewTarget('modal_geoip');?>
	<div id="select-regions1" class="modal hide fade container row">
		<?if(method_exists($this, 'createFrame')) $frame = $this->createFrame()->begin('Loading...'); ?>
	  	<div class="modal-header">
	    	<button type="button" class="btn-icon close sym" data-dismiss="modal" aria-hidden="true">&#205;</button>
		    <h3 class="head"><?=GetMessage('BBS_POPUP_TITLE')?></h3>
		    <div class="searchform span5">
					<form action="#" method="post" class="form_city-name">
						<input type="text" placeholder="<?=GetMessage('BBS_ENTER_LOCATION')?>" class="stxt ys-city-query">
						
						<button class="b-action"><i class="sym">&#0035;</i></button>
					</form>
				</div>
				<h4 class="head"><?=GetMessage('BBS_SELECTED_CITY')?>: <span class="current-city"><?=!empty($arResult['CITY_INLINE']) ? $arResult['CITY_INLINE'] : $arResult['CITY_IP'];?></span></h4>
		</div>
		<div class="ys-loc-autocomplete"></div>
		
		<div class="modal-body tab-content">
			<?if(!empty($arResult['CITY_IP']) || !empty($arResult['CITY_INLINE'])):?>
				<?$selected_city =!empty($arResult['CITY_INLINE']) ? $arResult['CITY_INLINE'] : $arResult['CITY_IP'];?>
			<?endif;?>
			<ul id="russia" class='districts columnize tab-pane active' data-columns="4">
				<?foreach($arResult['CITY'] as $k => $city):?>
					<li class="<?=((strcasecmp($selected_city, $city) == 0) ? ' active' : '')?>">
						<a href="#"><?=$city?></a>
					</li>
				<?endforeach?>
			</ul>
		</div>
		
		<?if(method_exists($this, 'createFrame')) $frame->end();?>
	</div>
	<?//$this->EndViewTarget();?>
<?endif;?>