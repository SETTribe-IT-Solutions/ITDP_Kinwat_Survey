<?php
session_start();
include('include/con.php');
if(isset($_POST['submit'])){
    require_once('include/sweetAlert.php');
    $familyId = $_POST['familyId'];
    $memberId = $_POST['memberId'];
    $ownedLand = addslashes($_POST['ownedLand']);
    // $satbara = addslashes($_POST['satbara']);
    
    $satbara=addslashes($_FILES["satbara"]["name"]);
    $tempname=$_FILES["satbara"]["tmp_name"];
    $folder="uploadedFiles/".$filename;
    move_uploaded_file($tempname,$folder);
    
    
    $landType = addslashes($_POST['landType']);
    $house = addslashes($_POST['house']);
    
    $houseType = addslashes($_POST['houseType']);
    $area = addslashes($_POST['area']);
    $roomNo = addslashes($_POST['roomNo']);
    $tapConnection = addslashes($_POST['tapConnection']);
    $electricityConnection = addslashes($_POST['electricityConnection']);
    $toiletFacility = addslashes($_POST['toiletFacility']);
    $gasConnection = addslashes($_POST['gasConnection']);
    $ifr_cfrDone = addslashes($_POST['ifr_cfrDone']);
    $proposalDone = addslashes($_POST['proposalDone']);
    $sendProposal = addslashes($_POST['sendProposal']);
    $ownHome = addslashes($_POST['ownHome']);
    $homeArea = addslashes($_POST['homeArea']);
    
    $landToSold = addslashes($_POST['landToSold']);
    $landToSoldArea = addslashes($_POST['landToSoldArea']);
    // $landToSoldSatbara = addslashes($_POST['landToSoldSatbara']);
    $landToSoldSatbara=addslashes($_FILES["landToSoldSatbara"]["name"]);
    $tempname=$_FILES["landToSoldSatbara"]["tmp_name"];
    $folder="uploadedFiles/".$filename;
    move_uploaded_file($tempname,$folder);
    
    
    $createdId = $_SESSION['userId'];
    $dateTime = date('Y-m-d H:i:s');
    
    $q = mysqli_query($con, "SELECT * FROM landDetails WHERE memberId = '$memberId'");
    if(mysqli_num_rows($q) > 0){
        $q = mysqli_query($con, "DELETE FROM landDetails WHERE memberId = '$memberId'");
    }
    
    $query = mysqli_query($con, "INSERT INTO landDetails (`familyId`, `memberId`, `ownedLand`, `satbara`, `landType`, `roomNo`,`area`, `house`, `houseType`, `tapConnection`,`electricityConnection`, `toiletFacility`, `gasConnection`, `ifr_cfrDone`, `proposalDone`,`sendProposal`, `ownHome`, `homeArea`, `landToSold`, `landToSoldArea`, `landToSoldSatbara` ,`createdId`, `dateTime`, `status`) VALUES ('$familyId', '$memberId', '$ownedLand', '$satbara', '$landType', '$roomNo','$area', '$house', '$houseType', '$tapConnection', '$electricityConnection', '$toiletFacility', '$gasConnection', '$ifr_cfrDone', '$proposalDone', '$sendProposal', '$ownHome', '$homeArea', '$landToSold', '$landToSoldArea', '$landToSoldSatbara', '$createdId', '$dateTime', '1')") or die($con->error);
    
    
    
    //Msg
    if($query){
        $status = true;
        $msg = " घर/शेती माहिती यशस्वीरित्या सबमिट केली गेली आहे";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: schemes-details?familyId='.$familyId.'&memberId='.$memberId);
}
?>