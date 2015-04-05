jQuery(document).ready(function($) {
	
		function addFormAction(){
			
			$('#myForm').unbind('submit').submit(function(){
				setLoader();
				getContent();
				var form = $(this);
				var url = Routing.generate('secourut_admin_event_add');
				
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
									url:  Routing.generate('secourut_admin_event'),
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
				getContent();
				var form = $(this);
				var id = $('#conf_id').attr('value');
				var url = Routing.generate('secourut_admin_event_saveModif', { id: id });
				
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
									url:  Routing.generate('secourut_admin_event'),
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
						url:  Routing.generate('secourut_admin_event_cancel'),
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
						url:  Routing.generate('secourut_admin_event_modif'),
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
									url:  Routing.generate('secourut_admin_event_delete'),
									data: 'id=' + id,
								
									success: function(response)
									{
										$('li[id=' + id + ']').remove();
										$('#form_container').html(response);
										ckeditor();
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
        
        function ckeditor(){
			
			if (CKEDITOR.instances['secourut_sitebundle_eventtype_contenu']) {
				delete CKEDITOR.instances['secourut_sitebundle_eventtype_contenu'];
			}
			CKEDITOR.replace('secourut_sitebundle_eventtype_contenu');
			
			if (CKEDITOR.instances['secourut_sitebundle_eventtype_commentaire']) {
				delete CKEDITOR.instances['secourut_sitebundle_eventtype_commentaire'];
			}
			CKEDITOR.replace('secourut_sitebundle_eventtype_commentaire');
		}
		
		function getContent(){
			var editor = CKEDITOR.instances['secourut_sitebundle_eventtype_commentaire'];
			$('#secourut_sitebundle_eventtype_commentaire').val(editor.getData());
			
			var editor = CKEDITOR.instances['secourut_sitebundle_eventtype_contenu'];
			$('#secourut_sitebundle_eventtype_contenu').val(editor.getData());
		}
		
		function setLoader(){
			$.blockUI({ 
				message: 'Chargement...',
				showOverlay: false,
				centerY: false, 
				css: { 
					width: '200px', 
					top: '10px', 
					left: '', 
					right: '43%', 
					border: 'none', 
					padding: '10px', 
					borderRadius: '10px',
					backgroundColor: '#000', 
					'-webkit-border-radius': '10px', 
					'-moz-border-radius': '10px', 
					opacity: .7, 
					color: '#fff' 
				} 
			}); 
		}

		function unsetLoader(){
			setTimeout($.unblockUI,0);
		}
		
		function create( template, vars, opts ){
			return $container.notify("create", template, vars, opts);
		}

		function notification(){
			$container = $("#notif_container").notify();
			var text = $('#notif_text').html();
			
			create("withIcon", { title:'Notification', text:text , icon:'../../secouruts/css/images/check.png'
			});
		}
        
        setLoader();
        addFormAction();
        modifAction();
        deleteAction();
        unsetLoader();        
}); 
