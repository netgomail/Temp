$(document).ready(function(){
	$('[name="selectTarif"]').submit(function(){
		if($(this).find('input[name="tarif"]:checked').prop('checked')!=true)
		{
			$('.errorList').show();
			return false;
		}
	});
});