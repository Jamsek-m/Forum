<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 29.11.2017
 * Time: 21:08
 */

require_once "models/UporabnikRepository.php";
require_once "ViewUtil.php";

class LoginController {

    public static function loadPrijavaPage(){
        echo ViewUtil::render("views/login.php");
    }

    public static function prijaviUporabnika(){

        $vnos = filter_input_array(INPUT_POST, self::getPravila());

        $uporabnik = UporabnikRepository::getByUpbIme($vnos["upb_ime"]);

        if($uporabnik == null){
            ViewUtil::redirect(BASE_URL . "prijava?error=true");
        } elseif (password_verify($vnos["geslo"], $uporabnik["geslo"])){
            unset($uporabnik["geslo"]);
            $_SESSION["uporabnik"] = $uporabnik;

            ViewUtil::redirect(BASE_URL);
        } else {
            ViewUtil::redirect(BASE_URL . "prijava?error=true");
        }
        //$vnos["geslo"] = password_hash($vnos["geslo"], PASSWORD_DEFAULT);
    }

    public static function odjaviUporabnika(){
        session_destroy();
        ViewUtil::redirect(BASE_URL . "prijava");
    }

    public static function preusmeriNeprijavljenegaUporabnika(){
        ViewUtil::redirect(BASE_URL . "prijava");
    }

    private static function getPravila(){
        return [
            "upb_ime" => FILTER_SANITIZE_SPECIAL_CHARS,
            "geslo" => []
        ];
    }

}