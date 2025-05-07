<?php 
include("include/con.php");
// include("include/sweetAlert.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <title>
        Lively Details
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
                        <?php
                        $memberId = $_GET['memberId'];
                        $q = mysqli_query($con, "SELECT * FROM familyDetails WHERE memberId = '$memberId'");
                        $r = mysqli_fetch_assoc($q);
                        $bday = $r['dob'];
                        $name = $r['name'];
                        if(empty($r['familyHead'])){
                            $familyHead = true;
                        }
                        
                        $q = mysqli_query($con, "SELECT * FROM livelihood WHERE memberId = '$memberId'");
                        $r = mysqli_fetch_assoc($q);
                        if($r['occupationType'] == "शेतकरी"){
                            if($r['ownedLand'] == 1){
                                $script .= '$("#ownedYes").click();';
                            } else {
                                $script .= '$("#ownedNo").click();';
                            }
                        } else if($r['occupationType'] == "पाळीव प्राणी"){
                            if($r['shade'] == 1){
                                $script .= '$("#shadeYes").click();';
                            } else {
                                $script .= '$("#shadeNo").click();';
                            }
                        } else if($r['occupationType'] == "नोकरी"){
                            $script .= '$("#pr_gov'.$r['private_government'].'").click();';
                        }
                        
                        if(!empty($r['gharkul'])){
                            if($r['gharkul'] == 1){
                                $script .= '$("#gharkulYes").click();';
                            } else {
                                $script .= '$("#gharkulNo").click();';
                            }
                        }
                        
                        if(!empty($r['shg'])){
                            if($r['shg'] == 1){
                                $script .= '$("#shgYes").click();';
                            } else {
                                $script .= '$("#shgNo").click();';
                            }
                        }
                        
                        ?>
                        <div class="card-header pb-0">
                            <h4 class="card-title">राहणीमान -
                                <?php echo $name ?>
                            </h4>
                        </div>
                        <div class="card-body p-3">
                            <form action="livelyhood_details_db.php" method="POST">
                                <input type="hidden" value="<?php echo $_GET['familyId'] ?>" name="familyId">
                                <input type="hidden" name="memberId" value="<?php echo $memberId ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group dropdown">
                                            <label class="form-control-label" for="headName">व्यवसाय <span style="color:red">*</span></label>
                                            <select class="form-select" id="type" onchange="choose()" required name="occupation">
                                                <option selected disabled value="">-- व्यवसाय निवडा --</option>
                                                <option value="शेतकरी">शेतकरी</option>
                                                <option value="पाळीव प्राणी">पाळीव प्राणी</option>
                                                <option value="नोकरी">नोकरी</option>
                                                <option value="धंदा">धंदा</option>
                                                <option value="बेरोजगार">बेरोजगार</option>
                                                <option value="इतर">इतर</option>
                                            </select>
                                            <div id="otherOccupation">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6" id="owned_land" style="display:none">
                                        <label>स्वतःची जागा आहे का?</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" id="ownedYes" class="form-check-input" name="owned" value="1" onchange="yes()">होय
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" id="ownedNo" name="owned" class="form-check-input" value="0" onchange="no1()">नाही
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6" style="display:none" id="area">
                                        <label>क्षेत्रफळ</label>
                                        <input type="text" name="area" value="<?php echo $r['landArea'] ?>" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-6" style="display:none" id="crops_type">
                                        <label>पिकाचा / धान्याचा प्रकार</label>
                                        <input type="text" name="crops" value="<?php echo $r['cropsType'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6" style="display:none" id="income1">
                                        <label>मिळकत (रु.)</label>
                                        <input type="text" name="income1" value="<?php echo $r['income'] ?>" class="form-control">
                                    </div>

                                    <div class="col-md-6" style="display:none" id="an_type">
                                        <label>प्राणी?</label>
                                        <input type="text" name="animal_type" value="<?php echo $r['animalType'] ?>" class="form-control">
                                    </div>

                                    <div class="col-md-6" style="display:none" id="count1">
                                        <label>पाळीव प्राण्यांची संख्या</label>
                                        <input type="text" name="animal_count" value="<?php echo $r['animalCount'] ?>" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-6" style="display:none" id="shade1">
                                        <label>प्राण्यांसाठी शेड आहे का?</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" name="shade" id="shadeYes" class="form-check-input" value="1">होय
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" name="shade" id="shadeNo" class="form-check-input" value="0">नाही
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6" style="display:none" id="income4">
                                        <label>मिळकत (रु.)</label>
                                        <input type="text" name="income2" value="<?php echo $r['income'] ?>" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-6" style="display:none" id="p_g">
                                        <label>खाजगी नोकरी</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="pr_govPrivate" name="pr_gov" value="Private"> खाजगी नोकरी
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" name="pr_gov" id="pr_govGovernment" class="form-check-input" value="Government"> शासकीय
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="display: none" id="income5">
                                        <label>मिळकत (रु.)</label>
                                        <input type="text" name="income3" value="<?php echo $r['income'] ?>" class="form-control">
                                    </div>

                                    <div class="col-md-6" style="display: none" id="business_t">
                                        <label>व्यवसायाचा प्रकार</label>
                                        <input type="text" name="business_type" value="<?php echo $r['businessType'] ?>" class="form-control">
                                    </div>

                                    <div class="col-md-6" style="display: none" id="income6">
                                        <label>मिळकत (रु.)</label>
                                        <input type="text" name="income4" value="<?php echo $r['income'] ?>"  class="form-control">
                                    </div>


                                    <div class="col-md-6">
                                        <label>बचत गटाचे सदस्य आहात काय?</label>
                                        <!--<input type="text" name="shg" class="form-control">-->

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="shgYes" name="shg" value="1">
                                                    होय
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" name="shg" class="form-check-input" id="shgNo" value="0">
                                                    नाही
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    if($familyHead == true){
                                    ?>
                                    <div class="col-md-6">
                                        <label>घरकुल आहे का ?</label>
                                        <!--<input type="text" name="shg" class="form-control">-->

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
                                                    <label class="form-control-label" for="gharkulNo">होय</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    

                                    <div class="col-md-6" style="" id="">
                                        <label>Remark</label>
                                        <input type="text" name="remark" value="<?php echo $r['remark'] ?>" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-success" type="submit" name="submit">Submit</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="family-report"><button class="btn btn-info" type="button" name="submit">Back</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include('include/footer.php');
            ?>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/js/plugins/chartjs.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>

        function choose() {
            var type = document.getElementById("type").value;

            if (type == 'शेतकरी') {
                document.getElementById("owned_land").style.display = 'block';

                document.getElementById("an_type").style.display = 'none';

                document.getElementById("count1").style.display = 'none';
                document.getElementById("shade1").style.display = 'none';
                document.getElementById("income4").style.display = 'none';
                document.getElementById("p_g").style.display = 'none';
                document.getElementById("income5").style.display = 'none';

                document.getElementById("business_t").style.display = 'none';
                document.getElementById("income6").style.display = 'none';
                // document.getElementById("shg1").style.display='none';
                document.getElementById('otherOccupation').innerHTML = '';
            }
            else if (type == 'पाळीव प्राणी') {
                document.getElementById("an_type").style.display = 'block';

                document.getElementById("count1").style.display = 'block';
                document.getElementById("shade1").style.display = 'block';
                document.getElementById("income4").style.display = 'block';

                document.getElementById("owned_land").style.display = 'none';

                document.getElementById("area").style.display = 'none';
                document.getElementById("crops_type").style.display = 'none';
                document.getElementById("income1").style.display = 'none';
                document.getElementById("p_g").style.display = 'none';
                document.getElementById("income5").style.display = 'none';

                document.getElementById("business_t").style.display = 'none';
                document.getElementById("income6").style.display = 'none';
                document.getElementById('otherOccupation').innerHTML = '';

                // document.getElementById("shg1").style.display='none';
            }
            else if (type == 'नोकरी') {
                document.getElementById("p_g").style.display = 'block';
                document.getElementById("income5").style.display = 'block';

                document.getElementById("an_type").style.display = 'none';

                document.getElementById("count1").style.display = 'none';
                document.getElementById("shade1").style.display = 'none';
                document.getElementById("income4").style.display = 'none';
                document.getElementById("owned_land").style.display = 'none';
                document.getElementById("area").style.display = 'none';
                document.getElementById("crops_type").style.display = 'none';
                document.getElementById("income1").style.display = 'none';

                document.getElementById("business_t").style.display = 'none';
                document.getElementById("income6").style.display = 'none';

                // document.getElementById("shg1").style.display='none';
                document.getElementById('otherOccupation').innerHTML = '';
            }
            else if (type == 'धंदा') {
                //   document.getElementById("shg1").style.display='none';

                document.getElementById("business_t").style.display = 'block';
                document.getElementById("income6").style.display = 'block';

                document.getElementById("p_g").style.display = 'none';
                document.getElementById("income5").style.display = 'none';

                document.getElementById("an_type").style.display = 'none';

                document.getElementById("count1").style.display = 'none';
                document.getElementById("shade1").style.display = 'none';
                document.getElementById("income4").style.display = 'none';
                document.getElementById("owned_land").style.display = 'none';
                document.getElementById("area").style.display = 'none';
                document.getElementById("crops_type").style.display = 'none';
                document.getElementById("income1").style.display = 'none';
                document.getElementById('otherOccupation').innerHTML = '';
            }
            else if (type == 'बेरोजगार') {
                // document.getElementById("shg1").style.display='block';

                document.getElementById("business_t").style.display = 'none';
                document.getElementById("income6").style.display = 'none';

                document.getElementById("p_g").style.display = 'none';
                document.getElementById("income5").style.display = 'none';

                document.getElementById("an_type").style.display = 'none';

                document.getElementById("count1").style.display = 'none';
                document.getElementById("shade1").style.display = 'none';
                document.getElementById("income4").style.display = 'none';
                document.getElementById("owned_land").style.display = 'none';
                document.getElementById("area").style.display = 'none';
                document.getElementById("crops_type").style.display = 'none';
                document.getElementById("income1").style.display = 'none';
                document.getElementById('otherOccupation').innerHTML = '';
                document.getElementById('otherOccupation').innerHTML = '';
            } else if (type == 'इतर') {
                document.getElementById('otherOccupation').innerHTML = '<input type="text" requred class="form-control mt-3"  name="occupation">';
                document.getElementById("business_t").style.display = 'none';
                document.getElementById("income6").style.display = 'none';

                document.getElementById("p_g").style.display = 'none';
                document.getElementById("income5").style.display = 'none';

                document.getElementById("an_type").style.display = 'none';

                document.getElementById("count1").style.display = 'none';
                document.getElementById("shade1").style.display = 'none';
                document.getElementById("income4").style.display = 'none';
                document.getElementById("owned_land").style.display = 'none';
                document.getElementById("area").style.display = 'none';
                document.getElementById("crops_type").style.display = 'none';
                document.getElementById("income1").style.display = 'none';
            }
            else {
                //   document.getElementById("shg1").style.display='none';
                document.getElementById('otherOccupation').innerHTML = '';

                document.getElementById("business_t").style.display = 'none';
                document.getElementById("income6").style.display = 'none';

                document.getElementById("p_g").style.display = 'none';
                document.getElementById("income5").style.display = 'none';

                document.getElementById("an_type").style.display = 'none';

                document.getElementById("count1").style.display = 'none';
                document.getElementById("shade1").style.display = 'none';
                document.getElementById("income4").style.display = 'none';
                document.getElementById("owned_land").style.display = 'none';
                document.getElementById("area").style.display = 'none';
                document.getElementById("crops_type").style.display = 'none';
                document.getElementById("income1").style.display = 'none';
            }

        }
        function yes() {

            var if_yes = document.getElementById("ownedYes").value;
            if (if_yes == '1') {
                document.getElementById("area").style.display = 'block';
                document.getElementById("crops_type").style.display = 'block';
                document.getElementById("income1").style.display = 'block';
            }
            else {

            }

        }
        function no1() {

            document.getElementById("area").style.display = 'none';
            document.getElementById("crops_type").style.display = 'none';
            document.getElementById("income1").style.display = 'none';
        }
        <?php 
        if(!empty($r['occupationType'])){
        ?>
        $('#type option[value="<?php echo $r['occupationType'] ?>"]').prop('selected', 'selected');
        choose();
        <?php
            echo $script;
        }
        ?>
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