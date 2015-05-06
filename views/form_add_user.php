<div id="formdiv" class="col-md-12" style="margin-top : 15px">
	<form id="newuser" class="form-horizontal" method='post' action="..secouriste/new_user">
		<div class="form-group">
			<label class="col-md-2 control-label" for="login">Login</label>  
			<div class="col-md-10">
				<input id="login" name="login" type="text" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="name">Nom</label>
			<div class="col-md-10">
				<input id="nom" type="text" name="nom" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="firstname">Prénom</label>
			<div class="col-md-10">
				<input id="firstname" type="text" name="firstname" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="admin">Administrateur</label>
			<div class="col-md-3">
				<input id="admin" type="checkbox" name="admin" class="form-control">
			</div>
		</div>
		<div class="col-md-offset-3">
			<button id="submit" class="btn btn-primary">Valider</button>
			<button id="back" class="btn btn-info">Retour</button>
		</div>
		<input id="hidden" type="hidden" name="login" >

	</form>
</div>
<div id="successdiv" class="col-md-offset-1 col-md-10 alert alert-success" style="margin-top : 15px">
			<h4 align="center">Enregistrement réussi ! Cliquer pour revenir à la liste.</h4>
</div>
<div id="faildiv" class="col-md-offset-3 col-md-6 alert alert-danger" style="margin-top : 15px">
			<h3 align="center">Echec ...</h3>
</div>

<script>

$(function(){
	$('.alert').hide();

	$('#submit').click(function(event){
		event.preventDefault();
			//Valider le conformité du formulaire et l'envoyer si OK, alerter sinon.
			//Si valide alors : 

			$this = $('#newuser');
			//Envoi en ajax :
			$.ajax({
                url: $this.attr('action'), // Le nom du fichier indiqué dans le formulaire
                type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
                data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                success: function(html) {
                	$('#successdiv').show('slow');
                	$('#submit').text("Modifier");
                	alert("login du user : "+html);
                	$('#hidden').attr('value', html);
                },
                statusCode: {
                	500: function() { $('#faildiv').show('slow'); }
                }
            });

		});
	
	$('#successdiv').click(function(){
		$('#content').load('../ajax/users_content');
	});

	$('#back').click(function(event){
		event.preventDefault();
		$('#content').load('../ajax/users_content');
	});
});

</script>