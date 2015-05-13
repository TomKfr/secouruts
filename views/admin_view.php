 
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
	</div>

	<div class="main-container">
		<div class="main">

			<nav class="navbar navbar-default">
				<div class="container-fluid">

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li ><a href="../">Evènements</a></li>
							<li ><a href="../profile">Mon profil</a></li>
								<li class="dropdown active">
								<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li id="dpstoggle"><a >Postes</a></li>
									<li id="userstoggle"><a >Utilisateurs</a></li>
								</ul>
							</li>
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

				<div class="col-lg-12" id="content" target="<?php echo $target ?>">
				</div>

		</div>

	</div>


	<!-- Ici, placer les éléments communs à toutes les pages -->

	<div class="footer-container">

		<footer>
			

			<span class="links"> <span>Liens utiles :</span> <span>	<a href="http://assos.utc.fr/asso/bde">BDE</a> | 	<a href="http://assos.utc.fr/">Portail des associations</a> | 	<a href="http://www.utc.fr/">UTC</a> | 	<a href="http://www.croixblanche.org/">Croix Blanche</a> </span> 
		</footer>
	</div>


	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	<!-- <script src="http://assos.utc.fr/secouruts/javascript/loader.js" type="text/javascript"></script>
	<script src="http://assos.utc.fr/secouruts/bundles/fosjsrouting/js/router.js"></script>
	<script src="http://assos.utc.fr/secouruts/javascript/jquery.blockUI.js" type=text/javascript></script> -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
	<script type="text/javascript">
	$(function(){
		if($('#content').attr('target') == 'dps') $('#content').load('../ajax/postes_content');
		if($('#content').attr('target') == 'users') $('#content').load('../ajax/users_content');

		$('#dpstoggle').click(function(){
			$('#content').load('../ajax/postes_content');
		});

		$('#userstoggle').click(function(){
			$('#content').load('../ajax/users_content');
		});
	});
	</script>

</body>
</html>
