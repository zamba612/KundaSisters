<?php

namespace Netas\KundaSisters;

class Mysql_Driver {
    //ICnI@@j2qs3hrN&%
    public $URL = "ec2-107-21-10-179.compute-1.amazonaws.com";
    public $USER = "uxisgbrsadlvrr";
    public $PASS="4e32370f56328dea4e61a174412723b0c302d42a9e3ad6834b432080ae8f7581";
    public $DB = "denq624vvdk3r6";
    public $port = "5432";
    public $URI = "postgres://uxisgbrsadlvrr:4e32370f56328dea4e61a174412723b0c302d42a9e3ad6834b432080ae8f7581@ec2-107-21-10-179.compute-1.amazonaws.com:5432/denq624vvdk3r6";
    function __construct() {
        
    }
    function getURL() {
        return $this->URL;
    }

    function getUSER() {
        return $this->USER;
    }

    function getPASS() {
        return $this->PASS;
    }

    function getDB() {
        return $this->DB;
    }

    function setURL($URL) {
        $this->URL = $URL;
    }

    function setUSER($USER) {
        $this->USER = $USER;
    }

    function setPASS($PASS) {
        $this->PASS = $PASS;
    }

    function setDB($DB) {
        $this->DB = $DB;
    }

}
