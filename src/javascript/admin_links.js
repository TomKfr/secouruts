$(function() {
	
	function addFormAction(){
			
			$('#myForm').unbind('submit').submit(function(){
				setLoader();
				var form = $(this);
				var url = Routing.generate('secourut_admin_links_add');
				
				$.ajax({
						type: 'POST',
						url:  url,
						data: form.serialize(),
						dataType: 'html',
						success: function(response)
						{
							$('#form_container').html(response);
							addFormAction();
							
							$.ajax({
									type: 'POST',
									url:  Routing.generate('secourut_admin_links'),
									data: form.serialize(),
									dataType: 'html',
									success: function(response)
									{
										$('#liste').html(response);
										modifAction();
										deleteAction();
										unsetLoader();
										notification();
									}
							});
						}
				});
				
				return false;
				
			});
			
		}
		
		function updateFormAction(){
		
			$('#myForm').submit(function(){
				setLoader();
				var form = $(this);
				var id = $('#conf_id').attr('value');
				var url = Routing.generate('secourut_admin_links_saveModif', { id: id });
				
				$.ajax({
						type: 'POST',
						url:  url,
						data: form.serialize(),
						dataType: 'html',
						success: function(response)
						{
							$('#form_container').html(response);
							addFormAction();
							
							$.ajax({
									type: 'POST',
									url:  Routing.generate('secourut_admin_links'),
									data: form.serialize(),
									dataType: 'html',
									success: function(response)
									{
										$('#liste').html(response);
										modifAction();
										deleteAction();
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
						url:  Routing.generate('secourut_admin_links_cancel'),
						success: function(response)
						{
							$('#form_container').html(response);
							addFormAction();
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
						url:  Routing.generate('secourut_admin_links_modif'),
						data: 'id=' + id,
					
						success: function(response)
						{
							$('#form_container').html(response);
							updateFormAction();
							cancelFormAction();
							unsetLoader();
						}
				});					
			});
			
        }
        
        function deleteAction(){
			
			$('input[id^="s_"]').click(function(){
				var array = $(this).attr('id').split('_');
				var id = array[1];
				
				$( "#dialog" ).dialog({
					modal: true,
					  buttons: {
						"Oui": function() {
							  setLoader();
							  $( this ).dialog( "close" );
							  
							  $.ajax({
									type: 'POST',
									url:  Routing.generate('secourut_admin_links_delete'),
									data: 'id=' + id,
								
									success: function(response)
									{
										$('li[id=' + id + ']').remove();
										$('#form_container').html(response);
										addFormAction();
										modifAction();
										deleteAction(); 
										unsetLoader();
										notification();
									}
							});
						},
						"Non": function() {
						  $( this ).dialog( "close" );
						}
					  }
				});
			});
			
        }
        
        setLoader();
        addFormAction();
        modifAction();
        deleteAction();
        unsetLoader();
});
