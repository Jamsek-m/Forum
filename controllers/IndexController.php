<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 29.11.2017
 * Time: 16:52
 */

require_once "models/UporabnikRepository.php";
require_once "ViewUtil.php";
require_once "models/NovicaRepository.php";

class IndexController {

    public static function index(){
        UporabnikRepository::get(["id" => 1]);
        $novice = NovicaRepository::getAll();
        echo ViewUtil::render("views/index-page.php", ["novice" => $novice]);
    }

    public static function dodajNovico(){

        $podatki = filter_input_array(INPUT_POST, self::getFilterRules());
        $podatki["avtor_id"] = $_SESSION["uporabnik"]["id"];

        if(self::preveriVrednosti($podatki)){
            $id =  NovicaRepository::insert($podatki);
            echo ViewUtil::redirect(BASE_URL);
        }

    }

    private static function getFilterRules(){
        return [
            "tekst" => FILTER_SANITIZE_SPECIAL_CHARS,
            "naslov" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }

    private static function preveriVrednosti($input){
        if (empty($input)) {
            return FALSE;
        }
        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }
        return $result;
    }

}