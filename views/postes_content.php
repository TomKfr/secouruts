<div class="col-lg-12">
	<div class="col-md-6">
		<select id="selectbasic" name="selectbasic" class="form-control">
			<option value="0"> -- Sélectionner un poste -- </option>
			<?php
			if(isset($postes)){
				foreach ($postes as $dps) {
					echo "<option id=".$dps->getId()." value=".$dps->getId().">".$dps->getTitre()."  -  ".$dps->getDebut()->format("d F Y")."</option>";
				}
			}
			?>
		</select>
	</div>
	<div id="control_buttons" class="col-md-offset-1 col-md-5">
		<button id="close" class="btn btn-info">Clore</button>
		<button id="modify" class="btn btn-warning">Modifier</button>
		<button id="cancel" class="btn btn-danger">Annuler</button>
		<button id="delete" class="btn btn-danger">Supprimer</button>
	</div>
	<div id='info' class="well col-md-12" style="height: 200px; margin-top: 15px;"></div>
	<div class="col-md-offset-5 col-md-2" style="margin-top : 20px">
		<button id="addpost" class="btn btn-success">Ajouter un nouveau poste</button>
	</div>
</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">

function dps_action(action){
	var retrn = "";
	var dps_id = $('#selectbasic').val();
		$.ajax({
			url: '../dps/'+action+'/'+dps_id,
			type: 'get',
			success: function(data){
				retrn = data;
			},
			error: function(data){
				alert(data);
			}
		});

		return retrn;
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
	});

	$('#addpost').click(function(){
		$('#content').load('../ajax/dps_form/null');
	});

	$('#close').click(function(){
		var status = dps_action('close');
		if(status == "already_closed") { toastr.error('Le poste est déjà clos !'); }
		else  { toastr.info('Le poste a été clos.'); }
	});

	$('#cancel').click(function(){
		dps_action('cancel');
		toastr.warning('Le poste a été annulé.');
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

