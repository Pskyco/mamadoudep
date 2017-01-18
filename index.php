<!doctype html>
<?php
include ('./admin/lib/php/adm_liste_include.php');
include ('./lib/php/fonctions_panier.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);

session_start();

if (isset($_POST['login'])) {
    $data = new ClientBD($cnx);
    $retour = $data->isClient($_POST['email'], $_POST['password']);
    if ($retour != 0) {
        $_SESSION['client'] = $retour;
        $userAuthentifie = $data->getClientById($retour);
        $_SESSION['client'] = $userAuthentifie;
    }
} else {
    $retour = -1;
}
?>

<html>
    <head>
        <title>Mamadou Dépannage - Pourquoi aller voir ailleurs ?</title>     
        <link rel="stylesheet" type="text/css" href="./admin/lib/css/bootstrap-3.3.7/dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="./admin/lib/css/style.css"/>
        <link rel="icon" href="./admin/lib/css/favicon.ico" />
        <script src="admin/lib/js/jquery-3.1.1.js"></script>
        <script src="admin/lib/js/allJavascriptFunctions.js" type="text/javascript"></script>
        <script src="admin/lib/js/bootbox.min.js" type="text/javascript"></script>
        <script src="admin/lib/js/jquery-validation-1.15.0/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="admin/lib/css/bootstrap-3.3.7/dist/js/bootstrap.js" type="text/javascript"></script>
        <meta charset='UTF-8'/>
    </head>

    <body>
		<div class="container">
			<header>
			<?php
			if (file_exists('./lib/php/header.php')) {
				include ('./lib/php/header.php');
			}
			?>
			</header>
			<nav>
				<?php
				if (file_exists('./lib/php/menu_client.php')) {
					include ('./lib/php/menu_client.php');
				}
				?>   
			</nav>
			<section id="main">
				<?php
				if ($retour > 0) {
					?> <div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Succès!</strong> Vous êtes désormais authentifié sur notre site web !
					</div> <?php
				} else if ($retour == -1 && !isset($_SESSION['client']) && !isset($_POST['submitInscription'])) {
					?> <div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Hé ho !</strong> Connectez-vous pour profiter pleinement du site <a href="#" data-toggle="modal" data-target="#login-modal" class="alert-link">en cliquant ici</a> !
					</div> <?php
				} else if ($retour == 0) {
					?> <div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Erreur!</strong> La connexion a échoué, réessayez <a href="#" data-toggle="modal" data-target="#login-modal" class="alert-link">en cliquant ici</a>.
					</div> <?php
				}
				if (!isset($_SESSION['page'])) {
					$_SESSION['page'] = "accueil";
				}
				if (isset($_GET['page'])) {
					$_SESSION['page'] = $_GET['page'];
				}
				$path = './pages/' . $_SESSION['page'] . '.php';
				if (file_exists($path)) {
					include ($path);
				} else { ?>
					<span class="txtGras txtRouge">Erreur 404: la page demandée n'existe pas.</span>
					<meta http-equiv="refresh" content="4; url=index.php?page=accueil" />
				<?php }	?> 
			</section>
			<footer class="footer">
				<?php
				if (file_exists('./lib/php/footer.php')) {
					include ('./lib/php/footer.php');
				}
				?>  
			</footer>
		</div>
	</body>
</html>
