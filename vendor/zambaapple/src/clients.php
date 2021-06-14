<?php

namespace Netas\KundaSisters;

class clients {

    public $albums;
    public $chansons;
    public $username;
    public $password;
    public $Nom;
    public $PostNom;
    public $Prenom;

    function __construct() {
        $this->mysqldriver = new Mysql_Driver();
        $this->albums = new albums_();
        $this->chansons = new titres();
        $this->DB = $this->mysqldriver->DB;
        $this->PASS = $this->mysqldriver->PASS;
        $this->URL = $this->mysqldriver->URL;
        $this->USER = $this->mysqldriver->USER;

        $this->connection = mysqli_connect($this->URL, $this->USER, $this->PASS, $this->DB);
    }

}
