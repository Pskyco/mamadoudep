<?php
	$utilisateur = new ClientBD($cnx);
	$liste_ut = $utilisateur->getClients();
?>

<div class="row">
	<?php include('./lib/php/gestion_utilisateurs_menu.php'); ?>
	<div class="col-md-9">
        <div class="profile-content">
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th>#</th>
			      <th>Email</th>
			      <th>Nom</th>
			      <th>Prénom</th>
			      <th>Admin</th>
			      <th>Action</th>
			    </tr>
			  </thead>
			  <tbody>
				<?php for($i=0;$i<sizeof($liste_ut);$i++) { ?>
				<tr>
				   <th scope="row"><?php print $liste_ut[$i]->id_utilisateur; ?></th>
				   <td><?php print $liste_ut[$i]->mail; ?></td>
				   <td><?php print $liste_ut[$i]->nom; ?></td>
				   <td><?php print $liste_ut[$i]->prenom; ?></td>
				   <td><?php if($liste_ut[$i]->admin == 1) echo '<a class="btn btn-xs btn-success"><span class="glyphicon glyphicon-ok"></span> </a>'; ?></td>
				   <td><a href="index.php?page=gestion_utilisateurs_update&amp;id=<?php echo $liste_ut[$i]->id_utilisateur; ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>
				<?php } ?>
			  </tbody>
			</table>
        </div>
	</div>
</div>