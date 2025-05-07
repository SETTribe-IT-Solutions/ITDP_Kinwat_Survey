<?php 
include('include/con.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76"
            href="assets/img/apple-icon.png">
        <title>
            Education
        </title>

        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
            rel="stylesheet" />

        <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

        <script src="https://kit.fontawesome.com/42d5adcbca.js"
            crossorigin="anonymous"></script>
        <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

        <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.8"
            rel="stylesheet" />
            
            
    </head>
    <body class="g-sidenav-show bg-gray-100">
        <?php
        include('include/side-navbar.php');
        ?>
        <main class="main-content position-relative border-radius-lg ">


            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card z-index-2">
                           <?php
                            $memberId = $_GET['memberId'];
                            $q = mysqli_query($con, "SELECT * FROM familyDetails WHERE memberId = '$memberId'");
                            $r = mysqli_fetch_assoc($q);
                            $bday = $r['dob'];
                            $name = $r['name'];
                            ?>
                            <div class="card-header pb-0">
                                <h4 class="card-title">शिक्षण - <?php echo $name ?></h4>
                            </div>
                           
                            <div class="card-body p-3">
                                <form action="education-details_db" method="POST">
                                    <input type="hidden" value="<?php echo $_GET['familyId'] ?>" name="familyId">
                                    <input type="hidden" value="<?php echo $memberId ?>" name="memberId">
                                    <div class="row">
                                        <!-- Head of family  -->
                                        <?php
                                        $memberId = $_GET['memberId'];
                                        $query = mysqli_query($con, "SELECT * FROM familyDetails WHERE memberId = '$memberId'");
                                        $result = mysqli_fetch_assoc($query);
                                        $bday = $result['dob'];
                                        
                                        $dob = new DateTime($bday);
                                        $now = new DateTime();
                                        $diff = $now->diff($dob);
                                        $age = $diff->y;
                                        
                                        $q = mysqli_query($con, "SELECT * FROM educationDetails WHERE memberId = '$memberId'");
                                        $r = mysqli_fetch_assoc($q);
                                        
                                        $educationArray = array('Primary school', 'Secondary school', '10 Pass', '12 Pass', 'Degree', 'Illiterate', 'इतर');
                                        
                                        if($result['familyHead'] == "" || $age >18){
                                        ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="schoolType">शिक्षण <span style="color:red">*</span></label>
                                                <select name="education"  required class="form-control" id="education">
                                                    <option value="" selected disabled >-- शिक्षण निवडा --</option>
                                                    <?php
                                                    
                                                    foreach ($educationArray as $education){
                                                        if($education == $r['education']){
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $education ?>"><?php echo $education ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <div id="otherEducation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="degreeNameDiv" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-control-label" for="aadharNo">Degree name <span style="color:red">*</span> </label>
                                                <input type="text" class="form-control" value="<?php echo $r['degreeName'] ?>" id="incomeNo" name="degreeName" placeholder="degress name">
                                            </div>  
                                        </div>
                                        <?php 
                                        } else if($age <= 6 && $age >0){
                                            
                                            if($r['registerBalAargya'] != ""){
                                                if($r['registerBalAargya'] == 1){
                                                    $script .= '$("#registerBalAargyaYes").click();';
                                                } else {
                                                    $script .= '$("#registerBalAargyaNo").click();';
                                                }
                                            }
                                            
                                            if($r['wantToRegister'] != ""){
                                                if($r['wantToRegister'] == 1){
                                                    $script .= '$("#wantToRegisterYes").click();';
                                                } else {
                                                    $script .= '$("#wantToRegisterNo").click();';
                                                }
                                            }
                                            
                                            if($r['childcareCenter'] != ""){
                                                if($r['childcareCenter'] == 1){
                                                    $script .= '$("#childcareCenterYes").click();';
                                                } else {
                                                    $script .= '$("#childcareCenterNo").click();';
                                                }
                                            }
                                        ?>
                                        
                                        <!-- Age is 0 to 6 years -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="education">बाल आरोग्य नोंदणी आहे का?<span style="color:red">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check">  
                                                            <input type="radio" required="" name="registerBalAargya" id="registerBalAargyaYes" class="form-check-input" value="1" onclick="document.querySelector('.fiel').style.display = 'block';document.querySelector('#reg').style.display = 'none';" />
                                                            <label class="form-control-label"for="registerBalAargyaYes">होय</label>
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check"> 
                                                            <input type="radio" required="" name="registerBalAargya" id="registerBalAargyaNo" value="0" class="form-check-input" onclick="document.querySelector('.fiel').style.display = 'none';document.querySelector('#reg').style.display = 'block';" />
                                                            <label class="form-control-label" for="registerBalAargyaNo">नाही</label> 
                                                        </div>
                                                    </div>                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="reg" style="display:none">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name">नोंदणी करायची आहे का? <span style="color:red">*</span></label><br>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                        <input type="radio"  class="form-check-input"  name="wantToRegister" value="1" id="wantToRegisterYes" onclick="document.querySelector('.fieldes').style.display = 'none';document.querySelector('.fiel').style.display = 'block';">
                                                            <label class="form-control-label" for="wantToRegisterYes">होय</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="wantToRegister" value="0" id="wantToRegisterNo"onclick="document.querySelector('.fieldes').style.display = 'block';document.querySelector('.fiel').style.display = 'none';">
                                                            <label  class="form-control-label"  for="wantToRegisterNo">नाही</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                        
                                        <div class="col-md-6 fiel" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-control-label" for="aadharNo">अंगनवाडी निवडा <span style="color:red">*</span></label>
                                                <input type="text" class="form-control"id="incomeNo" name="anganwadiName" value="<?php echo $r['anganwadiName'] ?>" placeholder="">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name">बालसंस्कार केंद्रामध्ये जातो का ? <span style="color:red">*</span></label><br>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                        <input type="radio"  class="form-check-input"  name="childcareCenter" value="1" required id="childcareCenterYes">
                                                            <label class="form-control-label" for="childcareCenterYes">होय</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="childcareCenter" value="0" required id="childcareCenterNo">
                                                            <label  class="form-control-label"  for="childcareCenterNo">नाही</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        } else if($age > 6 && $age <=18){
                                            if($r['goToSchool'] != ''){
                                                if($r['childcareCenter'] == 1){
                                                    $script .= '$("#childcareCenterYes").click();';
                                                } else {
                                                    $script .= '$("#childcareCenterNo").click();';
                                                }
                                            }
                                        ?>
                                            
                                        <!-- Age is above 6 years -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="rationNo">शाळेत जातो / जाते का? <span style="color:red">*</span></label>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio"  class="form-check-input" required=""  name="goToSchool" value="1" id="goToSchoolYes" onclick="document.querySelector('.school').style.display = 'block';document.querySelector('.reson').style.display = 'none'; document.querySelector('#school1').style.display = 'block';">
                                                            <label class="form-control-label" for="goToSchoolYes">होय</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" required="" name="goToSchool" value="0" id="goToSchoolNo" onclick="document.querySelector('.school').style.display = 'none';document.querySelector('.reson').style.display = 'block';document.querySelector('#school').style.display = 'none';">
                                                            <label  class="form-control-label"  for="goToSchoolNo">नाही</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="school" style="display:none;">
                                            <div class="col-md-6 " >
                                                <div class="form-group">
                                                    <label class="form-control-label" for="schoolType">कोणत्या शाळेत जातो / जाते? <span style="color:red">*</span></label>
                                                    <select name="schoolType" class="form-control" id="schoolType">
                                                        <option selected disabled >-- शाळा निवडा--</option>
                                                        <option <?php if($r['schoolType'] == "Ashram school") { echo "selected"; } ?> >Ashram school</option>
                                                        <option <?php if($r['schoolType'] == "Zilla Parishad school") { echo "selected"; } ?>>Zilla Parishad school</option>
                                                        <option <?php if($r['schoolType'] == "Private school") { echo "selected"; } ?>>Private school</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label
                                                        class="form-control-label"
                                                        for="ifsc">वर्ग<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" id="class" value="<?php echo $r['class'] ?>" name="class">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 reson" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-control-label" for="aadharNo">Reason <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" id="reasonNoGoschool" value="<?php echo $r['reasonNoGoschool'] ?>" name="reasonNoGoschool" placeholder="">
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div id="school">
                                            <div class="col-md-6  "id="school1" style="display:none;">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="ifsc">शाळेचे नाव<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" id="schoolName" value="<?php echo $r['schoolName'] ?>" name="schoolName">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php 
                                        }
                                        ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success"
                                                type="submit" name="submit">Submit</button>
                                                
                                                  <a href="family-report.php" ><button  type="button" class="btn btn-primary">Back</button></a>
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
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
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
        
        $("#degreeNameDiv").hide();
        $("#education").on('change', function(){
            if($(this).val() == "Degree"){
                $("#degreeNameDiv").show();
                $("#otherEducation").html('');
            } else if($(this).val() == "इतर"){
                $("#otherEducation").html('<input type="text"  class="form-control mt-3"  name="education">');
            } else {
                $("#degreeNameDiv").hide();
                $("#otherEducation").html('');
            }
        })
        $("#disabledCertificateDiv").hide();
        $("input[name=disabled_handicap]").on('click', function(){
            if($(this).val() == "1"){
                $("#disabledCertificateDiv").show();
                $("#disabledCertificateDiv div input").attr('required', 'required');
            } else {
                $("#disabledCertificateDiv").hide();
                $("#disabledCertificateDiv div input").removeAttr('required');
            }
        })
        
        <?php
        echo $script;
        ?>
    </script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
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