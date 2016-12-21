$(document).ready(function(){
	$('div.item .node').hide();
	$('div.item.active .node').show();
	
	$('div.item .tit').click(function(){
		console.log('qwertyuiop');
		var item = $(this).parent();
		item.toggleClass('active');
		if(item.hasClass('active'))
			item.find('.node').slideDown();
		else
			item.find('.node').slideUp();
	});
	
});
