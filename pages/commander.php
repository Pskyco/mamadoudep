<?php
	echo 'create facture...';
	$facture = new FacturesBD($cnx);
	$retourFacture = $facture->ajoutFacture($_SESSION['client'][0]->id_utilisateur,MontantGlobal());
	if($retourFacture) {
		echo 'create comporte...';
		$comporte = new ComporteBD($cnx);
		for($i=0;$i<compterArticles();$i++) {
			echo 'comporte '.$i.' en cours...';
			$retourComporte = $comporte->ajoutComporte($retourFacture,$_SESSION['panier']['idProduit'][$i],$_SESSION['panier']['qteProduit'][$i]);
		}
		supprimePanier();
	}
?>