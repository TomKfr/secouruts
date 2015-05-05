<div class="col-lg-12">
	<div class="form-group">
		<label class="col-md-3 control-label" for="selectbasic">Modifier l'utilisateur :</label>
		<div class="col-md-6">
			<select id="selectbasic" name="selectbasic" class="form-control">
				<option value="1">Liste des utilisateurs</option>
				<option value="2">Option two</option>
			</select>
		</div>
		<div class="col-md-2"><button id="val" class="btn btn-primary">Voir/Modifier</button></div>
	</div>
	<div class="col-md-offset-4 col-md-2" style="margin-top : 10px">
		<button id="adduser" class="btn btn-success">Ajouter un compte utilisateur</button>
	</div>
	<div id="formdiv" class="col-md-5" style="margin-top : 15px">
		<form id="newuser" class="form-horizontal" method='post' action="../user/new_user">
			<div class="form-group">
				<label class="col-md-5 control-label" for="login">Login</label>  
				<div class="col-md-4">
					<input id="login" name="login" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-5 control-label" for="name">Nom</label>  
				<div class="col-md-4">
					<input id="name" name="name" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-5 control-label" for="firstname">Prénom</label>
				<div class="col-md-4">
					<input id="firstname" type="text" name="firstname" class="form-control datetimepicker">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-5 control-label" for="admin">Administrateur</label>
				<div class="col-md-5">
					<input id="admin" name="admin" type="checkbox" placeholder="" class="form-control input-md" >
				</div>
			</div>
			<div class="col-md-offset-4">
				<button id="submit" class="btn btn-primary">Valider</button>
		</form>
	</div>
</div>
<div id="successdiv" class="col-md-offset-3 col-md-6 alert alert-success" style="margin-top : 15px">
			<h3 align="center">Ajout réussi !</h3>
</div>
<div id="faildiv" class="col-md-offset-3 col-md-6 alert alert-danger" style="margin-top : 15px">
			<h3 align="center">Echec ...</h3>
</div>
<script type="text/javascript">
$(function(){
	$('#formdiv').hide();
	$('.alert').hide();

	$('#adduser').click(function(){
		$('#formdiv').toggle('slow');
	});

	$('#submit').click(function(event){
		event.preventDefault();
			//Valider le conformité du formulaire et l'envoyer si OK, alerter sinon.
			//Si valide alors : 

			$this = $('#newuser');
			// //Envoi en ajax :
			$.ajax({
                url: $this.attr('action'), // Le nom du fichier indiqué dans le formulaire
                type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
                data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                success: function(html) {
                	$('#formdiv').hide('slow');
                	$(':input','#formdiv')
                	.not(':button, :submit, :reset, :hidden')
                	.val('')
                	.removeAttr('checked')
                	.removeAttr('selected');
                	$('#successdiv').show('slow');
                },
                statusCode: {
                	500: function() { $('#faildiv').show(); }
                }
            });

		});
});
</script>