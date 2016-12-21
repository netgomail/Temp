// @var bbs_options - set in result_modifier.php
// @var bbs_path_to_order - set in yenisite:bbs.full result_modifier.php

$(document).ready(function () {

	$(".blc_ditail .gallery .thumbs a").click(function () {
		$('.blc_ditail .gallery .node img').attr('src', $(this).attr('href'));
		$('.blc_ditail .gallery .node .yenisite-zoom').attr('href', $(this).data('big-img'));
		
		$(".blc_ditail .gallery .thumbs a").removeClass('active');
		$(this).addClass('active');
		
		return false;
	});

	$('.blc_ditail .gallery .navi .navi_next').click(function () {
		var next = $(".blc_ditail .gallery .thumbs a.active").next();
		if(next.size()<1)
			return;
		$('.blc_ditail .gallery .node img').attr('src', next.attr('href'));
		$('.blc_ditail .gallery .node .yenisite-zoom').attr('href', next.data('big-img'));

		$(".blc_ditail .gallery .thumbs a").removeClass('active');
		next.addClass('active');		
	});

	$('.blc_ditail .gallery .navi .navi_prev').click(function () {
		var prev = $(".blc_ditail .gallery .thumbs a.active").prev();
		if(prev.size()<1)
			return;
		$('.blc_ditail .gallery .node img').attr('src', prev.attr('href'));
		$('.blc_ditail .gallery .node .yenisite-zoom').attr('href', prev.data('big-img'));

		$(".blc_ditail .gallery .thumbs a").removeClass('active');
		prev.addClass('active');
	});
	
	/*OPTION BUY BUTTONS*/
	$("div.item_buttons button").click(function(){
		var params = {
			ad_id: $(document.forms['edit_ad']).find('input[name="CODE"]').val(),
			sessid: bxSession.sessid,
			add_order_for_ad: 'Y'
		};
		var $span = $(this).find('span.s');
		if ($span.hasClass('i_top')) {
			params.options = [bbs_options['ad-opt-top']];
		} else
		if ($span.hasClass('i_quickly')) {
			params.options = [bbs_options['ad-opt-urgent']];
		} else
		if ($span.hasClass('i_pick')) {
			params.options = [bbs_options['ad-opt-highlight']];
		} else
		if ($span.hasClass('i_up')) {
			params.options = [bbs_options['ad-opt-raise']];
		}
		window.location.assign(bbs_path_to_order + '?' + $.param(params) );
	});
});