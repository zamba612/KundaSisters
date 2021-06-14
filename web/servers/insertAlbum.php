<?php
require_once '../../vendor/autoload.php';
use Netas\KundaSisters\albums_;
$createAlbum=new albums_();
$array = array();
if (isset($_POST['annedepub']) && isset($_POST['titre']) && isset($_POST['categorie']) && isset($_POST['nombretitre']) && isset($_POST['duration']) && isset($_POST['description']) ) {
    $array['Server_lan_connected'] = true;  
   $array=$createAlbum->create_Album($_POST['titre'],$_POST['nombretitre'],$_POST['categorie'],$_POST['duration'],$_POST['description'],$_POST['annedepub']); 
}
echo json_encode($array);
