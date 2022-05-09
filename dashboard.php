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
    <title>Trioventure</title>
    <meta name="description" content="Trioventure App">
    <meta name="keywords" content="bootstrap 5, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/192x192.png">
    <link rel="stylesheet" href="assets/css/style.css">
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
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
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
                <div class="col-3">
                    <div class="card product-card">
                        <div class="card-body">
                            <img src="assets/img/order-history.png" class="image" alt="product image">
                            <a href="all-orders.php" class="btn btn-sm btn-primary btn-block mt-1">Order History</a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card product-card">
                        <div class="card-body">
                            <img src="assets/img/payments.png" class="image" alt="product image">
                            <a href="all-payments.php" class="btn btn-sm btn-primary btn-block mt-1">Payments</a>

                        </div>
                    </div>
                </div>
          

                <div class="col-3">
                    <div class="card product-card">
                        <div class="card-body">
                            <img src="assets/img/retailer.png" class="image" alt="product image">
                            <a href="all-retailers.php" class="btn btn-sm btn-primary btn-block mt-1">Retailer List</a>

                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card product-card">
                        <div class="card-body">
                            <img src="assets/img/products.png" class="image" alt="product image">
                            <a href="all-products.php" class="btn btn-sm btn-primary btn-block mt-1">Prodcuts</a>

                        </div>
                    </div>
                </div>
            </div>
   



        <div class="section full mt-2">


            <div class="text-center">Last Completed Orders</div>

            <div class="wide-block">
                <!-- timeline -->
                <div class="timeline timed">


                <?php
        $rt = "SELECT * FROM orders ORDER BY id DESC LIMIT 2 ";
        $order = mysqli_query($db, $rt);
        
        if (mysqli_num_rows($order) > 0) {
        // output data of each row
        while($list = mysqli_fetch_assoc($order)) {
            ?>

                    <div class="item">
                        <span class="time"><?php echo $list['date_time'] ; ?></span>
                        <div class="dot bg-success"></div>
                        <div class="content">
                            <h4 class="title">#Order No.  <?php echo $list['id'] ;?></h4>
                            <div class="text"><?php
                            
                            $rid = $list['retailer_id'];
                             $rt = mysqli_query($db,"SELECT * FROM retailers WHERE id=$rid");
                             while($rname = mysqli_fetch_assoc($rt)) {
                                echo $rname['name'].'-'.$rname['shopname'];
                             }

                            ?>        </div>
                        </div>
                    </div>

                    <?php
          }
    
            } 
            else {
                echo "No Products";
            }
                ?>
                    
                </div>
                <!-- * timeline -->
            </div>

        </div>


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