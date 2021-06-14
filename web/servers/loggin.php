<?php
require '../../vendor/autoload.php';
use Netas\KundaSisters\Login;
$result = array();
if (isset($_POST['username']) && isset($_POST['password'])) {
    
    $result=new Login($_POST['username'], $_POST['password']);
    

//            if ($row['username'] == $_POST['username'] && $row['password'] == $_POST['password']) {
//                $result["Login"] = true;
//                $result["Login"] = "Login success";
//            } else {
//                $result["sql"] = "Not Login" . mysqli_error($row);
//                $result["Login"] = false;
//            }

}
echo json_encode($result);
?>