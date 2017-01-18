<?php
//fonction visant à supprimer les accents de l'adresse qui est entrée
function str_to_noaccent($str)
{
    $url = $str;
    $url = preg_replace('#Ç#', 'C', $url);
    $url = preg_replace('#ç#', 'c', $url);
    $url = preg_replace('#è|é|ê|ë#', 'e', $url);
    $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
    $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
    $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
    $url = preg_replace('#ì|í|î|ï#', 'i', $url);
    $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
    $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
    $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
    $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
    $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
    $url = preg_replace('#ý|ÿ#', 'y', $url);
    $url = preg_replace('#Ý#', 'Y', $url);
     
    return ($url);
}

if (isset($_POST['submitUpdateProfile'])) {
	$id_utilisateur = $_POST['id_admin'];
	$utilisateur = new ClientBD($cnx);
	$user = $utilisateur->getClientById($id_utilisateur);
    //on détecte si les mots de passe ont bien été ré-inscrits
    $erreur = false;
    $changement = false;
    if(!empty($_POST['pwd_admin'])) {
    	if($_POST['pwd_admin']) {
    		//les deux mots de passes sont identiques
    		//on détecte s'il y a un changement de données
    		if($_POST['nom_admin'] != $user[0]->nom) {
    			$changement = true;
    		} else if($_POST['prenom_admin'] != $user[0]->prenom) {
    			$changement = true;
    		} else if($_POST['mail_admin'] != $user[0]->mail) {
    			$changement = true;
    		} else if($_POST['pwd_admin'] != $user[0]->pwd) {
    			$changement = true;
    		} else if(str_to_noaccent($_POST['rue_admin']) != str_to_noaccent(utf8_encode($user[0]->rue))) {
    			$changement = true;
    		} else if($_POST['ville_admin'] != $user[0]->ville) {
				$changement = true;
    		} else if($_POST['tel_admin'] != $user[0]->tel) {
				$changement = true;
    		} else if($_POST['admin_admin'] != $user[0]->admin) {
				$changement = true;
    		}

    		if($changement) {
			    $cli = new ClientBD($cnx);
    			$retourClient = $cli->updateClient($id_utilisateur,$_POST['nom_admin'],$_POST['prenom_admin'],$_POST['mail_admin'],$_POST['pwd_admin'],str_to_noaccent($_POST['rue_admin']),str_to_noaccent($_POST['ville_admin']),$_POST['tel_admin'],boolval($_POST['admin_admin']));
    			$erreur = true;
    			$changement = false;
    			switch($retourClient) {
    				case -1 : $erreurMessage = 'Bizarre.. nous n\'avons pas trouvé votre identifiant ?!';
    				break;
    				case -2 : $erreurMessage = 'Cette adresse mail est déjà répertoriée dans notre base de données.';
    				break;
    				case -3 : $erreurMessage = 'Ce numéro de téléphone est déjà répertorié dans notre base de données.';
    				break;
    				case -4 : $erreurMessage = 'Une erreur est survenue lors de la mise à jour.';
    				break;
    				default : {
    					$erreur = false;
    					$changement = true;
    					$erreurMessage = 'Le profil a correctement été mis à jour ! :)';
					}
    			};
    		} else {
    			$erreur = true;
    			$erreurMessage = 'Aucune modification n\'a été détectée...';
    		}
    	} else {
    		$erreurMessage = 'Les deux mots de passes doivent être identiques :\'(';
    	}
    } else {
    	$erreur = true;
    	$erreurMessage = 'Il est obligatoire de confirmer votre mot de passe avant d\'effectuer une modification.';
    }
}
?>
<div class="row">
	<?php include('./lib/php/gestion_utilisateurs_menu.php'); ?>
	<div class="col-md-9">
		<section id="message">
			<?php if ($changement || $erreur) { ?>
			<div class="alert alert-<?php if($changement) echo 'success'; else echo 'danger'; ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><?php if ($erreur) echo 'Erreur !'; else echo 'Bien...'; ?></strong> <?php echo $erreurMessage; ?>
			</div> <?php } ?>
		</section>
	    <div class="profile-content">
		   <form class="form-horizontal" action="index.php?page=gestion_utilisateurs_search" method="post" id="form_admin_update_profile">
				<legend>Modificaiton du profil de l'utilisateur</legend>
				<div class="form-group">
					<label for="id" class="col-sm-3 control-label">Identifiant</label>
					<div class="col-sm-9">
						<input type="text" id="id_admin" name="id_admin" placeholder="Inscrivez d'abord une adresse mail !" class="form-control" readonly >
					</div>
				</div>
				<div class="form-group">
					<label for="mail" class="col-sm-3 control-label">Adresse mail</label>
					<div class="col-sm-9">
						<input type="email" id="mail_admin" name="mail_admin" placeholder="indiquez une adresse mail" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="nom" class="col-sm-3 control-label">Nom</label>
					<div class="col-sm-9">
						<input type="text" id="nom_admin" name="nom_admin" placeholder="indiquez un nom" class="form-control" disabled >
					</div>
				</div>
				<div class="form-group">
					<label for="prenom" class="col-sm-3 control-label">Prénom</label>
					<div class="col-sm-9">
						<input type="text" id="prenom_admin" name="prenom_admin" placeholder="indiquez un prenom" class="form-control" disabled >
					</div>
				</div>
				<div class="form-group">
					<label for="pwd" class="col-sm-3 control-label">Mot de passe</label>
					<div class="col-sm-9">
						<input type="password" id="pwd_admin" name="pwd_admin" value="" placeholder="indiquez un mot de passe" class="form-control" disabled >
					</div>
				</div>
				<div class="form-group">
					<label for="rue" class="col-sm-3 control-label">Rue</label>
					<div class="col-sm-9">
						<input type="text" id="rue_admin" name="rue_admin" placeholder="indiquez votre rue" class="form-control" disabled >
					</div>
				</div>
				<div class="form-group">
					<label for="ville" class="col-sm-3 control-label">Ville</label>
					<div class="col-sm-9">
						<input type="text" id="ville_admin" name="ville_admin" placeholder="indiquez votre ville" class="form-control" disabled >
					</div>
				</div>
				<div class="form-group">
					<label for="tel" class="col-sm-3 control-label">Téléphone</label>
					<div class="col-sm-9">
						<input type="tel" id="tel_admin" name="tel_admin" placeholder="indiquez un numéro de téléphone" class="form-control" disabled >
					</div>
				</div>
				<div class="form-group">
					<label for="admin" class="col-sm-3 control-label">Administrateur</label>
					<div class="col-sm-9">
						<input type="number" id="admin_admin" name="admin_admin" placeholder="indiquez 0 ou 1" class="form-control" disabled >
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" name="submitUpdateProfile" id="submitUpdateProfile" class="btn btn-primary btn-block" disabled>Mettre à jour le profil</button>
					</div>
				</div>
			</form> <!-- /form -->
	    </div>
	</div>
</div>