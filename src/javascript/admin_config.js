$(function() {
	
		function updateFormAction(){
		
			$('#myForm').submit(function(){
				setLoader();
				var form = $(this);
				var id = $('#conf_id').attr('value');
				var url = Routing.generate('secourut_admin_general_saveModif', { id: id });
				
				$.ajax({
						type: 'POST',
						url:  url,
						data: form.serialize(),
						dataType: 'html',
						success: function(response)
						{
							$('#form_container').html(response);
							
							$.ajax({
									type: 'POST',
									url:  Routing.generate('secourut_admin_general'),
									data: form.serialize(),
									dataType: 'html',
									success: function(response)
									{
										$('#liste').html(response);
										modifAction();
										unsetLoader();
										notification();
									}
							});
						}
				});
				
				return false;
				
			});
			
		}
		
		function cancelFormAction(){
		
			$('#cancel').click(function(){
				setLoader();
				$.ajax({
						type: 'POST',
						url:  Routing.generate('secourut_admin_general_cancel'),
						success: function(response)
						{
							$('#form_container').html(response);
							unsetLoader();
						}
				});
				
			});
		}
        
        function modifAction(){
        
			$('input[id^="m_"]').unbind('click').click(function(){
				setLoader();
				var array = $(this).attr('id').split('_');
				var id = array[1];
				
				$.ajax({
						type: 'POST',
						url:  Routing.generate('secourut_admin_general_modif'),
						data: 'id=' + id,
					
						success: function(response)
						{
							$('#form_container').html(response);
							readonly();
							updateFormAction();
							cancelFormAction();
							unsetLoader();		
						}
				});		
					
			});
			
        }
		
		function readonly(){
			$('#secourut_sitebundle_configtype_attribut').attr('readonly', 'readonly');
		}
        
        setLoader();
        modifAction(); 
        unsetLoader();
}); 
