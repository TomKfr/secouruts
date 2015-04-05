( function($) {
	
	function formattedDate(date) {
		var d = new Date(date || Date.now()),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();

		if (month.length < 2) month = '0' + month;
		if (day.length < 2) day = '0' + day;

		return [year, month, day].join('-');
	}
	
	Calendar.setup({
		parentElement : 'calendar',
		selectHandler : function(){ 
			var type = $('#selecteur_type').val();
			$('#date').html(this.date.print(this.dateFormat));
			setLoader();
			$.ajax({
				type: 'POST',
				url:  Routing.generate('secourut_site_after_event'),
				data: 'date=' + this.date.print(this.dateFormat) + '&type=' + type,
				success: function(response)
				{
					$('#listEvent').html(response);
					unsetLoader();
				}
			});
		}
	});
	
	$('#selecteur_type').unbind('change').change(function(){
		var type = $(this).val(),
			date = $('#date').html();
			setLoader();
		$.ajax({
			type: 'POST',
			url:  Routing.generate('secourut_site_after_event'),
			data: 'date=' + date + '&type=' + type,
			success: function(response)
			{
				$('#listEvent').html(response);
				unsetLoader();
			}
		});
	});
	
	$('#date').html(formattedDate(Date()));
	
}) (jQuery);
