<?php
include 'php/dbconnect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("location:index.php");
    die();
}?>
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Multi Tab Shopping Cart By Using PHP Ajax Jquery Bootstrap Mysql</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:800px;">  
                <?php  
                if(isset($_POST["place_order"]))  
                {  
                    $date = date("h:i A (d-m-Y)");
                    $rtid = "1";
                     $order_details = "";  
                     foreach($_SESSION["shopping_cart"] as $keys => $values)  
                     {  
                          $order_details .= "  
                          INSERT INTO orders( date_time,retailer_id,product_id, total_price,quantity)  
                          VALUES('".$date."','".$rtid."','".$values["product_name"]."', '".$values["product_price"]."', '".$values["product_quantity"]."');  
                          ";  
                     }  
                     if(mysqli_multi_query($db, $order_details))  
                     {  
                        $orderid = mysqli_insert_id($db);
                        $_SESSION["order_id"]=$orderid;
                          unset($_SESSION["shopping_cart"]);  
                          echo '<script>alert("You have successfully place an order...Thank you")</script>';  
                          echo '<script>window.location.href="cart.php"</script>';  
                     }  
                }  
                if(isset($_SESSION["order_id"]))  
                {  
                     $customer_details = '';  
                     $order_details = '';  
                     $total = 0;  
                     $query = '  
                     SELECT * FROM orders  WHERE id = "'.$_SESSION["order_id"].'"  
                     ';  
                     $result = mysqli_query($db, $query);  
                     while($row = mysqli_fetch_array($result))  
                     {  
                        
                          $order_details .= "  
                               <tr>  
                                    <td>".$row["product_id"]."</td>  
                                    <td>".$row["pquantity"]."</td>  
                                    <td>".$row["total_price"]."</td>  
                                    <td>".number_format($row["quantity"] * $row["total_price"], 2)."</td>  
                               </tr>  
                          ";  
                          $total = $total + ($row["quantity"] * $row["total_price"]);  
                     }  
                     echo '  
                     <h3 align="center">Order Summary for Order No.'.$_SESSION["order_id"].'</h3>  
                     <div class="table-responsive">  
                          <table class="table">  
                               <tr>  
                                    <td><label>Customer Details</label></td>  
                               </tr>  
                              
                               <tr>  
                                    <td><label>Order Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>  
                                         <table class="table table-bordered">  
                                              <tr>  
                                                   <th width="50%">Product Name</th>  
                                                   <th width="15%">Quantity</th>  
                                                   <th width="15%">Price</th>  
                                                   <th width="20%">Total</th>  
                                              </tr>  
                                              '.$order_details.'  
                                              <tr>  
                                                   <td colspan="3" align="right"><label>Total</label></td>  
                                                   <td>'.number_format($total, 2).'</td>  
                                              </tr>  
                                         </table>  
                                    </td>  
                               </tr>  
                          </table>  
                     </div>  
                     ';  
                }  
                ?>  
           </div>  
      </body>  
 </html>