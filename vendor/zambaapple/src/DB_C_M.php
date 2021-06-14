<?php

namespace Netas\KundaSisters;

use Netas\KundaSisters\Mysql_Driver;

class DB_C_M {

    public $connection;
    public $result;
    public $mysqldriver;
    public $URL;
    public $USER;
    public $PASS;
    public $DB;
    public $port;

    function __construct() {
        
        $this->mysqldriver = new Mysql_Driver();
        
        $this->DB = $this->mysqldriver->DB;
        $this->PASS = $this->mysqldriver->PASS;
        $this->URL = $this->mysqldriver->URL;
        $this->USER = $this->mysqldriver->USER;
         $this->port = $this->mysqldriver->port;
        $this->dsn = "pgsql:host=" . $this->URL . ";port=" . $this->port . ";dbname=" . $this->DB . ";user=" . $this->USER . ";password=" . $this->PASS . "";
        try {
            $this->pdo = new PDO($this->dsn);
            if ($this->pdo) {
                $this->response = "Connecté à $this->DB avec succès!";
            }
        } catch (PDOException $e) {
            $this->response = $e->getMessage();
        }
        echo json_encode($this->response);
    }

}
