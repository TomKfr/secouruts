<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="INDEX,FOLLOW">
	<title>	Accueil - événements</title>
	<link rel="stylesheet" href="../src/css/reset.css" type="text/css" />
	<link rel="stylesheet" href="../src/css/main.css" type="text/css" />
	<link rel="stylesheet" href="../src/css/responsive.css" type="text/css" />
	<link rel="stylesheet" href="../src/css/layout.css" type="text/css" />
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
	<style type="text/css">
	th:hover{
		background-color: #e8e8e8;
	}
	.red{
		font-color : #ed0000;
	}
	table{
		margin-top: 15px;
	}
	</style>

</head>

<body>
	<div class="wrapper">
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
								<li class="active"><a href="#">Evènements</a></li>
								<li ><a href="./profile">Mon profil</a></li>
								<?php if($user2->isAdmin()) { ?>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration <span class="caret"></span></a>
									<ul id="test" class="dropdown-menu" role="menu">
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

				<div class="col-lg-12">
					<h3>Evènements à venir :</h3>
					<div id="accordion">
						<?php
						if(isset($postes)){
							foreach ($postes as $dps) {
								$closed = $dps->isclosed();
								if(!$dps->isCancelled() && !$dps->date_passed()){
									echo "<h3> <b>".$dps->getTitre()." - ".$dps->getDebut()->format('d/m/Y \d\e H:i').$dps->getFin()->format(' \à H:i')."</b></h3>";
									?>
									<div class='min'>
										<div class="col-md-6">
											<?php echo "Lieu : ".$dps->getLieu()."\n"; ?>
										</div>
										<div class="col-md-4">
											<?php echo "Type : ".$dps->getType() ?>
										</div>
										<div class="col-md-2">
											<?php if($dps->isClosed()) echo "<h4 class='red'>Inscriptions clôturées</h4>" ?>
										</div>
											<div class="col-md-6">
											<?php echo "PSE1 requis : ".$dps->getPSE1() ?>
										</div>
										<div class="col-md-4">
											<?php echo "PSE2 requis : ".$dps->getPSE2() ?>
										</div>
										<div class="col-md-10">
											<?php echo "Demandeur : ".$dps->getClient()."\n"; ?>
										</div>
										<div class="col-md-12">
											<?php echo "Limite inscriptions : <u>".$dps->getLimitDate()->format('d/m/Y')."</u>\n"; ?>
										</div>
										

										

									

										<div class="col-md-12">
											<?php if($dps->getDesc() != "") echo "Description : \n<i>".$dps->getDesc()."</i>\n"; ?>
										</div>

										<?php
										echo "<div class='col-md-12'><table class='table'><tr>";
										foreach ($dps->getCreneaux() as $creneau) {
											echo "<th closed=".($closed ? 'true' : 'false')." cre=".$creneau->getId().">".$creneau->getDateDeb()->format('H:i')." - ".$creneau->getDateFin()->format('H:i')."</th>";
										}
										echo "</tr><tr>";
										foreach ($dps->getCreneaux() as $creneau) {
											echo "<td cre=".$creneau->getId().">";
											foreach ($creneau->getSecouristes() as $secouriste) {
												echo $secouriste->getPrenom()." ".$secouriste->getNom()."<br>";
											}
											echo "</td>";
										}
										echo "</tr></table></div></div>";
									}
								}
							}
							?>
						</div>

					</div>

				</div>
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
	<script type="text/javascript">
	var triggered = false;

	$(function(){
		$('#accordion').accordion();

		$('th[closed!="true"]').click(function(event){
			$.ajax({
				type: "POST",
				url: './ajax/sec_cre/<?php echo $user2->getLogin() ?>/'+$(event.target).attr('cre'),
				success: function(txt){
					var data = $.parseJSON(txt);
					var result = "";
					for(var i=1; i<data.length; i++){
						result += data[i]+"<br>";
					}
					if(data[0] == "add"){
						toastr.success("Inscription de l'utilisateur <?php echo $user?> au créneau "+$(event.target).text());
					}
					else {
						toastr.warning("Désinscription de l'utilisateur <?php echo $user?> du créneau "+$(event.target).text());
					}	
					var $target = $(event.target);
					var cellIndex = $target.index();
					$target.closest('tr').next().children().eq(cellIndex).html(result);
				}
			});
		});

		$('th[closed="true"]').click(function(event){
			toastr.warning("Les inscriptions ne sont pas ouvertes pour ce poste !");
		});

		$('#accordion').one('mouseover', function() {
			toastr.info("Cliquer sur une tranche horaire pour s'y inscrire/désincrire");
		});

	});
</script>

</body>
</html>
