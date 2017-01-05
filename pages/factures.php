<?php
	$factures = new FacturesBD($cnx);
	$liste_fac = $factures->getFacturesByUtilisateur($_SESSION['client'][0]->id_utilisateur);
	$nbrFac = count($liste_fac);

	$comporte = new ComporteBD($cnx);
	for($i=0;$i<$nbrFac;$i++) {
		$liste_com[$i] = $comporte->getComporteNumberByFacture($liste_fac[$i]->id_facture);
	}

	if(isset($_GET['status'])) {
		if($_GET['status'] == 3 || $_GET['status'] == 0) {
			$retour = $factures->incrementStatus($_GET['facture']);
			if($retour) {
				$changement = true;
				if($_GET['status'] == 0) {
					$prefixe = 'Félicitations !';
					$message = 'Vous venez de payer la facture N'.$_GET['facture'].', merci.';
				} else {
					$prefixe = 'Merci. ';
					$message = 'Votre commande a correctement été notée comme livrée, merci de votre confiance et à bientôt !';
				}

				//on recharge les factures
				$liste_fac = $factures->getFacturesByUtilisateur($_SESSION['client'][0]->id_utilisateur);
				$nbrFac = count($liste_fac);

				for($i=0;$i<$nbrFac;$i++) {
					$liste_com[$i] = $comporte->getComporteNumberByFacture($liste_fac[$i]->id_facture);
				}
			} else {
				$changement = false;
			}
		}
	}
?>

<div class="row">
	<div class="col-md-12">
		<section id="message">
			<?php if ($changement) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><?php echo $prefixe; ?></strong> <?php echo $message; ?>
			</div> <?php } ?>
		</section>
		<table class="table table-striped">
			<thead>
				<tr>
					<th><span class="glyphicon glyphicon-barcode"></span></th>
					<th>Date</th>
					<th><span class="glyphicon glyphicon-shopping-cart"></span></th>
					<th><span class="glyphicon glyphicon-eur"></span></th>
					<th>État</th>
					<th>Action</th>
					<th>Facture</th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<$nbrFac;$i++) { ?>
				<tr>
					<th scope="row"><?php print $liste_fac[$i]->id_facture; ?></th>
					<td><?php print date('d/m/Y H:i:s', strtotime($liste_fac[$i]->date)); ?></td>
					<td><?php print $liste_com[$i] ?></td>
					<td><?php print $liste_fac[$i]->total; ?></td>
					<?php 
						switch($liste_fac[$i]->etat) {
							case 0 : $message = '<span class="label label-default">En attente de paiement</span>';
							break;
							case 1 : $message = '<span class="label label-info">Paiement accepté</span>';
							break;
							case 2 : $message = '<span class="label label-primary">En préparation</span>';
							break;
							case 3 : $message = '<span class="label label-warning">En cours de livraison</span>';
							break;
							case 4 : $message = '<span class="label label-success">Livré</span>';
							break;
						}
					?>
					<td><?php echo $message; ?></td>
					<?php 
						switch($liste_fac[$i]->etat) {
							case 0 : $changementStatut = '<a href="index.php?page=factures&amp;status='.$liste_fac[$i]->etat.'&amp;facture='.$liste_fac[$i]->id_facture.'" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-euro"></span> Payer</a>';
							break;
							case 3 : $changementStatut = '<a href="index.php?page=factures&amp;status='.$liste_fac[$i]->etat.'&amp;facture='.$liste_fac[$i]->id_facture.'" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-send"></span> Confirmer la livraison</a>';
							break;
							default: $changementStatut = '<a class="btn btn-xs btn-default"><span class="glyphicon glyphicon-info-sign"></span> </a>';
						}
					?>
					<td><?php echo $changementStatut; ?></td>
					<td><a href='pdf_commande.php?&amp;facture=<?php print $liste_fac[$i]->id_facture ?>' target="_blank" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-cloud-download"></span> </a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>