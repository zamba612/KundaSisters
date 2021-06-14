<?php
namespace Netas\KundaSisters;

use PDO;
use PDOException;
use Netas\KundaSisters\titres;
use Netas\KundaSisters\Mysql_Driver;


class single_tire {

public $chansons;
public $connection;
public $result;
public $mysqldriver;
public $URL;
public $USER;
public $PASS;
public $DB;
public $Success = true;
public $Failed = false;
public $Titre_chanson;
public $Album;
public $Request;
public $query;
public $Table = "titres_chansons";
public $resultQuer;
public $pdo;

function __construct() {
    $this->mysqldriver = new Mysql_Driver();
    $this->chansons = new titres();
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
  public function create_single_file($titre,$duration,$album,$description) {
          try {
            $sql = "INSERT INTO ".$this->Table." (titre, duration, album, description)VALUES(:titre,:duration, :album, :description)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':titre'=>$titre,':duration'=>$duration,':album'=>$album,':description'=>$description]);
            $publisher_id = $this->pdo->lastInsertId();
            $this->response = $publisher_id;
        } catch (PDOException $th) {
            $this->response = $th;
        }
        return $this->response;
     
    }
public function single_titre($titre, $album) {
    $this->query = "SELECT * FROM " . $this->Table . " WHERE `titre`='" . $titre . "' AND `Album`='" . $album . "'";
    $this->Request = mysqli_query($this->connection, $this->query);
    while ($this->result = mysqli_fetch_assoc($this->Request)) {
        $this->chansons->id = $this->result['id'];
        $this->chansons->titre = $this->result['titre'];
        $this->chansons->duration = $this->result['duration'];
        $this->chansons->Album = $this->result['album'];
        $this->chansons->description = $this->result['description'];
        $this->chansons->date_heure = $this->result['date_heure'];
        return $this->chansons;
    }
}
public function single_titre_ex($titre) {
    $this->query = "SELECT * FROM " . $this->Table . " WHERE album=:album";
     $this->Request = $this->pdo->prepare($this->query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $this->Request->execute([':album'=>$titre]);
    while ($this->result = $this->Request->fetch(PDO::FETCH_ASSOC)) {
        $this->chansons->id = $this->result['id'];
        $this->chansons->titre = $this->result['titre'];
        $this->chansons->duration = $this->result['duration'];
        $this->chansons->Album = $this->result['album'];
        $this->chansons->description = $this->result['description'];
        $this->chansons->date_heure = $this->result['date_heure'];
        return $this->chansons;
    }
}

public function titres() {
    $this->query = "SELECT * FROM " . $this->Table . " ";
    $this->Request = mysqli_query($this->connection, $this->query);
    while ($this->result = mysqli_fetch_assoc($this->Request)) {
        $this->chansons->id = $this->result['id'];
        $this->chansons->titre = $this->result['titre'];
        $this->chansons->duration = $this->result['duration'];
        $this->chansons->Album = $this->result['album'];
        $this->chansons->description = $this->result['description'];
        $this->chansons->date_heure = $this->result['date_heure'];
        return $this->chansons;
    }
}

}
