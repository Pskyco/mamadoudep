<?php 
require './lib/php/verifier_connexion.php';
include ('./admin/lib/php/adm_liste_include.php');
$cnx = Connexion::getInstance($dsn, $user, $pass); 
/*
*	Récupération des informations de la DB
*/

$categories = new CategoriesBD($cnx);
$liste_cat = $categories->getCategories();
$nbrCat = count($liste_cat);

$produits = new ProduitsBD($cnx);
$liste_pro = $produits->getProduits();
$nbrPro = count($liste_pro);

$clients = new ClientBD($cnx);
$liste_cli = $clients->getClients();
$nbrCli = count($liste_cli);

$factures = new FacturesBD($cnx);
$liste_fac = $factures->getFactures();
$nbrFac = count($liste_fac);


?>

<div class="" id="accueil_admin">
	<div class="row">
		<div class="col-md-3">
          <div class="update-nag">
            <div class="update-split"><i class="glyphicon glyphicon-user"></i></div>
            <div class="update-text"><?php echo $nbrCli ?> utilisateurs enregistrés</div>
          </div>
        </div>
    
        <div class="col-md-3">
          <div class="update-nag">
            <div class="update-split update-info"><i class="glyphicon glyphicon-folder-open"></i></div>
            <div class="update-text"><?php echo $nbrCat ?> catégories</div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="update-nag">
            <div class="update-split update-success"><i class="glyphicon glyphicon-barcode"></i></div>
            <div class="update-text"><?php echo $nbrPro ?> articles proposés</div>
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="update-nag">
            <div class="update-split update-danger"><i class="glyphicon glyphicon-euro"></i></div>
            <div class="update-text"><?php echo $nbrFac ?> factures émises</div>
          </div>
        </div>
	</div>
</div>

