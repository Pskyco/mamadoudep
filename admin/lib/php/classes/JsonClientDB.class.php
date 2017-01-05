<?php

class JsonClientDB
{

    private $_db;
    private $_gateauxArray = array();

    public function __construct($cnx)
    {
        $this->_db = $cnx;
    }

    public function getClient($email)
    {
        $query = "select * from client where email=:email";
        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $email, PDO::PARAM_STR);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_clientArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_clientArray;
    }


}
