<div class="right-content">
	<h3>Modification du Profil de <?php echo $user->getLogin() ?></h3>
</div>
<div id="formdiv" class="col-md-12" style="margin-top : 15px">
	<form id="modifuser" class="form-horizontal" method='post' action="../secouriste/modify_user/<?php echo $user->getLogin() ?>">
		<div class="form-group col-md-5">
			<label class="col-md-4 control-label" for="titre">Nom</label>  
			<div class="col-md-4">
				<input id="nom" name="nom" type="text" class="form-control" value=<?php if(isset($user)) echo("'".$user->getNom()."'"); ?> >
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="prenom">Prénom</label>
			<div class="col-md-4">
				<input id="prenom" type="text" name="prenom" class="form-control" value=<?php if(isset($user)) echo("'".$user->getPrenom()."'"); ?>>
			</div>
		</div>
		<div class="form-group col-md-5">
			<label class="col-md-4 control-label" for="ddn">Date de naissance</label>  
			<div class="col-md-4">
				<input id="ddn" name="ddn" type="text" placeholder="" class="form-control input-md" required="" value=<?php if($user->getDDN() != null && $user->getDDN()->format('Y') > 1900) echo("'".$user->getDDN()->format('d/m/Y')."'"); ?> >
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="ldn">Lieu de naissance</label>  
			<div class="col-md-4">
				<input id="ldn" name="ldn" type="text" placeholder="" class="form-control input-md"  required="" value=<?php if(isset($user)) echo("'".$user->getLDN()."'"); ?>>
			</div>
		</div>
		<div class="right-content">
			<h4>Diplômes obtenus :</h4>
		</div>
		<div class="form-group col-md-5">
			<label class="col-md-4 control-label" for="pse1">PSE1</label>  
			<div class="col-md-4">
				<input id="pse1" name="pse1" type="checkbox" placeholder="" class="form-control input-md" >
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
			<div class="col-md-4">
				<input id="date_pse1" name="date_pse1" type="text" placeholder="" class="form-control input-md datepicker">
			</div>
		</div>
		<div class="form-group col-md-5">
			<label class="col-md-4 control-label" for="pse2">PSE2</label>  
			<div class="col-md-4">
				<input id="pse2" name="pse2" type="checkbox" placeholder="" class="form-control input-md">
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
				<div class="col-md-4">
					<input id="date_pse2" name="date_pse2" type="text" placeholder="" class="form-control input-md datepicker">
				</div>
		</div>
		<div class="form-group col-md-5">
			<label class="col-md-4 control-label" for="lat">LAT</label>  
			<div class="col-md-4">
				<input id="lat" name="lat" type="checkbox" placeholder="" class="form-control input-md datepicker">
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
				<div class="col-md-4">
					<input id="date_lat" name="date_lat" type="text" placeholder="" class="form-control input-md datepicker">
				</div>
		</div>
		<div class="form-group col-md-5">
			<label class="col-md-4 control-label" for="cod1">COD1</label>  
			<div class="col-md-4">
				<input id="cod1" name="cod1" type="checkbox" placeholder="" class="form-control input-md">
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
				<div class="col-md-4">
					<input id="date_cod1" name="date_cod1" type="text" placeholder="" class="form-control input-md datepicker">
				</div>
		</div>
		<div class="form-group col-md-5">
			<label class="col-md-4 control-label" for="cod2">COD2</label>  
			<div class="col-md-4">
				<input id="cod2" name="cod2" type="checkbox" placeholder="" class="form-control input-md">
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
				<div class="col-md-4">
					<input id="date_cod2" name="date_cod2" type="text" placeholder="" class="form-control input-md datepicker">
				</div>
		</div>
		<div class="form-group col-md-5">
			<label class="col-md-4 control-label" for="vpsp">VPSP</label>  
			<div class="col-md-4">
				<input id="vpsp" name="vpsp" type="checkbox" placeholder="" class="form-control input-md">
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
				<div class="col-md-4">
					<input id="date_vpsp" name="date_vpsp" type="text" placeholder="" class="form-control input-md datepicker">
				</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label" for="admin">Administrateur</label>
			<div class="col-md-3">
				<input id="admin" type="checkbox" name="admin" class="form-control" value=<?php if(isset($user)) echo("'".$user->isAdmin()."'"); ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label" for="permis">Permis B</label>
			<div class="col-md-3">
				<input id="permis" type="checkbox" name="permis" class="form-control" value=<?php if(isset($user)) echo("'".$user->isPermis()."'"); ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label" for="address">Adresse</label>  
			<div class="col-md-3">
				<textarea id="address" name="adresse" class="form-control" required="" value=<?php if(isset($user)) echo("'".$user->getAdresse()."'"); ?> ></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label" for="mail">Email</label>  
			<div class="col-md-3">
				<input id="mail" name="email" type="text" placeholder="" class="form-control input-md" required="" value=<?php if(isset($user)) echo("'".$user->getEmail()."'"); ?> >
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label" for="phone">Téléphone</label>  
			<div class="col-md-3">
				<input id="phone" name="tel" type="text" placeholder="" class="form-control input-md" required="" value=<?php if(isset($user)) echo("'".$user->getTel()."'"); ?> >
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label" for="semestre">Semestre actuel </label>
			<div class="col-md-3">
				<select id="semestre" name="semestre" class="form-control">
					<option value="TC01">TC01</option>
					<option value="TC02">TC02</option>
					<option value="TC03">TC03</option>
					<option value="TC04">TC04</option>
					<option value="TC05">TC05</option>
					<option value="TC05">TC06</option>
					<option value="GX01">GX01</option>
					<option value="GX02">GX02</option>
					<option value="GX03">GX03</option>
					<option value="GX04">GX04</option>
					<option value="GX05">GX05</option>
					<option value="GX06">GX06</option>
					<option value="GX07">GX07</option>
					<option value="Master">Master</option>
				</select>
			</div>
			<input id="other" name="other" type="text" placeholder=" Autre (préciser)" class="form-control input-md" >
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label" for="taille">Taille de vêtements: </label>
			<div class="col-md-3">
				<select id="taille" name="taille" class="form-control">
					<option value="XS">XS / 34</option>
					<option value="S">S / 36</option>
					<option value="M">M / 38</option>
					<option value="L">L / 40</option>
					<option value="XL">XL / 42</option>
					<option value="XXL">XXL / 44</option>
					<option value="XXXL">XXXL / 46</option>
				</select>
			</div>
		</div>
		<div class="col-md-offset-4">
			<button id="submit" class="btn btn-primary">Enregistrer</button>
			<button id="back" class="btn btn-info">Retour</button>
		</div>
		<input id="hidden" type="hidden" name="id" value=<?php if(isset($user)) echo("'".$user->getLogin()."'"); ?> >

	</form>
