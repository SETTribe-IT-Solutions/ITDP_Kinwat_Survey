<?php
session_start();
include('include/con.php');
if(isset($_POST['submit'])){
    require_once('include/sweetAlert.php');
    $familyId = $_POST['familyId'];
    $memberId = $_POST['memberId'];
    $createdId = $_SESSION['userId'];
    $dateTime = date('Y-m-d H:i:s');
    $appledForPO = addslashes($_POST['appledForPO']);
    
    $pmKisan = addslashes($_POST['pmKisan']);
    $sanjayGandhiNiradhar = addslashes($_POST['sanjayGandhiNiradhar']);
    $jandhanBank = addslashes($_POST['jandhanBank']);
    
    if(isset($_POST['gharkul'])){
        
        $q = mysqli_query($con, "SELECT * FROM schemesDetails WHERE memberId = '$memberId' AND gharkul != ''");
        if(mysqli_num_rows($q) > 0){
            $q = mysqli_query($con, "DELETE FROM schemesDetails WHERE memberId = '$memberId' AND gharkul != ''");
        }
        
        $gharkul = $_POST['gharkul'];
        
        if($gharkul == 1){
            $gharkulHouse = $_POST['gharkulHouse'];
            if($needGharkul == 0){
                $reason = $_POST['reason'];
            }
            
        } else {
            $needGharkul = $_POST['needGharkul'];
        }
        
        $query = mysqli_query($con, "INSERT INTO schemesDetails (`memberId`, `gharkul`, `needGharkul`, `gharkulHouse`, `reason`) VALUES ('$memberId', '$gharkul', '$needGharkul', '$gharkulHouse', '$reason')");
    }
    
    $q = mysqli_query($con, "SELECT * FROM schemesDetails WHERE memberId = '$memberId'");
    if(mysqli_num_rows($q) <= 0){
        $query = mysqli_query($con, "INSERT INTO schemesDetails (`memberId`, `pmKisan`, `sanjayGandhiNiradhar`, `jandhanBank`, `createdId`, `dateTime` ) VALUES ('$memberId', '$pmKisan', '$sanjayGandhiNiradhar', '$jandhanBank', '$createdId', '$dateTime')")  or die($con->error);
    } else {
        $query = mysqli_query($con, "UPDATE schemesDetails SET `pmKisan` = '$pmKisan', `sanjayGandhiNiradhar` = '$sanjayGandhiNiradhar', `jandhanBank` = '$jandhanBank', `createdId` = '$createdId', `dateTime` = '$dateTime' WHERE memberId = '$memberId'")  or die($con->error);
    }

    foreach ($_POST['schemeName'] as $schemeName){
        $schemeName = addslashes($schemeName);
        if($schemeName != ''){
            $query = mysqli_query($con, "INSERT INTO schemesDetails (`memberId`, `appledForPO`, `name`, `remark`, `createdId`, `dateTime` ) VALUES ('$memberId', '$appledForPO', '$schemeName', '$remark', '$createdId', '$dateTime')") or die($con->error);
        }
    }
    
    //Msg
    if($query){
        $status = true;
        $msg = " योजनांची माहिती यशस्वीरित्या सबमिट केली ";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: family-details?familyId='.$familyId);
}
?>