<?php
	$produits = new ProduitsBD($cnx);
	$liste_pro = $produits->getProduits();
	$nbrPro = count($liste_pro);

	$categories = new CategoriesBD($cnx);
	$liste_cat = $categories->getCategories();
	$nbrCat = count($liste_cat);
	$param1 = $_GET['action'];
	$param2 = $_GET['id'];
	$param3 = $_GET['confirm'];
	$retourDel = -1;
	//dans le cas d'une SUPPRESSION
	if($param1 == 'del' && !isset($param3)) { ?>
		<script>
			bootbox.confirm({
		    title: "Supprimer cet article ?",
		    message: "Êtes-vous certain de vouloir supprimer cet article ?",
		    buttons: {
		        cancel: {
		            label: '<i class="fa fa-times"></i> Annuler'
		        },
		        confirm: {
		            label: '<i class="fa fa-check"></i> Confirmer'
		        }
		    },
		    callback: function (result) {
				window.location.href = window.location.href + "&confirm=" + result; 
		    }
		});
		</script>
	<?php } else if ($param1 == 'del' && $param3 == 'true') {
		//suppression demandée et confirmée
		$retourDel = $produits->deleteProduit($param2);
	} else if ($param1 == 'del' && $param3 == 'false') {
		//suppression demandée mais annulée
		echo '<meta http-equiv="refresh" content="0; url=index.php?page=gestion_articles_accueil" />';
	} else if ($param1 == 'stockM') {
		$retourStock = $produits->changeStock($param2,0);
		if($retourStock) {
			$produits = new ProduitsBD($cnx);
			$liste_pro = $produits->getProduits();
			$nbrPro = count($liste_pro);
		}
	} else if ($param1 == 'stockP') {
		$retourStock = $produits->changeStock($param2,1);
		if($retourStock) {
			$produits = new ProduitsBD($cnx);
			$liste_pro = $produits->getProduits();
			$nbrPro = count($liste_pro);
		}
	}
?>

<div class="row">
	<?php include('./lib/php/gestion_articles_menu.php'); ?>
	<div class="col-md-9">
        <div class="profile-content">
	        <section id="message">
				<?php if ($retourDel == 2) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Erreur !</strong> Impossible de supprimer un article déjà répertorié dans une facture.</a>
				</div>
				<?php } else if ($retourDel == 1) { ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Félicitations !</strong> Le produit a correctement été supprimé.
					<meta http-equiv="refresh" content="4; url=index.php?page=gestion_categories_accueil" />
				</div> <?php } else if ($retourDel == 0) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Erreur !</strong> Une erreur est survenue lors de la suppression de produit.
				</div> <?php } else if ($retourStock == -1) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Erreur !</strong> Une erreur est survenue lors de l'enregistrement dans le stock.
				</div> <?php } else if ($retourStock == -2) { ?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Attention !</strong> Il n'est pas possible de déstocker un article qui n'est déjà plus en stock.
				</div> <?php } else if ($retourStock > 0) { ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Félicitations !</strong> Le produit a correctement été scanné et inclut dans le stock.
				</div> <?php } ?>
			</section>
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th>#</th>
			      <th>Nom</th>
			      <th>Stock</th>
			      <th>Prix</th>
			      <th>Action</th>
			    </tr>
			  </thead>
			  <tbody>
				<?php for($i=0;$i<$nbrPro;$i++) { ?>
				<tr>
				   <th scope="row"><?php print $liste_pro[$i]->id_produit; ?></th>
				   <td><?php print utf8_encode($liste_pro[$i]->nom); ?></td>
				   <td><?php print utf8_encode($liste_pro[$i]->quantite); ?></td>
				   <td><?php print utf8_encode($liste_pro[$i]->prix).' €'; ?></td>
				   <td>
					<a href="index.php?page=gestion_articles_update&amp;id=<?php echo $liste_pro[$i]->id_produit; ?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-zoom-in"></span></a>
					<a href="index.php?page=gestion_articles_accueil&amp;action=stockP&amp;id=<?php echo $liste_pro[$i]->id_produit; ?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></a>
					<a href="index.php?page=gestion_articles_accueil&amp;action=stockM&amp;id=<?php echo $liste_pro[$i]->id_produit; ?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-minus"></span></a>
					<a href="index.php?page=gestion_articles_accueil&amp;action=del&amp;id=<?php echo $liste_pro[$i]->id_produit; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
				   </td>
				<?php } ?>
			  </tbody>
			</table>
        </div>
	</div>
</div>