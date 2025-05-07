<?php
session_start();

include('include/con.php');
include('include/sweetAlert.php');

$occupation = addslashes($_POST['occupation']);
$familyId = addslashes($_POST['familyId']);
$owned = addslashes($_POST['owned']);


if($owned=='1'){
    $area = addslashes($_POST['area']);
    $crops = addslashes($_POST['crops']);
    $income = addslashes($_POST['income']);
}
else{
    $area = '';
    $crops = '';
    $income = '';
    
}


$animal_type = addslashes($_POST['animal_type']);

$animal_count = addslashes($_POST['animal_count']);

$shade = addslashes($_POST['shade']);


if($occupation=='Farmer'){
     $income = addslashes($_POST['income1']);
}elseif($occupation=='Livestacle'){
     $income = addslashes($_POST['income2']);
}elseif($occupation=='Salaied'){
     $income = addslashes($_POST['income3']);
}elseif($occupation=='Business'){
     $income = addslashes($_POST['income4']);
}


$pr_gov = addslashes($_POST['pr_gov']);

$business_type = addslashes($_POST['business_type']);

$shg = addslashes($_POST['shg']);

$gharkul = $_POST['gharkul'];

$remark = addslashes($_POST['remark']);
$memberId = addslashes($_POST['memberId']);
$dateTime = date('Y-m-d H:i:s');
$createdId = $_SESSION['userId'];

$q = mysqli_query($con, "SELECT count(memberId) as 'memberId' FROM livelihood WHERE memberId = '$memberId'");
if(mysqli_num_rows($q) > 0){
    $q = mysqli_query($con, "DELETE FROM `livelihood` WHERE memberId = '$memberId'");
}

$query = mysqli_query($con,"INSERT INTO livelihood(occupationType,ownedLand,landArea,cropsType,animalType,animalCount,shade,private_government,businessType,income,shg,gharkul,remark,memberId,dateTime,createdId)VALUES('$occupation','$owned','$area','$crops','$animal_type','$animal_count','$shade','$pr_gov','$business_type','$income','$shg','$gharkul','$remark','$memberId', '$dateTime', '$createdId')");

//Msg
    if($query){
        $status = true;
        $msg = "राहणीमान माहिती यशस्वीरित्या सबमिट केली गेली आहे";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: land-details?familyId='.$familyId.'&memberId='.$memberId);

?>
