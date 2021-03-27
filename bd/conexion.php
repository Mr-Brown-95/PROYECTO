<?php

class Conexion extends PDO{

    private $tipoBase = 'mysql';
    private $host = '192.168.0.10';
    private $database = 'MCU';
    private $user = 'android';
    private $password = '12345';
    private $puerto='8080';

    public function __construct() {
        try {
            parent::__construct($this->tipoBase.':host='.$this->host.';port='.$this->puerto.';dbname='
                .$this->database, $this->user, $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        } catch (Exception $exc) {
            echo 'Error al conectarse con la base de datos: ' .$exc->getMessage();
            exit;
        }
    }
}
