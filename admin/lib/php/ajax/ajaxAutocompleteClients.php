<?php
header('Content-Type: application/json');
require '../dbConnect.php';
require '../classes/Connexion.class.php';
require '../classes/JsonClientDB.class.php';

$cnx = Connexion::getInstance($dsn, $user, $pass);

try {
    $search = new JsonClientDB($cnx);
    $retour = $search->getClient($_GET['email']);
    print json_encode($retour);
} catch (PDOException $e) {
}
