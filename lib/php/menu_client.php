<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Afficher le menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./index.php?page=accueil">
        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
		<li><a href="./index.php?page=boutique">
			<!-- boutique -->
			<span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
			Boutique
		</a></li>
		<li><a href="./index.php?page=panier">
			<!-- panier -->
			<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
			Panier
		</a></li>
		<?php
		if (!isset($_SESSION['client'])) {
		?>
		<li><a href="./index.php?page=contact">
			<!-- contact -->
			<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
			Nous contacter
		</a></li>
		<li><a href="./index.php?page=inscription">
			<!-- inscription -->
			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
			S'inscrire
		</a></li>
		<li><a href="#" data-toggle="modal" data-target="#login-modal">
			<!-- connexion -->
			<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
			Connexion
		</a></li>
		<?php } else { ?>
		<li><a href="./index.php?page=factures">
			<!-- factures -->
			<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
			Mes factures
		</a></li>
		<li><a href="./index.php?page=profile">
			<!-- gestion du profil -->
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			Gestion du profil
		</a></li> <?php
		if (isset($_SESSION['client']) && $_SESSION['client'][0]->admin) {
			?>
			<li><a href="./admin/index.php?page=accueil_admin">
				<!-- panel admin -->
				<span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
				Panel admin
			</a></li>
		<?php
		}
		?>
		<li><a href="./index.php?page=contact">
			<!-- contact -->
			<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
			Nous contacter
		</a></li>
		<li><a href="./index.php?page=disconnect">
			<!-- déconnexion -->
			<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
			Se déconnecter
		</a></li>
		<?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- BEGIN # MODAL LOGIN -->

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
		<div class="loginmodal-container">
			<h1>Panel d'authentification</h1><br>
		  <form form action="./index.php" method='post'>
			<input type="text" name="email" placeholder="Adresse mail">
			<input type="password" name="password" placeholder="Mot de passe">
			<input type="submit" name="login" class="login loginmodal-submit" value="Se connecter">
		  </form>
			
		  <div class="login-help">
			<a href="#">S'enregistrer</a> - <a href="#">Mot de passe oublié ?</a>
		  </div>
		</div>
	</div>
</div>

<!-- END # MODAL LOGIN -->