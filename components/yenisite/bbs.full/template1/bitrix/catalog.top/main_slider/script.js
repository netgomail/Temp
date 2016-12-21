$(document).on('ready', function(){
	
	// SLIDER
	$('.blc_recentads .row-fluid').each(function(){
		
		var th = $(this);
		var slw = th.width();
		var count = Math.floor( slw / $(".span2").width())-1;
		
		th.find('div.span2:gt('+count+')').addClass('hide');
		$(window).resize(function(){
			var slw = th.width();
			var count = Math.floor( slw / $(".span2").width())-1;
			console.log(count);
			th.find('div.span2:gt('+count+')').addClass('hide');
			th.find('div.span2:lt('+(count+1)+')').removeClass('hide');
		});
		
		$('.blc_recentads .navi a.navi_next').click(function(){
			th.find('.clear').before(th.find('div.span2:first'));
			th.find('div.span2:gt('+count+')').addClass('hide');
			th.find('div.span2:lt('+(count+1)+')').removeClass('hide');
		});
		
		$('.blc_recentads .navi a.navi_prev').click(function(){
			th.prepend(th.find('div.span2:last'));
			th.find('div.span2:gt('+(count)+')').addClass('hide');
			th.find('div.span2:lt('+(count+1)+')').removeClass('hide');
		});
	});
	
});