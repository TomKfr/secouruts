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

</head>

<body>
	<!-- Ici, placer les éléments communs à toutes les pages -->

	<div class="header-container">
		<header>
			<a class="logo" href="/secouruts/" ></a>
			<div class="title red">Secourut's<br/>Sensibiliser, Alerter, Agir</div>	
		</header>
		<!-- <div class="col-lg-offset-9 col-lg-2">
			<ul class="nav nav-pills">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><?php echo $user?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="./index.php/logout">Déconnexion</a></li>
					</ul>
				</li>
			</ul>
		</div> -->
	</div>

	<div class="main-container">
		<div class="main">

			<!-- <div class="left-content">
				<div class="left-menu light-grey-bg">
					<li ><a href="./">Evènements</a></li>
					<li class="selected"><a href="#">Mon profil</a></li>
					<li ><a href="./admin">Administration</a></li>
				</div>
			</div> -->

			<nav class="navbar navbar-default">
				<div class="container-fluid">

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li ><a href="./">Evènements</a></li>
							<li class="active"><a href="#">Mon profil</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="./admin/dps">Postes</a></li>
									<li><a href="./admin/users">Utilisateurs</a></li>
								</ul>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $user?> <span class="caret"></span></a>
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
				<form id="form" class="form-horizontal" method="get" action="../secouriste/profil_user">
					<fieldset id="target">
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label class="col-md-4 control-label" for="name">Nom</label>  
									<div class="col-md-4">
										<input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="" value=<?php if(isset($secouriste)) echo("'".$secouriste->getNom()."'"); ?>>
									</div>							
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 control-label" for="surname">Prénom</label>  
									<div class="col-md-4">
										<input id="surname" name="surname" type="text" placeholder="" class="form-control input-md"  required="" value=<?php if(isset($secouriste)) echo("'".$secouriste->getPrenom()."'"); ?>>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label class="col-md-4 control-label" for="ddn">Date de naissance</label>  
									<div class="col-md-4">
										<input id="ddn" name="ddn" type="text" placeholder="" class="form-control input-md" required="" value=<?php if(isset($secouriste)) echo("'".$secouriste->getDDN()."'"); ?> >
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 control-label" for="ldn">Lieu de naissance</label>  
									<div class="col-md-4">
										<input id="ldn" name="ldn" type="text" placeholder="" class="form-control input-md"  required="" value=<?php if(isset($secouriste)) echo("'".$secouriste->getLDN()."'"); ?>>

									</div>
								</div>
							</div>
						</div>
						<h4>Diplômes obtenus :</h4>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label class="col-md-4 control-label" for="pse1">PSE1</label>  
									<div class="col-md-4">
										<input id="pse1" name="pse1" type="checkbox" placeholder="" class="form-control input-md" >
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
									<div class="col-md-4">
										<input id="date_pse1" name="date_pse1" type="text" placeholder="" class="form-control input-md">

									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label class="col-md-4 control-label" for="pse2">PSE2</label>  
									<div class="col-md-4">
										<input id="pse2" name="pse2" type="checkbox" placeholder="" class="form-control input-md">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
									<div class="col-md-4">
										<input id="date_pse2" name="date_pse2" type="text" placeholder="" class="form-control input-md">

									</div>
								</div>
							</div>
							<div id="alert" class="col-md-10 alert alert-danger" style="display:none">
								<p align="center">Au moins un des deux diplômes est requis !</p>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label class="col-md-4 control-label" for="lat">LAT</label>  
										<div class="col-md-4">
											<input id="lat" name="lat" type="checkbox" placeholder="" class="form-control input-md">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
										<div class="col-md-4">
											<input id="date_lat" name="date_lat" type="text" placeholder="" class="form-control input-md">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label class="col-md-4 control-label" for="cod1">COD1</label>  
										<div class="col-md-4">
											<input id="cod1" name="cod1" type="checkbox" placeholder="" class="form-control input-md">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
										<div class="col-md-4">
											<input id="date_cod1" name="date_cod1" type="text" placeholder="" class="form-control input-md">

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label class="col-md-4 control-label" for="cod2">COD2</label>  
										<div class="col-md-4">
											<input id="cod2" name="cod2" type="checkbox" placeholder="" class="form-control input-md">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
										<div class="col-md-4">
											<input id="date_cod2" name="date_cod2" type="text" placeholder="" class="form-control input-md">

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label class="col-md-4 control-label" for="vpsp">VPSP</label>  
										<div class="col-md-4">
											<input id="vpsp" name="vpsp" type="checkbox" placeholder="" class="form-control input-md">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-4 control-label" for="date_dip">Date d'obtention</label>  
										<div class="col-md-4">
											<input id="date_vpsp" name="date_vpsp" type="text" placeholder="" class="form-control input-md">

										</div>
									</div>
								</div>
							</div>
						<br>
						<div class="form-group">
							<label class="col-md-4 control-label" for="permis">Permis B</label>  
							<div class="col-md-4">
								<input id="permis" type="checkbox" name="permis" class="form-control" value=<?php if(isset($secouriste)) echo("'".$secouriste->isPermis()."'"); ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="address">Adresse</label>  
							<div class="col-md-4">
								
								<textarea id="address" name="address" class="form-control" required="" value=<?php if(isset($secouriste)) echo("'".$secouriste->getAdresse()."'"); ?> ></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="mail">Email</label>  
							<div class="col-md-4">
								<input id="mail" name="mail" type="text" placeholder="" class="form-control input-md" required="" value=<?php if(isset($secouriste)) echo("'".$secouriste->getEmail()."'"); ?> >

							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="phone">Téléphone</label>  
							<div class="col-md-4">
								<input id="phone" name="phone" type="text" placeholder="" class="form-control input-md" required="" value=<?php if(isset($secouriste)) echo("'".$secouriste->getTel()."'"); ?> >

							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="semestre">Semestre actuel </label>
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
							<label class="col-md-4 control-label" for="taille">Taille de vêtements: </label>
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
						<div class="form-group">
							<div class="col-md-2 col-md-offset-4">
								<button id="validate" class="btn btn-primary">Valider</button>
							</div>
						</div>
					</fieldset>
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
	<!-- <script src="http://assos.utc.fr/secouruts/javascript/jquery.blockUI.js" type=text/javascript></script>
	<script src="http://assos.utc.fr/secouruts/javascript/loader.js" type="text/javascript"></script>
	<script src="http://assos.utc.fr/secouruts/bundles/fosjsrouting/js/router.js"></script> -->
	<script type="text/javascript">
	$(function() {
		$( "#ddn" ).datepicker();
		$("#date_pse1").datepicker();
		$("#date_pse2").datepicker();

		function hide_alert(){
			$("#alert").hide("slow");
		}

		$("#validate").click(function(){
			if($("#pse1").prop('checked') || $("#pse2").prop('checked')){
    				//envoyer les données
    				$("#form").submit();
    			}
    			else{
    				$("#alert").show("slow");
    			}
    		});

		$("#pse1").change(hide_alert);
		$("#pse2").change(hide_alert);

	});
	</script>

</body>
</html>
