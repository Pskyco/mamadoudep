
<?php
	if(isset($_GET['action'])) {
		if($_GET['action'] == 'del') {
			//suppression du panier
			supprimePanier();
		} else if($_GET['action'] == 'remove'){
			//suppression d'un produit
			supprimerArticle($_GET['id']);
		} else if($_GET['action'] == 'confirm'){
			//confirmation du panier
			verrouillerPanier();
		} else if($_GET['action'] == 'unconfirm'){
			//déverouiller le panier
			deverrouillerPanier();
		} else if($_GET['action'] == 'commande'){
			//déverouiller le panier
			if(isVerrouille()) {
				echo '<meta http-equiv="refresh" content="0; url=index.php?page=commander" />';
			}
		}
	}
?>
<div class="row">
	<div class="col-md-12">
		<section id="message">
			<?php if (isVerrouille()) { ?>
			<div class="alert alert-info alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Information :</strong> Votre panier est actuellement verrouilé, vous ne pouvez plus y ajouter d'articles. Il est temps de passer votre commande !
			</div> <?php } else if (!isset($_SESSION['panier']) || !compterArticles()) { ?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Information :</strong> Aucun article n'est actuellement présent dans votre panier.
			</div> <?php } ?>
		</section>
	<?php if (isset($_SESSION['panier']) && compterArticles()) { ?>
		<table class="table table-striped">
			<thead>
				<tr>
				<th><span class="glyphicon glyphicon-barcode"></span></th>
				<th>Nom</th>
				<th><span class="glyphicon glyphicon-shopping-cart"></span></th>
				<th><span class="glyphicon glyphicon-eur"></span></th>
				<th></th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<compterArticles();$i++) { ?>
				<tr>
				<th scope="row"><?php print $_SESSION['panier']['idProduit'][$i]; ?></th>
				<td><?php print utf8_encode($_SESSION['panier']['libelleProduit'][$i]); ?></td>
				<td><?php print $_SESSION['panier']['qteProduit'][$i]; ?></td>
				<td><?php print $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i].' €'; ?></td>
				<td><a href="index.php?page=panier&amp;action=remove&amp;id=<?php print utf8_encode($_SESSION['panier']['idProduit'][$i]); ?>" class="btn btn-xs btn-danger <?php if(isVerrouille()) echo 'disabled'; ?>" id="delpro"><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
				<?php } ?>
				<tr>
					<th scope="row"></th>
					<td><strong>Montant total: </strong></td>
					<td></td>
					<td><?php print MontantGlobal().' €'?></td>
					<td></td>
				</tr>
				<?php if($i == compterArticles ()) { ?>
				<tr>
					<th scope="row"></th>
					<td>
						<?php if (!isVerrouille()) { ?>
							<a href="index.php?page=panier&amp;action=del" class="btn btn-danger" id="delpanier"><span class="glyphicon glyphicon-trash"></span> Supprimer le panier</a>
							<a href="index.php?page=panier&amp;action=confirm" class="btn btn-success" id="confirmpanier"><span class="glyphicon glyphicon-ok"></span> Valider le panier</a> <?php
						} else { ?>
							<a href="index.php?page=panier&amp;action=unconfirm" class="btn btn-warning" id="unconfirmpanier"><span class="glyphicon glyphicon-lock"></span> Déverrouiller le panier</a>
							<?php if(isset($_SESSION['client'])) { ?>
								<a href="index.php?page=panier&amp;action=commande" class="btn btn-primary" id="commande"><span class="glyphicon glyphicon-qrcode"></span> Passer commande</a>
						<?php } else { ?>
							<a class="btn btn-primary" id="commande" disabled><span class="glyphicon glyphicon-qrcode"></span> Connectez-vous pour commander !</a>
					<?php }
					} ?>
					</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } ?>
	</div>
</div>