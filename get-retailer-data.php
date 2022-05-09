<?php
$q = intval($_GET['q']);


include 'php/dbconnect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("location:index.php");
    die();
} 

$sql1="SELECT * FROM retailers WHERE id = '".$q."'";
$result1= mysqli_query($db,$sql1);

while($row1 = mysqli_fetch_assoc($result1)) {


  echo $row1['name'] .",".$row1['shopname'].",".$row1['phone'].",".$row1['address'].",".$row1['id'];
 


}

mysqli_close($db);
?>