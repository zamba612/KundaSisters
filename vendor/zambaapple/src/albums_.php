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

class albums_ {

    public $albums;
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
    public $Table = "albums";
    public $resultQuer;

    function __construct() {
        $this->mysqldriver = new Mysql_Driver();
        $this->albums = new albums();
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

    public function single_album($titre, $album) {

        $this->query = "SELECT * FROM " . $this->Table . " WHERE titre=:titre AND Album=:Album";
        $this->Request = $this->pdo->prepare($this->query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $this->Request->execute(array(':titre' => $titre, ':Album' => $album));
        while ($this->result = $this->Request->fetch(PDO::FETCH_ASSOC)) {
            $this->albums->id = $this->result->id;
            $this->albums->titre = $this->result->titre;
            $this->albums->nbredestitres = $this->result->nbredestitres;
            $this->albums->duration = $this->result->duration;
            $this->albums->visitors = $this->result->visitors;
            $this->albums->description = $this->result->description;
            $this->albums->annedepub = $this->result->annedepub;
            $this->albums->date_heure = $this->result->date_heure;
            return $this->albums;
        }
    }

    public function _albums() {
        $this->query = "SELECT * FROM " . $this->Table . " ";
        $this->Request = $this->pdo->prepare($this->query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $this->Request->execute();
        while ($this->result = $this->Request->fetch(PDO::FETCH_ASSOC)) {
            $this->albums->id = $this->result['id'];
            $this->albums->titre = $this->result['titre'];
            $this->albums->nbredestitres = $this->result['nbredestitres'];
            $this->albums->duration = $this->result['duration'];
            $this->albums->visitors = $this->result['visitors'];
            $this->albums->description = $this->result['description'];
            $this->albums->annedepub = $this->result['annedepub'];
            $this->albums->date_heure = $this->result['date_heure'];
            return $this->albums;
        }
    }
    public function create_Album($titre,$nombretitre,$categorie,$duration,$description,$annedepub) {
          try {
            $sql = "INSERT INTO albums (titre,nbredestitres, categorie,duration,description,annedepub)VALUES(:titre,:nbredestitres, :categorie,:duration,:description,:annedepub)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':titre'=>$titre,':nbredestitres'=>$nombretitre,':categorie'=>$categorie,':duration'=>$duration,':description'=>$description,':annedepub'=>$annedepub]);
            $publisher_id = $this->pdo->lastInsertId();
            $this->response = $publisher_id;
        } catch (PDOException $th) {
            $this->response = $th;
        }
        return $this->response;
    }
}
