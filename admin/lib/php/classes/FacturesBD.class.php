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

    public function getFactures() {
        try {
            $query = "SELECT * FROM factures order by etat";
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
