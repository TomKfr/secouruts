
<style type="text/css">
	input{
		text-align: center;
	}
	label ~ div {
		margin-top: 10px;
	}
</style>

<div class="right-content">
	<h3>Modification du Profil de <?php echo $user2->getLogin() ?></h3>
</div>
<div id="formdiv" class="col-md-12" style="margin-top : 15px">
	<form id="modifuser" class="form-horizontal" method='post' action="../secouriste/modify_user/<?php echo $user2->getLogin() ?>">
		<fieldset id="target">
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label class="col-md-4 control-label" for="name">Nom</label>  
									<div class="col-md-4">
										<input id="name" name="nom" type="text" placeholder="" class="form-control input-md" required="" value=<?php if($user2->getNom() != null ) echo("'".$user2->getNom()."'"); ?>>
									</div>							
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 control-label" for="surname">Prénom</label>  
									<div class="col-md-4">
										<input id="surname" name="prenom" type="text" placeholder="" class="form-control input-md"  required="" value=<?php if($user2->getPrenom() != null ) echo("'".$user2->getPrenom()."'"); ?>>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label class="col-md-4 control-label" for="ddn">Date de naissance</label>  
									<div class="col-md-4">
										<input id="ddn" name="ddn" type="text" placeholder="" class="form-control input-md " required="" value=<?php if($user2->getDDN() != null && $user2->getDDN()->format('Y') > 1900) echo("'".$user2->getDDN()->format('d/m/Y')."'"); ?> >
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 control-label" for="ldn">Lieu de naissance</label>  
									<div class="col-md-4">
										<input id="ldn" name="ldn" type="text" placeholder="" class="form-control input-md"  required="" value=<?php if($user2->getLDN() != null ) echo("'".$user2->getLDN()."'"); ?>>

									</div>
								</div>
							</div>
						</div>
						<h4>Diplômes obtenus :</h4>
						<div id="dips" class="row"> <!-- PSE1 & PSE2 -->
						  <div class="col-md-5">
						  	<label class="col-md-4 control-label" for="pse1">PSE1</label>
						    <div class="input-group">
						      <span class="input-group-addon">
						        <input id="pse1" name="pse1" type="checkbox" placeholder="" <?php if(($dip = $user2->getDiplome("PSE1")) != null) echo "checked" ?> >
						      </span>
						      <input id="date_pse1" name="date_pse1" type="text" placeholder="Date d'obtention" class="form-control input-md datepicker" value=<?php if($dip != null) echo '"'.$dip.'"' ?> >
						    </div><!-- /input-group -->
						  </div><!-- /.col-md-6 -->
						  <div class="col-md-5">
						  	<label class="col-md-4 control-label" for="pse2">PSE2</label>  
						    <div class="input-group">
						      <span class="input-group-addon">
						        <input id="pse2" name="pse2" type="checkbox" placeholder="" <?php if(($dip = $user2->getDiplome("PSE2")) != null) echo "checked" ?> >
						      </span>
						      <input id="date_pse2" name="date_pse2" type="text" placeholder="Date d'obtention" class="form-control input-md datepicker" value=<?php if($dip != null) echo '"'.$dip.'"' ?> >
						    </div><!-- /input-group -->
						  </div><!-- /.col-md-6 -->
						</div><!-- /.row -->

						<div class="row"> <!-- COD1 & COD2 -->
						  <div class="col-md-5">
						  	<label class="col-md-4 control-label" for="cod1">COD1</label> 
						    <div class="input-group">
						      <span class="input-group-addon">
						        <input id="cod1" name="cod1" type="checkbox" placeholder="" <?php if(($dip = $user2->getDiplome("COD1")) != null) echo "checked" ?> >
						      </span>
						      <input id="date_cod1" name="date_cod1" type="text" placeholder="Date d'obtention" class="form-control input-md datepicker" value=<?php if($dip != null) echo '"'.$dip.'"' ?>>
						    </div><!-- /input-group -->
						  </div><!-- /.col-md-6 -->
						  <div class="col-md-5">
						  	<label class="col-md-4 control-label" for="cod2">COD2</label>
						    <div class="input-group">
						      <span class="input-group-addon">
						        <input id="cod2" name="cod2" type="checkbox" placeholder="" <?php if(($dip = $user2->getDiplome("COD2")) != null) echo "checked" ?> >
						      </span>
						      <input id="date_cod2" name="date_cod2" type="text" placeholder="Date d'obtention" class="form-control input-md datepicker" value=<?php if($dip != null) echo '"'.$dip.'"' ?>>
						    </div><!-- /input-group -->
						  </div><!-- /.col-md-6 -->
						</div><!-- /.row -->

						<div class="row"> <!-- LAT & VPSP -->
						  <div class="col-md-5">
						  	<label class="col-md-4 control-label" for="lat">LAT</label>  
						    <div class="input-group">
						      <span class="input-group-addon">
						        <input id="lat" name="lat" type="checkbox" placeholder="" <?php if(($dip = $user2->getDiplome("LAT")) != null) echo "checked" ?> >
						      </span>
						      <input id="date_lat" name="date_lat" type="text" placeholder="Date d'obtention" class="form-control input-md datepicker" value=<?php if($dip != null) echo '"'.$dip.'"' ?>>
						    </div><!-- /input-group -->
						  </div><!-- /.col-md-6 -->
						  <div class="col-md-5">
						  	<label class="col-md-4 control-label" for="vpsp">VPSP</label>  
						    <div class="input-group">
						      <span class="input-group-addon">
						        <input id="vpsp" name="vpsp" type="checkbox" placeholder="" <?php if(($dip = $user2->getDiplome("VPSP")) != null) echo "checked" ?> >
						      </span>
						      <input id="date_vpsp" name="date_vpsp" type="text" placeholder="Date d'obtention" class="form-control input-md datepicker" value=<?php if($dip != null) echo '"'.$dip.'"' ?>>
						    </div><!-- /input-group -->
						  </div><!-- /.col-md-6 -->
						</div><!-- /.row -->

						<br>
						<div class="form-group">
							<!-- <label class="col-md-4 control5label" for="permis">Permis B</label>   -->
							<div class="col-md-offset-5 col-md-4">
								<label class="btn btn-primary">
								<input id="permis" type="checkbox" name="permis" <?php if($user2->isPermis() != null ) echo "checked" ?> > Permis B
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="address">Adresse</label>  
							<div class="col-md-4">
								
								<textarea id="address" name="adresse" class="form-control" required="" ><?php if($user2->getAdresse() != null ) echo($user2->getAdresse()); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="mail">Email</label>  
							<div class="col-md-4">
								<input id="mail" name="email" type="text" placeholder="" class="form-control input-md" required="" value=<?php if($user2->getEmail() != null ) echo("'".$user2->getEmail()."'"); ?> >

							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="phone">Téléphone</label>  
							<div class="col-md-4">
								<input id="phone" name="tel" type="text" placeholder="" class="form-control input-md" required="" value=<?php if($user2->getTel() != null ) echo("'".$user2->getTel()."'"); ?> >

							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="semestre">Semestre actuel </label>
							<div class="col-md-3">
								<select id="semestre" name="semestre" class="form-control">
									<option value="TC01" <?php if($user2->getSemestre() == 'TC01') echo "selected" ?> >TC01</option>
									<option value="TC02" <?php if($user2->getSemestre() == 'TC02') echo "selected" ?>>TC02</option>
									<option value="TC03" <?php if($user2->getSemestre() == 'TC03') echo "selected" ?>>TC03</option>
									<option value="TC04" <?php if($user2->getSemestre() == 'TC04') echo "selected" ?>>TC04</option>
									<option value="TC05" <?php if($user2->getSemestre() == 'TC05') echo "selected" ?>>TC05</option>
									<option value="TC06" <?php if($user2->getSemestre() == 'TC06') echo "selected" ?>>TC06</option>
									<option value="GX01" <?php if($user2->getSemestre() == 'GX01') echo "selected" ?>>GX01</option>
									<option value="GX02" <?php if($user2->getSemestre() == 'GX02') echo "selected" ?>>GX02</option>
									<option value="GX03" <?php if($user2->getSemestre() == 'GX03') echo "selected" ?>>GX03</option>
									<option value="GX04" <?php if($user2->getSemestre() == 'GX04') echo "selected" ?>>GX04</option>
									<option value="GX05" <?php if($user2->getSemestre() == 'GX05') echo "selected" ?>>GX05</option>
									<option value="GX06" <?php if($user2->getSemestre() == 'GX06') echo "selected" ?>>GX06</option>
									<option value="GX07" <?php if($user2->getSemestre() == 'GX07') echo "selected" ?>>GX07</option>
									<option value="Master" <?php if($user2->getSemestre() == 'Master') echo "selected" ?>>Master</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="taille">Taille de vêtements: </label>
							<div class="col-md-3">
								<select id="taille" name="taille" class="form-control">
									<option value="XS / 34" <?php if($user2->getTaille() == 'XS') echo "selected" ?>>XS / 34</option>
									<option value="S / 36" <?php if($user2->getTaille() == 'S') echo "selected" ?>>S / 36</option>
									<option value="M / 38" <?php if($user2->getTaille() == 'M') echo "selected" ?>>M / 38</option>
									<option value="L / 40" <?php if($user2->getTaille() == 'L') echo "selected" ?>>L / 40</option>
									<option value="XL / 42" <?php if($user2->getTaille() == 'XL') echo "selected" ?>>XL / 42</option>
									<option value="XXL / 44" <?php if($user2->getTaille() == 'XXl') echo "selected" ?>>XXL / 44</option>
									<option value="XXXL / 46" <?php if($user2->getTaille() == 'XXXL') echo "selected" ?>>XXXL / 46</option>
								</select>
							</div>
						</div>
					</fieldset>
					<input type="hidden" name="origin" value="adminview" />
			<div class="col-md-offset-4">
			<button id="submit" class="btn btn-primary">Enregistrer</button>
			<button id="back" class="btn btn-info">Retour</button>
			</div>
		<input id="hidden" type="hidden" name="id" value=<?php if(isset($user)) echo("'".$user->getLogin()."'"); ?> >
	</form>
</div>

	<script	src="../../src/bootstrap-datepicker.min.js"></script>
	<script	src="../../src/bootstrap-datepicker.fr.min.js"></script>

<script>

$(function(){
	$('#ddn').datepicker({ 
		language : 'fr',
		startView : 2
	});
	$('.datepicker').datepicker({ language : 'fr' });

	$('input[type="checkbox"][checked]').click(function(event){
			$(event.target).parent().next().prop('value','');
	});

	$('.datepicker').change(function(event){
			if($('.datepicker').val() != "") $(event.target).prev().children('input').prop('checked', true);
			else  $(event.target).prev().children('input').prop('checked', false);
	});

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
