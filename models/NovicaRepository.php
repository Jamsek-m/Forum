<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 29.11.2017
 * Time: 19:47
 */

require_once "models/Repository.php";

class NovicaRepository extends Repository {

    public static function get(array $id) {
        $novica = parent::query("SELECT * FROM novica WHERE id = :id", $id);
        if(count($novica) == 1){
            return $novica[0];
        } else {
            throw new InvalidArgumentException("Uporabnik ne obstaja!");
        }
    }

    public static function getAll() {
        return parent::query("SELECT * FROM novica");
    }

    public static function insert(array $params) {
        return parent::modify("INSERT INTO novica(naslov, tekst, datum, avtor_id) VALUES (:naslov, :tekst, NOW(), :avtor_id)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE novica SET naslov = :naslov, tekst = :tekst, datum = :datum, avtor_id = :avtor_id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM novica WHERE id = :id", $id);
    }
}