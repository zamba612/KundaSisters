<?php
require '../../vendor/autoload.php';
use Netas\KundaSisters\single_tire;
$single_titre=new single_tire();
$insert=array();
if (isset($_POST['titre']) && isset($_POST['duration']) && isset($_POST['album']) && isset($_POST['description']) ) {
 $insert=$single_titre->create_single_file($_POST['titre'],$_POST['duration'],$_POST['album'],$_POST['description']);
 if ($insert) {
     $response=array("titre"=>$_POST['titre'],"album"=>$_POST['album']);
 }
  
}
echo json_encode($response);


