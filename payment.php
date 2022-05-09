<?php
include 'php/dbconnect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("location:index.php");
    die();
}?>

<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Payment</title>
    <meta name="description" content="Trioventure App">
    <meta name="keywords" content="bootstrap 5, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/192x192.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

</head>

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
        <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline" role="img" class="md hydrated" aria-label="chevron back outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"><img src="assets/img/logo.png" alt="logo" class="logo"></div>
        <div class="right">
          <a href="php/logout.php" class="headerButton">
          <ion-icon name="log-out-outline"></ion-icon></a>
        </div>
    </div>
    <!-- * App Header -->



    <!-- App Capsule -->
    <div id="appCapsule">

    <div class="section mt-2">
            <div class="row">

            <?php

        $id = $_GET['orderid'];

        $sql = "SELECT * FROM payments WHERE order_id=$id";
        $result = mysqli_query($db, $sql);
        
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-12">
                    <div class="card product-card">
                        <div class="card-body">

                        <div class="price text-center">Total Annount to Pay</div>
                        
                        <h1 class=" text-center">BDT <?php echo $row['amount']- $row['paid'] ;?> </br>
                        <span class="badge badge-primary">Paid: BDT <?php echo $row['paid'] ; ?> </span>
                        </h1>


                 
                            <!--a href="#" class="btn btn-sm btn-primary btn-block">ADD TO CART</a-->
                        </div>
                    </div>
                </div>

                <div class="col-12">

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="form-label" for="name5">Paid Amount</label>
                            <input type="hidden" name="orderid" value="<?php echo $id ;?>">
                            <input type="hidden" name="total" id="total" value="<?php echo $row['amount'] ;?>">
                            <input type="hidden" name="paid" id="total" value="<?php echo $row['paid'] ;?>">
                            <input type="number" class="form-control equipCatValidation" name="paidamount" id="paidamount"  placeholder="Enter Paid Amount" autocomplete="off">
                            <i class="clear-input">
                                <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <input type="submit" name="confirm" class="btn btn-primary btn-block" value="Confirm Payment">

                </div>
</form>


                <?php
          }
    
            } 
            else {
                echo "No Products";
            }
                ?>
            </div>
        </div>


<?php
if(isset($_POST['confirm']))
{
    $orderid = $_POST['orderid'];
    $newpaid = $_POST['paidamount'];
    $prepaid = $_POST['paid'];
    $total = $_POST['total'];

    $date = date("h:i A (d-m-Y)");

    $new = $prepaid+$newpaid;

    if ($total > $new ){
        $status="Due";
    }
    else{
        $status="Paid";
    }


    $check= mysqli_query($db, "UPDATE payments  SET paid='$new', status='$status', last_pay_date='$date' WHERE order_id=$orderid"); 

if($check==TRUE)
{

   echo '<script>window.location="all-payments.php"</script>';
}
else{
   echo "Sorry";
}

}

    ?>




    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu rounded">
                <a href="dashboard.php" class="item">
                    <div class="col">
                    <ion-icon name="home-outline" role="img" class="md hydrated" aria-label="home outline"></ion-icon>
                    <strong>Dashboard</strong>
                    </div>
                </a>
                <a href="#" class="item">
                    <div class="col">
                        <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                        <strong>Call Retailer</strong>
                    </div>
                </a>
                <a href="new-order.php" class="item">
                    <div class="col">
                        <div class="action-button">
                            <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
                        </div>
                    </div>
                </a>
                <a href="all-invoice.php" class="item">
                    <div class="col">
                        <ion-icon name="document-text-outline" role="img" class="md hydrated" aria-label="document text outline"></ion-icon>
                        <strong>Invoices</strong>
                    </div>
                </a>
                <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                    <div class="col">
                        <ion-icon name="menu-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                        <strong>Menu</strong>
                    </div>
                </a>
            </div>
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">

                    <!-- profile box -->
                    <div class="profileBox">
                        <div class="image-wrapper">
                            <img src="products/cs.jpg" alt="image" class="imaged rounded">
                        </div>
                        <div class="in">
                            <strong>Trioventure Admin</strong>
                            <div class="text-muted">
                                <ion-icon name="location"></ion-icon>
                                Uttara, Dhaka
                            </div>
                        </div>
                        <a href="#" class="close-sidebar-button" data-bs-dismiss="modal">
                            <ion-icon name="close"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->

                    <ul class="listview flush transparent no-line image-listview mt-2">
                        <li>
                            <a href="#" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Dashboard
                                </div>
                            </a>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="moon-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Dark Mode</div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input dark-mode-switch" type="checkbox"
                                            id="darkmodesidebar">
                                        <label class="form-check-label" for="darkmodesidebar"></label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>



                </div>

                <!-- sidebar buttons -->
                <div class="sidebar-buttons">
             
                    <a href="php/logout.php" class="button">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </a>
                </div>
                <!-- * sidebar buttons -->
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->



    <!-- ============== Js Files ==============  -->
    <!-- Bootstrap -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="assets/js/plugins/splide/splide.min.js"></script>
    <!-- ProgressBar js -->
    <script src="assets/js/plugins/progressbar-js/progressbar.min.js"></script>
    <!-- Base Js File -->
    <script src="assets/js/base.js"></script>

    <script>
        // Trigger welcome notification after 5 seconds
        setTimeout(() => {
            notification('notification-welcome', 5000);
        }, 2000);
    </script>

</body>

</html>