<?php
	if(!isset($_SESSION['panier'])) {
		creationPanier();
		$produits = new ProduitsBD($cnx);
		$produitRecup = $produits->getProduit($_GET['id_produit']);
		ajouterArticle($produitRecup[0]->id_produit,$produitRecup[0]->nom,1,$produitRecup[0]->prix);
		$returnCode = 1;
	} else {
		$produits = new ProduitsBD($cnx);
		$produitRecup = $produits->getProduit($_GET['id_produit']);
		$positionProduit = array_search($_GET['id_produit'],  $_SESSION['panier']['idProduit']);

         if ($positionProduit !== false)
         {
            if($_SESSION['panier']['qteProduit'][$positionProduit] + 1 > $produitRecup[0]->quantite) {
            	$returnCode = 2;
            } else {
            	ajouterArticle($produitRecup[0]->id_produit,$produitRecup[0]->nom,1,$produitRecup[0]->prix);
            	$returnCode = 1;
            }
         } else {
         	ajouterArticle($produitRecup[0]->id_produit,$produitRecup[0]->nom,1,$produitRecup[0]->prix);
         	$returnCode = 1;
         }
	}

	echo '<meta http-equiv="refresh" content="0; url=index.php?page=boutique&amp;action=addArticle&amp;code='.$returnCode.'" />';
?>