<?php
session_start();
if (isset($_SESSION['id'])) {
    header("location:dashboard.php");
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
    <title>Mobilekit Mobile UI Kit</title>
    <meta name="description" content="Trioventure">
    <meta name="keywords" content="b" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/192x192.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    function login()
    {

      console.log("working");
     var username=$("#username").val();
     var pass=$("#password").val();

     console.log(pass);
     if(username!="" && pass!="")
     {
      $("#loader").css({"display":"block"});
      $.ajax
      ({
      type:'post',
      url:'php/login.php',
      data:{
       do_login:"do_login",
       username:username,
       password:pass
      },
      success:function(response) {
      if(response=="success")
      {
        window.location.href="dashboard.php";
      }
      else
      {
        $("#loader").css({"display":"none"});
        alert("Wrong Details");
      }
      }
      });
     }
    
     else
     {
      alert("Please Fill All The Details");
     }
    
     return false;
    }
    </script>
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

    <ul class="listview flush transparent no-line image-listview mt-2">


                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="moon-outline" role="img" class="md hydrated" aria-label="moon outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Dark Mode</div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodesidebar">
                                        <label class="form-check-label" for="darkmodesidebar"></label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                       

        <div class="login-form mt-1">
            <div class="section">
                <img src="assets/img/sample/photo/vector4.png" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h1>Get started</h1>
                <h4>Fill the form to log in</h4>
            </div>
            <div class="section mt-1 mb-5">
    
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="username" placeholder="Username">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="password" placeholder="Password">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-links mt-2">
                        <div>
                            <a href="page-register.html">Register Now</a>
                        </div>
                        <div><a href="page-forgot-password.html" class="text-muted">Forgot Password?</a></div>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" onclick="login()" class="btn btn-primary btn-block btn-lg">Log in</button>
                    </div>

            </div>
        </div>


    </div>
    <!-- * App Capsule -->



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

</body>

</html>