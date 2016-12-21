var RZBBS = RZBBS || {};
RZBBS.ajax = RZBBS.ajax || {};
RZBBS.ajax.params = RZBBS.ajax.params || {};

RZBBS.ajax.setLocation = function (curLoc)
{
	try {
		history.pushState(null, null, curLoc);
		return;
	} catch(e) {}
		location.hash = '#' + curLoc.substr(1)
}

RZBBS.ajax.loader = function()
{
	return $('<div class="ajax_loader"></div>');
}

RZBBS.ajax.loader.Start = function(obj, notLoader)
{
	if (typeof(obj) == "undefined") 
	{ 
		return;
	}
	obj.animate({ 
        opacity: 0.4,         // прозрачность будет 40%
    }, 500);
	if(!notLoader)
		obj.addClass('ajax_loader');
}

RZBBS.ajax.loader.Stop = function(obj)
{
	if (typeof(obj) == "undefined") 
	{ 
		return;
	}
	obj.animate({ 
        opacity: 1,         // прозрачность будет 1000%
    }, 300);
	obj.removeClass('ajax_loader');
}

RZBBS.ajax.AddAdForm = 
{
	Enable: false,
	Start: function(obj, Params)
	{	
		this.Reload(obj, Params);
		
	},
	
	Reload: function(obj, params)
	{
		var objLoader = $('#ad_add');
		
		var data = {
			'rz_ajax' : 'y',
			// 'site_id': SITE_ID,
		};
		for(var key in params) 
		{
			data[key] = params[key];
		}
		for(var key in RZBBS.ajax.params) 
		{
			data[key] = RZBBS.ajax.params[key];
		}
				
		this.SendRequest(data, objLoader, params);
	},
	
	SendRequest: function(data, objLoader, params)
	{
		RZBBS.ajax.loader.Start(objLoader, true);
		
		$.ajax({
			url: '/bitrix/components/yenisite/bbs.full/ajax/index.php',
			type: "POST",
			data: data,
			dataType: 'html',
			success: function(data){
				RZBBS.ajax.loader.Stop(objLoader); 
				RZBBS.ajax.AddAdForm.Refresh(data, params);
			}
		});
	},
	
	Refresh: function(data, params)
	{
		$('#ad_add').html($(data).find('#ad_add').html());
	}
}