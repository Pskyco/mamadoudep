<?php
	if (isset($_POST["submit"])) {
		//initilisation des variables d'erreurs
		$errHuman = '';
		$errMessage = '';
		$errEmail = '';
		$errName = '';
		$result = '';
		
		//récupération des données
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$human = intval($_POST['human']);
		$from = 'Demo Contact Form'; 
		$to = 'example@domain.com'; 
		$subject = 'Message from Contact Demo ';
		
		$body ="From: $name\n E-Mail: $email\n Message:\n $message";
		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Merci d\'entrer votre nom complet';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Entrez une adresse mail valide';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Il faut écrire un message !';
		}
		//Check if simple anti-bot test is correct
		if ($human !== 5) {
			$errHuman = 'La réponse anti-spam est incorrecte';
		}
		// If there are no errors, send the email
		if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
			if (mail ($to, $subject, $body, $from)) {
				$result='<div class="alert alert-success">Merci ! Je vous contacte dès que possible.</div>';
			} else {
				$result='<div class="alert alert-danger">Désolé, il semble qu\'il y ai eu une erreur lors de l\'envoi du message. Réessayez plus tard.</div>';
			}
		} else {
			$result = '';
		}
	} else {
		$name = '';
		$email = '';
		$message = '';
		$human = '';
	}
?>
<div class="container">
	<div class="col-sm-12">
			<div id="address" class="col-sm-3">
				<h2>Nos locaux</h2>
				<address>
					<strong>Mamadou Dépannage SA</strong><br>
					Chemin du Champ de Mars 15<br>
					7000<br>
					Mons<br>
					Belgique<br>
					<abbr><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span></abbr> +32 498 82 21 01
				</address>
			</div>
			<div id="map" class="col-sm-9">
				<div style="width: 100%"><iframe width="100%" height="300"
				src="http://www.mapi.ie/create-google-map/map.php?width=100%&amp;height=300&amp;hl=en&amp;q=Chemin%20du%20Champ%20de%20Mars%2015+(Mamadou%20D%C3%A9pannage)&amp;ie=UTF8&amp;t=&amp;z=18&amp;iwloc=A&amp;output=embed"
				frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="http://www.mapsdirections.info/ro/creeaza-harta-google/">Adauga Google Map Website-ului</a> na 
				<a href="http://www.mapsdirections.info/ro/">Planificare rută cu Google Maps</a></iframe></div><br />
			</div>
		<h1 class="page-header text-center">Formulaire de contact</h1>
	</div>
	<div class="col-sm-12">
		<form class="form-horizontal" role="form" method="post" action="index.php">
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Nom complet</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name" name="name" placeholder="Prénom & Nom" value="<?php if(isset($_POST['name'])) echo htmlspecialchars($_POST['name']); ?>">
					<?php if(isset($errName)) echo "<p class='text-danger'>$errName</p>";?>
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Adresse mail</label>
				<div class="col-sm-9">
					<input type="email" class="form-control" id="email" name="email" placeholder="example@domaine.be" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">
					<?php if(isset($errEmail)) echo "<p class='text-danger'>$errEmail</p>";?>
				</div>
			</div>
			<div class="form-group">
				<label for="message" class="col-sm-3 control-label">Message</label>
				<div class="col-sm-9">
					<textarea class="form-control" rows="4" name="message"><?php if(isset($_POST['message'])) echo htmlspecialchars($_POST['message']); ?></textarea>
					<?php if(isset($errMessage)) echo "<p class='text-danger'>$errMessage</p>";?>
				</div>
			</div>
			<div class="form-group">
				<label for="human" class="col-sm-3 control-label">2 + 3 = ?</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="human" name="human" placeholder="Votre réponse">
					<?php if(isset($errHuman)) echo "<p class='text-danger'>$errHuman</p>";?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input id="submit" name="submit" type="submit" value="Envoyer" class="btn btn-primary">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<?php if(isset($result)) echo $result; ?>	
				</div>
			</div>
		</form> 
	</div>
</div>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>