 
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

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
					<li class="selected"><a href="#">Evènements</a></li>
					<li ><a href="./profile">Mon profil</a></li>
					<li ><a href="./admin">Administration</a></li>
				</div>
			</div>


			<div class="right-content">

				<h3>Evènements à venir :</h3>
				<div id="accordion">
					<h3>Evènement 1</h3>
					<div>
						<p>
							Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
							ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
							amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
							odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
						</p>
					</div>
					<h3>Gros évènement de la mort !</h3>
					<div>
						<p>
							Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
							purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
							velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
							suscipit faucibus urna.
						</p>
					</div>
					<h3>FAAT évènement</h3>
					<div>
						<p>
							Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
							Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
							ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
							lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
						</p>
						<ul>
							<li>List item one</li>
							<li>List item two</li>
							<li>List item three</li>
						</ul>
					</div>
					<h3>Le dernier tout pourri ...</h3>
					<div>
						<p>
							Cras dictum. Pellentesque habitant morbi tristique senectus et netus
							et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
							faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
							mauris vel est.
						</p>
						<p>
							Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
							Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
							inceptos himenaeos.
						</p>
					</div>
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
	/*<!-- <script src="http://assos.utc.fr/secouruts/javascript/jquery.blockUI.js" type=text/javascript></script>
	<script src="http://assos.utc.fr/secouruts/javascript/loader.js" type="text/javascript"></script>
	<script src="http://assos.utc.fr/secouruts/bundles/fosjsrouting/js/router.js"></script> -->*/
	<script type="text/javascript">
		$(function(){
			$('#accordion').accordion();
		});
	</script>

</body>
</html>
