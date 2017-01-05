<?php
	$factures = new FacturesBD($cnx);
	$liste_fac = $factures->getFactures();
	$nbrFac = count($liste_fac);

	$comporte = new ComporteBD($cnx);
	for($i=0;$i<$nbrFac;$i++) {
		$liste_com[$i] = $comporte->getComporteNumberByFacture($liste_fac[$i]->id_facture);
	}

	$clients=array();
	$clients['id_utilisateur'] = array();
	$clients['nom'] = array();
	$clients['prenom'] = array();

	$cli = new ClientBD($cnx);
	$liste_cli = $cli->getClients();
	$nbrCli = count($liste_cli);

	for($i=0;$i<$nbrCli;$i++) {
		array_push( $clients['id_utilisateur'],$liste_cli[$i]->id_utilisateur);
		array_push( $clients['nom'],$liste_cli[$i]->nom);
		array_push( $clients['prenom'],$liste_cli[$i]->prenom);
	}

	if(isset($_GET['status'])) {
		if($_GET['status'] == 1 || $_GET['status'] == 2) {
			$retour = $factures->incrementStatus($_GET['facture']);
			if($retour) {
				$changement = true;
				if($_GET['status'] == 1) {
					$prefixe = 'Emballez, c\'est pesé !';
					$message = 'La commande '.$_GET['facture'].' est désormais en préparation.';
				} else {
					$prefixe = 'En route ! ';
					$message = 'La commande '.$_GET['facture'].' a correctement été envoyée.';
				}

				//on recharge les factures
				$liste_fac = $factures->getFactures();
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
	<?php include('./lib/php/gestion_factures_menu.php'); ?>
	<div class="col-md-9">
        <div class="profile-content">
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
						<th><span class="glyphicon glyphicon-user"></span></th>
						<th>Date</th>
						<th><span class="glyphicon glyphicon-shopping-cart"></span></th>
						<th><span class="glyphicon glyphicon-eur"></span></th>
						<th>État</th>
						<th>Action</th>
						<th>Détail</th>
						<th>Facture</th>
					</tr>
				</thead>
				<tbody>
					<?php for($i=0;$i<$nbrFac;$i++) {
						$positionClient = array_search($liste_fac[$i]->fk_utilisateur,  $clients['id_utilisateur']);
					 ?>
					<tr>
						<th scope="row"><?php print $liste_fac[$i]->id_facture; ?></th>
						<td><?php print $clients['nom'][$positionClient].' '.$clients['prenom'][$positionClient]; ?></td>
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
								case 1 : $changementStatut = '<a href="index.php?page=gestion_factures_accueil&amp;status='.$liste_fac[$i]->etat.'&amp;facture='.$liste_fac[$i]->id_facture.'" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-gift"></span> Préparer</a>';
								break;
								case 2 : $changementStatut = '<a href="index.php?page=gestion_factures_accueil&amp;status='.$liste_fac[$i]->etat.'&amp;facture='.$liste_fac[$i]->id_facture.'" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plane"></span> Expédier</a>';
								break;
								default: $changementStatut = '<a class="btn btn-xs btn-default"><span class="glyphicon glyphicon-info-sign"></span> </a>';
							}
						?>
						<td><?php echo $changementStatut; ?></td>
						<td>
							<a href="index.php?page=gestion_factures_detail&amp;facture=<?php print $liste_fac[$i]->id_facture ?>&amp;user=<?php print $liste_fac[$i]->fk_utilisateur ?>" class="btn btn-xs btn-default">
								<span class="glyphicon glyphicon-paperclip"></span>
							</a>
						</td>
						<td>
							<a href="http://mamadou-depannage.ddns.net/pdf_commande.php?&amp;facture=<?php print $liste_fac[$i]->id_facture ?>" target="_blank" class="btn btn-xs btn-default">
								<span class="glyphicon glyphicon-cloud-download"></span>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>