<?php
session_start();
include('include/con.php');
include('include/sweetAlert.php');

$familyId = addslashes($_POST['familyId']);
$education = addslashes($_POST['education']);


$degreeName = addslashes($_POST['degreeName']);


$registerBalAargya = addslashes($_POST['registerBalAargya']);

$anganwadiName = addslashes($_POST['anganwadiName']);

$wantToRegister = addslashes($_POST['wantToRegister']);

$goToSchool = addslashes($_POST['goToSchool']);

$reasonNoGoschool = addslashes($_POST['reasonNoGoschool']);

$schoolName = addslashes($_POST['schoolName']);

$schoolType = addslashes($_POST['schoolType']);

$remark = addslashes($_POST['remark']);

$memberId = addslashes($_POST['memberId']);
$createdId = $_SESSION['userId'];
$dateTime = date('Y-m-d H:i:s');


$childcareCenter = $_POST['childcareCenter'];

$q = mysqli_query($con, "SELECT * FROM educationDetails WHERE memberId = '$memberId'");
if(mysqli_num_rows($q) >0 ){
    $q = mysqli_query($con, "DELETE FROM educationDetails WHERE memberId = '$memberId'");
}

$query = mysqli_query($con,"INSERT INTO educationDetails(education,degreeName,registerBalAargya,anganwadiName,wantToRegister,goToSchool,reasonNoGoschool,schoolName,schoolType,childcareCenter,remark,memberId,createdId,dateTime)VALUES('$education','$degreeName','$registerBalAargya','$anganwadiName','$wantToRegister','$goToSchool','$reasonNoGoschool','$schoolName','$schoolType','$childcareCenter','$remark','$memberId', '$createdId', '$dateTime')")or die ($con->error);

    $q = mysqli_query($con, "SELECT dob FROM familyDetails WHERE memberId = '$memberId'");
    $r = mysqli_fetch_assoc($q);
    $bday = $r['dob'];                            
    $dob = new DateTime($bday);
    $now = new DateTime();
    $diff = $now->diff($dob);
    $age = $diff->y;

//Msg
    if($query){
        $status = true;
        $msg = "शिक्षण माहिती यशस्वीरित्या सबमिट केली गेली आहे";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    if($age >= 18){
        header('location: livelyhood_details?familyId='.$familyId.'&memberId='.$memberId);    
    } else {
        header('location: schemes-details?familyId='.$familyId.'&memberId='.$memberId);    
    }

?>

<!--<script>
     alert("Data Added Successfully.");
    window.location = 'education-details.php';
</script>-->