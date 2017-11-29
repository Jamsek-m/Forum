<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 29.11.2017
 * Time: 17:16
 */

require_once "models/Repository.php";

class UporabnikRepository extends  Repository {

    public static function get(array $id) {
        $uporabniki = parent::query("SELECT * FROM uporabnik WHERE id = :id", $id);

        if(count($uporabniki) == 1){

            $uporabnik = $uporabniki[0];

            $query_vloge = "SELECT naziv FROM vloga v INNER JOIN upb_vl uv ON v.id = uv.id_vl "
              . "WHERE uv.id_upb = :id";

            $vloge = parent::query($query_vloge, ["id" => $uporabnik["id"]]);

            $uporabnik["vloge"] = $vloge;

            return $uporabnik;
        } else {
            throw new InvalidArgumentException("Uporabnik ne obstaja!");
        }
    }

    public static function getByUpbIme($upbime){
        $users = parent::query("SELECT * FROM uporabnik where upb_ime = :upb_ime", ["upb_ime" => $upbime]);
        if(count($users) == 1){
            $uporabnik = $users[0];

            $query_vloge = "SELECT naziv FROM vloga v INNER JOIN upb_vl uv ON v.id = uv.id_vl "
                . "WHERE uv.id_upb = :id";

            $vloge = parent::query($query_vloge, ["id" => $uporabnik["id"]]);

            $uporabnik["vloge"] = $vloge;

            return $uporabnik;
        } else {
            return null;
        }
    }

    public static function getAll() {
        return parent::query("SELECT * FROM uporabnik ORDER BY id ASC");
    }

    public static function insert(array $params) {
        return parent::modify(
            "INSERT INTO uporabnik(upb_ime, ime, geslo) VALUES(:upb_ime, :ime, :geslo)",
            $params
        );
    }

    public static function update(array $params) {
        return parent::modify(
            "UPDATE uporabnik SET upb_ime = :upb_ime, ime = :ime, geslo = :geslo WHERE id = :id",
            $params
        );
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM uporabnik WHERE id = :id", $id);
    }
}