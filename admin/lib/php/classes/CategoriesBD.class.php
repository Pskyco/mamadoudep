<?php

class CategoriesBD extends Categories {
    private $_db;
    private $_infoArray = array();
    private $_variable = "valeur";

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    /*
    *   fonction 'ajoutCategorie'
    *   seul paramètre : $nom
    *   permet d'effectuer un insert dans la base de données
    *   retour : > 0 si c'est ok, -1 si déjà inscrit, -2 si erreur
    */
    public function ajoutCategorie($nom) {
        $retour = array();
        try {
            $query = "select categorie_ajout(:nom) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':nom', strtoupper($nom));
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requête (ajoutCategorie) " . $e;
        }
        return $retour;
    }

    /*
    *   fonction 'deleteCategorie'
    *   seul paramètre : $id
    *   permet d'effectuer une suppression de catégorie
    *   retour : 1 = ok, 0 = suppression non effectuée, 2 = articles dans cette catégo
    */
    public function deleteCategorie($id) {
        $retour = array();
        try {
            $query = "select categorie_delete(:id) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':id', $id);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requête (deleteCategorie) " . $e;
        }
        return $retour;
    }

    /*
    *   fonction 'getCategories'
    *   aucun paramètre
    *   retourne la liste des catégories présentes dans la db
    */
    public function getCategories() {
        try {
            $query = "SELECT * FROM categories";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Categories($data);
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
