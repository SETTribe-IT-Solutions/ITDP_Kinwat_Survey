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
                                    <input type="hidden" value="<?php echo $memberId ?>" name="memberId">
                                    <div class="row">
                                        <!-- Head of family  -->
                                        <?php
                                        $memberId = $_GET['memberId'];
                                        $q = mysqli_query($con, "SELECT * FROM familyDetails WHERE memberId = '$memberId'");
                                        $r = mysqli_fetch_assoc($q);
                                        $bday = $r['dob'];
                                        
                                        $dob = new DateTime($bday);
                                        $now = new DateTime();
                                        $diff = $now->diff($dob);
                                        $age = $diff->y;
                                        
                                        if($r['familyHead'] == "" || $age >18){
                                        ?>
                                        
                                        <?php
                                        // Connect to database
                                        $con  = mysqli_connect('localhost', 'u196817721_ST_pardhiForm', 'ST_pardhiSurveyForm@1234', 'u196817721_pardhi_survey');
                                        // Check connection
                                        if (mysqli_connect_errno()) {
                                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                        }
                                        // Fetch data
                                        $memberId = $_REQUEST['memberId'];
                                        $query = "SELECT * FROM familyDetails WHERE memberId = '$memberId'";
                                        $result = mysqli_query($con, $query);
                                        // Print data
                                    $row = mysqli_fetch_array($result);
                                   $edu = $row['eduction'];
                                        // Close connection
                                        mysqli_close($con);
                                        ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="schoolType">शिक्षण <span style="color:red">*</span></label>
                                                <select name="education"  required class="form-control" id="education">
                                                    <option  value="" selected disabled >-- शिक्षण निवडा --</option>
                                                    <option value="Primary school"<?php if($edu=='Primary school'){ ?> selected <?php }  ?>>  Primary school</option> 
                                                    <option value="Seconder school"<?php if($edu=='Seconder school'){ ?> selected <?php }  ?> >Seconder school</option>
                                                    <option value="10 Pass"<?php if($edu=='10th'){ ?> selected <?php }  ?> >10 Pass</option>
                                                    <option value="12 Pass" <?php if($edu=='12th'){ ?> selected <?php }  ?>>12 Pass</option>
                                                    <option value="Degree""<?php if($edu=='Degree'){ ?> selected <?php }  ?> >Degree</option>
                                                    <option value="Illiterate"<?php if($edu=='Illiterate'){ ?> selected <?php }  ?>>Illiterate</option>
                                                </select>
                                               
                                                
                                               <!-- <label
                                                    class="form-control-label"
                                                    for="name">10 pass ?</label><br>
                                                    
                                                    <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio"  class="form-check-input"  name="tenPass" value="1" id="Yes">
                                                            <label
                                                                class="form-control-label"
                                                                for="Yes">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="tenPass" value="0" id="No">
                                                            <label  class="form-control-label"  for="No">No</label>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="degreeNameDiv" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-control-label" for="aadharNo">Degree name <span style="color:red">*</span> </label>
                                                <input type="text" class="form-control" id="incomeNo" name="degreeName" placeholder="degress name">
                                            </div>  
                                        </div>
                                        <!--<div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-control-label"
                                                    for="caste">12 pass ?</label><br>
                                                    
                                                  <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input"  name="twelvePass" value="1" id="Yes">
                                                            <label  class="form-control-label" for="Yes">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="twelvePass" value="0"  id="No">
                                                            <label
                                                                class="form-control-label"
                                                                for="No">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             
                                            <div class="form-group">
                                                <label class="form-control-label" for="aadharNo">Degress done?</label><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check">  
                                                            <input type="radio" name="degressDone" class="form-check-input" value="1" onclick="document.querySelector('.field').style.display = 'block';" />
                                                            <label class="form-control-label"for="Yes">Yes</label>
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check"> 
                                                            <input type="radio" name="degressDone" class="form-check-input" value="0" onclick="document.querySelector('.field').style.display = 'none';" /> 
                                                            <label class="form-control-label"for="No">No</label> 
                                                        </div>
                                                    </div>                     
                                                </div>
                                            </div>                                           
                                        </div>
                                        
                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-control-label"
                                                    for="incomeNo">Illiterade</label>
                                                    
                                                     <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio"
                                                                class="form-check-input"
                                                                name="Illiterate"
                                                                value="1"
                                                                id="Yes">
                                                            <label
                                                                class="form-control-label"
                                                                for="Yes">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio"
                                                                class="form-check-input"
                                                                name="Illiterate"
                                                                value="0"
                                                                id="No">
                                                            <label
                                                                class="form-control-label"
                                                                for="No">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                               
                                            </div>
                                        </div>-->
                                        
                                        <?php 
                                        } else if($age <= 6 && $age >0){
                                        ?>
                                        
                                        <!-- Age is 0 to 6 years -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="education">बाल आरोग्य नोंदणी आहे का?<span style="color:red">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check">  
                                                            <input type="radio" required="" name="registerBalAargya" class="form-check-input" value="1" onclick="document.querySelector('.fiel').style.display = 'block';document.querySelector('#reg').style.display = 'none';" />
                                                            <label class="form-control-label"for="Yes">होय</label>
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check"> 
                                                            <input type="radio" required="" name="registerBalAargya" value="0" class="form-check-input" onclick="document.querySelector('.fiel').style.display = 'none';document.querySelector('#reg').style.display = 'block';" />
                                                            <label class="form-control-label" for="No">नाही</label> 
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
                                                        <input type="radio"  class="form-check-input"  name="wantToRegister" value="1" id="Yes" onclick="document.querySelector('.fieldes').style.display = 'none';document.querySelector('.fiel').style.display = 'block';">
                                                            <label class="form-control-label" for="Yes">होय</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="wantToRegister" value="0" id="No"onclick="document.querySelector('.fieldes').style.display = 'block';document.querySelector('.fiel').style.display = 'none';">
                                                            <label  class="form-control-label"  for="No">नाही</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                               
                                            </div>
                                        </div>
                                        
                                       
                                        
                                        <div class="col-md-6 fiel" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-control-label" for="aadharNo">अंगनवाडी निवडा <span style="color:red">*</span></label>
                                                <input type="text" class="form-control"id="incomeNo" name="anganwadiName" placeholder="">
                                            </div>
                                        </div>
                                        <?php
                                        } else if($age > 6 && $age <=18){
                                        ?>
                                            
                                        <!-- Age is above 6 years -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="rationNo">शाळेत जातो / जाते का? <span style="color:red">*</span></label>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio"  class="form-check-input" required=""  name="goToSchool" value="1" id="Yes" onclick="document.querySelector('.school').style.display = 'block';document.querySelector('.reson').style.display = 'none'; document.querySelector('#school1').style.display = 'block';">
                                                            <label class="form-control-label" for="Yes">होय</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" required="" name="goToSchool" value="0" id="No" onclick="document.querySelector('.school').style.display = 'none';document.querySelector('.reson').style.display = 'block';document.querySelector('#school').style.display = 'none';">
                                                            <label  class="form-control-label"  for="No">नाही</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 school" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-control-label" for="schoolType">कोणत्या शाळेत जातो / जाते? <span style="color:red">*</span></label>
                                                <select name="schoolType" class="form-control" id="schoolType">
                                                     <option selected disabled >-- शाळा निवडा--</option>
                                                     
                                                    <option>Ashram school</option>
                                                    
                                                    <option>Zilla Parishad school</option>
                                                    
                                                    <option>Private school</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 reson" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-control-label" for="aadharNo">Reason <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" id="incomeNo" name="reasonNoGoschool" placeholder="">
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div id="school">
                                            <div class="col-md-6  "id="school1" style="display:none;">
                                                <div class="form-group">
                                                    <label
                                                        class="form-control-label"
                                                        for="ifsc">शाळेचे नाव<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" id="ifsc" name="schoolName">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php 
                                        }
                                        ?>
                                        
                                        
                                        
                                        
                                        
                                    <!--    <div class="col-md-6">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label-->
                                    <!--                class="form-control-label"-->
                                    <!--                for="gender">Gender</label>-->
                                    <!--            <input type="text"-->
                                    <!--                class="form-control"-->
                                    <!--                id="gender" name="gender">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label-->
                                    <!--                class="form-control-label"-->
                                    <!--                for="dob">DOB</label>-->
                                    <!--            <input type="text"-->
                                    <!--                class="form-control"-->
                                    <!--                id="dob" name="dob">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label-->
                                    <!--                class="form-control-label"-->
                                    <!--                for="mobileNo">Mobile No.</label>-->
                                    <!--            <input type="text"-->
                                    <!--                class="form-control"-->
                                    <!--                id="mobileNo"-->
                                    <!--                name="mobileNo">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label-->
                                    <!--                class="form-control-label"-->
                                    <!--                for="localVillage">Local-->
                                    <!--                village</label>-->
                                    <!--            <input type="text"-->
                                    <!--                class="form-control"-->
                                    <!--                id="localVillage"-->
                                    <!--                name="localVillage">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label-->
                                    <!--                class="form-control-label"-->
                                    <!--                for="permanentVillage">Permanent-->
                                    <!--                village</label>-->
                                    <!--            <input type="text"-->
                                    <!--                class="form-control"-->
                                    <!--                id="permanentVillage"-->
                                    <!--                name="permanentVillage">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label-->
                                    <!--                class="form-control-label">Disabled/Handicap?</label>-->
                                    <!--            <div class="row">-->
                                    <!--                <div class="col-6">-->
                                    <!--                    <div class="form-check">-->
                                    <!--                        <input type="radio"-->
                                    <!--                            class="form-check-input"-->
                                    <!--                            name="disabled_handicap"-->
                                    <!--                            value="1"-->
                                    <!--                            id="disabledYes">-->
                                    <!--                        <label-->
                                    <!--                            class="form-control-label"-->
                                    <!--                            for="disabledYes">Yes</label>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--                <div class="col-6">-->
                                    <!--                    <div class="form-check">-->
                                    <!--                        <input type="radio"-->
                                    <!--                            class="form-check-input"-->
                                    <!--                            name="disabled_handicap"-->
                                    <!--                            value="0"-->
                                    <!--                            id="disabledNo">-->
                                    <!--                        <label-->
                                    <!--                            class="form-control-label"-->
                                    <!--                            for="disabledNo">No</label>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6"-->
                                    <!--        id="disabledCertificateDiv">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label-->
                                    <!--                class="form-control-label"-->
                                    <!--                for="disabledCertificate">Disabled-->
                                    <!--                Certificate</label>-->
                                    <!--            <input type="text"-->
                                    <!--                class="form-control"-->
                                    <!--                id="disabledCertificate"-->
                                    <!--                name="disabledCertificate">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label-->
                                    <!--                class="form-control-label">Register-->
                                    <!--                for Jan Aarogya?</label>-->
                                    <!--            <div class="row">-->
                                    <!--                <div class="col-6">-->
                                    <!--                    <div class="form-check">-->
                                    <!--                        <input type="radio"-->
                                    <!--                            class="form-check-input"-->
                                    <!--                            name="janAarogya"-->
                                    <!--                            value="1"-->
                                    <!--                            id="janAarogyaYes">-->
                                    <!--                        <label-->
                                    <!--                            class="form-control-label"-->
                                    <!--                            for="janAarogyaYes">Yes</label>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--                <div class="col-6">-->
                                    <!--                    <div class="form-check">-->
                                    <!--                        <input type="radio"-->
                                    <!--                            class="form-check-input"-->
                                    <!--                            name="janAarogya"-->
                                    <!--                            value="0"-->
                                    <!--                            id="janAarogyaNo">-->
                                    <!--                        <label-->
                                    <!--                            class="form-control-label"-->
                                    <!--                            for="janAarogyaNo">No</label>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <label-->
                                    <!--                class="form-control-label">Niradhar-->
                                    <!--                done?</label>-->
                                    <!--            <div class="row">-->
                                    <!--                <div class="col-6">-->
                                    <!--                    <div class="form-check">-->
                                    <!--                        <input type="radio"-->
                                    <!--                            class="form-check-input"-->
                                    <!--                            name="niradhar"-->
                                    <!--                            value="1"-->
                                    <!--                            id="niradharYes">-->
                                    <!--                        <label-->
                                    <!--                            class="form-control-label"-->
                                    <!--                            for="janAarogyaYes">Yes</label>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--                <div class="col-6">-->
                                    <!--                    <div class="form-check">-->
                                    <!--                        <input type="radio"-->
                                    <!--                            class="form-check-input"-->
                                    <!--                            name="niradharniradhar"-->
                                    <!--                            value="0"-->
                                    <!--                            id="niradharNo">-->
                                    <!--                        <label-->
                                    <!--                            class="form-control-label"-->
                                    <!--                            for="jniradharNo">No</label>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
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
            } else {
                $("#degreeNameDiv").hide();
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
    </script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
    </body>
</html>