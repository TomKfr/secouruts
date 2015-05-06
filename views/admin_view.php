 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="INDEX,FOLLOW">
	<title>	Accueil -     Secourut's

	</title>
	<link rel="stylesheet" href="../../src/css/reset.css" type="text/css" />
	<link rel="stylesheet" href="../../src/css/main.css" type="text/css" />
	<link rel="stylesheet" href="../../src/css/responsive.css" type="text/css" />
	<link rel="stylesheet" href="../../src/css/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="../../src/css/bootstrap-datetimepicker.min.css" type="text/css" />
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

</head>

<body>
	<!-- Ici, placer les éléments communs à toutes les pages -->


	<div class="header-container">
		<header>
			<a class="logo" href="/secouruts/" ></a>
			<div class="title red">Secourut's<br/>Sensibiliser, Alerter, Agir</div>	
		</header>
		<div class="col-lg-offset-9 col-lg-2">
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
		</div>
	</div>

	<div class="main-container">
		<div class="main">

			<div class="left-content">
				<div class="left-menu light-grey-bg">
					<li ><a href="../">Evènements</a></li>
					<li ><a href="../profile">Mon profil</a></li>
					<li class="selected"><a href="#">Administration</a></li>
				</div>
			</div>


			<div class="right-content">

				<h3 class="col-md-8">Administration :</h3>

				<ul class="nav nav-pills col-md-4">
					<li class="active" id="postes"><a>Postes</a></li>
					<li id="users"><a>Utilisateurs</a></li>
					<!-- <li ><a>Autre ??</a></li> -->
				</ul>
				<br>
				<div id="content">
				</div>

			</div>

		</div>

	</div>


	<!-- Ici, placer les éléments communs à toutes les pages -->

	<div class="footer-container">

		<footer>
			<span class="tools"> <span>Outils :</span>  <a href="/secouruts/contactus">Nous contacter</a> <a href="/secouruts/calendar">Calendrier</a> <a href="/secouruts/admin/">Administration</a> <a class="facebook" href="https://www.facebook.com/secouruts.utc"></a></span>		

			<span class="links"> <span>Liens utiles :</span> <span>	<a href="http://assos.utc.fr/asso/bde">BDE</a> | 	<a href="http://assos.utc.fr/">Portail des associations</a> | 	<a href="http://www.utc.fr/">UTC</a> | 	<a href="http://www.croixblanche.org/">Croix Blanche</a> </span> <a class="credit" href="/secouruts/credits"> Crédits </a></span>
		</footer>
	</div>


	<script src="https://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script	src="../../src/moment-with-locales.min.js"></script>
	<script	src="../../src/bootstrap-datepicker.js"></script>
	<script	src="../../src/bootstrap-datepicker.fr.min.js"></script>
	<script	src="../../src/bootstrap-datetimepicker.min.js"></script>
	<!-- <script src="http://assos.utc.fr/secouruts/javascript/loader.js" type="text/javascript"></script>
	<script src="http://assos.utc.fr/secouruts/bundles/fosjsrouting/js/router.js"></script>
	<script src="http://assos.utc.fr/secouruts/javascript/jquery.blockUI.js" type=text/javascript></script> -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#content').load('../ajax/postes_content'); //	AJAAAAAAAX !!!
			$("#postes").click(function(){
				if($('#postes').attr('class')!='active'){
					$("[class='active']").attr('class','');
					$('#postes').attr('class','active');
					$('#content').load('../ajax/postes_content');
				}
			});
			$("#users").click(function(){
				if(!$('#users').attr('class')!='active'){
					$("[class='active']").attr('class','');
					$('#users').attr('class','active');
					$('#content').load('../ajax/users_content');
				}
			});
		});
	</script>

</body>
</html>
