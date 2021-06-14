<?php

require '../vendor/autoload.php';

use Netas\KundaSisters\single_audio;
use Netas\KundaSisters\chansons;
use Netas\KundaSisters\MP3File;

$single = new single_audio();

$chansons = new chansons();

$chansons=$single->titres();

$duration=$single->_get_duration($chansons);
echo $duration;


