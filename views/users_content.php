<div class="col-lg-12">
	<div class="col-md-6">
		<select id="selectbasic" name="selectbasic" class="form-control">
			<option value="0"> -- Sélectionner un compte -- </option>
			<?php
			if(isset($users)){
				foreach ($users as $user) {
					echo "<option value=".$user->getLogin().">".$user->getNom()."  -  ".$user->getPrenom()."</option>";
				}
			}
			?>
		</select>
	</div>
	<div id="control_buttons" class="col-md-6">
		<button id="modify" class="btn btn-warning">Modifier</button>
		<button id="delete" class="btn btn-danger">Supprimer</button>
	</div>
	<div id='info' class="well col-md-12" style="height: 150px; margin-top: 15px;"></div>
	<div class="col-md-offset-4 col-md-2" style="margin-top : 20px">
		<button id="adduser" class="btn btn-success">Ajouter un nouvel utilisateur</button>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('#control_buttons').hide();
	$('#selectbasic').change(function(event){
		//demander les détails de l'utilisateur sélectionné
		var user_id = $('#selectbasic').val();
		// $('form').submit();
		if(user_id != ""){
			$('#info').load('../secouriste/get/'+user_id);
			$('#control_buttons').show('fast');
		}
		else {
			$('#control_buttons').hide('fast');
			$('#info').html("");
		}
	});

	$('#adduser').click(function(){
		$('#content').load('../ajax/users_form');
	});

	$('#delete').click(function(){
		var user_id = $('#selectbasic').val();
		$.ajax({
			url: '../secouriste/delete/'+user_id,
			type: 'get',
			success: function(data){
				alert(data);
			},
			error: function(data){
				alert(data);
			}
		});

		//$('option [value='+"'"+dps_id+"'"+']').remove();  TROUVER UNE SOLUTION !!
	});
});
</script>