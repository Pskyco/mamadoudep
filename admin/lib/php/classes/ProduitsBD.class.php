<?php

class ProduitsBD extends Produits {

    private $_db;
    private $_infoArray = array();
    private $_variable = "valeur";

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    /*
    *   fonction 'ajoutProduit'
    *   paramètres : nom, stock, prix, catégorie
    *   permet d'effectuer un insert dans la base de données
    *   retour : > 0 si c'est ok, -1 si déjà inscrit, -2 si erreur
    */
    public function ajoutProduit($nom,$quantite,$prix,$categorie) {
        $retour = array();
        try {
            $query = "select produit_ajout(:nom,:quantite,:prix,:categorie) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':nom', $nom);
            $sql->bindValue(':quantite', $quantite);
            $sql->bindValue(':prix', $prix);
            $sql->bindValue(':categorie', $categorie);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requête (ajoutProduit) " . $e;
        }
        return $retour;
    }

    /*
    *   fonction 'deleteProduit'
    *   un paramètre représentant l'id de produit
    *   permet de rapidement supprimer un produit identifié par l'id $id
    */

    public function deleteProduit($id) {
        $retour = array();
        try {
            $query = "select produit_delete(:id) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':id', $id);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requête (deleteProduit) " . $e;
        }
        return $retour;
    }

    /*
    *   fonction 'changeStock'
    *   deux paramètres : l'id du produit à modifier, l'action à réaliser (0 = -, 1 = +)
    *   permet d'incrémenter ou de décrémenter le stock d'un produit
    *   retourne -1 si le produit n'est pas trouvé, l'id du produit s'il est trouvé
    */
    public function changeStock($id,$action) {
        $retour = array();
        try {
            $query = "select produit_stupdate(:id,:action) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':id', $id);
            $sql->bindValue(':action', $action);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requête (changeStock) " . $e;
        }
        return $retour;
    }

    /*
    *   fonction 'updateProduit'
    *   3 paramètres : l'id du produit, le nom et le prix
    *   permet de rapidement modifier les détails d'un produit
    */
    public function updateProduit($id,$nom,$prix) {
        $retour = array();
        try {
            $query = "select produit_update(:id,:nom,:prix) as retour";
            $sql = $this->_db->prepare($query);
            $sql->bindValue(':id', $id);
            $sql->bindValue(':nom', $nom);
            $sql->bindValue(':prix', $prix);
            $sql->execute();
            $retour = $sql->fetchColumn(0);
        } catch (PDOException $e) {
            print "Echec de la requête (updateProduit) " . $e;
        }
        return $retour;
    }

    /*
    *   fonction 'getProduits'
    *   aucun paramètre
    *   permet d'obtenir tous les produits, ordonnées par id_produit croissant
    */
    public function getProduits() {
        try {
            $query = "SELECT * FROM produits ORDER BY id_produit";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = new Produits($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

    /*
    *   fonction 'getProduit'
    *   un paramètre représentant l'id de produit
    *   obtient toutes les infos concernant le produit avec l'id_produit $id
    *   retourne -1 si pas trouvé
    */
    public function getProduit($id) {
        try {
            $query = "SELECT * FROM produits where id_produit = :id";
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
                $_infoArray[] = new Produits($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

    /*
    *   fonction 'getProduitsByCategorie'
    *   un paramètre représentant l'id de la catégorie
    *   retourne tous les produits présents dans cette catégorie
    */
    public function getProduitsByCategorie($id) {
        try {
            $query = "SELECT * FROM produits where fk_categorie = :id";
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
                $_infoArray[] = new Produits($data);
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
