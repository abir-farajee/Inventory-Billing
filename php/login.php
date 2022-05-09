<?php
include 'dbconnect.php';

session_start();
if (isset($_SESSION['id'])) {
    header("location:dashboard.php");
    die();
}

if(isset($_POST['do_login']))
{

 $username=$_POST['username'];
 $pass=$_POST['password'];

 $login = "SELECT id FROM user WHERE username='$username' and password = '$pass'";

 $result = mysqli_query($db, $login);
 $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
 if($row)
 {
  $_SESSION['id']=$row['id'];
  echo "success";
 }
 else
 {
  echo "fail";
 }
 exit();
}
?>