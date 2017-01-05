<?php
if (isset($_POST['submitAddCategorie'])) {
    $categories = new CategoriesBD($cnx);
    $retourAjoutCategorie = $categories->ajoutCategorie($_POST['nom']);
} else {
	$retourAjoutCategorie = -3;
}
?>

<div class="row">
	<?php include('./lib/php/gestion_categories_menu.php'); ?>
	<div class="col-md-9">
		<section id="message">
			<?php if ($retourAjoutCategorie == -1) { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Erreur !</strong> Cette catégorie est déjà enregistrée...
			</div> <?php } else if ($retourAjoutCategorie == -2) { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Erreur !</strong> Une erreur inconnue s\'est produite, veuillez réessayer ultérieurement.</a>
			</div>
			<?php } else if ($retourAjoutCategorie > 0) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Félicitations !</strong> Votre catégorie a été correctement ajoutée.
			</div> <meta http-equiv="refresh" content="4; url=index.php?page=gestion_categories_accueil" /> <?php } ?>
		</section>
	    <div class="profile-content">
		   <form class="form-horizontal" action="index.php?page=gestion_categories_ajouter" method="post" id="form_add_categorie">
				<legend>Ajouter une catégorie</legend>
				<div class="form-group">
					<label for="prenom" class="col-sm-3 control-label">Nom de la catégorie</label>
					<div class="col-sm-9">
						<input type="text" id="nom" name="nom" placeholder="indiquez un nom" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" name="submitAddCategorie" id="submitAddCategorie" class="btn btn-primary btn-block">Ajouter</button>
					</div>
				</div>
			</form> <!-- /form -->
	    </div>
	</div>
</div>