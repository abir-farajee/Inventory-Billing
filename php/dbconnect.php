<?php
//$servername = "localhost";
//$username = "binarybr_travelguide";
//$password = "binarybr_travelguide";
//$dbname = "binarybr_travelguide";

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "trioventure";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

?>