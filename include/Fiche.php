<?php

class Fiche{

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        //Ouverture connexion db
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    /**
     * @param $id
     */
    public function getFiche($id){
        return $id;
    }

    public function putFiche($tabInfos, $files){
        $nom = $tabInfos['nom'];
        $continent = $tabInfos['continent'];
        $capitale = $tabInfos['capital'];
        $langue = $tabInfos['langue'];
        $monnaie = $tabInfos['monnaie'];
        $population = $tabInfos['population'];
        $superficie = $tabInfos['superficie'];
        $description = $tabInfos['description'];
        $style = $tabInfos['page'];

        $req = $this->conn->prepare('INSERT INTO land(styl_lnd, nam_land, area_land, cap_land, text_land, pop_land, mon_land, cont_land, lang_land) VALUE (:styl_lnd, :nam_land, :area_land, :cap_land, :text_land,: pop_land, :mon_land, :cont_land, :lang_land)');

        $req->execute(array(
            'styl_lnd' => $style,
            'nam_land' => $nom,
            'area_land' => $superficie,
            'cap_land' => $capitale,
            'text_land' => $description,
            'pop_land' => $population,
            'mon_land' => $monnaie,
            'cont_land' => $continent,
            'lang_land' => $langue
        ));




        print_r($tabInfos);die;

//        print_r($_FILES);


//        return $continent;
    }

    public function postFiche(){

    }


}