$(document).ready(function(){
	// ADD Form  - change section
	$('#ad_add').on('change', '#PROPERTY_IBLOCK_SECTION', function(e){
		if(typeof RZBBS.ajax.AddAdForm === 'undefined' || !RZBBS.ajax.AddAdForm.Enable)
		{
			document.getElementById('ad_add').submit();
		}
		else
		{
			RZBBS.ajax.AddAdForm.Start(this, {'PROPERTY': { 'IBLOCK_SECTION' : this.options[this.selectedIndex].value}});
		}
	});
});