<?php

class ComporteBD extends Comporte {
    private $_db;
    private $_infoArray = array();
    private $_variable = "valeur";

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    /*
    *   fonction 'ajoutComporte'
    *   paramètres : fk_facture, fk_produit & quantité & prix
    *   permet d'effectuer un insert dans la base de données
    *   retour : > 0 si c'est ok, -1 si erreur
    */
    public function ajoutComporte($facture,$produit,$quantite,$prix) {
        $retour = array();
        try {
            $query = "select comporte_ajout(:facture,:produit,:quantite,:prix) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':facture', $facture);
            $sql->bindValue(':produit', $produit);
            $sql->bindValue(':quantite', $quantite);
            $sql->bindValue(':prix', $prix);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requête (ajoutComporte) " . $e;
        }
        return $retour;
    }

    public function getComporteNumberByFacture($id) {
        try {
            $query = "SELECT sum(quantite) from comporte where fk_facture = :id";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $id);
            $resultset->execute();
            $retour = $resultset->fetchColumn(0);

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        return $retour;
    }

    public function getComporteByFacture($id) {
        try {
            $query = "SELECT * FROM comporte WHERE fk_facture = :id";
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
                $_infoArray[] = new Comporte($data);
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
