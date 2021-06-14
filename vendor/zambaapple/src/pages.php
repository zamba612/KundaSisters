<?php

namespace Netas\KundaSisters;

class pages {

    public $Home;
    public $albums;
    public $values;
    public $const;
    public $SERVERNAME;
    public $REQUESTURI;

    function __construct($const) {
        $this->const = $const;
        $this->SERVERNAME = $_SERVER["SERVER_NAME"];
        $this->REQUESTURI = $_SERVER["REQUEST_URI"];

        if ($this->const == "home") {
            $this->Home = 'home';
            return $this->Home;
        } elseif ($this->const == "Albums") {
            $this->Home = './servers/albums/albums';
            return $this->Home;
        } elseif ($this->const == "single") {
            $this->Home = './servers/titres/filesnames';
            return $this->Home;
        }elseif ($this->const=="putnewfile") {
            return $this->Home="./servers/putaudio_files";
        }elseif ($this->const=="putfile") {
            return $this->Home="./servers/files_put";
        }
    }

}
