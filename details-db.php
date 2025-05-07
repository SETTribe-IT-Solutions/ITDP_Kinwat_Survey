<?php
session_start();
include('include/con.php');
if(isset($_POST['submit'])){
    require_once('include/sweetAlert.php');
    $familyId = $_POST['familyId'];
    $q = mysqli_query($con, "SELECT count(*) as 'count' FROM familyDetails WHERE familyId = '$familyId'");
    $r = mysqli_fetch_assoc($q);
    $count = $r['count']+1;
    $memberId = $familyId."_".$count;
    if(isset($_GET['member'])){
        $familyHead = $familyId."_1";
    }
    $lastName = addslashes($_POST['lastName']);
    $firstName = addslashes($_POST['firstName']);
    $middleName = addslashes($_POST['middleName']);
    $caste = addslashes($_POST['caste']);
    $aadharNo = addslashes($_POST['aadharNo']);
    $incomeNo = addslashes($_POST['incomeNo']);
    $education = addslashes($_POST['education']);
    $rationNo = addslashes($_POST['rationNo']);
    $ifsc = addslashes($_POST['ifsc']);
    $gender = addslashes($_POST['gender']);
    $dob = addslashes($_POST['dob']);
    $explode = explode('/', $dob);
    $dob = $explode[2]."-".$explode[1]."-".$explode[0];
    $age = addslashes($_POST['age']);
    $mobileNo = addslashes($_POST['mobileNo']);
    $localVillage = addslashes($_POST['localVillage']);
    $permanentVillage = addslashes($_POST['permanentVillage']);
    $disabled_handicap = addslashes($_POST['disabled_handicap']);
    $disabledCertificate  = addslashes($_POST['disabledCertificate']);
    $janAarogya = addslashes($_POST['janAarogya']);
    $niradhar = addslashes($_POST['niradhar']);
    $createdId = $_SESSION['userId'];
    $dateTime = date('Y-m-d H:i:s');
    $beda = $_POST['beda'];
    
    $name = $lastName." ".$firstName." ".$middleName;
    
    $query = mysqli_query($con, "INSERT INTO familyDetails (`familyId`, `memberId`,`lastName`,`firstName`,`middleName`, `name`, `caste`, `aadharNo`, `incomeNo`, `eduction`, `rationNo`, `ifsc`, `gender`, `dob`, `mobileNo`, `disabled_handicap`, `handicapCertificate`, `janAarogya`, `localVillage`, `permanentVillage`, `niradhar`, `familyHead`, `remark`, `createdId`, `dateTime`, `status`, `beda`) VALUES ('$familyId', '$memberId','$lastName','$firstName','$middleName', '$name', '$caste', '$aadharNo', '$incomeNo', '$education', '$rationNo', '$ifsc', '$gender', '$dob', '$mobileNo', '$disabled_handicap', '$disabledCertificate', '$janAarogya', '$localVillage', '$permanentVillage', '$niradhar', '$familyHead', '$remark', '$createdId', '$dateTime', '1', '$beda')") or die($con->error);
    
    
    if($age >=0 && $age <6){
        $registerBalAargya = addslashes($_POST['registerBalAargya']);
        if($registerBalAargya == 1){
            $anganwadiName = addslashes($_POST['anganwadiName']);   
        } else {
            $wantToRegister = addslashes($_POST['wantToRegister']);    
        }
    } else if($age >=6 && $age <18){
        $goToSchool = addslashes($_POST['goToSchool']);
        if($goToSchool == 1){
            $class = addslashes($_POST['class']);
            $schoolName = addslashes($_POST['schoolName']);
            $schoolType = addslashes($_POST['schoolType']);    
        } else {
            $reasonNoGoschool = addslashes($_POST['reasonNoGoschool']);    
        }
    } else if($age >18){
        $education = addslashes($_POST['education']);
        $degreeName = addslashes($_POST['degreeName']);
    }
    
    
    $remark = addslashes($_POST['remark']);
    $query = mysqli_query($con,"INSERT INTO educationDetails(education,degreeName,registerBalAargya,anganwadiName,wantToRegister,goToSchool,class,reasonNoGoschool,schoolName,schoolType,remark,memberId,createdId,dateTime)VALUES('$education','$degreeName','$registerBalAargya','$anganwadiName','$wantToRegister','$goToSchool','$class','$reasonNoGoschool','$schoolName','$schoolType','$remark','$memberId', '$createdId', '$dateTime')") or die ($con->error);
    
    
    $occupation = addslashes($_POST['occupation']);
    
    if($occupation == "शेतकरी"){
        $owned = addslashes($_POST['owned']);
        if($owned == 1){
            $area = addslashes($_POST['area']);
            $crops = addslashes($_POST['crops']);
            $income = addslashes($_POST['income1']);
        }
    } else if($occupation == "पाळीव प्राणी") {
        $animal_type = addslashes($_POST['animal_type']);
        $animal_count = addslashes($_POST['animal_count']);
        $shade = addslashes($_POST['shade']);   
        $income = addslashes($_POST['income2']);
    } else if($occupation == "नोकरी"){
        $pr_gov = addslashes($_POST['pr_gov']);
        $income = addslashes($_POST['income3']);
    } else if($occupation == "धंदा"){
        $business_type = addslashes($_POST['business_type']);
        $income = addslashes($_POST['income4']);
    }
    
    $shg = addslashes($_POST['shg']);
    
    $remark = addslashes($_POST['remark']);    
    
     $query = mysqli_query($con,"INSERT INTO livelihood(occupationType,landArea,cropsType,animalType,animalCount,shade,private_government,businessType,income,shg,remark,memberId,dateTime,createdId)VALUES('$occupation','$area','$crops','$animal_type','$animal_count','$shade','$pr_gov','$business_type','$income','$shg','$remark','$memberId', '$dateTime', '$createdId')") or die ($con->error);
     
    $ownedLand = addslashes($_POST['ownedLand']);
    if($ownedLand == 1){
        $satbara = addslashes($_POST['satbara']);
        $area = addslashes($_POST['area']);
    } else {
        $landType = addslashes($_POST['landType']);    
    }
    $house = addslashes($_POST['house']);
    if($house == 1){
        $houseType = addslashes($_POST['houseType']);
        $roomNo = addslashes($_POST['roomNo']);
        $tapConnection = addslashes($_POST['tapConnection']);
        $electricityConnection = addslashes($_POST['electricityConnection']);
        $toiletFacility = addslashes($_POST['toiletFacility']);
        $gasConnection = addslashes($_POST['gasConnection']);
        $ifr_cfrDone = addslashes($_POST['ifr_cfrDone']);
        if($ifr_cfrDone == 0){
            $proposalDone = addslashes($_POST['proposalDone']);
            if($proposalDone == 0){
                $sendProposal = addslashes($_POST['sendProposal']);    
            }
        }
    } else {
        $ownHome = addslashes($_POST['ownHome']);
        if($ownHome == 1){
            $homeArea = addslashes($_POST['homeArea']);    
        }
    }
    
    $query = mysqli_query($con, "INSERT INTO landDetails (`familyId`, `memberId`, `ownedLand`, `satbara`, `landType`, `roomNo`,`area`, `house`, `houseType`, `tapConnection`,`electricityConnection`, `toiletFacility`, `gasConnection`, `ifr_cfrDone`, `proposalDone`,`sendProposal`, `ownHome`, `homeArea`, `createdId`, `dateTime`, `status`) VALUES ('$familyId', '$memberId', '$ownedLand', '$satbara', '$landType', '$roomNo','$area', '$house', '$houseType', '$tapConnection', '$electricityConnection', '$toiletFacility', '$gasConnection', '$ifr_cfrDone', '$proposalDone', '$sendProposal', '$ownHome', '$homeArea', '$createdId', '$dateTime', '1')") or die($con->error);
    
    $appledForPO = addslashes($_POST['appledForPO']);
    if($appledForPO == 1){
        foreach ($_POST['schemeName'] as $schemeName){
            $schemeName = addslashes($schemeName);
            if($schemeName != ''){
                $query = mysqli_query($con, "INSERT INTO schemesDetails (`memberId`, `appledForPO`, `name`, `remark`, `createdId`, `dateTime` ) VALUES ('$memberId', '$appledForPO', '$schemeName', '$remark', '$createdId', '$dateTime')") or die($con->error);
            }
        }
    }
    
    
    //Msg
    if($query){
        $status = true;
        $msg = " परिवार जोडा यशस्वीरित्या सबमिट केली गेली आहे";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: details?familyId='.$familyId);
}
?>