<?php

namespace Netas\KundaSisters;

//require '../../autoload.php';
use PDO;
use PDOException;
use Netas\KundaSisters\Mysql_Driver;

class Login {

    public $pdo;
    public $result;
    public $mysqldriver;
    public $URL;
    public $USER;
    public $PASS;
    public $DB;
    public $Success = true;
    public $Failed = false;
    public $UserName;
    public $PassWord;
    public $Request;
    public $query;
    public $Table = "users";
    public $resultQuer;
    public $port;

    function __construct($UserName, $PassWord) {

        $this->mysqldriver = new Mysql_Driver();

        $this->DB = $this->mysqldriver->DB;
        $this->PASS = $this->mysqldriver->PASS;
        $this->URL = $this->mysqldriver->URL;
        $this->USER = $this->mysqldriver->USER;
        $this->port = $this->mysqldriver->port;
        $this->dsn = "pgsql:host=" . $this->URL . ";port=" . $this->port . ";dbname=" . $this->DB . ";user=" . $this->USER . ";password=" . $this->PASS . "";
//        try {
        $this->pdo = new PDO($this->dsn);
        if ($this->pdo) {
            $this->response = "Connecté à $this->DB avec succès!";
        }
//        } catch (PDOException $e) {
//            $this->response = $e->getMessage();
//        }
//        echo json_encode($this->response);

        $this->UserName = $UserName;
        $this->PassWord = $PassWord;
        $this->login_admin();
    }

    public function login_admin() {
        $this->query = "SELECT * FROM " . $this->Table . " WHERE username=:username AND password=:password";
        $this->Request = $this->pdo->prepare($this->query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $this->Request->execute(array(':username' => $this->UserName, ':password' => $this->PassWord));
        while ($this->result = $this->Request->fetch(PDO::FETCH_ASSOC)) {
            if ($this->result->username == $this->UserName && $this->result->password == $this->PassWord) {
                return $this->resultQuer["Login"] = "Login success";
            } else {
                return $this->resultQuer["Login"] = "Not login";
            }
        }
        return $this->resultQuer;
    }

}
