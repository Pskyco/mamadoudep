<?php
	$categories = new CategoriesBD($cnx);
	$liste_cat = $categories->getCategories();
	$nbrCat = count($liste_cat);

	if (isset($_POST['submitAddProduit'])) {
	    $produits = new ProduitsBD($cnx);
	    $retourAjoutProduit = $produits->ajoutProduit($_POST['nom'],$_POST['stock'],$_POST['prix'],$_POST['categorie']);
	} else {
		$retourAjoutProduit = -3;
	}
?>

<div class="row">
	<?php include('./lib/php/gestion_articles_menu.php'); ?>
	<div class="col-md-9">
		<section id="message">
			<?php if ($retourAjoutProduit == -1) { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Erreur !</strong> Ce produit existe déjà...
			</div> <?php } else if ($retourAjoutProduit == -2) { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Erreur !</strong> Une erreur inconnue s\'est produite, veuillez réessayer ultérieurement.</a>
			</div>
			<?php } else if ($retourAjoutProduit > 0) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Félicitations !</strong> Votre produit a été correctement ajouté. Référencez l'image via l'id <?php echo $retourAjoutProduit ?>
			</div> <?php } ?>
		</section>
	    <div class="profile-content">
		   <form class="form-horizontal" action="index.php?page=gestion_articles_ajouter" method="post" id="form_add_article">
				<legend>Ajouter un article</legend>
				<div class="form-group">
					<label for="nom" class="col-sm-3 control-label">Désignation du produit</label>
					<div class="col-sm-9">
						<input type="text" id="nom" name="nom" placeholder="indiquez un nom" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="stock" class="col-sm-3 control-label">Stock initial</label>
					<div class="col-sm-9">
						<input type="text" id="stock" name="stock" placeholder="indiquez une quantité" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="prix" class="col-sm-3 control-label">Prix</label>
					<div class="col-sm-9">
						<input type="text" id="prix" name="prix" placeholder="indiquez un prix" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="categorie" class="col-sm-3 control-label">Catégorie</label>
					<div class="col-sm-9">
	                    <select class="form-control" name="categorie" id="categorie">
	                        <option value="0">Choisissez</option>
	                        <?php
	                        for ($i = 0; $i < $nbrCat; $i++) {
	                            ?>                    
	                            <option value="<?php print $liste_cat[$i]->id_categorie; ?>">
	                                <?php print '#'.$liste_cat[$i]->id_categorie.' '.$liste_cat[$i]->nom; ?>
	                            </option>
	                            <?php
	                        }
	                        ?>
	                    </select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" name="submitAddProduit" id="submitAddProduit" class="btn btn-primary btn-block">Ajouter</button>
					</div>
				</div>
			</form> <!-- /form -->
	    </div>
	</div>
</div>