<?php
include 'dbconnect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("location:index.php");
    die();
}

if(isset($_POST['order']))
{
 $date = date("h:i A (d-m-Y)");

 $retailername=$_POST['retailername'];
 $retailershop=$_POST['retailershop'];
 $retailerphone=$_POST['retailerphone'];
 $retaileraddress=$_POST['retaileraddress'];
 $retailerid=$_POST['retailerid'];

 $productid = $_POST['product_id'];
 $qty = $_POST['quantity'];

 $totalprice = "";

 foreach($_SESSION["shopping_cart"] as $keys => $values)  
{

    $itid .= $values["product_id"].',';
    $qty .= $values["product_quantity"].',';
    $item .= $values["product_name"].',';
    $price .= $values["product_price"];

    $list .= ($values["product_name"].' ('.$values["product_price"].')'.' || '.'Quantity-'.$values["product_quantity"] .' || '. 'Amount-'.$values["product_quantity"] * $values["product_price"].','); 
    $totalprice = $totalprice + ($values["product_quantity"] * $values["product_price"]);
    
 
}
//---------DEMO OUTPUT--------------

$itemid = trim($itid, ',');
$quantity = trim($qty, ',');
$items = trim($item, ',');
$all_list = trim($list, ',');



$rtcheck = "SELECT * FROM retailers WHERE id=$retailerid";
        $retcheck = mysqli_query($db, $rtcheck);
        
        if (mysqli_num_rows($retcheck) > 0) {
        $newretailerid = $retailerid;
        }
        else {
            $newtr= mysqli_query($db, "INSERT INTO retailers 

            (name, shopname,phone,address) values 
            ('$retailername', '$retailershop','$retailerphone','$retaileraddress')"); 
            
            if($newtr==TRUE){
               $newretailerid = mysqli_insert_id($db);

            }
        }





$order= mysqli_query($db, "INSERT INTO orders 

(date_time, retailer_id,product_id,quantity,total_price,order_details) values 
('$date', '$newretailerid','$itemid','$quantity', '$totalprice','$all_list')"); 

if($order==TRUE){
   $orderid = mysqli_insert_id($db);


   $pay = mysqli_query($db, "INSERT INTO payments (order_id,retailer_id,amount,paid,last_pay_date,status) values
   ('$orderid','$newretailerid','$totalprice','0','No Date','Pending')"); 
if($pay==TRUE){
   $_SESSION['msg']=$success;
   unset($_SESSION["shopping_cart"]);
   echo $orderid ;
}

}
else{
   echo "Sorry";
}





}
?>