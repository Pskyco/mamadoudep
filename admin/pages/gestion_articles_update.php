<?php
	$retourUpdateArticle = 0;
	if (isset($_GET['id'])) {
		$idProduit = $_GET['id'];
		$pro = new ProduitsBD($cnx);
		$produit = $pro->getProduit($idProduit);
	} else {
		$retourUpdateArticle = -3;
	}

	if(isset($_POST['submitUpdateArticle'])) {
		$changement = false;
		//on détecte les changements
		if(utf8_encode($produit[0]->nom) != $_POST['nom']) {
			$changement = true;
		} else if ($produit[0]->prix != $_POST['prix']) {
			$changement = true;
		}

		if($changement) {
			$retourUpdateArticle = $pro->updateProduit($idProduit,$_POST['nom'], $_POST['prix']);
			$produit = $pro->getProduit($idProduit);
		} else {
			$retourUpdateArticle = -2;
		}
	}
?>

<div class="row">
	<?php include('./lib/php/gestion_articles_menu.php'); ?>
		<div class="col-md-9">
			<?php if($retourUpdateArticle == -3) { ?>
				<section id="message">
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
						<strong>Erreur !</strong> Vous devez d'abord sélectionner un article dans l'accueil de 'Gestion des articles' !
					</div>
				</section>
			<?php } else { ?>
			<section id="message">
				<?php if ($retourUpdateArticle == -2) { ?>
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Hé non...</strong> aucune modification n'a été détectée sur cet article !
				</div> <?php } else if ($retourUpdateArticle == -1) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Erreur !</strong> Une erreur inconnue est survenue lors de la modification de l'article...
				</div> <?php } else if ($retourUpdateArticle > 0) { ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Félicitations </strong> L'article a correctement été mis à jour !
				</div> <?php } ?>
			</section>
		    <div class="profile-content">
			   <form class="form-horizontal" action="index.php?page=gestion_articles_update&id=<?php echo $idProduit;?>" method="post" id="form_add_categorie">
					<legend>Modifier un article</legend>
					<div class="form-group">
						<label for="nom" class="col-sm-3 control-label">Nom de l'article</label>
						<div class="col-sm-9">
							<input type="text" id="nom" name="nom" placeholder="indiquez un nom d'article" value="<?php echo utf8_encode($produit[0]->nom); ?>" class="form-control" >
						</div>
					</div>
					<div class="form-group">
						<label for="prix" class="col-sm-3 control-label">Prix de l'article</label>
						<div class="col-sm-9">
							<input type="text" id="prix" name="prix" placeholder="indiquez un prix d'article" value="<?php echo utf8_encode($produit[0]->prix); ?>" class="form-control" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" name="submitUpdateArticle" id="submitUpdateArticle" class="btn btn-primary btn-block">Modifier</button>
						</div>
					</div>
				</form> <!-- /form -->
		    </div>
		    <?php } ?>
		</div>
</div>