<style type="text/css">
.space{
	margin-top: 10px;
}
td, th{
	padding-right: 20px;
	padding-top: 5px;
}
</style>
<div class="col-md-12">
	<div class="col-md-11">
		<h3><?php echo $secouriste->getPrenom()." ".$secouriste->getNom()?> - <?php echo $secouriste->getSemestre() ?></h3>
	</div>
	<div class="col-md-1">
		<?php if($secouriste->isAdmin()) { ?> <span class="alert alert-success">Admin</span><?php } ?>
	</div>
	

	<div class="col-md-6">
			Né(e) le <?php echo $secouriste->getDDN()->format('d/m/Y') ?> à <?php echo $secouriste->getLDN()?>
	</div>
	<div class="col-md-4">
		Permis B <span class="glyphicon glyphicon-<?php if($secouriste->isPermis()) echo "ok"; else echo "remove"; ?>"></span>
	</div>

	<div class="col-md-6 space">
		<table>
		<tr><td>Contact : </td><td><span class="glyphicon"><b>@</b></span> <?php echo $secouriste->getEmail() ?></td><td><span class="glyphicon glyphicon-earphone"></span> <?php echo $secouriste->getTel() ?></td></tr>
		<tr><td></td><td colspan=2 ><span class="glyphicon glyphicon-envelope"></span> <?php echo $secouriste->getAdresse() ?></td></tr>
	</table>
	</div>
	<div class="col-md-6 space">
		<table>
		<tr><td>Diplômes : </td><th>Type</th><th>Date d'obtention</th></tr>
		<?php foreach ($secouriste->getDiplomes() as $dip) {
			echo "<tr><td></td><td>".$dip->getType()."</td><td>".$dip->getDate()->format('d/m/Y')."</td></tr>";
		}
		?>
	</table>
	</div>

	<div class="col-md-12 space">
		<p>Vêtements : <?php echo $secouriste->getTaille() ?></p>
	</div>

	<div class="col-md-4">
	</div>
	<div class="col-md-4">
	</div>
</div>