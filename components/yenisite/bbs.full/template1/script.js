function setViewField(view) {
	$('#view_field').attr('value', view);
	document.forms['sort_form'].submit();
	return false;
}

function setSortFields(order, by) {
	$('#order_field').attr('value', order);
	$('#by_field').attr('value', by);
	document.forms['sort_form'].submit();
	return false;
}

$(document).ready(function(){
	$('.wdt_city').on('click', 'a.border-dotted', function() {
		// scroll to page start
		if(window.pageYOffset > 0)
		{
			$('html,body').animate({scrollTop: 0},800);
		}
	});	
});