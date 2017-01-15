<?php
	$numeroFacture = $_GET['facture'];
	$numeroClient = $_GET['user'];

	$fac = new FacturesBD($cnx);
	$facture = $fac->getFactureById($numeroFacture);

	$com = new ComporteBD($cnx);
	$listeComporte = $com->getComporteByFacture($numeroFacture);
	$nbrComporte = count($listeComporte);
	$nbrPieces = $com->getComporteNumberByFacture($numeroFacture);

	$pro = new ProduitsBD($cnx);
	$total = 0.0;
	for($i=0;$i<$nbrComporte;$i++) {
		$produit = $pro->getProduit($listeComporte[$i]->fk_produit);
		$total = $total + $produit[0]->prix*$listeComporte[$i]->quantite;
	}

	$newPrice = $false;
	if($total - $facture[0]->total != 0.0) $newPrice = true;

	$cli = new ClientBD($cnx);
	$client = $cli->getClientById($numeroClient);
?>

<div class="row">
	<?php include('./lib/php/gestion_factures_menu.php'); ?>
	<div class="col-md-9">
        <div class="profile-content">
       		<?php //informations client ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th colspan="4">
							Informations du client <?php echo '<span class="label label-warning">n°'.$numeroClient.'</span>'?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><strong>Nom</strong></td>
						<td><?php echo $client[0]->nom; ?></td>
						<td><strong>Prénom</strong></td>
						<td><?php echo $client[0]->prenom; ?></td>
					</tr>
					<tr>
						<td><strong>Rue</strong></td>
						<td colspan="3"><?php echo $client[0]->rue; ?></td>
					</tr>
					<tr>
						<td><strong>Ville</strong></td>
						<td><?php echo $client[0]->ville; ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Email</strong></td>
						<td><?php echo $client[0]->mail; ?></td>
						<td><strong>Téléphone</strong></td>
						<td><?php echo $client[0]->tel; ?></td>
					</tr>
				</tbody>
			</table>

			<?php 
				switch($facture[0]->etat) {
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
       		<?php //informations facture ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th colspan="4">
							Détail de la facture <?php echo '<span class="label label-warning">n°'.$numeroFacture.'</span>'?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><strong>Date de facturation</strong></td>
						<td><?php print date('d/m/Y H:i:s', strtotime($facture[0]->date)); ?></td>
						<td><strong>État</strong></td>
						<td><?php echo $message; ?></td>
					</tr>
					<tr>
						<td><strong>Montant total</strong></td>
						<td><?php echo $facture[0]->total.' €'; ?></td>
						<td><strong>Nombre de pièces</strong></td>
						<td><?php echo $nbrPieces; ?></td>
					</tr>
					<tr>
						<td colspan="4"><a href='http://mamadou-depannage.ddns.net/pdf_commande.php?&amp;facture=<?php print $numeroFacture ?>' target="_blank" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-search"></span> Visualiser la facture</a></td>
					</tr>
				</tbody>
			</table>
			<section id="message">
				<?php if ($newPrice) { ?>
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Attention !</strong> Les prix ont subit des modifications depuis l'émission de la facture.
				</div> <?php } ?>
			</section>
			<table class="table table-striped">
				<thead>
					<tr>
						<th><span class="glyphicon glyphicon-barcode"></span></th>
						<th>Désignation</th>
						<th><span class="glyphicon glyphicon-shopping-cart"></span></th>
						<th><span class="glyphicon glyphicon-eur"></span></th>
					</tr>
				</thead>
				<tbody>
					<?php for($i=0;$i<$nbrComporte;$i++) {
						$produit = $pro->getProduit($listeComporte[$i]->fk_produit);
					 ?>
					<tr>
						<th scope="row"><?php print $listeComporte[$i]->fk_produit; ?></th>
						<td><?php print $produit[0]->nom; ?></td>
						<td><?php print $listeComporte[$i]->quantite; ?></td>
						<td><?php print $listeComporte[$i]->prix.' €'; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>