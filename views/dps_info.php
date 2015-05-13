<div class="col-md-8">
	<h4><?php echo $dps->getTitre() ?> - <?php echo $dps->getType() ?></h4>
</div>

<div class="col-md-4">
	<h5><?php echo $dps->getDebut()->format("d F Y - H:i") ?></h5>
</div>

<div class="col-md-8">
	<?php if($dps->isClosed()) echo "<h5>Inscriptions clôturées</h5>" ?>
	<?php if($dps->isCancelled()) echo "<h5>Annulé</h5>" ?>
</div>

<div class="col-md-4">
	<h5><?php echo $dps->getFin()->format("d F Y - H:i") ?></h5>
</div>

<div class="col-md-8">
	<?php echo $dps->getDesc() ?>
</div>

<div class="col-md-4">
	<?php
	echo $dps->getLieu()."\n";
	echo "<h5>Date limite : ".$dps->getLimitDate()->format('d/m/Y')."</h5>";
	?>
</div>

<div class="col-md-4">
	<?php echo "PSE1 requis : ".$dps->getPSE1() ?>
</div>
<div class="col-md-4">
	<?php echo "PSE2 requis : ".$dps->getPSE2() ?>
</div>
<div class="col-md-4">
	<?php echo "Client : ".$dps->getClient() ?>
</div>