// @var bbs_options - set in result_modifier.php
// @var bbs_path_to_order - set in yenisite:bbs.full result_modifier.php

$(document).ready(function(){
	$('button.promote, button.extend').on('click', function(){
		var params = {
			ad_id: $(this).closest('div.announcement').find('div.checkboxTD input[type="checkbox"]').val(),
			sessid: bxSession.sessid,
			add_order_for_ad: 'Y'
		};
		var $parent = $(this).parent();
		if ($parent.hasClass('to-top')) {
			params.options = [bbs_options['ad-opt-top']];
		}
		if ($parent.hasClass('urgent')) {
			params.options = [bbs_options['ad-opt-urgent']];
		}
		if ($parent.hasClass('markout')) {
			params.options = [bbs_options['ad-opt-highlight']];
		}
		if ($parent.hasClass('lift')) {
			params.options = [bbs_options['ad-opt-raise']];
		}
		if($parent.hasClass('edit')){
			editPath = $(this).data('path-edit');
			document.location.href = editPath;
			return;
		}
		window.location.assign(bbs_path_to_order + '?' + $.param(params) );
	});
});