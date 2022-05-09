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


    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txt1").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {

                        data = this.responseText.split(",");

                        var name = document.getElementById('name');
                        var shopname = document.getElementById('shopname');
                        var phone = document.getElementById('phone');
                        var address = document.getElementById('address');

                        name.value = data[0];
                        shopname.value = data[1];
                        phone.value = data[2];
                        address.value = data[3];

                        toastbox('retaileradded',3000);


                    }
                };
                xmlhttp.open("GET", "get-retailer-data.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>

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
                <ion-icon name="log-out-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->





    <div class="extraHeader">
        <ul class="nav nav-tabs style1" role="tablist">
            <li class="nav-item">

                <a class="nav-link active" data-bs-toggle="tab" href="#retailerinfo" role="tab" aria-selected="true">

                    Retailer Info
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#products" role="tab" id="button2" aria-selected="false">
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#bill" role="tab" aria-selected="false">
                    Bill &nbsp <span class="badge badge-secondary">
                        <?php if(isset($_SESSION["shopping_cart"])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}?>
                    </span>
                </a>
            </li>
        </ul>
    </div>



    <div id="appCapsule" class="extra-header-active">


        <div class="tab-content mt-1">



            <div class="tab-pane fade active show" id="retailerinfo" role="tabpanel">


                <div class="section mt-1">

                    <ul class="listview link-listview mt-2">

                        <li class="multi-level">
                            <?php
        $rt = "SELECT * FROM retailers ";
        $retailer = mysqli_query($db, $rt);
        $countlist = mysqli_num_rows($retailer)
    
            ?>
                            <a href="#" class="item">Returning Retailer
                                <span class="badge badge-primary">
                                    <?php echo $countlist; ?>
                                </span>
                            </a>


                            <ul class="listview image-listview">

                                <?php
        $rt = "SELECT * FROM retailers ";
        $retailer = mysqli_query($db, $rt);
        
        if (mysqli_num_rows($retailer) > 0) {
        // output data of each row
        while($list = mysqli_fetch_assoc($retailer)) {

            ?>
                                <li>
                                    <div class="item">
                                        <div class="icon-box bg-primary">
                                            <ion-icon name="image-outline" role="img" class="md hydrated"
                                                aria-label="image outline"></ion-icon>
                                        </div>
                                        <div class="in">
                                            <div>
                                                <?php echo $list['shopname'] ;?>
                                            </div>
                                            <button type="button" value="<?php echo $list['id'] ;?>"
                                                onclick="showUser(this.value)"
                                                class="btn btn-primary btn-sm me-1">Select</button>
                                        </div>
                                    </div>
                                </li>


                                <?php
          }
    
            } 
            else {
                echo "No Products";
            }
                ?>
                            </ul>
                        </li>

                    </ul>


                </div>
                <div class="section mt-2">
                    <div class="card text-center">
                        <div class="card-body p-2">

                            <form>
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="form-label" for="name">Retailer Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter retailer name" autocomplete="off">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle" role="img" class="md hydrated"
                                                aria-label="close circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="form-label" for="shopname">Shop Name</label>
                                        <input type="text" class="form-control" name="shopname" id="shopname"
                                            placeholder="Enter retailer's shop name" autocomplete="off">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle" role="img" class="md hydrated"
                                                aria-label="close circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            placeholder="Enter retailer's phone number">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle" role="img" class="md hydrated"
                                                aria-label="close circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="form-label" for="address">Address</label>
                                        <textarea name="address" rows="2" id="address" class="form-control"></textarea>
                                        <i class="clear-input">
                                            <ion-icon name="close-circle" role="img" class="md hydrated"
                                                aria-label="close circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <div class="chip chip-media mt-2 text-center">
                        <i class="chip-icon bg-primary">
                            <ion-icon name="arrow-forward" role="img" class="md hydrated" aria-label="person">
                            </ion-icon>
                        </i>
                        <span class="chip-label">Go to next tab for select products</span>
                    </div>

                </div>

            </div>



            <div class="tab-pane fade" id="products" role="tabpanel">

                <div class="section full mt-1">

                    <div class="section mt-2">


                        <?php
        $sql = "SELECT * FROM products ";
        $result = mysqli_query($db, $sql);
        
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            ?>
                        <!-- item -->
                        <div class="card cart-item mb-2">
                            <div class="card-body">
                                <div class="in">
                                    <img src="products/<?php echo $row['image'] ;?>" alt="product" class="imaged">
                                    <div class="text">
                                        <h3 class="title">
                                            <?php echo $row['name'] ;?>
                                        </h3>
                                        <p class="detail">
                                            <?php echo $row['weight'] ;?>
                                        </p>
                                        <strong class="price">
                                            <?php echo $row['price'] ;?> BDT
                                        </strong>
                                    </div>
                                </div>
                                <div class="cart-item-footer">
                                    <div class="stepper stepper-success">
                                        <a href="#" class="stepper-button stepper-down">-</a>
                                        <input type="text" class="form-control" name="quantity"
                                            id="quantity<?php echo $row[" id"]; ?>" value="0">
                                        <input type="hidden" name="hidden_name" id="name<?php echo $row[" id"]; ?>"
                                        value="
                                        <?php echo $row["name"]; ?>" />
                                        <input type="hidden" name="hidden_price" id="price<?php echo $row[" id"]; ?>"
                                        value="
                                        <?php echo $row["price"]; ?>" />
                                        <a href="#" class="stepper-button stepper-up">+</a>
                                    </div>
                                    <button type="button" name="add_to_cart" id="<?php echo $row[" id"]; ?>" class="btn
                                        btn-primary me-1 add_to_cart">
                                        <ion-icon name="add-outline" class="md hydrated"
                                            aria-label="document text outline"></ion-icon>
                                        ADD TO LIST
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php
          }
    
            } 
            else {
                echo "No Products";
            }
                ?>

                        <!-- * item -->



                    </div>

                </div>
            </div>

            <div id="toast-3" class="toast-box toast-top mt-2">
                <div class="in">
                    <ion-icon name="checkmark-circle" class="text-success"></ion-icon>
                    <div class="text">
                        Product has been added to list.
                    </div>
                </div>
            </div>

            <div id="retaileradded" class="toast-box toast-top mt-2">
                <div class="in">
                    <ion-icon name="checkmark-circle" class="text-success"></ion-icon>
                    <div class="text">
                        Retailer info added. Go to next tab.
                    </div>
                </div>
            </div>


            <!-- toast top iconed -->
            <div id="deletesuccess" class="toast-box toast-top mt-2">
                <div class="in">
                    <ion-icon name="checkmark-circle" class="text-success"></ion-icon>
                    <div class="text">
                        Item has been removed!
                    </div>
                </div>
            </div>
            <!-- * toast top iconed -->

            <!-- toast top iconed -->
            <div id="qtyalert" class="toast-box toast-top mt-2">
                <div class="in">
                    <ion-icon name="alert-circle-outline" class="text-danger"></ion-icon>
                    <div class="text">
                        Quantity must be at least 1
                    </div>
                </div>
            </div>
            <!-- * toast top iconed -->

            <div id="toast-11" class="toast-box toast-center">
                <div class="in">
                    <ion-icon name="close-circle" class="text-danger md hydrated" role="img" aria-label="close circle">
                    </ion-icon>
                    <div class="text">
                        Are you sure?
                    </div>
                </div>
                <button type="button" class="btn btn-sm bg-danger close-button" id="OK">DELETE</button>
                <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
            </div>




            <div class="tab-pane fade" id="bill" role="tabpanel">

                <div class="section full mt-1">
                    <div class="section">
                        <a href="#" class="btn btn-sm btn-text-secondary btn-block" data-bs-toggle="modal"
                            data-bs-target="#actionSheetDiscount">
                            <ion-icon name="qr-code-outline"></ion-icon>
                            Have a discount code?
                        </a>
                    </div>

                    <!-- Discount Action Sheet -->
                    <div class="modal fade action-sheet" id="actionSheetDiscount" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Enter Discount Code</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="action-sheet-content">
                                        <form>
                                            <div class="form-group basic">
                                                <div class="input-wrapper">
                                                    <label class="form-label" for="discount1">Discount Code</label>
                                                    <input type="text" class="form-control" id="discount1"
                                                        placeholder="Enter your discount code">
                                                    <i class="clear-input">
                                                        <ion-icon name="close-circle"></ion-icon>
                                                    </i>
                                                </div>
                                            </div>

                                            <div class="form-group basic">
                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-bs-dismiss="modal">Apply
                                                    Discount</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- * Discount Action Sheet -->


                    <div class="section mt-2 mb-2">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="order_table">

                                <?php  
                                    if(!empty($_SESSION["shopping_cart"]))  
                                    {  
                                         $total = 0;  
                                         foreach($_SESSION["shopping_cart"] as $keys => $values)  
                                         {                                               
                                    ?>
                                <tr>
                                    <td>
                                        <?php echo $values["product_name"]; ?>
                                    </td>
                                    <td><input type="text" name="quantity[]" id="quantity<?php echo $values["
                                            product_id"]; ?>" value="
                                        <?php echo $values["product_quantity"]; ?>" data-product_id="
                                        <?php echo $values["product_id"]; ?>" class="form-control quantity" />
                                    </td>
                                    <td>BDT
                                        <?php echo $values["product_price"]; ?>
                                    </td>
                                    <td>BDT
                                        <?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?>
                                    </td>
                                    <td><button name="delete" class="btn btn-danger btn-xs delete"
                                            id="<?php echo $values[" product_id"]; ?>">X</button></td>
                                </tr>
                                <?php  
                                              $total = $total + ($values["product_quantity"] * $values["product_price"]);  
                                         }  
                                    ?>
                                <tr>
                                    <td>Total</td>
                                    <td colspan="5" align="right">BDT <span class="text-primary font-weight-bold">
                                            <?php echo number_format($total, 2); ?>
                                        </span></td>

                                </tr>

                                <?php  
                                    }  
                                    ?>

                            </tbody>
                        </table>



                    </div>

                    <div class="section mb-2">
                        <a href="#" class="btn btn-primary ">Confirm Order</a>



                    </div>


                </div>
            </div>




        </div>



    </div>








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
        <a href="#" class="item">
            <div class="col">
                <ion-icon name="document-text-outline" role="img" class="md hydrated"
                    aria-label="document text outline"></ion-icon>
                <strong>Invoices</strong>
            </div>
        </a>
        <a href="#" class="item">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                <strong>Test</strong>
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

    <script src="cart.js"></script>
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