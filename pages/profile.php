<?php
// Fonction visant à supprimer les accents de l'adresse qui est entrée
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
    //on détecte si les mots de passe ont bien été ré-inscrits
    $erreur = false;
    $changement = false;
    if(!empty($_POST['pwd'] && !empty($_POST['pwd2']))) {
    	if($_POST['pwd'] == $_POST['pwd2']) {
    		//les deux mots de passes sont identiques
    		//on détecte s'il y a un changement de données
    		if($_POST['nom'] != $_SESSION['client'][0]->nom) {
    			$changement = true;
    		} else if($_POST['prenom'] != $_SESSION['client'][0]->prenom) {
    			$changement = true;
    		} else if($_POST['mail'] != $_SESSION['client'][0]->mail) {
    			$changement = true;
    		} else if($_POST['pwd'] != $_SESSION['client'][0]->pwd) {
    			$changement = true;
    		} else if(str_to_noaccent($_POST['rue']) != str_to_noaccent(utf8_encode($_SESSION['client'][0]->rue))) {
    			$changement = true;
    		} else if($_POST['ville'] != $_SESSION['client'][0]->ville) {
				$changement = true;
    		} else if($_POST['tel'] != $_SESSION['client'][0]->tel) {
				$changement = true;
    		}

    		if($changement) {
			    $cli = new ClientBD($cnx);
    			$retourClient = $cli->updateClient($_SESSION['client'][0]->id_utilisateur,$_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['pwd'],str_to_noaccent($_POST['rue']),str_to_noaccent($_POST['ville']),$_POST['tel']);
    			switch($retourClient) {
    				case -1 : $erreurMessage = 'Une erreur inconnue est survenue :O';
    				break;
    				case -2 : $erreurMessage = 'Une erreur est survenue lors de la mise à jour du profil :(';
    				break;
    				default : {
    					$erreurMessage = 'Le profil a correctement été mis à jour ! :)';
					    $_SESSION['client'] = $cli->getClientById($_SESSION['client'][0]->id_utilisateur);
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
	<div class="col-md-12">
		<section id="message">
			<?php if ($changement || $erreur) { ?>
			<div class="alert alert-<?php if($changement) echo 'success'; else echo 'danger'; ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><?php if ($erreur) echo 'Erreur !'; else echo 'Bien...'; ?></strong> <?php echo $erreurMessage; ?>
			</div> <?php } ?>
		</section>
	    <div class="profile-content">
		   <form class="form-horizontal" action="index.php?page=profile" method="post" id="form_add_categorie">
				<legend>Modificaiton du profil utilisateur</legend>
				<div class="form-group">
					<label for="nom" class="col-sm-3 control-label">Nom</label>
					<div class="col-sm-9">
						<input type="text" id="nom" name="nom" placeholder="indiquez un nom" value="<?php echo $_SESSION['client'][0]->nom; ?>" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="prenom" class="col-sm-3 control-label">Prénom</label>
					<div class="col-sm-9">
						<input type="text" id="prenom" name="prenom" placeholder="indiquez un prenom" value="<?php echo $_SESSION['client'][0]->prenom; ?>" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="mail" class="col-sm-3 control-label">Adresse mail</label>
					<div class="col-sm-9">
						<input type="email" id="mail" name="mail" placeholder="indiquez une adresse mail" value="<?php echo $_SESSION['client'][0]->mail; ?>" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="pwd" class="col-sm-3 control-label">Mot de passe</label>
					<div class="col-sm-9">
						<input type="password" id="pwd" name="pwd" value="" placeholder="indiquez un mot de passe" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="pwd2" class="col-sm-3 control-label">Confirmer le mot de passe</label>
					<div class="col-sm-9">
						<input type="password" id="pwd2" name="pwd2" value="" placeholder="confirmez votre mot de passe" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="rue" class="col-sm-3 control-label">Rue</label>
					<div class="col-sm-9">
						<input type="text" id="rue" name="rue" placeholder="indiquez votre rue" value="<?php echo utf8_encode($_SESSION['client'][0]->rue); ?>" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="ville" class="col-sm-3 control-label">Ville</label>
					<div class="col-sm-9">
						<input type="text" id="ville" name="ville" placeholder="indiquez votre ville" value="<?php echo $_SESSION['client'][0]->ville; ?>" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label for="tel" class="col-sm-3 control-label">Téléphone</label>
					<div class="col-sm-9">
						<input type="tel" id="tel" name="tel" placeholder="indiquez un numéro de téléphone" value="<?php echo $_SESSION['client'][0]->tel; ?>" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" name="submitUpdateProfile" id="submitUpdateProfile" class="btn btn-primary btn-block">Mettre à jour le profil</button>
					</div>
				</div>
			</form> <!-- /form -->
	    </div>
	</div>
</div>