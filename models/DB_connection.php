<?php

class DB_connection {

    private static $HOST = "localhost";
    private static $USER = "root";
    private static $PASS = "metalm";
    private static $SCHEMA = "forum";

    private static $instance = null;

    public static function getInstance(){
        if(!self::$instance){
            $config = "mysql:host=" . self::$HOST . ";dbname=" . self::$SCHEMA;
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );
            self::$instance = new PDO($config, self::$USER, self::$PASS, $options);
        }
        return self::$instance;
    }


}