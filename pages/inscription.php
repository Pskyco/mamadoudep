<?php
if (isset($_POST['submitInscription'])) {
    $data = new ClientBD($cnx);
    $retourInscription = $data->ajoutClient($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['pwd'], $_POST['rue'], $_POST['ville'], $_POST['tel']);;
} else {
	$retourInscription = -3;
}
?>
<section id="message">
	<?php if ($retourInscription == -1) { ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Erreur !</strong> Cette adresse mail ou ce numéro de téléphone est déjà enregistré, vous allez être redirigé vers l'accueil...
	</div> <meta http-equiv="refresh" content="4; url=index.php?page=accueil" /> <?php } else if ($retourInscription == -2) { ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Erreur !</strong> Une erreur inconnue s\'est produite, veuillez réessayer ultérieurement.</a>
	</div>
	<?php } else if ($retourInscription > 0) { ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Félicitations !</strong> Vous êtes désormais inscrit sur notre site, vous allez être redirigé vers l'accueil...
	</div> <meta http-equiv="refresh" content="4; url=index.php?page=accueil" /> <?php } ?>
</section>
<form class="form-horizontal" action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_inscription">
	<legend>Formulaire d'inscription</legend>
	<div class="form-group">
		<label for="prenom" class="col-sm-3 control-label">Prénom</label>
		<div class="col-sm-9">
			<input type="text" id="prenom" name="prenom" placeholder="votre prénom" class="form-control" >
		</div>
	</div>
		<div class="form-group">
		<label for="nom" class="col-sm-3 control-label">Nom</label>
		<div class="col-sm-9">
			<input type="text" id="nom" name="nom" placeholder="votre nom" class="form-control">
			<!--<span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-3 control-label">Adresse e-mail</label>
		<div class="col-sm-9">
			<input type="email" id="email" name="email" placeholder="votre adresse mail" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="pwd" class="col-sm-3 control-label">Mot de passe</label>
		<div class="col-sm-9">
			<input type="password" id="pwd" name="pwd" placeholder="votre mot de passe" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="pwd2" class="col-sm-3 control-label">Confirmation</label>
		<div class="col-sm-9">
			<input type="password" id="pwd2" name="pwd2" placeholder="confirmez votre mot de passe" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="rue" class="col-sm-3 control-label">Rue</label>
		<div class="col-sm-9">
			<input type="text" id="rue" name="rue" placeholder="votre rue" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="ville" class="col-sm-3 control-label">Ville</label>
		<div class="col-sm-9">
			<input type="text" id="ville" name="ville" placeholder="votre ville" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="tel" class="col-sm-3 control-label">Téléphone</label>
		<div class="col-sm-9">
			<input type="text" id="tel" name="tel" placeholder="votre numéro de téléphone au format +32498822101" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-9 col-sm-offset-3">
			<button type="submit" name="submitInscription" id="submitInscription" class="btn btn-primary btn-block">S'enregistrer</button>
		</div>
	</div>
</form> <!-- /form -->