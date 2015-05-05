<div class="col-lg-12">
	<div class="col-md-6">
		<select id="selectbasic" name="selectbasic" class="form-control">
			<option value="0"> -- Sélectionner un poste -- </option>
			<?php
			if(isset($postes)){
				foreach ($postes as $dps) {
					echo "<option value=".$dps->getId().">".$dps->getTitre()."  -  ".$dps->getDebut()->format("d F Y")."</option>";
				}
			}
			?>
		</select>
	</div>
	<div id="control_buttons" class="col-md-6">
		<button id="close" class="btn btn-info">Clore</button>
		<button id="modify" class="btn btn-warning">Modifier</button>
		<button id="cancel" class="btn btn-danger">Annuler</button>
		<button id="delete" class="btn btn-danger">Supprimer</button>
	</div>
	<div id='info' class="well col-md-12" style="height: 150px; margin-top: 15px;"></div>
	<div class="col-md-offset-4 col-md-2" style="margin-top : 20px">
		<button id="addpost" class="btn btn-success">Ajouter un nouveau poste</button>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('#control_buttons').hide();
	$('#selectbasic').change(function(event){
		//demander les détail du poste sélectionné en ajax...
		var dps_id = $('#selectbasic').val();
		// $('form').submit();
		if(dps_id != 0){
			$('#info').load('../dps/get/'+dps_id);
			$('#control_buttons').show('fast');
		}
		else {
			$('#control_buttons').hide('fast');
			$('#info').html("");
		}
	});

	$('#addpost').click(function(){
		$('#content').load('../ajax/dps_form');
	});

	$('#close').click(function(){
		alert("hello!");
	});
	$('#delete').click(function(){
		var dps_id = $('#selectbasic').val();
		$.ajax({
			url: '../dps/delete/'+dps_id,
			type: 'get',
			success: function(data){
				alert(data);
			},
			error: function(data){
				alert(data);
			}
		});

		//$('option [value='+"'"+dps_id+"'"+']').remove();  TROUVER UNE SOLUTION !!
	});
});
</script>

