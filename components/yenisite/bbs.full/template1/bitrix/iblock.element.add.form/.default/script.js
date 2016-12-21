$(document).ready(function(){
	 $('#ad_add').on('change', 'input[name ^= PROPERTY_FILE_]', function(){
		
		 $('#'+$(this).attr('name')).html(this.files[0].name);
	 });
});

function addImage(id){
	
	$('[name = '+id+']').click();
}
