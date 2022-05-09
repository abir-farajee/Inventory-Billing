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


    <div id="appCapsule" class="pb-2">


    <?php
        $id = $_GET['orderid'];
        $rt = "SELECT * FROM orders WHERE id=$id";
        $order = mysqli_query($db, $rt);
        
        if (mysqli_num_rows($order) > 0) {
        // output data of each row
        while($list = mysqli_fetch_assoc($order)) {

            $pmnt = mysqli_query($db,"SELECT * FROM payments WHERE order_id=$id");
            $payment = mysqli_fetch_assoc($pmnt);

            $rid = $list['retailer_id'];
            $rtinf = mysqli_query($db,"SELECT * FROM retailers WHERE id=$rid");
            $rtinfo = mysqli_fetch_assoc($rtinf)
        
            ?>



<div  class="section full mt-3">
    <div class="invoice">
        <div class="invoiceBackgroundLogo">
            <img src="assets/img/logo.png" alt="background-logo">
        </div>
        <div class="invoice-page-header">
            <div class="invoice-logo">
                <img src="assets/img/logo.png" alt="logo">
            </div>
            <div class="invoice-id">#INVOICE No. <?php echo $list['id'];?> <span class="badge badge-primary"> <?php echo $payment['status'];?> </span></div>
        </div>
        <div class="invoice-person mt-4">
            <div class="invoice-to">
                <h4><?php echo $rtinfo['name'];?> - <?php echo $rtinfo['shopname'];?> </h4>
                <p> <?php echo $rtinfo['phone'];?></p>
                <p><?php echo $rtinfo['address'];?></p>
            </div>
            <div class="invoice-from">
                <h4>Trioventure Admin</h4>
                <p>01622124013</p>
                <p>House# 81, Road - 18, Secctor-11, <br>Uttara, Dhaka-1230</p>
            </div>
        </div>
        <div class="invoice-detail mt-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Item</td>
                            <td>Price(Per Item)</td>
                            <td>Quantity</td>
                            <td>SUBTOTAL</td>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                    
                    $data = explode(',',$list['product_id']);
                    $qty = explode(',',$list['quantity']);
                    foreach(array_combine($data,$qty)  as $out => $qt ) {

                    $prdct = mysqli_query($db,"SELECT * FROM products WHERE id=$out");
                    $item = mysqli_fetch_assoc($prdct);


                       ?>

                        <tr>
                            <td><?php echo $item['name'];?></td>
                            <td>BDT <?php echo $item['price'];?></td>
                            <td><?php   echo $qt;?></td>
                            <td>BDT <?php echo $item['price']*$qt;?> </td>
                        </tr>

                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="invoice-total mt-4">
            <ul class="listview transparent simple-listview">
                <li>Total<span class="totaltext text-secondary"> BDT <?php echo $payment['amount'];?></span></li>
            </ul>
        </div>

        <div class="invoice-signature mt-4">
            <div class="signature-block">
                Signature Here
            </div>
        </div>

        <div class="invoice-bottom">
            Trioventure | Aftab Foods
        </div>
    </div>
</div>

<?php
        }
    }
        ?>

</div>




    <!-- App Bottom Menu -->
    <div class="appBottomMenu rounded">
                <a href="dashboard.php" class="item">
                    <div class="col">
                    <ion-icon name="home-outline" role="img" class="md hydrated" aria-label="home outline"></ion-icon>
                    <strong>Dashboard</strong>
                    </div>
                </a>


                <a  class="item" onclick="printDiv('appCapsule')">
                    <div class="col">
                        <div class="action-button large">
                            <ion-icon name="print-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
                        </div>
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

	<script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();
            document.margin='none';

			document.body.innerHTML = originalContents;

		}
	</script>

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