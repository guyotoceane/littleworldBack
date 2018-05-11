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


    public function getFiches(){
        $req = $this->conn->prepare('SELECT * FROM img
                                              LEFT JOIN land On IdtFiche_img = idt_lnd');

        $result = $req->execute();

        $result = $req->fetchAll();

        return $result;


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
        $dsc_monument = $tabInfos['monument'];


        if (move_uploaded_file($files['image-monument']['tmp_name'], 'D:\dev\wamp64\www\littleworldFront\images\fiches_pays' . '/' . $files['image-monument']['name'])) {
            $req = $this->conn->prepare('INSERT INTO land(styl_lnd, nam_land, area_land, cap_land, text_land, pop_land, mon_land, cont_land, lang_land) VALUE (:styl_lnd, :nam_land, :area_land, :cap_land, :text_land,:pop_land, :mon_land, :cont_land, :lang_land)');



            $result = $req->execute(array(
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
            

            if($result == false){
                die('error to create content');
            }

            $lastId = $this->conn->lastInsertId();


            $req = $this->conn->prepare('INSERT INTO img (nam_img, dsc_img, IdtFiche_img) VALUE (:nam_img, :dsc_img, :IdtFiche_img) ');

            $rmp = array(
                'nam_img' => $files['image-monument']['name'],
                'dsc_img' => $dsc_monument,
                'IdtFiche_img' =>  (int) $lastId
            );


            $result = $req->execute($rmp);


            if($result == false){
                die('error to add img');
            }




        } else{
            die('error upload');
        }




//        print_r($_FILES);


//        return $continent;
    }

    public function postFiche(){

    }


}