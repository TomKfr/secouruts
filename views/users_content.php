<div class="col-lg-12">
	<div class="col-md-1"><span style="font-size:2.5em" class="glyphicon glyphicon-user"></span></div>
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
	<div id="control_buttons" class="col-md-offset-1 col-md-4">
		<button id="modify" class="btn btn-warning">Modifier</button>
		<button id="delete" class="btn btn-danger">Supprimer</button>
	</div>
	<div id='info' class="well col-md-12" style="min-height: 200px; margin-top: 15px;"></div>
	<div class="col-md-offset-4 col-md-2" style="margin-top : 20px">
		<button id="adduser" class="btn btn-primary">Ajouter un nouvel utilisateur</button>
	</div>
</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
function user_action(action){
	var user_id = $('#selectbasic').val();
		$.ajax({
			url: '../secouriste/'+action+'/'+user_id,
			type: 'get',
			success: function(data){
				//alert(data);
			},
			error: function(data){
				alert(data);
			}
		});

		return user_id;
};

$(function(){
	$('#control_buttons').hide();
	$('#selectbasic').change(function(event){
		var user_id = $('#selectbasic').val();
		var logged_user = $('#userloggedin').text().trim();

		if(user_id != ""){
			$('#info').load('../secouriste/get/'+user_id);
			if(user_id != logged_user) $('#control_buttons').show('fast');
			else $('#control_buttons').hide('fast');
		}
		else {
			$('#control_buttons').hide('fast');
			$('#info').html("");
		}
	});

	$('#adduser').click(function(){
		$('#content').load('../ajax/users_form/null');
	});

	$('#delete').click(function(){
		user_id = user_action('delete');
		$('#selectbasic option[value='+'"'+user_id+'"]').remove();
		$('#control_buttons').hide('fast');
		$('#info').empty();
		toastr.error('Le compte a été supprimé.');
	});
	$('#modify').click(function(){
		var user_id = $('#selectbasic').val();
		$('#content').load('../ajax/users_form2/'+user_id);
	});
});
</script>

