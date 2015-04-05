( function($) {
	
	Calendar.setup({
		parentElement : 'calendar',
		selectHandler : function(){ 
			$('#date').html(this.date.print(this.dateFormat));
			setLoader();
			$.ajax({
				type: 'POST',
				url:  Routing.generate('secourut_site_home_event'),
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
