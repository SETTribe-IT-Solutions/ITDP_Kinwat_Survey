<?php 
session_start();
$familyId = $_GET['familyId'];
include('include/con.php');

if(isset($_POST['submit'])){
    include('include/sweetAlert.php');
    $familyId = $_POST['familyId'];
    
    $filename=$_FILES["familyPhoto"]["name"];
    $tempname=$_FILES["familyPhoto"]["tmp_name"];
    $folder="familyPhoto/".$filename;
    move_uploaded_file($tempname,$folder);
    
    $query = mysqli_query($con, "UPDATE familyDetails SET familyPhoto = '$filename' WHERE familyId = '$familyId'");
    //Msg
    if($query){
        $status = true;
        $msg = " परिवार छायाचित्र यशस्वीरित्या सबमिट केली गेली आहे";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: family-photo?familyId='.$familyId);
    die();
}

if(isset($_GET['delete'])){
    include('include/sweetAlert.php');
    $familyId = $_GET['delete'];
    
    unlink('familyPhoto/'.$_GET['file']);
    $q = mysqli_query($con, "UPDATE familyDetails SET familyPhoto = '' WHERE familyId = '$familyId'");
    //Msg
    if($query){
        $status = true;
        $msg = " परिवार छायाचित्र यशस्वीरित्या डिलीट केली गेली आहे";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: family-photo?familyId='.$familyId);
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
        Family Details
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
    <main class="main-content position-relative border-radius-lg ">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            
                            <?php
                            if(isset($_GET['member'])){
                                $member = "?member=";
                            ?>
                            <h4 class="card-title">परिवार छायाचित्र - 
                            <?php 
                            $q = mysqli_query($con, "SELECT name, beda FROM familyDetails WHERE familyId = '$familyId' ORDER BY sr_no ASC LIMIT 1");
                            $r = mysqli_fetch_assoc($q);
                            echo $r['name'];
                            $beda = $r['beda'];
                            ?>
                            </h4>
                            <?php 
                            } else {
                                
                            ?>
                            <h4 class="card-title">परिवार छायाचित्र </h4>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="card-body p-3">
                            <form action="family-photo" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $familyId ?>" name="familyId">
                                <input type="hidden" value="<?php echo $beda ?>" name="beda">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">छायाचित्र <span style="color:red">*</span></label>
                                            <input type="file" class="form-control" required="" id="familyPhoto" accept=".jpe,.jpeg,.png,.tiff,.pdf" name="familyPhoto">
                                        </div>    
                                    </div>     
                                    <div class="col-md-12">
                                        <?php
                                        $q = mysqli_query($con, "SELECT familyPhoto FROM familyDetails WHERE familyId = '$familyId'");
                                        $r = mysqli_fetch_assoc($q);
                                        if(!empty($r['familyPhoto'])){
                                        ?>
                                        <img src="familyPhoto/<?php echo $r['familyPhoto'] ?>" class="img-fluid">
                                        <a onclick="deletefun('family-photo', '<?php echo $familyId ?>&file=<?php echo $r['familyPhoto'] ?>')" style="float:right" button class="btn btn-danger" type="button"><i class="bi bi-trash"></i></button></a>
                                        <?php 
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-success" type="submit" name="submit">Submit</button>
                                    </div>
                                    <?php 
                                    // if(isset($_GET['member'])){
                                    ?>
                                    <!--<div class="col-6">-->
                                        <!--<a href="family-report">-->
                                    <!--        <button class="btn btn-info" type="button" name="submit">Back</button>-->
                                            <!--</a>-->
                                    <!--</div>-->
                                    <?php 
                                    // } else {
                                    ?>
                                    <div class="col-6">
                                        <a href="family-report"><button class="btn btn-info" type="button" name="submit">Back</button></a>
                                    </div>
                                    <?php
                                    // }
                                    ?>
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
    <script src="assets/js/plugins/chartjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        $("#disabledCertificateDiv").hide();
        $("input[name=disabled_handicap]").on('click', function(){
            if($(this).val() == "1"){
                $("#disabledCertificateDiv").show();
                $("#disabledCertificateDiv div input").attr('required','required');
            } else {
                $("#disabledCertificateDiv").hide();
                $("#disabledCertificateDiv div input").removeAttr('required','required');
            }
        })
        
        function isInputNumberMobile(evt) {
    
            var ch = String.fromCharCode(evt.which);

            if (!(/[0-9]/.test(ch))) {
                evt.preventDefault();
                if (!$('#mobileNo').val().match('[0-9]{10}')) {
                    // alert("Enter Valid Mobile Number...");

                    return;
                }
            }

        }
        
         function isInputNumberAadhar(evt) {
    
            var ch = String.fromCharCode(evt.which);

            if (!(/[0-9]/.test(ch))) {
                evt.preventDefault();
                if (!$('#aadhar_number').val().match('[0-9]{12}')) {
                    // alert("Enter Valid Mobile Number...");

                    return;
                }
            }

        }
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