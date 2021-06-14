<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Netas\KundaSisters;

use PDO;
use Netas\KundaSisters\chansons;
use Netas\KundaSisters\Mysql_Driver;

/**
 * Description of single-audio
 *
 * @author netas
 */
class single_audio {

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
    public $Table = "fichiers_audios";
    public $resultQuer;
    public $titre_chanson, $titre_album, $condition, $duration;

    function __construct() {
        $this->mysqldriver = new Mysql_Driver();
        $this->chansons = new chansons();
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

    public function single_titre($titre_chansons, $album) {
        $this->query = "SELECT * FROM " . $this->Table . " WHERE titre_chansons=:titre_chansons AND titrealbum=:titrealbum";
        $this->Request = $this->pdo->prepare($this->query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $this->Request->execute(array(':titre_chansons' => $titre_chansons, ':titrealbum' => $album));
        while ($this->result = $this->Request->fetch(PDO::FETCH_ASSOC)) {
            $this->chansons->id = $this->result['id'];
            $this->chansons->titre_chansons = $this->result['titre_chansons'];
            $this->chansons->titreAlbum = $this->result['titrealbum'];
            $this->chansons->fileName = $this->result['filename'];
            $this->chansons->fichier_audio = $this->result['fichier_audio'];
            return $this->chansons;
        }
                  
    }

    public function titres() {
       $this->query = "SELECT * FROM " . $this->Table . "";
        $this->Request = $this->pdo->prepare($this->query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $this->Request->execute();
        while ($this->result = $this->Request->fetch(PDO::FETCH_ASSOC)) {
            $this->chansons = $this->result;
            return $this->chansons;
        }
    }

    public function update_single($titre_chanson, $titre_album, $duration) {
        $this->titre_chanson = $titre_chanson;
        $this->titre_album = $titre_album;
        $this->duration = $duration;
        $this->query = "UPDATE " . $this->Table . " SET "
                . "`duration`='" . $this->duration . "' WHERE "
                . "`titre_chansons`='" . $this->titre_chanson . "' AND "
                . "`titreAlbum`='" . $this->titre_album . "'";
        if (mysqli_query($this->connection, $this->query)) {
            return $this->Success;
        } else {
            return mysqli_error($this->connection);
        }
    }

    public function _get_duration($chansons) {
        for ($index = 0; $index < count($chansons); $index++) {
            $mp3file = new MP3File($chansons[$index][3]);
            $duration1 = $mp3file->getDurationEstimate();
            $duration2 = $mp3file->getDuration();
//            echo "duration: $duration1 seconds" . "\n";
//            echo "estimate: $duration2 seconds" . "\n";
//            echo MP3File::formatTime($duration2) . "\n";

            $str = str_replace("00:", "", MP3File::formatTime($duration2));
            echo $str;
            $this->update_single($chansons[$index][1], $chansons[$index][2], $str);
            //echo json_encode($single->Success);
        }
    }

}
