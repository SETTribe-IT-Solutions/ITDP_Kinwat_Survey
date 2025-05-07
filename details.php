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
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.10" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <style>
        .accessory:before,
        .accessory:after {
            content: "";
        }
        
        hr {
            border: 0;
            margin: 1.35em auto;
            max-width: 100%;
            background-position: 50%;
            box-sizing: border-box;
            opacity:inherit;
        }
        .accessory {
            height: 2px;
            background-image: radial-gradient(black, rgba(128, 128, 128) 100%);
        }
        
        
        /*.accessory:after {
            position: absolute;
            top: 50%;
            left: 50%;
            display: block;
            background-color: #bfbfbf;
            height: 18px;
            width: 18px;
            transform: rotate(45deg);
            margin-top: -9px;
            margin-left: -10px;
            border-radius: 4px 0;
            border: 4px solid rgba(255, 255, 255, 0.35);
            background-clip: padding-box;
            box-shadow: -10px 10px 0 rgb(255 255 255 / 15%), 10px -10px 0 rgb(255 255 255 / 15%);
        }*/


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
                            } else if(isset($_GET['memberId'])){
                                $memberId = $_GET['memberId'];
                                $query = mysqli_query($con, "SELECT * FROM familyDetails WHERE memberId = '$memberId' ORDER BY sr_no ASC LIMIT 1");
                                $result = mysqli_fetch_assoc($query);
                                $result['name'];
                                $beda = $result['beda'];
                                $lastName = $result['lastName'];
                                
                                $educationQuery = mysqli_query($con, "SELECT * FROM educationDetails WHERE memberId = '$memberId' ORDER BY srNo ASC LIMIT 1");
                                $educationResult = mysqli_fetch_assoc($educationQuery);
                            ?>
                            <h4 class="card-title">परिवार जोडा - <?php echo $result['name']; ?> </h4>
                            <?php
                            }
                            else {
                                
                            ?>
                            <h4 class="card-title">परिवार जोडा </h4>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="card-body p-3">
                            <form action="details-db<?php echo $member ?>" method="post">
                                <input type="hidden" value="<?php echo $familyId ?>" name="familyId">
                                <input type="hidden" value="<?php echo $beda ?>" name="beda">
                                
                                <!-- Family Details Start -->
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
                                            <input type="text" class="form-control" required="" value="<?php echo $result['firstName'] ?>" id="firstName" name="firstName">
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           

                                            <label class="form-control-label" for="name"> वडिलांचे / पतीचे नाव <span style="color:red">*</span></label>
                                            
                                            <input type="text" class="form-control" required="" value="<?php echo $result['middleName'] ?>" id="middleName" name="middleName">
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="caste">जात <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" required="" value="<?php echo $result['caste'] ?>" id="caste" name="caste">
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
                                            <input type="text" class="form-control" id="incomeNo" value="<?php echo $result['incomeNo'] ?>" name="incomeNo">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rationNo">राशन कार्ड क्र. </label>
                                            <input type="text" class="form-control" id="rationNo" value="<?php echo $result['rationNo'] ?>" name="rationNo">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="gender">लिंग <span style="color:red">*</span></label>
                                            <select name="gender" class="form-control" required id="gender">
                                                <option value="" selected="" disabled="">-- लिंग निवडा --</option>
                                                <?php 
                                                $genderArray = array('Male', 'Female', 'Other');
                                                foreach ($genderArray as $gender){
                                                    if($gender == $result['gender']){
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                ?>
                                                <option value="<?php echo $gender ?>" <?php echo $selected ?>><?php echo $gender ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="dob">जन्म दिनांक <span style="color:red">*</span></label>
                                            <input type="date" class="form-control" id="dob" value="<?php echo $result['dob'] ?>" placeholder="DD/MM/YYYY" required="" name="dob">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="mobileNo">मोबाईल क्र .</label>
                                            <input type="tel"  class="form-control" id="mobileNo" value="<?php echo $result['mobileNo'] ?>" onkeypress="isInputNumberMobile(event)" maxlength="10" minlength="10" name="mobileNo">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="localVillage">हल्ली मुक्काम <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="localVillage" value="<?php echo $result['localVillage'] ?>" required="" name="localVillage">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="permanentVillage">मुळ गाव <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="permanentVillage" value="<?php echo $result['permanentVillage'] ?>" required="" name="permanentVillage">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">अपंग? <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="disabled_handicap" <?php if($result['disabled_handicap'] == 1){ echo 'checked'; } ?> value="1" id="disabledYes">
                                                        <label class="form-control-label" for="disabledYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="disabled_handicap" value="0" <?php if($result['disabled_handicap'] == 0){ echo 'checked'; } ?> id="disabledNo">
                                                        <label class="form-control-label" for="disabledNo">नाही</label>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-6" id="disabledCertificateDiv">
                                        <div class="form-group">
                                            <label class="form-control-label" for="disabledCertificate">अपंग सर्टिफिकेट क्र. </label>
                                            <input type="text" class="form-control" id="disabledCertificate" value="<?php echo $result['disabledCertificate'] ?>" name="disabledCertificate">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">जनआरोग्य नोंदणी आहे का? <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" <?php if($result['janAarogya'] == 1){ echo 'checked'; } ?> name="janAarogya" value="1" id="janAarogyaYes">
                                                        <label class="form-control-label" for="janAarogyaYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="janAarogya" <?php if($result['janAarogya'] == 0){ echo 'checked'; } ?> value="0" id="janAarogyaNo">
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
                                                        <input type="radio" class="form-check-input" required="" <?php if($result['niradhar'] == 1){ echo 'checked'; } ?> name="niradhar" value="1" id="niradharYes">
                                                        <label class="form-control-label" for="niradharYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" required="" name="niradhar" <?php if($result['niradhar'] == 0){ echo 'checked'; } ?> value="0" id="niradharNo">
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
                                <!-- Family Details End -->
                                
                                <hr class="accessory">
                                
                                <!-- Education Details Start -->
                                <h4 class="card-title" id="educationDetails">शिक्षण</h4>
                                <!-- Head of family  && Age is above 18 -->
                                <div class="row" id="age-above-18">    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="schoolType">शिक्षण <span style="color:red">*</span></label>
                                            <select name="education"  class="form-control" id="education">
                                                <option value="" selected disabled >-- शिक्षण निवडा --</option>
                                                <?php 
                                                $educationArray = array('Primary school', 'Seconder school', '10 Pass', '12 Pass', 'Degree', 'Illiterate');
                                                foreach ($educationArray as $education){
                                                    if($education == $educationResult['education']){
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                ?>
                                                <option value="<?php echo $education ?>" <?php echo $selected ?>><?php echo $education ?></option> 
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
                                            <input type="text" class="form-control" id="incomeNo" value="<?php echo $educationResult['degreeName'] ?>" name="degreeName" placeholder="degress name">
                                        </div>  
                                    </div>
                                </div>
                                
                                <!-- Age is 0 to 6 years -->
                                <div class="row" id="age-0-6">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="education">बाल आरोग्य नोंदणी आहे का?<span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">  
                                                        <input type="radio" name="registerBalAargya" <?php if($educationResult['registerBalAargya'] == 1){ echo 'checked'; } ?> class="form-check-input" value="1" onclick="document.querySelector('.fiel').style.display = 'block';document.querySelector('#reg').style.display = 'none';" />
                                                        <label class="form-control-label"for="Yes">होय</label>
                                                    </div>    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check"> 
                                                        <input type="radio" name="registerBalAargya" value="0" <?php if($educationResult['registerBalAargya'] == 0){ echo 'checked'; } ?> class="form-check-input" onclick="document.querySelector('.fiel').style.display = 'none';document.querySelector('#reg').style.display = 'block';" />
                                                        <label class="form-control-label" for="No">नाही</label> 
                                                    </div>
                                                </div>                     
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    if($educationResult['wantToRegister'] == 1){
                                        $reg  = '';
                                    }   else {
                                        $reg  = 'style="display:none;"';
                                    }
                                    ?>
                                    
                                    <div class="col-md-6" id="reg" <?php echo $reg; ?>>
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">नोंदणी करायची आहे का? <span style="color:red">*</span></label><br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                    <input type="radio"  class="form-check-input"  name="wantToRegister" value="1" id="Yes" <?php if($educationResult['wantToRegister'] == 1){ echo 'checked'; } ?> onclick="document.querySelector('.fieldes').style.display = 'none';document.querySelector('.fiel').style.display = 'block';">
                                                        <label class="form-control-label" for="Yes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="wantToRegister" value="0" <?php if($educationResult['wantToRegister'] == 0){ echo 'checked'; } ?> id="No"onclick="document.querySelector('.fieldes').style.display = 'block';document.querySelector('.fiel').style.display = 'none';">
                                                        <label  class="form-control-label"  for="No">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    if($educationResult['wantToRegister'] == 1){
                                        $fiel  = '';
                                    }   else {
                                        $fiel  = 'style="display:none;"';
                                    }
                                    ?>
                                    
                                    <div class="col-md-6 fiel" <?php echo $fiel ?>>
                                        <div class="form-group">
                                            <label class="form-control-label" for="aadharNo">अंगनवाडी निवडा <span style="color:red">*</span></label>
                                            <input type="text" class="form-control"id="incomeNo" value="<?php echo $educationResult['anganwadiName'] ?>" name="anganwadiName" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Age is above 6 years -->
                                <div class="row" id="age-above-6">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rationNo">शाळेत जातो / जाते का? <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio"  class="form-check-input" name="goToSchool" value="1" <?php if($educationResult['goToSchool'] == 1){ echo 'checked'; } ?> id="Yes"  onclick="document.querySelector('.school').style.display = 'block';document.querySelector('.reson').style.display = 'none'; document.querySelector('#school1').style.display = 'block';">
                                                        <label class="form-control-label" for="Yes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="goToSchool" value="0" id="No" <?php if($educationResult['goToSchool'] == 0){ echo 'checked'; } ?> onclick="document.querySelector('.school').style.display = 'none';document.querySelector('.reson').style.display = 'block';document.querySelector('#school').style.display = 'none';">
                                                        <label  class="form-control-label"  for="No">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    if($educationResult['goToSchool'] == 1){
                                        $school  = '';
                                        $school1 = '';
                                        $reason = 'style="display:none';
                                    }   else {
                                        $school  = 'style="display:none;"';
                                        $school1  = 'style="display:none;"';
                                        $reason = '';
                                    }
                                    ?>
                                    
                                    <div class="school" <?php echo $school ?>>
                                        <div class="col-md-6 " >
                                            <div class="form-group">
                                                <label class="form-control-label" for="schoolType">कोणत्या शाळेत जातो / जाते? <span style="color:red">*</span></label>
                                                <select name="schoolType" class="form-control" id="schoolType">
                                                     <option selected disabled >-- शाळा निवडा--</option>
                                                     
                                                    <option <?php if($educationResult['schoolType'] == 'Ashram school'){ echo 'selected'; } ?>>Ashram school</option>
                                                    
                                                    <option <?php if($educationResult['schoolType'] == 'Zilla Parishad school'){ echo 'selected'; } ?>>Zilla Parishad school</option>
                                                    
                                                    <option <?php if($educationResult['schoolType'] == 'Private school'){ echo 'selected'; } ?>>Private school</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="form-control-label"
                                                    for="ifsc">वर्ग<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" id="class" value="<?php echo $educationResult['class'] ?>" name="class">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 reson" <?php echo $reason ?>>
                                        <div class="form-group">
                                            <label class="form-control-label" for="reasonNoGoschool">Reason <span style="color:red">*</span></label>
                                            <input type="text" class="form-control"  value="<?php echo $educationResult['reasonNoGoschool'] ?>" id="reasonNoGoschool" name="reasonNoGoschool" placeholder="">
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div id="school">
                                        <div class="col-md-6  "id="school1" <?php echo $school1 ?>>
                                            <div class="form-group">
                                                <label
                                                    class="form-control-label"
                                                    for="schoolName">शाळेचे नाव<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" value="<?php echo $educationResult['schoolName'] ?>" id="schoolName" name="schoolName">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Education Details End-->
                                
                                <hr class="accessory">
                                
                                <!-- Livelihood Details Start -->
                                <h4 class="card-title" id="livelihoodDetails">राहणीमान</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group dropdown">
                                            <label class="form-control-label" for="occupation">व्यवसाय <span style="color:red">*</span></label>
                                            <select class="form-select" id="type" id="occupation" onchange="occupationFun(this.value)" name="occupation">
                                                <option selected disabled>-- व्यवसाय निवडा --</option>
                                                <option>शेतकरी</option>
                                                <option>पाळीव प्राणी</option>
                                                <option>नोकरी</option>
                                                <option>धंदा</option>
                                                <option>बेरोजगार</option>
                                                <option>इतर</option>
                                            </select>
                                            <div id="otherOccupation">
                                
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- Farmer Start -->
                                    <div class="col-md-6 farmer" id="owned_land" style="display:none">
                                        <label>स्वतःची जागा आहे का?</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" id="areaOwnedYes" class="form-check-input" onclick="ownedFun(this.value)" name="owned" value="1">
                                                    <label for="areaOwnedYes">होय</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" id="areaOwnedNo" name="owned" class="form-check-input" onclick="ownedFun(this.value)" value="0">
                                                    <label for="areaOwnedYes">नाही</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 farmerYes" style="display:none">
                                        <div class="form-group">
                                            <label for="livelihoodArea">क्षेत्रफळ</label>
                                            <input type="text" name="area" id="livelihoodArea" class="form-control">    
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 farmerYes" style="display:none" id="crops_type">
                                        <div class="form-group">
                                            <label for="crops">पिकाचा / धान्याचा प्रकार</label>
                                            <input type="text" id="crops" name="crops" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 farmerYes" style="display:none" id="income1">
                                        <div class="form-group">
                                            <label id="income1">मिळकत (रु.)</label>
                                            <input type="text" id="income1" name="income1" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Farmer End -->
                                    
                                    
                                    <!-- Livestacle Start -->
                                    <div class="col-md-6 livestacle" style="display:none" id="an_type">
                                        <div class="form-group">
                                            <label for="animal_type">प्राणी?</label>
                                            <input type="text" id="animal_type" name="animal_type" class="form-control">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6 livestacle" style="display:none" id="count1">
                                        <div class="form-group">
                                            <label for="animal_count">पाळीव प्राण्यांची संख्या</label>
                                            <input type="text" id="animal_count" name="animal_count" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 livestacle" style="display:none" id="shade1">
                                        <div class="form-group">
                                            <label>प्राण्यांसाठी शेड आहे का?</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" id="shadeYes" name="shade" class="form-check-input" value="1">
                                                        <label for="shadeYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" id="shadeNo" name="shade" class="form-check-input" value="0">
                                                        <label for="shadeNo">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 livestacle" style="display:none" id="income4">
                                        <div class="form-group">
                                            <label for="income2">मिळकत (रु.)</label>
                                            <input type="text" id="income2" name="income2" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Livestacle End -->
                                    
                                    <!-- Salaried Start -->
                                    <div class="col-md-6 salaried" style="display:none" id="p_g">
                                        <div class="form-group">
                                            <label>नोकरी?</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="private" name="pr_gov" value="Private">
                                                        <label for="private">खाजगी नोकरी</label>
                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="radio" name="pr_gov" id="government" class="form-check-input" value="Government"> 
                                                        <label for="government">शासकीय</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 salaried" style="display: none" id="income5">
                                        <div class="form-group">
                                            <label for="income3">मिळकत (रु.)</label>
                                            <input type="text" name="income3" id="income3" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Salaried End -->
                                    
                                    <!-- Business Start -->
                                    <div class="col-md-6 business" style="display: none" id="business_t">
                                        <div class="form-group">
                                            <label for="businessType">व्यवसायाचा प्रकार</label>
                                            <input type="text" id="businessType" name="business_type" class="form-control">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6 business" style="display: none" id="income6">
                                        <div class="form-group">
                                            <label for="income4">मिळकत (रु.)</label>
                                            <input type="text" id="income4" name="income4" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Business End -->
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>बचत गटाचे सदस्य आहात काय?</label>                                    
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" id="shgYes" name="shg" value="1">
                                                        <label for="shgYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" name="shg" id="shgNo" class="form-check-input" value="0">
                                                        <label for="shgNo">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6" style="" id="">
                                        <div class="form-group">
                                            <label for="remark">अधिकची माहिती (ऐच्छिक) </label>
                                            <input type="text" id="remark" name="remark" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Livelihood Details End -->
                                
                                <hr class="accessory">
                                
                                <!-- Land Details Start -->
                                
                                <!-- Farm Details Start -->
                                <h4 class="card-title" id="farmDetails">शेतीविषयक माहिती</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">स्वतःची शेती आहे का?</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" id="ownedLandYes"
                                                                    name="ownedLand" value="1" onclick="showInput();" />
                                                                <label class="form-control-label" for="ownedLandYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" id="ownedLandNo" class="form-check-input"
                                                                    name="ownedLand" value="1"
                                                                    onclick="showDropdown();" />
                                                                <label class="form-control-label" for="ownedLandNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div id="inputFile" style="display:none;">
                                                        <label class="form-control-label">७/१२</label><br>
                                                        <input type="file" class="form-control" id="fileInput" />
                                                    </div>
                                                    <script>
                                                        function showInput() {
                                                            document.getElementById("inputFile").style.display = "block";
                                                            document.getElementById("dropdownList").style.display = "none";
                                                            document.getElementById("farmArea").style.display = "block";
                                                        }
                                                        function showDropdown() {
                                                            document.getElementById("inputFile").style.display = "none";
                                                            document.getElementById("dropdownList").style.display = "block";
                                                            document.getElementById("farmArea").style.display = "none";
                                                        }
                                                    </script>

                                                    <div id="dropdownList" style="display:none;">
                                                        <label class="form-control-label">इतर कोणाची शेती करता का?</label><br>
                                                        <select id="dropdown" class="form-select">
                                                            <option value="" selected="" disabled="">-- निवडा --</option>
                                                            <option value="1">नाही</option>
                                                            <option value="2">मक्ता / बटाई</option>
                                                            <option value="3">अतिक्रमण</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="farmArea" style="display:none">
                                        <div class="form-group">
                                            <label class="form-control-label">क्षेत्रफळ</label><br>
                                            <input type="text" class="form-control" id="area" name="area">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Farm Details End -->
                                
                                <hr class="accessory">
                                
                                <!-- House Details Start -->
                                <h4 class="card-title" id="houseDetails">घराचे माहिती</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-control-label">घर आहे का?</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" onclick="showData()"
                                                        name="house" value="1" id="gharYes">
                                                    <label class="form-control-label" for="gharYes">होय</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" onclick="hideData()"
                                                        name="house" value="0" id="gharNo">
                                                    <label class="form-control-label" for="gharNo">नाही</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="dataDiv" style="display:none;">

                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <label class="form-control-label">घराचा प्रकार</label>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" 
                                                                name="houseType" value="कच्च" id="houseTypeKachch">
                                                            <label class="form-control-label" for="houseTypeKachch">कच्च</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" 
                                                                name="houseType" value="पक्क" id="houseTypePakk">
                                                            <label class="form-control-label" for="houseTypePakk">पक्क</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" id="roomNo"># खोल्या</label><br>
                                                    <input type="text" class="form-control" id="roomNo" name="roomNo">
                                                    <!--<label class="form-control-label" for="janAarogyaYes">होय</label>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="caste">नळ</label><br>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="tapConnection" value="1" id="tapConnectionYes">
                                                                <label class="form-control-label" for="tapConnectionYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="tapConnection" value="0" id="tapConnectionNo">
                                                                <label class="form-control-label" for="tapConnectionNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="caste">विज जोडणी</label><br>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="electricityConnection" value="1" id="electricityConnectionYes">
                                                                <label class="form-control-label" for="electricityConnectionYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="electricityConnection" value="0" id="electricityConnectionNo">
                                                                <label class="form-control-label" for="electricityConnectionNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label class="form-control-label" for="aadharNo">शौचालय</label><br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" name="toiletFacility" id="toiletFacilityYes" class="form-check-input"
                                                                    value="1" onclick="document.querySelector('.field').style.display = 'block';" />
                                                                <label class="form-control-label" for="toiletFacilityYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" name="toiletFacility" id="toiletFacilityNo" class="form-check-input"
                                                                    value="0"
                                                                    onclick="document.querySelector('.field').style.display = 'none';" />
                                                                <label class="form-control-label" for="toiletFacilityNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="incomeNo">गॅस कनेक्शन?</label>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="gasConnection" value="1" id="gasConnectionYes">
                                                                <label class="form-control-label" for="gasConnectionYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="gasConnection" value="0" id="gasConnectionNo">
                                                                <label class="form-control-label" for="gasConnectionNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="education">IFR / CFR मंजूर आहे काय?</label>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" name="ifr_cfrDone" id="ifr_cfrDoneYes" class="form-check-input"
                                                                    value="1"
                                                                    onclick="document.querySelector('#proposalDoneDiv').style.display = 'none';document.querySelector('#sendProposalDiv').style.display = 'none';" />
                                                                <label class="form-control-label" for="ifr_cfrDoneYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" name="ifr_cfrDone" value="0" id="ifr_cfrDoneNo"
                                                                    class="form-check-input"
                                                                    onclick="document.querySelector('#proposalDoneDiv').style.display = 'block';" />
                                                                <label class="form-control-label" for="ifr_cfrDoneNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6" id="proposalDoneDiv" style="display:none">
                                                <div class=" form-group">
                                                    <label class="form-control-label" for="name">प्रस्तावित आहे काय??</label><br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="proposalDone" value="1" id="proposalDoneYes"
                                                                    onclick="document.querySelector('#sendProposalDiv').style.display = 'none';">
                                                                <label class="form-control-label" for="Yes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="proposalDone" value="0" id="proposalDoneNo"
                                                                    onclick="document.querySelector('#sendProposalDiv').style.display = 'block';">
                                                                <label class="form-control-label" for="proposalDoneNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>



                                            <div class="col-md-6" id="sendProposalDiv" style="display:none">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">प्रस्ताव पाठवयाचा आहे का?</label><br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="sendProposal" value="1" id="sendProposalYes"
                                                                    onclick="document.querySelector('.fieldes').style.display = 'none';document.querySelector('.fiel').style.display = 'block';">
                                                                <label class="form-control-label"
                                                                    for="sendProposalYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="sendProposal" value="0" id="sendProposalNo"
                                                                    onclick="document.querySelector('.fieldes').style.display = 'block';document.querySelector('.fiel').style.display = 'none';">
                                                                <label class="form-control-label"
                                                                    for="sendProposalNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="pakkaGharNoDiv" style="display:none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="caste">स्वतःची जागा आहे का?</label><br>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="ownHome" value="1" id="ownHomeYes" onclick="document.getElementById('areaHome').style.display='block'">
                                                                <label class="form-control-label" for="ownHomeYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="ownHome" value="0" id="ownHomeNo" onclick="document.getElementById('areaHome').style.display='none'">
                                                                <label class="form-control-label" for="ownHomeNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6" id="areaHome" style="display:none">
                                                <div class="form-group">
                                                    <label class="form-control-label">क्षेत्रफळ</label><br>
                                                    <input type="text" class="form-control" id="homeArea" name="homeArea">
                                                    <!--<label class="form-control-label" for="janAarogyaYes">होय</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function showData() {
                                            document.getElementById("dataDiv").style.display = "block";
                                            document.getElementById("pakkaGharNoDiv").style.display = "none";
                                        }
                                        function hideData() {
                                            document.getElementById("dataDiv").style.display = "none";
                                            document.getElementById("pakkaGharNoDiv").style.display = "block";
                                        }
                                       
                                    </script>
                                </div>
                                <!-- House Details Start -->
                                
                                <!-- Land Details End -->
                                
                                <hr class="accessory">
                                
                                <!-- Scheme Details End -->
                                <h4 class="card-title">योजनांचा लाभ</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">प्रकल्प कार्यालयाचे लाभार्थी
                                                आहात काय? </label>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="appledForPO"
                                                            value="1" id="appledForPOYes" onchange="appledForPOFun(this.value)">
                                                        <label class="form-control-label"
                                                            for="appledForPOYes">होय</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="appledForPO"
                                                            value="0" id="appledForPONo" onchange="appledForPOFun(this.value)">
                                                        <label class="form-control-label" for="appledForPONo">नाही</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                </div>
                                
                                <!-- Scheme Details End -->
                                
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
    <script>
    
        flatpickr(".js-datepicker-dob", {
            dateFormat: "d/m/Y",
            maxDate: "today"
        });
        
        
        
        function ageFun(dateOfBirth){
            var dob = new Date(dateOfBirth);  
            //calculate month difference from current date in time  
            var month_diff = Date.now() - dob.getTime();  
              
            //convert the calculated difference in date format  
            var age_dt = new Date(month_diff);   
              
            //extract year from date      
            var year = age_dt.getUTCFullYear();  
              
            //now calculate the age of the user  
            var age = Math.abs(year - 1970);
            
            console.log(age);
            
            if(age>=0 && age<6){
                $("#age-above-18").hide();
                $("#age-above-6").hide();
                $("#age-0-6").show();
            } else if(age >=6 && age <18){
                $("#age-above-18").hide();
                $("#age-above-6").show();
                $("#age-0-6").hide();
            } else if(age >= 18) {
                $("#age-above-18").show();
                $("#age-above-6").hide();
                $("#age-0-6").hide();
            }
        }
        
        $("#dob").on('change', function(){
            ageFun($(this).val());
        })
        
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
        
        $("#degreeNameDiv").hide();
        $("#education").on('change', function(){
            if($(this).val() == "Degree"){
                $("#degreeNameDiv").show();
                $("#otherEducation").html('');
            } else if($(this).val() == "other"){
                $("#otherEducation").html('<input type="text"  class="form-control mt-3"  name="education">');
            } else {
                $("#degreeNameDiv").hide();
                $("#otherEducation").html('');
            }
        })
        
        $("#lastName").on('change', function(){
            if($(this).val() == "इतर"){
                $("#lastNameTextBox").html('<br><input type="text" class="form-control" required="" id="" name="lastName">')
            } else {
                $("#lastNameTextBox").html('')
            }
        })
        
        function occupationFun(occupation){
            if(occupation == "शेतकरी"){
                $("form .farmer").show()
                $("form .livestacle").hide()
                $("form .salaried").hide()
                $("form .business").hide();
                $("form .farmerYes").hide();
                $("#otherOccupation").html('');
    
            } else if(occupation == "पाळीव प्राणी"){
                $("form .farmer").hide()
                $("form .livestacle").show();
                $("form .salaried").hide();
                $("form .business").hide();
                $("form .farmerYes").hide();
                $("#otherOccupation").html('');
                
            } else if(occupation == "नोकरी"){
                $("form .farmer").hide()
                $("form .livestacle").hide();
                $("form .salaried").show();
                $("form .business").hide();
                $("form .farmerYes").hide();
                $("#otherOccupation").html('');
    
            } else if(occupation == "धंदा"){
                $("form .farmer").hide()
                $("form .livestacle").hide()
                $("form .salaried").hide()
                $("form .business").show()
                $("#otherOccupation").html('');
                
            } else if(occupation == "बेरोजगार"){
                $("form .farmer").hide()
                $("form .livestacle").hide()
                $("form .salaried").hide()
                $("form .business").hide()
                $("form .farmerYes").hide();
                $("#otherOccupation").html('');
    
            } else {
                $("form .farmer").hide()
                $("form .livestacle").hide()
                $("form .salaried").hide()
                $("form .business").hide()
                $("form .farmerYes").hide();
                $("#otherOccupation").html('<input type="text" requred class="form-control mt-3"  name="occupation">');
            }
        };
        
        function ownedFun(val){
            if(val == "1"){
                $("form .farmerYes").show();
            } else {
                $("form .farmerYes").hide();
            }
        }
        
        function appledForPOFun(val){
            if(val == "1"){
                $("form #list").show();
            } else {
                $("form #list").hide();
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
    if(isset($_GET['familyId']) && !isset($_GET['member'])){
    ?>
    
    <script>
        addMember('<?php echo $familyId ?>', 'details');
    </script>
    <?php
    }
    
    if(isset($_GET['memberId'])){
    ?>
    <script>
        ageFun(<?php echo $result['dob'] ?>);
    </script>
    <?php
    }
    ?>
</body>

</html>