<?php

require_once "controllers/IndexController.php";
require_once "controllers/LoginController.php";
require_once "ViewUtil.php";

session_start();

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// definicija usmerjevalnikov:
$urls = [
    "" => function() {
        if(jeMetoda("POST")){
            IndexController::dodajNovico();
        } else {
            IndexController::index();
        }
    },
    "odjava" => function(){
        LoginController::odjaviUporabnika();
    },
    "prijava" => function(){
        if(jeMetoda("POST")){
            LoginController::prijaviUporabnika();
        } else {
            LoginController::loadPrijavaPage();
        }
    }
];

// izvedba usmerjevalnikov:
try {
    if(!isset($_SESSION["uporabnik"]) && $path != "prijava"){
        LoginController::preusmeriNeprijavljenegaUporabnika();
    } elseif (isset($urls[$path])) {
        $urls[$path]();
    } else {
        throw new InvalidArgumentException();
    }
} catch (InvalidArgumentException $e){
    echo "ERROR: 404";
} catch (Exception $ex){
    echo "Napaka! $ex";
}



function jeMetoda($metoda){
    return $_SERVER["REQUEST_METHOD"] == $metoda;
}

function imaVlogo($vloga){
    $seznam_vlog = $_SESSION["uporabnik"]["vloge"];
    foreach($seznam_vlog as $i => $item){
        if($seznam_vlog[$i]["naziv"] == $vloga){
            return true;
        }
    }
    return false;
}