<?php
session_start();
include('include/con.php');

if(isset($_POST['talukaS'])){
    $taluka = $_POST['talukaS'];
    $q = mysqli_query($con, "SELECT beda FROM master WHERE taluka = '$taluka' ");
    ?>
    <option value="" selected="" disabled="">-- गाव निवडा --</option>
    <?php
    while($r = mysqli_fetch_assoc($q)){
    ?>
    <option value="<?php echo $r['beda'] ?>"><?php echo $r['beda'] ?></option>
    <?php
    }
    ?>
    <option value="other">इतर</option>
    <?php
    die();
}

if(isset($_POST['submit'])){
    require_once('include/sweetAlert.php');
    
    $name = addslashes($_POST['name']);
    $village = addslashes($_POST['village']);
    $taluka = addslashes($_POST['taluka']);
    $district = addslashes($_POST['district']);
    $gutGramPanchayat = addslashes($_POST['gutGramPanchayat']);
    $waterTank = addslashes($_POST['waterTank']);
    $tapSupply = addslashes($_POST['tapSupply']);
    $electricityConnection = addslashes($_POST['electricityConnection']);
    $constructedRoad = addslashes($_POST['constructedRoad']);
    $DoSEL = addslashes($_POST['DoSEL']);
    $DoSELShera = addslashes($_POST['DoSELShera']);
    $MoAYUSH = addslashes($_POST['MoAYUSH']);
    $MoAYUSHShera = addslashes($_POST['MoAYUSHShera']);
    $DoTelecom = addslashes($_POST['DoTelecom']);
    $DoTelecomShera = addslashes($_POST['DoTelecomShera']);
    $MoSDE = addslashes($_POST['MoSDE']);
    $MoSDEShera = addslashes($_POST['MoSDEShera']);
    $MeiTY = addslashes($_POST['MeiTY']);
    $MeiTYShera = addslashes($_POST['MeiTYShera']);
    $MoAFW = addslashes($_POST['MoAFW']);
    $MoAFWShera = addslashes($_POST['MoAFWShera']);
    $MoFAHD = addslashes($_POST['MoFAHD']);
    $MoFAHDShera = addslashes($_POST['MoFAHDShera']);
    $MoPR = addslashes($_POST['MoPR']);
    $MoPRShera = addslashes($_POST['MoPRShera']);
    $MoP = addslashes($_POST['MoP']);
    $MoPShera = addslashes($_POST['MoPShera']);
    $MoNRE = addslashes($_POST['MoNRE']);
    $MoNREShera = addslashes($_POST['MoNREShera']);
    $MoHFW = addslashes($_POST['MoHFW']);
    $MoHFWShera = addslashes($_POST['MoHFWShera']);
    $MoWCD = addslashes($_POST['MoWCD']);
    $MoWCDShera = addslashes($_POST['MoWCDShera']);
    $remark = addslashes($_POST['remark']);
    $createdId = $_SESSION['userId'];
    $dateTime = date('Y-m-d H:i:s');


    $query = mysqli_query($con, "INSERT INTO bedaDetails (
        `name`, `village`, `taluka`, `district`, `gutGramPanchayat`, `waterTank`, `tapSupply`, 
        `electricityConnection`, `constructedRoad`, `DoSEL`, `DoSELShera`, `MoAYUSH`, `MoAYUSHShera`, 
        `DoTelecom`, `DoTelecomShera`, `MoSDE`, `MoSDEShera`, `MeiTY`, `MeiTYShera`, `MoAFW`, `MoAFWShera`, 
        `MoFAHD`, `MoFAHDShera`, `MoPR`, `MoPRShera`, `MoP`, `MoPShera`, `MoNRE`, `MoNREShera`, 
        `MoHFW`, `MoHFWShera`, `MoWCD`, `MoWCDShera`, `remark`, `createdId`, `dateTime`, `status`
    ) VALUES (
        '$name', '$village', '$taluka', '$district', '$gutGramPanchayat', '$waterTank', '$tapSupply', 
        '$electricityConnection', '$constructedRoad', '$DoSEL', '$DoSELShera', '$MoAYUSH', '$MoAYUSHShera', 
        '$DoTelecom', '$DoTelecomShera', '$MoSDE', '$MoSDEShera', '$MeiTY', '$MeiTYShera', '$MoAFW', '$MoAFWShera', 
        '$MoFAHD', '$MoFAHDShera', '$MoPR', '$MoPRShera', '$MoP', '$MoPShera', '$MoNRE', '$MoNREShera', 
        '$MoHFW', '$MoHFWShera', '$MoWCD', '$MoWCDShera', '$remark', '$createdId', '$dateTime', '1'
    )") or die($con->error);
    
    
    //Msg
    if($query){
        $status = true;
        $msg = " बेडाची माहिती यशस्वीरित्या सबमिट केली गेली आहे";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: family-details-ayan.php');
}
?>