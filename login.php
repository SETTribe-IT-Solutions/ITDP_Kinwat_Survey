<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <title>
        सर्व्हेक्षण व नोंदणी पोर्टल
    </title>


    <link rel="canonical" href="https://www.creative-tim.com/product/soft-ui-dashboard" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    <link id="pagestyle" href="assets/css/soft-ui-dashboard.min.css?v=1.0.9" rel="stylesheet" />

    <style>
        .async-hide {
            opacity: 0 !important
        }
          
    
        @media screen and (max-width: 600px) {
            .con{
                margin-left: 1px;
                
            }

        }
        
        @media screen and (max-width: 380px){
.con{
                margin-left: 1px;
                
            }

        }
        
        .blinker {
            color: red;
            font-size: 13px;
            font-weight: bold;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }
       
    </style>
</head>

<body class="" style="overflow-x: hidden;">     
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none " id="navbarBlur" navbar-scroll="true" style="background: #fff;">
        <div class="container-fluid py-1 px-3">
            <img src="media/itdpK_logo.jpg?v=1" class="img-fluid">
        </div>
    </nav>
    <main class="main-content  mt-0">
        <section class="con">
            <div class=" align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background:url('media/pardhi-img2.jpg');background-repeat: round;background-size: auto;">
                <span class="mask bg-gradient-dark opacity-2"></span>
                
            </div>
            <div class="container ">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="text-center pt-4">
                                <h5>सर्वेक्षण व नोंदणी पोर्टल</h5>
                            </div>
                            <div class="card-body">
                                <form role="form text-left" action="login_db" method="post">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Username" name="username" aria-label="Name"
                                            aria-describedby="email-addon">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Password" name="password"
                                            aria-label="Password" aria-describedby="password-addon">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2" name="login">Log In</button>
                                    </div>
                                    
                                </form>
                            </div>
                            <!--<div class="card-footer text-center pt-0">
                                <span class="text-danger blinker">Server Expiry Date - 28th Feb 2025</span>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php 
        include('include/footer.php');
        ?>

    </main>

    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993"
        integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA=="
        data-cf-beacon='{"rayId":"78e784e84b332e5e","version":"2022.11.3","r":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}'
        crossorigin="anonymous"></script>
    <?php 
    
    require_once('include/sweetAlert.php');
    if(isset($_SESSION['status'])){
        $status = $_SESSION['status'];
        $msg = $_SESSION['msg'];
        if($status != true){
            toastMsg('error', $msg);
        } else {
            toastMsg('success', $msg);
        }
        unset($_SESSION['status']);
        unset($_SESSION['msg']);
    }
    ?>
</body>

</html>