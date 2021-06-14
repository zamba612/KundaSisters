<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Netas\KundaSisters;

use PDO;
use Netas\KundaSisters\Mysql_Driver;
use Netas\KundaSisters\titres_descrit;

/**
 * Description of _titres
 *
 * @author netas
 */
class _titres {
    public $chansons;
    public $connection;
    public $result;
    public $mysqldriver;
    public $URL;
    public $USER;
    public $PASS;
    public $DB;
    public $dsn;
    public $port;
    public $pdo;
    public $Success = true;
    public $Failed = false;
    public $Titre_chanson;
    public $Album;
    public $Request;
    public $query;
    public $Table = "titres_chansons";
    public $resultQuer;
    public $titre_chanson, $titre_album, $condition, $duration;

    function __construct() {
        $this->mysqldriver = new Mysql_Driver();
        $this->chansons = new titres_descrit();
        $this->DB = $this->mysqldriver->DB;
        $this->PASS = $this->mysqldriver->PASS;
        $this->URL = $this->mysqldriver->URL;
        $this->USER = $this->mysqldriver->USER;
        $this->port = $this->mysqldriver->port;
        $this->dsn = "pgsql:host=" . $this->URL . ";port=" . $this->port . ";dbname=" . $this->DB . ";user=" . $this->USER . ";password=" . $this->PASS . "";
        $this->pdo = new PDO($this->dsn);
        if ($this->pdo) {
            $this->response = "Connecté à $this->DB avec succès!";
        }
    }
    public function _titres($album) {
        $this->query = "SELECT * FROM " . $this->Table . " WHERE Album=:Album";
        $this->Request = $this->pdo->prepare($this->query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $this->Request->execute(array(':Album' => $album));
        while ($this->result = $this->Request->fetch(PDO::FETCH_ASSOC)) {
            $this->chansons= $this->result;
//            $this->chansons->id = $this->result->id;
//            $this->chansons->titre = $this->result->titre;
//            $this->chansons->duration = $this->result->duration;
//            $this->chansons->description = $this->result->description;
//            $this->chansons->Album = $this->result->Album;
//             $this->chansons->date_heure = $this->result->date_heure;
//            $this->chansons->visitors = $this->result->visitors;          
            return $this->chansons;
        }
                  
    }
}
