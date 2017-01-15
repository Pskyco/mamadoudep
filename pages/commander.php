<?php
	$facture = new FacturesBD($cnx);
	$retourFacture = $facture->ajoutFacture($_SESSION['client'][0]->id_utilisateur,MontantGlobal());
	if($retourFacture) {
		$comporte = new ComporteBD($cnx);
		for($i=0;$i<compterArticles();$i++) {
			$retourComporte = $comporte->ajoutComporte($retourFacture,$_SESSION['panier']['idProduit'][$i],$_SESSION['panier']['qteProduit'][$i],$_SESSION['panier']['prixProduit'][$i]);
		}
		supprimePanier();
	}

	echo '<meta http-equiv="refresh" content="0; url=index.php?page=commander_done&retourF='.$retourFacture.'&retourC='.$retourComporte.'" />';
?>