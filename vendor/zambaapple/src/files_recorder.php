<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Netas\KundaSisters;

use PDO;
use PDOException;
use Netas\KundaSisters\Mysql_Driver;
use Netas\KundaSisters\titres_descrit;

/**
 * Description of files_recorder
 *
 * @author netas
 */
class files_recorder {
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
    public $Table = "fichiers_videos";
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
    public function insert_new_file($table,$chanson,$album,$fileName) {   
             try {
            $sql = "INSERT INTO ".$table."(titre_chanson,titrealbum, filename)values(:titre_chanson,:titrealbum,:filename)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':titre_chanson' => $chanson, ':titrealbum' => $album, ':filename' => $fileName]);
            $publisher_id = $this->pdo->lastInsertId();
            $this->response = $publisher_id;
        } catch (PDOException $th) {
            $this->response = $th;
        }
        return $this->response;
    }
}
