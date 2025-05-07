<?php 
session_start();
include('include/con.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Beda Details
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
                            <h4 class="card-title">बेडा ची सविस्तर महिती भरा</h4>
                        </div>
                        <div class="card-body p-3">
                            <form action="beda-details-db" method="post">
                                <input type="hidden" value="<?php echo $familyId ?>" name="familyId">
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="aadharNo">तालुका निवडा</label>
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
                                            <label class="form-control-label" for="name">बेडा निवडा</label>
                                            <!--<input type="text" class="form-control" id="name" name="name">-->
                                            <select name="name" class="form-control"  id="name" required>
                                                <option value="" selected disabled>-- बेडा निवडा --</option>
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

                                    <!--<div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="caste">Village</label>
                                            <input type="text" class="form-control" id="" name="village">
                                        </div>
                                    </div>-->

                                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="incomeNo">जिल्हा</label>
                                            <input type="text" class="form-control" value="Nanded" required id="district" name="district">
                                        </div>
                                    </div>

                                    <!--<div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="education">Gut Gram Panchayat</label>
                                            <input type="text" class="form-control" id="gutGramPanchayat" name="gutGramPanchayat">
                                        </div>
                                    </div>-->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rationNo">पाण्याची टाकी?</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="waterTankYes"
                                                            value="1" name="waterTank">
                                                        <label class="form-control-label" for="waterTankYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="waterTankNo"
                                                            value="0" name="waterTank">
                                                        <label class="form-control-label" for="waterTankNo">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rationNo">नळ कनेक्शन??</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="tapSupplyYes"
                                                            value="1" name="tapSupply">
                                                        <label class="form-control-label" for="tapSupplyYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="tapSupplyNo"
                                                            value="0" name="tapSupply">
                                                        <label class="form-control-label" for="tapSupplyNo">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rationNo">वीज कनेक्शन?</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="electricityConnectionYes"
                                                            value="1" name="electricityConnection">
                                                        <label class="form-control-label"
                                                            for="electricityConnectionYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="electricityConnectionNo"
                                                            value="0" name="electricityConnection">
                                                        <label class="form-control-label" for="electricityConnectionNo">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rationNo">पक्का  रस्ता?</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="constructedRoadYes"
                                                            value="1" name="constructedRoad">
                                                        <label class="form-control-label" for="constructedRoadYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="constructedRoadYes"
                                                            value="0" name="constructedRoad">
                                                        <label class="form-control-label" for="constructedRoadYes">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="dob">अधिकची माहिती (ऐच्छिक)</label>
                                            <input type="text" class="form-control" id="" name="remark">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-success" type="submit" name="submit">Submit</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="beda-report"><button class="btn btn-info" type="button" name="submit">Back</button></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
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
                $("#otherBeda").html('<input type="text"  class="form-control mt-3" required  name="name">')
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