<?php

class CategoriesBD extends Categories {
    private $_db;
    private $_infoArray = array();
    private $_variable = "valeur";

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getCategories() {
        try {
            $query = "SELECT * FROM \"CATEGORIES\"";
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
