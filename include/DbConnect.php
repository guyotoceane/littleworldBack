<?php

/**
 * Gérer la connexion à la base
 *
 */
class DbConnect {

    private $conn;

    function __construct() {
    }

    /**
     * établissement de la connexion
     * @return PDO
     */
    function connect() {
        include_once dirname(__FILE__) . '/Config.php';

        // Connexion à la base de données mysql
        try{
            $this->conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        //retourner la ressource de connexion
        return $this->conn;
    }

}