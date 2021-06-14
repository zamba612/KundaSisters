<?php

require_once '../vendor/autoload.php';

use Netas\KundaSisters\pages;

$condition = $_GET['page'] ?? '404';
  $page = new pages($condition);
   require '' . $page->Home . ".php";
//if ($condition != null) {
//  
//    echo $page->Home;
//    require '' . $page->Home . ".php";
//} else {
//    $home = new pages("home");
//    require '' . $home->Home . ".php";
//}
?>

