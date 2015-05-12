<div id="formdiv" class="col-md-12" style="margin-top : 15px">
	<form id="newuser" class="form-horizontal" method='post' action="../secouriste/new_user">
		<div class="form-group">
			<label class="col-md-2 control-label" for="login">Login</label>  
			<div class="col-md-10">
				<input id="login" name="login" type="text" class="form-control" value=<?php if(isset($user)) echo("'".$user->getLogin()."'"); ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="nom">Nom</label>
			<div class="col-md-10">
				<input id="nom" type="text" name="nom" class="form-control" value=<?php if(isset($user)) echo("'".$user->getNom()."'"); ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="prenom">Prénom</label>
			<div class="col-md-10">
				<input id="prenom" type="text" name="prenom" class="form-control" value=<?php if(isset($user)) echo("'".$user->getPrenom()."'"); ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="admin">Administrateur</label>
			<div class="col-md-3">
				<input id="admin" type="checkbox" name="admin" class="form-control" value=<?php if(isset($user)) echo("'".$user->isAdmin()."'"); ?>>
			</div>
		</div>
		<div class="col-md-offset-3">
			<button id="submit" class="btn btn-primary">Valider</button>
			<button id="back" class="btn btn-info">Retour</button>
		</div>
		<!-- <input id="hidden" type="hidden" name="login" > Pas deux éléments avec le même nom !--> 

	</form>
</div>
<!-- <div id="successdiv" class="col-md-offset-1 col-md-10 alert alert-success" style="margin-top : 15px">
			<h4 align="center">Enregistrement réussi ! Cliquer pour revenir à la liste.</h4>
</div>
<div id="faildiv" class="col-md-offset-3 col-md-6 alert alert-danger" style="margin-top : 15px">
			<h3 align="center">Echec ...</h3>
</div> -->

<script>

$(function(){
	$('.alert').hide();

	$('#submit').click(function(event){
		event.preventDefault();
			//Valider le conformité du formulaire et l'envoyer si OK, alerter sinon.
			//Si valide alors : 

			$this = $('#newuser');
			//mail("'".$_POST['login']."'"+"@utc.fr", "Accès plateforme d'inscription de Secourut\'s", "Bonjour, \n Votre compte vient d\'être ajouté sur le site d'inscriptions aux postes de secours de Secourut's. \n Merci de vous connecter à l\'adresse suivante pour compléter votre profil : ");
			//mail("morgane.becret@gmail.com", "Accès plateforme d'inscription de Secourut\'s", "Bonjour, \n Votre compte vient d\'être ajouté sur le site d'inscriptions aux postes de secours de Secourut's. \n Merci de vous connecter à l\'adresse suivante pour compléter votre profil : ");
			//Envoi en ajax :
			$.ajax({
                url: $this.attr('action'), // Le nom du fichier indiqué dans le formulaire
                type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
                data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                success: function(html) {
                	toastr.clear();
                	toastr.success('Enregistrement réussi !');
                	$('#submit').text("Modifier");
                	$('#hidden').attr('value', html);
                },
                error: {
                	//toastr.error('Echec');
                }

            });

		});
	
	//$('#successdiv').click(function(){
		//$('#content').load('../ajax/users_content');
	//});

	$('#back').click(function(event){
		event.preventDefault();
		$('#content').load('../ajax/users_content');
	});
});

</script>