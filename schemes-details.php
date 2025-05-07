<?php 
include('include/con.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <title>
        Schemes Details
    </title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.8" rel="stylesheet" />

    <style>
        #btn1 {
            margin-top: 55%
        }

        @media screen and (max-width: 600px) {
            #btn1 {
                margin-top: 1%
            }
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <?php
        include('include/side-navbar.php');
        ?>
    <main class="main-content position-relative border-radius-lg ">


        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">

                        <div class="card-header pb-0">
                            <?php
                            if(isset($_GET['familyId'])){
                                $familyId = $_GET['familyId'];;
                            ?>
                            <h4 class="card-title"> योजनांचा लाभ -
                            <?php 
                            $q = mysqli_query($con, "SELECT name, memberId FROM familyDetails WHERE familyId = '$familyId' ORDER BY sr_no ASC LIMIT 1");
                            $r = mysqli_fetch_assoc($q);
                            echo $r['name'];
                            $memberId = $r['memberId'];
                            ?>
                            </h4>
                            <?php 
                            } else {
                                
                            ?>
                            <h4 class="card-title">योजनांचा लाभ </h4>
                            <?php
                            }
                            ?>
                            <!--<h4 class="card-title">Schemes Detail</h4>-->
                        </div>
                        
                        <?php 
                        $q = mysqli_query($con, "SELECT * FROM schemesDetails WHERE memberId = '$memberId'");
                        $r = mysqli_fetch_assoc($q);
                        
                        if($r['gharkul']  != ""){
                            if($r['gharkul'] == 1){
                                $script .= '$("#gharkulYes").click();';
                            } else {
                                $script .= '$("#gharkulNo").click();';
                            }
                        }
                        
                        if($r['appledForPO'] != ""){
                            if($r['appledForPO'] == 1){
                                $script .= '$("#appledForPOYes").click();';
                            } else {
                                $script .= '$("#appledForPONo").click();';
                            }
                        }
                        
                        if($r['needGharkul']  != ""){
                            if($r['needGharkul'] == 1){
                                $script .= '$("#needGharkulYes").click();';
                            } else {
                                $script .= '$("#needGharkulNo").click();';
                            }
                        }
                        
                        if($r['gharkulHouse'] != ""){
                            if($r['gharkulHouse'] == 1){
                                $script .= '$("#gharkulHouseYes").click();';
                            } else {
                                $script .= '$("#gharkulHouseNo").click();';
                            }
                        }
                        
                        if($r['pmKisan'] != ""){
                            if($r['pmKisan'] == 1){
                                $script .= '$("#pmKisanYes").click();';
                            } else {
                                $script .= '$("#pmKisanNo").click();';
                            }
                        }
                        
                        if($r['sanjayGandhiNiradhar'] != ""){
                            if($r['sanjayGandhiNiradhar'] == 1){
                                $script .= '$("#sanjayGandhiNiradharYes").click();';
                            } else {
                                $script .= '$("#sanjayGandhiNiradharNo").click();';
                            }
                        }
                        
                        if($r['jandhanBank'] != ""){
                            if($r['jandhanBank'] == 1){
                                $script .= '$("#jandhanBankYes").click();';
                            } else {
                                $script .= '$("#jandhanBankNo").click();';
                            }
                        }
                        ?>
                        <div class="card-body p-3">
                            <form action="schemes-details-db" method="POST">
                                <input type="hidden" value="<?php echo $_GET['familyId'] ?>" name="familyId">
                                <input type="hidden" value="<?php echo $memberId ?>" name="memberId">
                                <div class="row">
                                    <!-- Head of family  -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">प्रकल्प कार्यालयाचे लाभार्थी
                                                आहात काय? </label><br>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="appledForPO"
                                                            value="1" id="appledForPOYes" onchange="yes()">
                                                        <label class="form-control-label"
                                                            for="appledForPOYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="appledForPO"
                                                            value="0" id="appledForPONo" onchange="no()">
                                                        <label class="form-control-label" for="appledForPONo">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>घरकुल योजनेचा लाभ घेतला का ?</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="gharkul" id="gharkulYes" value="1">
                                                    <label class="form-control-label" for="gharkulYes">होय</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" name="gharkul" id="gharkulNo" class="form-check-input" value="0">
                                                    <label class="form-control-label" for="gharkulNo">नाही</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>पीएम किसान योजनेचा लाभ घेतला का ?</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="pmKisan" id="pmKisanYes" value="1">
                                                    <label class="form-control-label" for="pmKisanYes">होय</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" name="pmKisan" id="pmKisanNo" class="form-check-input" value="0">
                                                    <label class="form-control-label" for="pmKisanNo">नाही</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6">
                                        <label>संजय गांधी निराधार योजनेचा लाभ घेतला का ?</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="sanjayGandhiNiradhar" id="sanjayGandhiNiradharYes" value="1">
                                                    <label class="form-control-label" for="sanjayGandhiNiradharYes">होय</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" name="sanjayGandhiNiradhar" id="sanjayGandhiNiradharNo" class="form-check-input" value="0">
                                                    <label class="form-control-label" for="sanjayGandhiNiradharNo">नाही</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>जन-धन योजनेचा लाभ घेतला का ?</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="jandhanBank" id="jandhanBankYes" value="1">
                                                    <label class="form-control-label" for="jandhanBankYes">होय</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" name="jandhanBank" id="jandhanBankNo" class="form-check-input" value="0">
                                                    <label class="form-control-label" for="jandhanBankNo">नाही</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6" style="display:none" id="needGharkulDiv">
                                        <label>घरकुल पाहिजे आहे का ?</label>
                                        <!--<input type="text" name="shg" class="form-control">-->

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="needGharkul" id="needGharkulYes" value="1">
                                                    <label class="form-control-label" for="needGharkulYes">होय</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" name="needGharkul" id="needGharkulNo" class="form-check-input" value="0">
                                                    <label class="form-control-label" for="needGharkulNo">नाही</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6" style="display:none" id="gharkulHouseDiv">
                                        <label>घरकुल अंतर्गत घर बांधले आहे का ?</label>
                                        <!--<input type="text" name="shg" class="form-control">-->

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="gharkulHouse" id="gharkulHouseYes" value="1">
                                                    <label class="form-control-label" for="gharkulHouseYes">होय</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" name="gharkulHouse" id="gharkulHouseNo" class="form-check-input" value="0">
                                                    <label class="form-control-label" for="gharkulHouseNo">नाही</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6" style="display:none" id="reasonDiv">
                                        <!--<label class="form-control-label" for="headName">व्यवसाय</label>-->
                                        <select class="form-select" id="reason" name="reason">
                                            <option selected disabled value="">-- निवडा --</option>
                                            <option <?php if($r['reason'] == "स्वतःची जागा नसल्यामुळे बांधले नाही"){ echo "selected"; } ?> value="स्वतःची जागा नसल्यामुळे बांधले नाही">स्वतःची जागा नसल्यामुळे बांधले नाही</option>
                                            <option <?php if($r['reason'] == "इतर कारणाने बांधले नाही"){ echo "selected"; } ?> value="इतर कारणाने बांधले नाही">इतर कारणाने बांधले नाही</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 reson" style="display:none;" id="list">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="form-control-label" for="schemeName1">लाभ घेतलेल्या
                                                        योजना निवडा</label>
                                                    <div class="row">
                                                        <?php 
                                                        $schemeNameArray = array(
                                                            'मिर्ची कांडप',
                                                            'आटा चक्की',
                                                            'ऑटोरिक्षा',
                                                            'दालमिल',
                                                            'शेळीपालन 2020-21',
                                                            'शेळीपालन 2021-22',
                                                            'कुकुटपालन 2019-20',
                                                            'कुकुटपाल 2020-21',
                                                            'कुकुटपाल 2021-22'
                                                            );
                                                            
                                                        $i = 1;
                                                        foreach ($schemeNameArray as $schemeName){
                                                        ?>
                                                        <div class="col-md-6">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="schemeName<?php echo $i; ?>" value="<?php echo $schemeName ?>" name="schemeName[]" placeholder="">
                                                                <label for="schemeName<?php echo $i; ?>" class="form-control-label"><?php echo $schemeName ?> </label>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $i++;
                                                        }
                                                        ?>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="otherSchemeName" value="other" placeholder="">
                                                                <label for="otherSchemeName" class="form-control-label">इथर</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="otherScheme" style="display:none">
                                                <div class="row" >
                                                    <div class="col-9">
                                                        <label class="form-control-label" for="schemeName<?php echo $i ?>">योजना निवडा</label>
                                                        <input type="text" class="form-control" name="schemeName[]" id="schemeName<?php echo $i ?>">
                                                    </div>
                                                    
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-success" id="add" style="margin-top: 1.5rem;"> <span id="boot-icon" class="bi bi-plus-circle" style="font-size:1rem"></span></button> 
                                                    </div>
                                                </div>
    
                                                <div id="textboxDiv">
    
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" type="submit" name="submit">Submit</button>

                                            <a href="family-report.php"><button type="button" class="btn btn-primary">Back</button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </main>

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
        
        
        
        $("input[name=gharkul]").on('click', function () {
            if ($(this).val() == "0") {
                $("#needGharkulDiv").show();
                $("#gharkulHouseDiv").hide();
                $("#reasonDiv").hide();
            } else {
                $("#reasonDiv").hide();
                $("#gharkulHouseDiv").show();
                $("#needGharkulDiv").hide();
            }
        })
        
        $("input[name=gharkulHouse]").on('click', function () {
            if ($(this).val() == "0") {
                $("#reasonDiv").show();
            } else {
                $("#reasonDiv").hide();
            }
        })
        
        
        $("#disabledCertificateDiv").hide();
        $("input[name=disabled_handicap]").on('click', function () {
            if ($(this).val() == "1") {
                $("#disabledCertificateDiv").show();
            } else {
                $("#disabledCertificateDiv").hide();
            }
        })
        
        $("#otherSchemeName").on('click', function(){
            console.log($(this).val());
            $("#otherScheme").toggle();
            // $("#otherScheme div div input").att('required', 'required');
        })

        var count = 2;
        $("#add").on("click", function on() {
            $("#textboxDiv").append('<div class="row"><div class="col-9"><label class="form-control-label" for="schemeName' + count + '">Scheme Name</label><input type="text" class="form-control"id="schemeName' + count + '" name="schemeName[]" placeholder=""> </div><div class="col-2"><button type="button" class="btn btn-danger" id="remove" style="margin-top: 1.5rem;"> <span id="boot-icon" class="bi bi-dash-circle" style="font-size:1rem"></span></button> </div> </div>');
            count = count + 1;
            if (count > 1) {
                $("#remove").show();
            }
        });

        $("#remove").on("click", function () {
            $("#textboxDiv").children().last().remove();
            count = count - 1;
            if (count == 1) {
                $("#remove").hide();
            }
        });
        
        <?php 
        echo $script;
        ?>
        
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
    <script>
        function yes() {
            document.getElementById("list").style.display = 'block';
        }
        function no() {
            document.getElementById("list").style.display = 'none';
        }
    </script>
    
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