<?php
	if($_GET['retourF']) {
		$erreurMessage = "Votre facture a bien été créée !";
	} else {
		$erreurMessage = "Quelque chose de bizarre est survenu lors de la création de votre facture...";
	}

	if($_GET['retourC']) {
		$erreurMessage2 = "Votre commande a été correctement enregistrée dans notre système !";
	} else {
		$erreurMessage2 = "Votre facture n'a malheureusement pas pu être sauvegardée.. Réessayez plus tard.";
	}
?>

<section id="message">
	<div class="alert alert-<?php if($_GET['retourF']) echo 'success'; else echo 'danger'; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong><?php if (!$_GET['retourF']) echo 'Erreur !'; else echo 'Bien...'; ?></strong> <?php echo $erreurMessage; ?>
	</div>
	<div class="alert alert-<?php if($_GET['retourC']) echo 'success'; else echo 'danger'; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong><?php if (!$_GET['retourC']) echo 'Erreur !'; else echo 'Bravo !'; ?></strong> <?php echo $erreurMessage2; ?>
	</div>
</section>