</div>
<!-- <div id="successdiv" class="col-md-offset-1 col-md-10 alert alert-success" style="margin-top : 15px">
			<h4 align="center">Enregistrement réussi !</h4>
</div>
<div id="faildiv" class="col-md-offset-3 col-md-6 alert alert-danger" style="margin-top : 15px">
			<h3 align="center">Echec ...</h3>
</div> -->

	<script	src="../../src/bootstrap-datepicker.min.js"></script>
	<script	src="../../src/bootstrap-datepicker.fr.min.js"></script>

<script>

$(function(){
	$('#ddn').datepicker({ 
		language : 'fr',
		startView : 2
	});
	$('.datepicker').datepicker({ language : 'fr' });

	$('#submit').click(function(event){
			event.preventDefault();
			//Valider la conformité du formulaire et l'envoyer si OK, alerter sinon.
			//Si valide alors : 
			//Envoi en ajax :
			$.ajax({
                url: $('#modifuser').attr('action'), // Le nom du fichier indiqué dans le formulaire
                type: $('#modifuser').attr('method'), // La méthode indiquée dans le formulaire (get ou post)
                data: $('#modifuser').serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                success: function(html) {
                	toastr.clear();
                	toastr.success('Enregistrement réussi !');
                	$('#hidden').attr('value', html);
                },
                error: function() {
                	toastr.error('Il y a eu un problème...');
                }
            });

		});

	$('#back').click(function(event){
		event.preventDefault();
		$('#content').load('../ajax/users_content');
	});
});

</script>
