<form class="form-horizontal" action="./index.php" method="post" id="form_connect_admin">
	<legend>Connexion au panel admin</legend>
	<div class="form-group">
		<label for="prenom" class="col-sm-3 control-label">Adresse mail</label>
		<div class="col-sm-9">
			<input type="text" id="email" name="email" placeholder="votre adresse mail" class="form-control" >
		</div>
	</div>
		<div class="form-group">
		<label for="nom" class="col-sm-3 control-label">Mot de passe</label>
		<div class="col-sm-9">
			<input type="password" id="password" name="password" placeholder="votre mot de passe" class="form-control">
			<!--<span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-9 col-sm-offset-3">
			<button type="submit" name="form_connect_admin" id="form_connect_admin" class="btn btn-primary btn-block">S'authentifier</button>
		</div>
	</div>
</form> <!-- /form -->