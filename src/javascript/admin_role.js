$(function() {
	
	function kcfinder(){
		
		window.KCFinder = {
			callBack: function(url) {
				$('#secourut_sitebundle_roletype_image_url').val(url);
				window.KCFinder = null;
			}
		};
		
		window.open('/secouruts/javascript/ckeditor/kcfinder/browse.php?type=images&lang=fr', 'kcfinder_textbox',
			'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
			'resizable=1, scrollbars=0, width=800, height=600'
		);
		
	}
	
	function init(){
		//$('#secourut_sitebundle_roletype_image_url').attr('readonly', 'readonly');
		$('#secourut_sitebundle_roletype_image_url').unbind('click').click(kcfinder);
	}	
	
	function addFormAction(){
			
			$('#myForm').unbind('submit').submit(function(){
				setLoader();
				var form = $(this);
				var url = Routing.generate('secourut_admin_role_add');
				
				$.ajax({
						type: 'POST',
						url:  url,
						data: form.serialize(),
						dataType: 'html',
						success: function(response)
						{
							$('#form_container').html(response);
							init();
							addFormAction();
							
							$.ajax({
									type: 'POST',
									url:  Routing.generate('secourut_admin_role'),
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
				var url = Routing.generate('secourut_admin_role_saveModif', { id: id });
				
				$.ajax({
						type: 'POST',
						url:  url,
						data: form.serialize(),
						dataType: 'html',
						success: function(response)
						{
							$('#form_container').html(response);
							init();
							addFormAction();
							
							$.ajax({
									type: 'POST',
									url:  Routing.generate('secourut_admin_role'),
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
						url:  Routing.generate('secourut_admin_role_cancel'),
						success: function(response)
						{
							$('#form_container').html(response);
							init();
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
						url:  Routing.generate('secourut_admin_role_modif'),
						data: 'id=' + id,
					
						success: function(response)
						{
							$('#form_container').html(response);
							init();
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
									url:  Routing.generate('secourut_admin_role_delete'),
									data: 'id=' + id,
								
									success: function(response)
									{
										$('li[id=' + id + ']').remove();
										$('#form_container').html(response);
										init();
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
        init();
        addFormAction();
        modifAction();
        deleteAction();
        unsetLoader();
});
