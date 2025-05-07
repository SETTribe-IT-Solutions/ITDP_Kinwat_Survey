<?php 
session_start();
include('include/con.php');

if(isset($_POST['update'])){
    require_once('include/sweetAlert.php');
    $accountNo= $_POST['accountNo'];
    $familyId=$_POST['familyId'];
    
    $query = mysqli_query($con, "UPDATE `familyDetails` SET  accountNo = '$accountNo' WHERE familyId = '$familyId'") or die($con->error);
    
    //Msg
    if($query){
        $status = true;
        $msg = " Account Number is successfully updated";
    } else {
        $status = false;
        $msg = "Sorry, Account Number can't be update. Please try again";
    }
    
    setSession($status, $msg);
    header('location: bank_details?familyId='.$familyId."&q=".$_GET['q']."&beda=".$_GET['beda']);
    die();
}
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">माहिती भरा</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="parameter-report-details?q=<?php echo $_GET['q'] ?>&beda=<?php echo $_GET['beda'] ?>">
                                        <button type="button" class="btn btn-primary">Back</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <form action="bank_details?q=<?php echo $_GET['q'] ?>&beda=<?php echo $_GET['beda'] ?>" method="POST" enctype="multipart/form-data">
                                <?php
                                $q = mysqli_query($con, "SELECT accountNo FROM familyDetails WHERE familyId = '{$_GET['familyId']}'");
                                $r = mysqli_fetch_assoc($q);
                                $accountNo = $r['accountNo'];
                                if($accountNo == "0"){
                                    $accountNo = "";
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6 class="form-control-label" for="aadharNo" style="">खाते क्रमांक </h6>
                                            <input type="text" class="form-control" value="<?php echo $accountNo ?>" maxlength="20" name="accountNo">
                                           <input type="text" class="form-control" id="" value="<?php echo $_GET['familyId']; ?>" name="familyId" hidden>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-info" type="submit" name="update">Submit</button>
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