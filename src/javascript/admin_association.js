$(function() {
	
		function getDefault(){
			
			$.ajax({
					type: 'POST',
					url:  Routing.generate('secourut_admin_default_page'),
					data: 'page=Association',
					success: function(response)
					{
						$('#list_defaut').html(response);
						setDefault();
						unsetLoader();
					}
			});
		}
		
		function setDefault(){
			
			$('#default').unbind('change').change(function(){
				
				var id = $(this).find(':selected').val();
				
				$.ajax({
						type: 'POST',
						url:  Routing.generate('secourut_admin_default_page'),
						data: 'page=Association&id=' + id,
						success: function(response)
						{
							
						}
				});
			});
		}
	
		function addFormAction(){
			
			$('#myForm').unbind('submit').submit(function(){
				setLoader();
				getContent();
				var form = $(this);
				var url = Routing.generate('secourut_admin_association_add');
				
				$.ajax({
						type: 'POST',
						url:  url,
						data: form.serialize(),
						dataType: 'html',
						success: function(response)
						{
							$('#form_container').html(response);
							ckeditor();
							addFormAction();
							
							$.ajax({
									type: 'POST',
									url:  Routing.generate('secourut_admin_association'),
									data: form.serialize(),
									dataType: 'html',
									success: function(response)
									{
										$('#liste').html(response);
										modifAction();
										deleteAction();
										getDefault();
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
				getContent();
				var form = $(this);
				var id = $('#conf_id').attr('value');
				var url = Routing.generate('secourut_admin_association_saveModif', { id: id });
				
				$.ajax({
						type: 'POST',
						url:  url,
						data: form.serialize(),
						dataType: 'html',
						success: function(response)
						{
							$('#form_container').html(response);
							ckeditor();
							addFormAction();
							
							$.ajax({
									type: 'POST',
									url:  Routing.generate('secourut_admin_association'),
									data: form.serialize(),
									dataType: 'html',
									success: function(response)
									{
										$('#liste').html(response);
										modifAction();
										deleteAction();
										getDefault();
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
						url:  Routing.generate('secourut_admin_association_cancel'),
						success: function(response)
						{
							$('#form_container').html(response);
							ckeditor();
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
						url:  Routing.generate('secourut_admin_association_modif'),
						data: 'id=' + id,
					
						success: function(response)
						{
							$('#form_container').html(response);
							ckeditor();
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
									url:  Routing.generate('secourut_admin_association_delete'),
									data: 'id=' + id,
								
									success: function(response)
									{
										$('li[id=' + id + ']').remove();
										$('#form_container').html(response);
										ckeditor();
										addFormAction();
										modifAction();
										deleteAction(); 
										getDefault();
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
        
        function ckeditor(){
			
			if (CKEDITOR.instances['secourut_sitebundle_contenueditabletype_contenu']) {
				delete CKEDITOR.instances['secourut_sitebundle_contenueditabletype_contenu'];
			}
			CKEDITOR.replace('secourut_sitebundle_contenueditabletype_contenu');
		}
		
		function getContent(){
			var editor = CKEDITOR.instances['secourut_sitebundle_contenueditabletype_contenu'];
			$('#secourut_sitebundle_contenueditabletype_contenu').val(editor.getData());
		}
        
        setLoader();
        addFormAction();
        modifAction();
        deleteAction(); 
        setDefault();   
        unsetLoader();    
}); 
