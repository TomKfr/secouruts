( function($) {
	
	Calendar.setup({
		parentElement : 'calendar',
		selectHandler : function(){ 
			setLoader();
			$.ajax({
				type: 'POST',
				url:  Routing.generate('secourut_site_calendar'),
				data: 'date=' + this.date.print(this.dateFormat),
				success: function(response)
				{
					$('#listEvent').html(response);
					unsetLoader();
				}
			});
		}
	});
	
	
	
}) (jQuery);
