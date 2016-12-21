$(document).ready(function(){
	var modal_id = '#select-regions1';
	
	var ysLocCookie = YS.GeoIP.Cookie;
	var town = ysLocCookie.getCookieTown('YS_GEO_IP_CITY');
	var ysLocAutoC	= YS.GeoIP.AutoComplete;
	
	// city text input handler
	var textchangeInterval;
	$(modal_id).on('keypress', '.form_city-name .ys-city-query',function(e) {
		// console.log('sd');
		if (e.which == 13) // press ENTER
		{
			$('.ys-loc-autocomplete div').eq(0).click();
		}
		
		var txtField = $(this);
		if (txtField.val().length > 1)
		{
			if (textchangeInterval) {
				clearInterval(textchangeInterval);
			}
			textchangeInterval = setInterval(function(){
				ysLocAutoC.buildList( txtField.val(),function(){
						window.location.reload();
					}
				);
				clearInterval(textchangeInterval);
			}, 500);
			
		} else if(txtField.val().length <= 1) {
			clearInterval(textchangeInterval);
			$('.ys-loc-autocomplete').css('display', 'none').empty();
		}
	});
		
		
	// if(town == null)
	// {
		// ysLocCookie.setCookieFromTownClick($(modal_id + ' .header .sub span.selected').text());
	// }
	
	// $(modal_id + ' .ys-loc-autocomplete').on('click','div',function () {
		// ysLocCookie.setCookieFromTownClick($(this).text());
	// });
	$(modal_id).on('click','ul li > a',function () {
		// console.log('sd');
		if ($(this).parent().hasClass('active')) return;
		
		ysLocCookie.setCookieFromTownClick($(this).text());
		$(modal_id + '.close').click();
		window.location.reload();
	});
});