	<div class="col-md-3">
		<div class="profile-sidebar">
			<!-- SIDEBAR USERPIC -->
			<div class="profile-userpic">
				<img src="./lib/images/users/test.png" class="img-responsive" alt="">
			</div>
			<!-- END SIDEBAR USERPIC -->
			<!-- SIDEBAR USER TITLE -->
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<?php echo $_SESSION['client'][0]->mail; ?>
				</div>
				<div class="profile-usertitle-job">
					Admin
				</div>
			</div>
			<!-- END SIDEBAR USER TITLE -->
			<!-- SIDEBAR MENU -->
			<div class="profile-usermenu">
				<ul class="nav">
					<li>
						<a href="index.php?page=gestion_utilisateurs_accueil">
						<i class="glyphicon glyphicon-home"></i>
						Gestion des utilisateurs </a>
					</li>
					<li>
						<a href="index.php?page=gestion_utilisateurs_search">
						<i class="glyphicon glyphicon-zoom-in"></i>
						Quick update </a>
					</li>
				</ul>
			</div>
			<!-- END MENU -->
		</div>
	</div>