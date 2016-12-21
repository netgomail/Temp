$(document).on('ready', function(){
	$('.dropdown-toggle').parent().on('mouseenter mouseleave', function(){
		$(this).children('.dropdown-toggle').dropdown('toggle');
	});
	columnize('.columnize', 2);

	$('.announcement .span3 div.status[title!=""]').addClass('no-moderation');

    //ползунки 

	/*jQuery("#slider").slider({
		min: 0,
		max: 50000,
		values: [10000,23000],
		range: true,
		stop: function(event, ui) {
			jQuery("input#minCost").val(jQuery("#slider").slider("values",0));
			jQuery("input#maxCost").val(jQuery("#slider").slider("values",1));
			jQuery("#minCostVal").text(jQuery("#slider").slider("values",0));
			jQuery("#maxCostVal").text(jQuery("#slider").slider("values",1));
		},
		slide: function(event, ui){
			jQuery("input#minCost").val(jQuery("#slider").slider("values",0));
			jQuery("input#maxCost").val(jQuery("#slider").slider("values",1));
			jQuery("#minCostVal").text(jQuery("#slider").slider("values",0));
			jQuery("#maxCostVal").text(jQuery("#slider").slider("values",1));
		}
	});*/

	jQuery(".yenisite-zoom").fancybox();

	$(".searchform .stxt").click(function(){
		$(".blc_toolbar .detail").show();
	});	
	$(".detail .close-detail").click(function(){
		$(".blc_toolbar .detail").hide();
	});	
	
    jQuery("input#minCost").change(function(){
		var value1=jQuery("input#minCost").val();
		var value2=jQuery("input#maxCost").val();
		if(parseInt(value1) > parseInt(value2)){
			value1 = value2;
			jQuery("input#minCost").val(value1);
		}
		jQuery("#slider").slider("values",0,value1); 
	});

	jQuery("input#maxCost").change(function(){
		var value1=jQuery("input#minCost").val();
		var value2=jQuery("input#maxCost").val();
		if (value2 > 50000) { value2 = 50000; jQuery("input#maxCost").val(50000)}
		if(parseInt(value1) > parseInt(value2)){
			value2 = value1;
			jQuery("input#maxCost").val(value2);
		}
		jQuery("#slider").slider("values",1,value2);
	});
	


    //блоки с объявлениями
	$("div.announcement").mouseover(function() {
		$(this).addClass('white');
		$('.white .b-action').removeClass('hide');
	
	  });

	$("div.announcement").mouseout(function() {
		$(this).removeClass('white');
	    $('.announcement .b-action').addClass('hide');
	  });

	$("div.announcement1").mouseover(function() {
		$(this).addClass('white');
	  });

	$("div.announcement1").mouseout(function() {
		$(this).removeClass('white');  
	  });


});




function columnize(selector, cols){
	$(selector).each( function(){
		var list=$(this),
			items=list.children(),
			columnCount=2,
			itemsInColumn;

		if(cols)
			columnCount=cols;
		if(list.data('columns'))
			columnCount=list.data('columns');

		itemsInColumn=Math.ceil(items.length/columnCount);

		items.remove();
		for(i = 1; i <= columnCount; ++i){
			var column = $('<div />');
			column
				.addClass('column')
				.append(items.slice((i-1)*itemsInColumn, i*itemsInColumn))
				.appendTo(list);
		}
		list.addClass('cols-'+columnCount);

	});
}

// ############################################################## //
// ################    ADD IN PROGGING BBS    ################### //
// ############################################################## //

// for section:
function setViewField(view) {
	$('#view_field').attr('value', view);
	document.forms['sort_form'].submit();
	return false;
}

// for settings button
function slideScreenUp() {
	 $('body,html').animate({scrollTop: 0}, 800);
}
