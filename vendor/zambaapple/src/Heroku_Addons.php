<?php

namespace Netas\KundaSisters;
require '../../autoload.php';
use PDO;
use PDOException;
use Netas\KundaSisters\PDOZambaDriver;


class Heroku_Addons {

    public $response;
    public $PDODR;
    public $dsn;
    public $connection;
    public $HOST;
    public $Database;
    public $User;
    public $port;
    public $Password;
    public $URI;
    public $pdo;
    public $array = array();

    function __construct() {
        $this->PDODR = new PDOZambaDriver();
        $this->HOST = $this->PDODR->HOST;
        $this->port = $this->PDODR->port;
        $this->Database = $this->PDODR->Database;
        $this->User = $this->PDODR->User;
        $this->Password = $this->PDODR->Password;
        $this->dsn = "pgsql:host=" . $this->HOST . ";port=" . $this->port . ";dbname=" . $this->Database . ";user=" . $this->User . ";password=" . $this->Password . "";
        try {
            $this->pdo = new PDO($this->dsn);
            if ($this->pdo) {
                $this->response = "Connecté à $this->Database avec succès!";
            }
        } catch (PDOException $e) {
            $this->response = $e->getMessage();
        }
        echo json_encode($this->response);
    }

    public function insert($username, $password) {
        try {
            $sql = "INSERT INTO users(username,password)values(:username,:password)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':username' => $username, ':password' => $password]);
            $publisher_id = $this->pdo->lastInsertId();
            $this->response = $publisher_id;
        } catch (PDOException $th) {
            $this->response = $th;
        }
        return $this->response;
    }

    public function resultSet() {
        $sql = "SELECT * FROM users";
        $resultset = $this->pdo->prepare($sql);
        $resultset->execute();
        while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
            $this->array[] = $row;
        }
        return $this->array;
    }

    public function PDO_Psg_sql() {
        try {
            $this->pdo = new PDO("pgsql:host=" . $this->HOST . ";port=" . $this->port . ";dbname=" . $this->Database . ";user=" . $this->User . ";password=" . $this->Password . "");

            if ($this->pdo) {
                $this->response = "Connecté à $this->Database avec succès!";
            }
        } catch (PDOException $e) {
            $this->response = $e->getMessage();
        }

        return $this->response;
    }

    public function PDO_C() {
        $pdo = new PDO("pgsql:host=" . $this->HOST . ";port=" . $this->port . ";user=" . $this->User . ";password=" . $this->Password . ";dbname=" . $this->Database . "");
        return $pdo;
    }

    public function Psgsql_env() {
        $db = parse_url(getenv($this->URI));
        $db["path"] = ltrim($db["path"], "/");
        $this->connection = $db;
        return $this->connection;
    }

}

$hrekoku = new Heroku_Addons();
//$code=random_int(2,3);
//$result=$hrekoku->insert("bob", "bob");
//echo json_encode($result);
echo json_encode($hrekoku);
