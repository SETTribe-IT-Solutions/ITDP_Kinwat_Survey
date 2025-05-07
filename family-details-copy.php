<?php 
session_start();
if(isset($_GET['familyId'])){
    $familyId = $_GET['familyId'];
} else {
    $familyId = uniqid();    
    $beda = $_GET['beda'];
    // $q = mysqli_query($con, "SELECT count(*) as 'count' FROM familyDetails WHERE beda = '$beda'");
    // $r = mysqli_fetch_assoc($q);
    // $familyId = $beda."_".$r['count']+1;
}
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
                            <h4 class="card-title">
                            <?php 
                            $q = mysqli_query($con, "SELECT name, beda, lastName FROM familyDetails WHERE familyId = '$familyId' ORDER BY sr_no ASC LIMIT 1");
                            $r = mysqli_fetch_assoc($q);
                            echo $r['name'];
                            $beda = $r['beda'];
                            $lastName = $r['lastName'];
                            ?>
                            परिवार जोडा
                            </h4>
                            <?php 
                            } else {
                                
                            ?>
                            <h4 class="card-title">परिवार जोडा </h4>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="card-body p-3">
                            <form action="family-details-db<?php echo $member ?>" method="post">
                                <input type="hidden" value="<?php echo $familyId ?>" name="familyId">
                                <input type="hidden" value="<?php echo $beda ?>" name="beda">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">आडनाव <span style="color:red">*</span></label>
                                            <!--<input type="text" class="form-control" required="" id="name" name="name">-->
                                             <select required name="lastName" class="form-control form-select"  id="lastName">
                                                <option value="" selected="" disabled="">-- आडनाव निवडा --</option>
                                                <?php
                                                $q = mysqli_query($con, "SELECT  surname FROM surnames");
                                                while($r = mysqli_fetch_assoc($q)){
                                                    if($lastName == $r['surname']){
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $r['surname'] ?>"><?php echo $r['surname'] ?></option>
                                                <?php
                                                }
                                                ?>
                                                <option value="इतर">इतर</option>
                                            </select>
                                            
                                            <div id="lastNameTextBox"></div>
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            
                                            <label class="form-control-label" for="name">नाव <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" required="" id="firstName" name="firstName">
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           

                                            <label class="form-control-label" for="name"> वडिलांचे / पतीचे नाव <span style="color:red">*</span></label>
                                            
                                            <input type="text" class="form-control" required="" id="middleName" name="middleName">
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="caste">जात <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" required="" id="caste" name="caste">
                                            <!--<div class="form-group">
                                                <input type="checkbox" id="sameCaste" value="<?php echo $result['caste'] ?>">
                                                <label class="form-control-label" for="sameCaste">Same of Head of house</label>
                                            </div>-->
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="aadharNo">आधार क्र. <span style="color:red">*</span></label>
                                            <input type="tel" class="form-control" required="" id="aadharNo" maxlength="12" minlength="12" onkeypress="isInputNumberAadhar(event)" name="aadharNo">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="incomeNo">इनकम सर्टिफिकेट क्र.</label>
                                            <input type="text" class="form-control" id="incomeNo" name="incomeNo">
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    if(!isset($_GET['member'])){
                                    ?>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rationNo">राशन कार्ड क्र. </label>
                                            <input type="text" class="form-control" id="rationNo" name="rationNo">
                                        </div>
                                    </div>
                                    
                                    <?php
                                    }
                                    ?>
                                    
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
                                            <!--<input type="text" class="form-control js-datepicker-dob" readonly id="dob" required="" name="dob">-->
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
                                                    <select name="date" class="form-control" required id="date">
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
                                                    <select name="date" class="form-control" required id="date">
                                                        <option selected="" disabled="" value="">-- वर्ष निवडा --</option>
                                                        <?php 
                                                        for($i = date('Y'); $i>=1900; $i--){
                                                            if($i == "2022"){
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
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">अपंग? <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="disabled_handicap" value="1" id="disabledYes">
                                                        <label class="form-control-label" for="disabledYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="disabled_handicap" value="0" id="disabledNo">
                                                        <label class="form-control-label" for="disabledNo">नाही</label>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">जात प्रमाणपत्र? <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="casteCertificate" value="1" id="casteCertificateYes">
                                                        <label class="form-control-label" for="casteCertificateYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="casteCertificate" value="0" id="casteCertificateNo">
                                                        <label class="form-control-label" for="casteCertificateNo">नाही</label>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6" id="disabledCertificateDiv">
                                        <div class="form-group">
                                            <label class="form-control-label" for="disabledCertificate">अपंग सर्टिफिकेट क्र. </label>
                                            <input type="text" class="form-control" id="disabledCertificate" name="disabledCertificate">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">जनआरोग्य नोंदणी आहे का? <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="janAarogya" value="1" id="janAarogyaYes">
                                                        <label class="form-control-label" for="janAarogyaYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="janAarogya" value="0" id="janAarogyaNo">
                                                        <label class="form-control-label" for="janAarogyaNo">नाही</label>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    if(!isset($_GET['member'])){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">निराधार? <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="niradhar" value="1" id="niradharYes">
                                                        <label class="form-control-label" for="niradharYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="niradhar" value="0" id="niradharNo">
                                                        <label class="form-control-label" for="niradharNo">नाही</label>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
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
            toastMsg('error', $msg);
        } else {
            toastMsg('success', $msg);
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