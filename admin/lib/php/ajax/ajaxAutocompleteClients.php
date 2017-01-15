<?php
header('Content-Type: application/json');
require '../dbConnect.php';
require '../classes/Connexion.class.php';
require '../classes/JSONClientDB.class.php';

$cnx = Connexion::getInstance($dsn, $user, $pass);

try {
    $search = new JSONClientBD($cnx);
    $retour = $search->getClient($_GET['email']);
    print json_encode($retour);
} catch (PDOException $e) {

}
