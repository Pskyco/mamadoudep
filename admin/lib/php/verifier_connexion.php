<?php
if (!isset($_SESSION['client']) && !$_SESSION['client'][0]->admin) {
	echo '<meta http-equiv="refresh" content="4; url=index.php?page=accueil" />';
	exit();
}