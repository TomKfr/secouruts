<style type="text/css">
.red{
	font-color : #ed0000;
}
</style>

<div class="col-md-8">
	<h4><b><?php echo $dps->getTitre()." - ".$dps->getDebut()->format("d/m/Y")." de ".$dps->getDebut()->format("H:i")." à ".$dps->getFin()->format("H:i")."</b></h4>" ?>
</div>


<div class="col-md-5">
	<?php echo "Lieu : ".$dps->getLieu()."\n"; ?>
</div>
<div class="col-md-4">
	<?php echo "Type : ".$dps->getType() ?>
</div>
<div class="col-md-3">
	<?php if($dps->isClosed()) echo "<p class='red'>Inscriptions clôturées</p>" ?>
	<?php if($dps->isCancelled()) echo "<p class='red'>Annulé</p>" ?>
</div>
<div class="col-md-5">
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
	<?php echo "Description : <i>".$dps->getDesc()."</i> \n" ?>
</div>

<div class="col-md-12">
	<table class="table" style="margin-top:15px" closed=<?php if($dps->isClosed()) echo "true"; ?><tr>
	<?php
		$closed = $dps->isClosed();
		foreach ($crenos as $key => &$cre) {
			echo "<th cre=".$key.">".array_shift($cre)."</th>";
		}

		$empty = true;
		do{	
			echo "</tr><tr>";
			$empty = true;
			foreach ($crenos as $key => &$cre) {
				if(empty($cre)) echo "<td></td>"; // Si tous les sec ont été affichés, on passe au suivant.
				else {
					$empty = false;
					$login = key($cre);
					$name = array_shift($cre);
					echo "<td closed=".($closed ? 'true' : 'false')." cre='".$key."' login='".$login."'>".$name."  <span class='";
					if($dps->getCreneau($key)->isSecVal($login)) echo "glyphicon glyphicon-ok";
					echo "' ></span></td>";
				}
			}
		} while (!$empty);
	?>


	</tr></table>

</div>

<script type="text/javascript">
$(function(){
	$('td[closed!="true"]').click(function(event){
		var cell = $(event.target);
		if(cell.text() != ""){

			$.ajax({
				url: '../ajax/val_inscr/'+cell.attr('login')+'/'+cell.attr('cre'),
				type: 'get',
				success: function(data){
					toastr.info(data);
					if(cell.children('span').attr("class") == '') cell.children('span').attr("class","glyphicon glyphicon-ok");
					else cell.children('span').attr("class",'');
				},
				error: function(data){
					alert(data);
				}
			});
		}
	});

	$('td[closed="true"]').click(function(event){
		toastr.warning("Tu ne peux pas modifier les inscriptions d'un poste cloturé !");
	});

	$('table[closed!="true"]').one('mouseover', function() {
		toastr.info("Cliquer sur un nom pour valider/invalider son inscription");
	});
});
</script>