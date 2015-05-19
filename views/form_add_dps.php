<div id="formdiv" class="col-md-12" style="margin-top : 15px">
	<form id="newpost" class="form-horizontal" method='post' action="../dps/new_post">
		<div class="form-group col-md-12">
			<label class="col-md-4 control-label" for="titre">Titre</label>  
			<div class="col-md-8">
				<input id="titre" name="titre" type="text" class="form-control" value=<?php if(isset($dps)) echo("'".$dps->getTitre()."'"); ?> >
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6 form-group">
				<label class="col-md-4 control-label" for="datedeb">Début</label>
				<div class="col-md-8">
					<input id="datedeb" type="text" name="datedeb" class="form-control datetimepicker" value=<?php if(isset($dps)) echo("'".$dps->getDebut()->format('d/m/Y H:i')."'"); ?> >
				</div>
			</div>
			<div class="col-md-6 form-group">
				<label class="col-md-4 control-label" for="datefin">Fin</label>
				<div class="col-md-8">
					<input id="datefin" type="text" name="datefin" class="form-control datetimepicker" value=<?php if(isset($dps)) echo("'".$dps->getFin()->format('d/m/Y H:i')."'"); ?> >
				</div>
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="typpost">Type</label>
			<div class="col-md-8">
				<select id="typpost" name="typpost" class="form-control">
					<option value="" <?php if(isset($dps)) {if($dps->getType() == "") echo("selected");} ?> ></option>
					<option value="PAPS" <?php if(isset($dps)) {if($dps->getType() == "PAPS") echo("selected");} ?> >PAPS</option>
					<option value="DPS-PE" <?php if(isset($dps)) {if($dps->getType() == "DPS-PE") echo("selected");} ?> >DPS-PE</option>
					<option value="DPS-ME" <?php if(isset($dps)) {if($dps->getType() == "DPS-ME") echo("selected");} ?> >DPS-ME</option>
					<option value="DPS-GE" <?php if(isset($dps)) {if($dps->getType() == "DPS-GE") echo("selected");} ?> >DPS-GE</option>
				</select>
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-4 control-label" for="lieu">Lieu</label>
			<div class="col-md-8">
				<input id="lieu" type="text" name="lieu" class="form-control" value=<?php if(isset($dps)) echo("'".$dps->getLieu()."'"); ?> >
			</div>
		</div>
		<div class="form-group col-md-12">
			<label class="col-md-4 control-label" for="limitdate">Date limite d'inscription</label>
			<div class="col-md-4">
				<input id="limitdate" type="text" name="limitdate" class="form-control" value=<?php if(isset($dps)) echo("'".$dps->getLimitDate()->format('d/m/Y')."'"); ?> >
			</div>
		</div>
		<div class="form-group col-md-12">
			<label class="col-md-4 control-label" for="client">Client</label>
			<div class="col-md-8">
				<input id="client" type="text" name="client" class="form-control" value=<?php if(isset($dps)) echo("'".$dps->getClient()."'"); ?> >
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-5 control-label" for="nbpse1">PSE1 requis</label>
			<div class="col-md-7">
				<input id="nbpse1" type="text" name="nbpse1" class="form-control" value=<?php if(isset($dps)) echo("'".$dps->getPSE1()."'"); ?> >
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-5 control-label" for="nbpse2">PSE2 requis</label>
			<div class="col-md-7">
				<input id="nbpse2" type="text" name="nbpse2" class="form-control" value=<?php if(isset($dps)) echo("'".$dps->getPSE2()."'"); ?> >
			</div>
		</div>
		<div class="form-group col-md-12">
			<label class="col-md-4 control-label" for"desc">Description</label>
			<div class="col-md-8">
				<textarea id="desc" name="desc" class="form-control"><?php if(isset($dps)) echo($dps->getDesc()); ?></textarea>
			</div>
		</div>
		<div class="col-md-offset-5">
			<button id="submit" class="btn btn-primary">Valider</button>
			<button id="back" class="btn btn-info">Retour</button>
		</div>
		<input id="hidden" type="hidden" name="id" value=<?php if(isset($dps)) echo("'".$dps->getId()."'"); ?> >

	</form>
</div>

<script	src="../../src/moment-with-locales.min.js"></script>
<script	src="../../src/bootstrap-datepicker.js"></script>
<script	src="../../src/bootstrap-datepicker.fr.min.js"></script>
<script	src="../../src/bootstrap-datetimepicker.min.js"></script>

<script>

$(function(){
	$('.datetimepicker').datetimepicker({ locale: 'fr'});
	$('#limitdate').datepicker({language: 'fr'});
	$('.alert').hide();

	$('#submit').click(function(event){
			event.preventDefault();
			//Valider la conformité du formulaire et l'envoyer si OK, alerter sinon.
			//Si valide alors : 

			//Envoi en ajax :
			// $.ajax({
   //              url: $('#newpost').attr('action'), // Le nom du fichier indiqué dans le formulaire
   //              type: $('#newpost').attr('method'), // La méthode indiquée dans le formulaire (get ou post)
   //              data: $('#newpost').serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
   //              success: function(html) {
   //              	toastr.clear();
   //              	toastr.success('Enregistrement réussi !');
   //              	$('#submit').text("Modifier");
   //              	$('#hidden').attr('value', html);
   //              },
   //              error: {
   //              	//toastr.error('Il y a eu un problème...');
   //              }
   //          });
		var date = moment($('#datedeb').val(), "DD-MM-YYYY HH:mm");
		 
		alert(date);

	});

	$('#back').click(function(event){
		event.preventDefault();
		$('#content').load('../ajax/postes_content');
	});
});

</script>