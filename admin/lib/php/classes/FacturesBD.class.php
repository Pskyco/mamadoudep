<?php

class FacturesBD extends Factures {
    private $_db;
    private $_infoArray = array();
    private $_variable = "valeur";

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    /*
    *   fonction 'ajoutFacture'
    *   paramètres : montant total & fk_utilisateur
    *   permet d'effectuer un insert dans la base de données
    *   retour : > 0 si c'est ok, -1 si erreur
    */
    public function ajoutFacture($total,$utilisateur) {
        $retour = array();
        try {
            $query = "select facture_ajout(:total,:utilisateur) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':total', $total);
            $sql->bindValue(':utilisateur', $utilisateur);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requête (ajoutFacture) " . $e;
        }
        return $retour;
    }

    /*
    *   fonction 'incrementStatus'
    *   un paramètre représentant l'id de la facture
    *   permet d'incrémenter le status de la facture
    * 0 en attente de paiement
    * 1 paiement accepté
    * 2 en préparation
    * 3 en cours de livraison
    * 4 Livré
    */

    public function incrementStatus($id) {
        $retour = array();
        try {
            $query = "select facture_increment(:id) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':id', $id);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requête (incrementStatus) " . $e;
        }
        return $retour;
    }

    /*
    *   fonction 'getFactures'
    *   aucun paramètre
    *   retourne la liste des factures actuellement dans la DB
    *   ordonné par état (0 -> 4)
    */

    public function getFactures() {
        try {
            $query = "SELECT * FROM factures order by etat, id_facture";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Factures($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

    /*
    *   fonction 'getFactureById'
    *   un paramètre représentant l'id de la facture
    *   permet d'obtenir la facture identifiée par l'id $id
    *   retourne 0 si aucune facture trouvée
    */

    public function getFactureById($id) {
        try {
            $query = "SELECT * FROM factures WHERE id_facture = :id";
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
                $_infoArray[] = new Factures($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

        /*
    *   fonction 'incrementStatus'
    *   un paramètre représentant l'id de l'utilisateur
    *   permet d'obtenir la liste des factures détenues par un client
    */

    public function getFacturesByUtilisateur($id) {
        try {
            $query = "SELECT * FROM factures where fk_utilisateur = :id order by id_facture";
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
                $_infoArray[] = new Factures($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

    public function __toString() {
        return $this->_variable . " " . $this->_db;
    }

}
