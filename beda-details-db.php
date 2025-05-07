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
    $remark = addslashes($_POST['remark']);
    $createdId = $_SESSION['userId'];
    $dateTime = date('Y-m-d H:i:s');
    
    $query = mysqli_query($con, "INSERT INTO bedaDetails (`name`, `village`, `taluka`, `district`, `gutGramPanchayat`, `waterTank`, `tapSupply`, `electricityConnection`, `constructedRoad`, `remark`, `createdId`, `dateTime`, `status`) VALUES ('$name', '$village', '$taluka', '$district', '$gutGramPanchayat', '$waterTank', '$tapSupply', '$electricityConnection', '$constructedRoad', '$remark', '$createdId', '$dateTime', '1')") or die($con->error);
    
    //Msg
    if($query){
        $status = true;
        $msg = " बेडाची माहिती यशस्वीरित्या सबमिट केली गेली आहे";
    } else {
        $status = false;
        $msg = "Sorry, Data can't be submit. Please try again";
    }
    
    setSession($status, $msg);
    header('location: beda-report');
}
?>