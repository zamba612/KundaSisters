<?php 

$conn=mysqli_connect("localhost","root","","kundasisters");

$query="INSERT INTO `users`(`username`, `password`) VALUES ('Bob','Bob')";
$result=array();
if(mysqli_query($conn,$query)){
    $result["Result success :"]=true;
$result["Result success :"]="insert success";
}else{
    $result["Result success :"]="Not insert".mysqli_error($conn);
    $result["Result success :"]=false;
}
echo json_encode($result);
?>