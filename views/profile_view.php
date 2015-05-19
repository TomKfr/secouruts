<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="INDEX,FOLLOW">
	<title>	Accueil -     Secourut's

	</title>
	<link rel="stylesheet" href="../src/css/reset.css" type="text/css" />
	<link rel="stylesheet" href="../src/css/main.css" type="text/css" />
	<link rel="stylesheet" href="../src/css/responsive.css" type="text/css" />
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
	<link rel="stylesheet" href="../src/css/bootstrap-datepicker3.min.css">

	<style type="text/css">
	input{
		text-align: center;
	}
	label ~ div {
		margin-top: 10px;
	}
	</style>

</head>

<body>
	<!-- Ici, placer les éléments communs à toutes les pages -->

	<div class="header-container">
		<header>
			<a class="logo" href="/secouruts/" ></a>
			<div class="title red">Secourut's<br/>Sensibiliser, Alerter, Agir</div>	
		</header>
	</div>

	<div class="main-container">
		<div class="main">

			<nav class="navbar navbar-default">
				<div class="container-fluid">

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<?php if($display_all) echo '<li ><a href="./">Evènements</a></li>' ?>
							<li class="active"><a href="#">Mon profil</a></li>
							<?php if($user2->isAdmin() && $display_all) { ?>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="./admin/dps">Postes</a></li>
									<li><a href="./admin/users">Utilisateurs</a></li>
								</ul>
							</li>
							<?php } ?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $user2->getLogin() ?> <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="./logout">Déconnexion</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>

			<div class="col-md-12">
				<h3>Profil utilisateur</h3>
				<?php if(!$display_all) { ?>
				<div id="infodiv" class="alert alert-info">
					<p>C'est ta première visite sur le site, pour continuer tu dois d'abord compléter ton profil utilisateur.</p>
				</div>
				<?php } ?>
				<form id="form" class="form-horizontal" method="post" action="./secouriste/modify_user/<?php echo $user2->getLogin() ?>">
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
									<option value="XS" <?php if($user2->getTaille() == 'XS') echo "selected" ?>>XS / 34</option>
									<option value="S" <?php if($user2->getTaille() == 'S') echo "selected" ?>>S / 36</option>
									<option value="M" <?php if($user2->getTaille() == 'M') echo "selected" ?>>M / 38</option>
									<option value="L" <?php if($user2->getTaille() == 'L') echo "selected" ?>>L / 40</option>
									<option value="XL" <?php if($user2->getTaille() == 'XL') echo "selected" ?>>XL / 42</option>
									<option value="XXL" <?php if($user2->getTaille() == 'XXl') echo "selected" ?>>XXL / 44</option>
									<option value="XXXL" <?php if($user2->getTaille() == 'XXXL') echo "selected" ?>>XXXL / 46</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 col-md-offset-5">
								<button id="validate" class="btn btn-primary"> Valider </button>
							</div>
						</div>
					</fieldset>
					<input type="hidden" name="origin" value="profileview" />
				</form>


			</div>

		</div>

	</div>


	<!-- Ici, placer les éléments communs à toutes les pages -->

	<div class="footer-container">

		<footer>
			

			<span class="links"> <span>Liens utiles :</span> <span>	<a href="http://assos.utc.fr/asso/bde">BDE</a> | 	<a href="http://assos.utc.fr/">Portail des associations</a> | 	<a href="http://www.utc.fr/">UTC</a> | 	<a href="http://www.croixblanche.org/">Croix Blanche</a> </span> 
		</footer>
	</div>


	<script src="https://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
	<script	src="../src/bootstrap-datepicker.min.js"></script>
	<script	src="../src/bootstrap-datepicker.fr.min.js"></script>
	<script	src="../src/moment-with-locales.min.js"></script>
	<script	src="../src/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript">
	$(function() {

		$('.datepicker').datepicker({
			startView : 1,
			language : 'fr'
		});
		$('.datepicker').click(function(event){
			$(event.target).prev().children('input').prop('checked', true);
		});

		$('#ddn').datepicker({
			startView : 2,
			language : 'fr'
		});

		$('input[type="checkbox"][checked]').click(function(event){
			$(event.target).parent().next().prop('value','');
		});

		function redirect(){
			document.location.href = './';
		};

		$("#validate").click(function(event){
			event.preventDefault();

			var valid = true;

			if($('#pse2').prop('checked')){
				if(!$('#pse1').prop('checked')){
					toastr.warning('Tu dois également enregistrer ton PSE1 !');
					valid = false;
				}
			}

			// Valider le formulaire
			if(valid){ // Seulement si le formulaire est valide.
				$.ajax({
					type: "POST",
					url: $('#form').attr('action'),
					data : $('#form').serialize(),
					success: function(txt){
						if(<?php echo $display_all?'true':'false' ?>) {
							toastr.success("Modifications enregistrées");
							$('#validate').text("Modifier");
						}
						else{
							toastr.success("Ton profil est complet, retour à la page d'accueil");
							setTimeout(redirect, 1500);
						}
					},
					error: function(txt){
						alert(txt);
					}
				});
			}

		});

	});
	</script>

</body>
</html>
