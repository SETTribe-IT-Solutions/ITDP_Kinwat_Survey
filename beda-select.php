<?php 
session_start();
include('include/con.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <title>
        Beda
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.8" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php
    include('include/side-navbar.php');
    ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h4 class="card-title">गाव</h4>
                        </div>
                        <div class="card-body p-3">
                            <form action="family-details-ayan.php" method="GET">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6 class="form-control-label" for="aadharNo" style="">तालुका</h6>
                                            <!--<input type="text" class="form-control" id="" name="taluka">-->
                                            <select required name="taluka" class="form-control"  id="taluka">
                                                <option value="" selected="" disabled="">-- तालुका निवडा --</option>
                                                <?php
                                                $q = mysqli_query($con, "SELECT DISTINCT taluka FROM master");
                                                while($r = mysqli_fetch_assoc($q)){
                                                ?>
                                                <option value="<?php echo $r['taluka'] ?>"><?php echo $r['taluka'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6 class="form-control-label" for="name">गाव</h6>
                                            <!--<input type="text" class="form-control" id="name" name="name">-->
                                            <select name="beda" class="form-control"  id="name" required>
                                                <option value="" selected disabled>-- गाव निवडा --</option>
                                                <?php
                                                $q = mysqli_query($con, "SELECT beda FROM master");
                                                while($r = mysqli_fetch_assoc($q)){
                                                ?>
                                                
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            
                                            <div id="otherBeda">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-info" type="submit" name="submit">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('include/footer.php'); ?>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
    <script src="assets/js/plugins/choices.min.js"></script>
    <script>
        if (document.getElementById('beda')) {
            var element = document.getElementById('beda');
            const example = new Choices(element, {});
          }
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        $("#disabledCertificateDiv").hide();
        $("input[name=disabled_handicap]").on('click', function () {
            if ($(this).val() == "1") {
                $("#disabledCertificateDiv").show();
            } else {
                $("#disabledCertificateDiv").hide();
            }
        })
        
        $("#taluka").on('change', function(){
            var taluka = $(this).val();
            $("#name").html("Please Wait");
            $.ajax({
                type : 'POST',
                url  : 'beda-details-db',
                data : {talukaS:taluka},
                success:function(data){
                    $("#name").html(data);
                }
            })
        })
        
        $("#name").on('change', function(){
            if($(this).val() == "other"){
                $("#otherBeda").html('<input type="text"  class="form-control mt-3" required  name="beda">')
            } else {
                $("#otherBeda").html('');
            }
        })
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
    
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