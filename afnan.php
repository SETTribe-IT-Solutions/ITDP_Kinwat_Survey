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
                            <form action="family-details-db" method="post">
                                <input type="hidden" value="<?php echo $beda ?>" name="beda">
                                <input type="hidden" value="<?php echo $taluka ?>" name="taluka">
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">आडनाव <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" required="" id="lastName" name="lastName">
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">नाव <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" required="" id="firstName" name="firstName">
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name"> वडिलांचे / पतीचे नाव <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" required="" id="middleName" name="middleName">
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="caste">जात <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" required="" id="caste" name="caste">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="gender">लिंग <span style="color:red">*</span></label>
                                            <select name="gender" class="form-control" required id="gender">
                                                <option value="" selected="" disabled="">-- लिंग निवडा --</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="dob">जन्म दिनांक <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <select name="date"  class="form-control" required id="date">
                                                        <option selected="" disabled="" value="">-- तारीख निवडा --</option>
                                                        <?php 
                                                        for($i = 1; $i<=31; $i++){
                                                        ?>
                                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-4">
                                                    <select name="month" class="form-control" required id="month">
                                                        <option selected="" disabled="" value="">-- महिना निवडा --</option>
                                                        <?php 
                                                        $months = [
                                                        'January',
                                                        'February',
                                                        'March',
                                                        'April',
                                                        'May',
                                                        'June',
                                                        'July',
                                                        'August',
                                                        'September',
                                                        'October',
                                                        'November',
                                                        'December'
                                                        ];
                                                        $i = 1;
                                                        foreach ($months as $month){
                                                        ?>
                                                        <option value="<?php echo $i ?>"><?php echo $month ?></option>
                                                        <?php
                                                            $i++;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-4">
                                                    <select name="year" class="form-control" required id="year">
                                                        <option selected="" disabled="" value="">-- वर्ष निवडा --</option>
                                                        <?php 
                                                        for($i = date('Y'); $i>=1900; $i--){
                                                            if($i == date("Y")){
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                        ?>
                                                        <option value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="mobileNo">मोबाईल क्र .</label>
                                            <input type="tel"  class="form-control" id="mobileNo" onkeypress="isInputNumberMobile(event)" maxlength="10" minlength="10" name="mobileNo">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="localVillage">हल्ली मुक्काम <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="localVillage" required="" name="localVillage">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="permanentVillage">मुळ गाव <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="permanentVillage" required="" name="permanentVillage">
                                        </div>
                                    </div>
                                    
                                    <?php
                                    if(!isset($_GET['familyId'])){
                                    ?>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">कुटुंबप्रमुख <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="familyHead" value="1" id="familyHeadYes">
                                                        <label class="form-control-label" for="familyHeadYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="familyHead" value="0" id="familyHeadNo">
                                                        <label class="form-control-label" for="familyHeadNo">नाही</label>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    }
                                    
                                    $questionIds = array();
                                    $q = mysqli_query($con, "SELECT * FROM questionsMaster WHERE type = 'yes_no'");
                                    while($r = mysqli_fetch_assoc($q)){
                                        $id = $r['id'];
                                        $question = $r['question'];
                                        array_push($questionIds, $id);
                                    ?>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><?php echo $question ?> <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="questionId<?php echo $id ?>" value="1" id="questionIdYes<?php echo $id ?>">
                                                        <label class="form-control-label" for="questionIdYes<?php echo $id ?>">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="questionId<?php echo $id ?>" value="0" id="questionIdNo<?php echo $id ?>">
                                                        <label class="form-control-label" for="questionIdNo<?php echo $id ?>">नाही</label>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    }
                                    
                                    $_SESSION['questionIds'] = $questionIds;
                                    ?>
                                </div>
                                
                                <hr class="horizontal dark my-3">
                                
                                <?php 
                                if(isset($_GET['familyId']) && !empty($_GET['familyId'])){
                                    
                                    $q = mysqli_query($con, "SELECT * FROM `familyDetails` WHERE familyId = '{$_GET['familyId']}'");
                                    $r = mysqli_fetch_assoc($q);
                                    $_GET['taluka'] = $r['taluka'];
                                    $_GET['beda'] = $r['beda'];
                                ?>
                                <input type="hidden" value="<?php echo $_GET['familyId'] ?>" name="familyId">
                                <?php
                                }
                                ?>
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
                                                <option value="<?php echo $r['taluka'] ?>" <?php echo ($_GET['taluka'] == $r['taluka']) ? 'selected' : ''; ?>><?php echo $r['taluka'] ?></option>
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
                                                if($_GET['beda']) {
                                                    $q = mysqli_query($con, "SELECT beda FROM master WHERE taluka = '{$_GET['taluka']}'");
                                                    while($r = mysqli_fetch_assoc($q)){
                                                ?>
                                                <option value="<?php echo $r['beda'] ?>" <?php echo ($_GET['beda'] == $r['beda']) ? 'selected' : ''; ?>><?php echo $r['beda'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            
                                            <div id="otherBeda">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-success" type="submit" name="submit">Submit</button>
                                    </div>
                                    <?php 
                                    if(isset($_GET['member'])){
                                    ?>
                                    <div class="col-6">
                                        <a href="family-report"><button class="btn btn-info" type="button" name="submit">Back</button></a>
                                    </div>
                                    <?php 
                                    } else {
                                    ?>
                                    <div class="col-6">
                                        <a href="beda-select"><button class="btn btn-info" type="button" name="submit">Back</button></a>
                                    </div>
                                    <?php
                                    }
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