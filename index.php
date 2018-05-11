<?php

require __DIR__ . '/vendor/autoload.php';

//Inclusion des models
require __DIR__.'/include/Fiche.php';

$app = new Slim\App;

//Initialisation des models
$Fiche = new Fiche();

//Routage sur les fiches
$app->group('/fiche', function () {

    $this->get('/{id}', function ($request, $response, $args) { //Lecture d'une fiche
        global $Fiche;

        $id = $args['id'];

        $retour = $Fiche->getFiche($id);

        $response->getBody()->write("id, $retour");

        return $response;

    });

    $this->post('/', function ($Request, $response, $args) { //Création d'une fiche
        global $Fiche;

//        print_r($Request->getParams());

//        print_r($_FILES);die;

        $Fiche->putFiche($_POST, $_FILES);

//        return $Fiche->putFiche($Request->getParams());

    });

    $this->post('/{id}', function ($request, $response, $args) { //Modification d'une fiche
        $name = $args['id'];
        $response->getBody()->write("Hello, $name");

        return $response;

    });

});

$app->run();