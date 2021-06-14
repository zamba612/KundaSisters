<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Netas\KundaSisters;

require '../../autoload.php';

use Netas\KundaSisters\Mysql_Driver;

/**
 * Description of User
 *
 * @author netas
 */
class User {

    public $id;
    public $nom;
    public $postnom;
    public $prenom;
    public $usersID;
    public $usercontroller;
    public $date_heure;
    public $query;
    public $connection;
    public $result;
    public $mysqldriver;
    public $URL;
    public $USER;
    public $PASS;
    public $DB;
    public $row;
    public $Success = true;
    public $Failed = false;
    public $array;

    function __construct() {
        $this->mysqldriver = new Mysql_Driver();
        $this->DB = $this->mysqldriver->DB;
        $this->PASS = $this->mysqldriver->PASS;
        $this->URL = $this->mysqldriver->URL;
        $this->USER = $this->mysqldriver->USER;
        $this->connection = mysqli_connect($this->URL, $this->USER, $this->PASS, $this->DB);
    }

    public function create_ID() {
        $this->usersID = random_int(125296, 963369);
        return $this->usersID;
    }

    public function create_user() {
        $this->query = "INSERT INTO `ext_users`("
                . "`nom`,"
                . " `postnom`,"
                . " `prenom`,"
                . " `usersID`) "
                . "VALUES ("
                . "'" . $this->getNom() . "',"
                . "'" . $this->getPostnom() . "',"
                . "'" . $this->getPrenom() . "',"
                . "'" . $this->usersID . "'"
                . ")";
        if (mysqli_query($this->connection, $this->query)) {
            return $this->Success;
        } else {
            return $this->Failed;
        }
    }
    function getUsercontroller() {
        return $this->usercontroller;
    }

    function setUsercontroller($userid) {
        $this->query = "SELECT * FROM `ext_users` WHERE `usersID`='" . $userid . "'";
        $this->result = mysqli_query($this->connection, $this->query);
        while ($this->row = mysqli_fetch_assoc($this->result)) {          
            if ($this->create_ID() == $this->row['usersID']) {
                  $this->array=$this->create_ID();
            } elseif ($this->row['usersID'] == "") {
                  $this->array=$this->create_ID();
            }
        }
        return  $this->array;
    }

    

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPostnom() {
        return $this->postnom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getUsersID() {
        return $this->usersID;
    }

    function getDate_heure() {
        return $this->date_heure;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPostnom($postnom) {
        $this->postnom = $postnom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setUsersID($usersID) {
        $this->usersID = $usersID;
    }

    function setDate_heure($date_heure) {
        $this->date_heure = $date_heure;
    }

}

$user = new User();
$user->setNom("Mantemo");
$user->setPostnom("Tusiamina");
$user->setPrenom("Bob");

$userid = $user->setUsercontroller($user->getUsersID());
$user->setUsersID($userid);
echo json_encode($userid);
$result=$user->create_user();
echo json_encode($result);