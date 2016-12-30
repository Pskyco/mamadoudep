<?php
/**
 * Description of ClientBD
 *
 * @author Ludwig
 */
class ClientBD {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    /*
    *   fonction 'isClient'
    *   2 paramètres : l'email et le mot de passe
    *   permet de rapidement savoir si l'utilisateur est dans la DB ou non
    *   retour : 0 si il n'existe pas, l'id utilisateur s'il existe
    */
    function isClient($login, $password) {
        $retour = array();
        try {
            $query = "select client_connexion(:email,:password) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':email', $_POST['email']);
            $sql->bindValue(':password', $_POST['password']);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        return $retour;
    }

    /*
    *   fonction 'ajoutClient'
    *   plusieurs paramètres
    *   la ville et l'adresse peuvent être null
    *   permet d'effectuer un insert dans la base de données
    *   retour : 0 si c'est ok, -1 si déjà inscrit, -2 si erreur
    */
    public function ajoutClient($nom, $prenom, $email, $password, $adresse, $ville, $telephone) {
        $retour = array();
        try {
            $query = "select client_ajout(:nom,:prenom,:adresse,:ville,:telephone,:email,:password) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':prenom', $prenom);
            $sql->bindValue(':nom', $nom);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':password', $password);
            $sql->bindValue(':adresse', $adresse);
            $sql->bindValue(':ville', $ville);
            $sql->bindValue(':telephone', $telephone);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te." . $e;
        }
        return $retour;
    }

    public function getClientbyID($id) {
        try {
            $query = "SELECT * FROM client where id_cli=:id";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $id);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Festival($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

}
