<div class="col-lg-12">
	<div class="col-md-1"><span style="font-size:2.5em" class="glyphicon glyphicon-calendar"></span></div>
	<div class="col-md-6">
		<select id="selectbasic" name="selectbasic" class="form-control">
			<option value="0"> -- Sélectionner un poste -- </option>
			<?php
			if(isset($postes)){
				foreach ($postes as $dps) {
					echo "<option id=".$dps->getId()." value=".$dps->getId().">".$dps->getTitre()."  -  ".$dps->getDebut()->format("d/m/Y");
					if($dps->date_passed()) echo " - Terminé";
					echo"</option>";
				}
			}
			?>
		</select>
	</div>
	<div id="control_buttons" class="col-md-5">
		<button id="close" class="btn btn-info">Clore</button>
		<button id="modify" class="btn btn-warning">Modifier</button>
		<button id="cancel" class="btn btn-danger">Annuler</button>
		<button id="delete" class="btn btn-danger">Supprimer</button>
	</div>
	<div id='info' class="well col-md-12" style="min-height: 200px; margin-top: 15px;"></div>
	<div class="col-md-offset-4 col-md-2" style="margin-top : 20px">
		<button id="addpost" class="btn btn-primary">Ajouter un nouveau poste</button>
	</div>
</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">

function dps_action(action){
	var dps_id = $('#selectbasic').val();
		$.ajax({
			url: '../dps/'+action+'/'+dps_id,
			type: 'get',
			success: function(data){
				if(action == 'close'){
					toastr.info(data);
				}
				retrn = data;
				if(action != "delete") $('#info').load('../dps/get/'+dps_id);
			},
			error: function(data){
				alert(data);
			}
		});
};

$(function(){
	$('#control_buttons').hide();
	$('#selectbasic').change(function(event){
		//demander les détails du poste sélectionné en ajax...
		var dps_id = $('#selectbasic').val();
		if(dps_id != 0){
			$('#info').load('../dps/get/'+dps_id);
			$('#control_buttons').show('fast');
		}
		else {
			$('#control_buttons').hide('fast');
			$('#info').html("");
		}
		// document.location.href='../dps/get/'+dps_id;
	});

	$('#addpost').click(function(){
		$('#content').load('../ajax/dps_form/null');
	});

	$('#close').click(function(){
		dps_action('close');
		if($('#close').text() == "Clore") $('#close').text("Ouvrir");
		if($('#close').text() == "Ouvrir") $('#close').text("Clore");
	});

	$('#cancel').click(function(){
		dps_action('cancel');
		toastr.warning('Le poste a été annulé.');
		var dps_id = $('#selectbasic').val();
	});

	$('#delete').click(function(){
		dps_id = dps_action('delete');
		$("#selectbasic").find('option:selected').remove()
		$('#control_buttons').hide('fast');
		$('#info').empty();
		toastr.error('Le poste a été supprimé.');
	});

	$('#modify').click(function(){
		var dps_id = $('#selectbasic').val();
		$('#content').load('../ajax/dps_form/'+dps_id);
		toastr.info('Modification du poste.');
	});
});
</script>

