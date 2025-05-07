<?php 
session_start();
if(isset($_GET['familyId'])){
    $familyId = $_GET['familyId'];
} else {   
    $beda = $_GET['beda'];
    $taluka = $_GET['taluka'];
}
$beda = $_GET['beda'];
$taluka = $_GET['taluka'];
include('include/con.php');

if(isset($_POST['submit'])) {
    
    require_once('include/sweetAlert.php');
    $familyId = $_POST['familyId'];
    $memeberId = $_POST['memberId'];
    
    $q = mysqli_query($con, "UPDATE familyDetails SET familyId = '$familyId' WHERE memberId = '$memeberId'");
    
    // Msg
    if($q){
        $status = true;
        $msg = "Allocated To Family.";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: allocateFamily?memberId='.$memeberId);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    
    <style>
        hr.horizontal {
            background-color: #000000;
        }
    </style>
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
                            <h4 class="card-title">माहिती भरा</h4>
                        </div>
                        <div class="card-body p-3">
                            <form action="" method="post">                                
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6 class="form-control-label" for="memberId" style="">Name</h6>
                                            <?php 
                                            $memeberId = $_GET['memberId'];
                                            $q = mysqli_query($con, "SELECT * FROM familyDetails WHERE memberId = '$memeberId'");
                                            $r = mysqli_fetch_assoc($q);
                                            if($r['familyId'] !='' ){
                                                $familyId = $r['familyId'];    
                                            }
                                            
                                            ?>
                                            <input type="text" class="form-control" readonly="" value="<?php echo $r['name'] ?>">
                                            <input type="hidden" class="form-control" name="memberId" value="<?php echo $memeberId ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6 class="form-control-label" for="familyId" style="">Select Family Head</h6>
                                            <!--<input type="text" class="form-control" id="" name="taluka">-->
                                            <select required name="familyId" class="form-control"  id="familyId">
                                                <option value="" selected="" disabled="">-- Family Head --</option>
                                                <?php
                                                $q = mysqli_query($con, "SELECT * FROM familyDetails WHERE familyHead = 1");
                                                while($r = mysqli_fetch_assoc($q)){
                                                ?>
                                                <option value="<?php echo $r['familyId'] ?>" <?php echo ($familyId == $r['familyId'])? 'selected': ''; ?>><?php echo $r['name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-success" type="submit" name="submit">Submit</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="beda-select"><button class="btn btn-info" type="button" name="submit">Back</button></a>
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
    <script src="assets/js/plugins/chartjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        /*flatpickr(".js-datepicker-dob", {
            dateFormat: "d/m/Y",
            maxDate: "today"
        });*/
        $('.js-datepicker-dob').datepicker({
            uiLibrary: 'bootstrap',
            dateFormat: 'dd/mm/yy' ,
            maxDate: new Date('<?php echo date('m/d/Y') ?>')
        });
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
        
        $("#lastName").on('change', function(){
            if($(this).val() == "इतर"){
                $("#lastNameTextBox").html('<br><input type="text" class="form-control" required="" id="" name="lastName">')
            } else {
                $("#lastNameTextBox").html('')
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
            sweetAlertMsg('error', $msg);
        } else {
            sweetAlertMsg('success', $msg);
        }
        unset($_SESSION['status']);
        unset($_SESSION['msg']);
    }
    if(isset($_GET['familyId']) && !isset($_GET['member'])){
    ?>
    
    <script>
        addMember('<?php echo $familyId ?>', 'family-details');
    </script>
    <?php
    }
    ?>
</body>

</html>