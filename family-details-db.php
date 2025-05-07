<?php
session_start();
include('include/con.php');
date_default_timezone_set('Aisa/Kolkata');
if(isset($_POST['submit'])){
    require_once('include/sweetAlert.php');
    $familyId = $_POST['familyId'];
    $q = mysqli_query($con, "SELECT count(*) as 'count' FROM familyDetails WHERE familyId = '$familyId'");
    $r = mysqli_fetch_assoc($q);
    $count = $r['count']+1; 
    
    if($_POST['familyHead'] == 1){
        $familyId = uniqid(); 
        $nextProc = "&familyId=".$familyId;
        $familyHead = 1;
    } else {
        $familyId = null;
    }
    
    if(!empty($_POST['familyId'])) {
        $familyId = $_POST['familyId'];
        $nextProc = "&familyId=".$familyId;
    }
    
    $memberId = uniqid();
    
    $lastName = addslashes($_POST['lastName']);
    $firstName = addslashes($_POST['firstName']);
    $middleName = addslashes($_POST['middleName']);
    $caste = addslashes($_POST['caste']);
    $gender = addslashes($_POST['gender']);
    
    
    $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
    
    $mobileNo = addslashes($_POST['mobileNo']);
    $localVillage = addslashes($_POST['localVillage']);
    $permanentVillage = addslashes($_POST['permanentVillage']);
    $createdId = $_SESSION['userId'];
    $dateTime = date('Y-m-d H:i:s');
    $taluka = $_POST['taluka'];
    $beda = $_POST['beda'];
    
    $name = $lastName." ".$firstName." ".$middleName;
    
    $query = mysqli_query($con, "INSERT INTO familyDetails 
    (`familyId`, `memberId`, `lastName`, `firstName`, `middleName`, `name`, `caste`, `localVillage`, `permanentVillage`, `gender`, `dob`, `mobileNo`, `familyHead`, `remark`, `createdId`, `dateTime`, `status`, `beda`, `taluka`) 
    VALUES 
    ('$familyId', '$memberId', '$lastName', '$firstName', '$middleName', '$name', '$caste', '$localVillage', '$permanentVillage', '$gender', '$dob', '$mobileNo', '$familyHead', '$remark', '$createdId', '$dateTime', '1', '$beda', '$taluka');");
    
    
    $questionIds = $_SESSION['questionIds'];
    
    foreach ($questionIds as $questionId) {
        $answer = $_POST['questionId'.$questionId];
        $query2 = mysqli_query($con, "
        INSERT INTO questionsAnswer (`questionId`, `answer`, `memberId`, `familyId`, `taluka`, `beda`, `userId`, `dateTime`)
        VALUES
        ('$questionId', '$answer', '$memberId', '$familyId', '$taluka', '$beda', '$createdId', '$dateTime');
        ");
    }
    
    // Msg
    if($query & $query2){
        $status = true;
        $msg = "माहिती यशस्वीरित्या भरली आहे.";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: family-details?taluka='.$taluka."&beda=".$beda.$nextProc);
}


?>