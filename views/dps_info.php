<div class="col-md-7">
	<h4><?php echo $dps->getTitre() ?></h4><br>
</div>

<div class="col-md-offset-1 col-md-4">
	<h5><?php echo $dps->getDebut()->format("d F Y - H:i") ?></h5>
	<h5><?php echo $dps->getFin()->format("d F Y - H:i") ?></h5>
</div>

<div class="col-md-12">
	<h5><?php echo $dps->getLieu() ?></h5>
</div>