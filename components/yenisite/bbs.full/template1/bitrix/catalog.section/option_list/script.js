function bbsAddOption(optionId, sender)
{
	if ($('#option'+optionId).length > 0) return;
	
	var $sender = $(sender).closest('div.span3');
	//payed ADs
	$('form div.wdt_addsumm div.clear')
		.before('<div class="unit">'
		      + '<input name="options[]" type="checkbox" value="'+optionId+'" id="option'+optionId+'" checked="checked">'
		      + '<label for="option'+optionId+'">'+$sender.find('.tit').text()+' ('+$sender.find('.price').text()+')</label>'
		      + '</div>');
	//free ADs
	$('div.alert form').show()
		.prepend('<input name="options[]" type="hidden" value="'+optionId+'" id="option'+optionId+'">');
	
	$sender
		.find('a').attr("disabled", "disabled")
		.filter('.b-action').text(BX.message('BBS_OPTION_ADDED'));
}