<div class="col-lg-12">
	<div class="form-group">
		<label class="col-md-3 control-label" for="selectbasic">Modifier le poste :</label>
		<div class="col-md-6">
			<select id="selectbasic" name="selectbasic" class="form-control">
				<option value="1">Liste des titres des postes</option>
				<option value="2">Option two</option>
			</select>
		</div>
		<div class="col-md-2"><button id="val" class="btn btn-primary">Modifier</button></div>
	</div>
	<div class="col-md-offset-4 col-md-2" style="margin-top : 20px">
		<button id="addpost" class="btn btn-success">Ajouter un nouveau poste</button>
	</div>
	<div id="formdiv" class="col-md-12" style="margin-top : 15px">
		<form id="newpost" class="form-horizontal" method='post' action="./admin/new_post">
			<div class="form-group">
				<label class="col-md-2 control-label" for="titre">Titre</label>  
				<div class="col-md-10">
					<input id="titre" name="titre" type="text" class="form-control">
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6 form-group">
					<label class="col-md-3 control-label" for="datedeb">Début</label>
					<div class="col-md-4">
						<input id="datedeb" type="text" name="datedeb" class="form-control datetimepicker">
					</div>
				</div>
				<div class="col-md-6 form-group">
					<label class="col-md-3 control-label" for="datefin">Fin</label>
					<div class="col-md-4">
						<input id="datefin" type="text" name="datedeb" class="form-control datetimepicker">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label" for="typpost">Type</label>
				<div class="col-md-4">
					<select id="typpost" name="typpost" class="form-control">
						<option value="">Typ1</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label" for="lieu">Lieu</label>
				<div class="col-md-4">
					<input id="lieu" type="text" name="lieu" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label" for="limitdate">Date limite d'inscription</label>
				<div class="col-md-4">
					<input id="limitdate" type="text" name="limitdate" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label" for="client">Client</label>
				<div class="col-md-4">
					<input id="client" type="text" name="client" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="nbpse1">PSE1 requis</label>
				<div class="col-md-4">
					<input id="nbpse1" type="text" name="nbpse1" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="nbpse2">PSE2 requis</label>
				<div class="col-md-4">
					<input id="nbpse2" type="text" name="nbpse2" class="form-control">
				</div>
			</div>
			<div class="col-md-offset-4">
				<button id="submit" class="btn btn-primary">Valider</button>
		</form>

	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('.datetimepicker').datetimepicker({ locale: 'fr'});
		$('#formdiv').hide();

		$('#addpost').click(function(){
			$('#formdiv').toggle();
		});

		$('#submit').click(function(event){
			event.preventDefault();
			//Valider le conformité du formulaire et l'envoyer si OK, alerter sinon.
			//Si valide alors : 

			$this = $(newpost);
			//Envoi en ajax :
			$.ajax({
                url: $this.attr('action'), // Le nom du fichier indiqué dans le formulaire
                type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
                data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                success: function(html) {
                    alert(html);
                }
           });
		});
	});
</script>