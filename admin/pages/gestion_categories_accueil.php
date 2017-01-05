<?php
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
		    title: "Supprimer cette catégorie ?",
		    message: "Êtes-vous certain de vouloir supprimer cette catégorie ?",
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
		$retourDel = $categories->deleteCategorie($param2);
	} else if ($param1 == 'del' && $param3 == 'false') {
		//suppression demandée mais annulée
		echo '<meta http-equiv="refresh" content="0; url=index.php?page=gestion_categories_accueil" />';
	}
?>

<div class="row">
	<?php include('./lib/php/gestion_categories_menu.php'); ?>
	<div class="col-md-9">
        <div class="profile-content">
	        <section id="message">
				<?php if ($retourDel == 2) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Erreur !</strong> Impossible de supprimer une catégorie comportant des articles.</a>
				</div>
				<?php } else if ($retourDel == 1) { ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Félicitations !</strong> La catégorie a correctement été supprimée.
					<meta http-equiv="refresh" content="4; url=index.php?page=gestion_categories_accueil" />
				</div> <?php } else if ($retourDel == 0) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Erreur !</strong> Une erreur est survenue lors de la suppression de la catégorie.
				</div> <?php } ?>
			</section>
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th>#</th>
			      <th>Nom</th>
			      <th>Action</th>
			    </tr>
			  </thead>
			  <tbody>
				<?php for($i=0;$i<$nbrCat;$i++) { ?>
				<tr>
				   <th scope="row"><?php print $liste_cat[$i]->id_categorie; ?></th>
				   <td><?php print $liste_cat[$i]->nom; ?></td>
				   <td><a href="index.php?page=gestion_categories_accueil&amp;action=del&amp;id=<?php echo $liste_cat[$i]->id_categorie; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
				<?php } ?>
			  </tbody>
			</table>
        </div>
	</div>
</div>