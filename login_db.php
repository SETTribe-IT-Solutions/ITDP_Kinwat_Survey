<?php 
session_start();
include('include/con.php');
if(isset($_POST['login'])){
    include('include/sweetAlert.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $q = mysqli_query($con, "SELECT username, password, user_id FROM users WHERE username = '$username' AND password = '$password'");
    if(mysqli_num_rows($q)>0){
        $r = mysqli_fetch_assoc($q);
        if($r['username'] == $username && $r['password'] == $password){
            $_SESSION['userId'] = $r['user_id'];
            if($r['username'] == "admin"){
                header('location: admin-dashboard');
            } else {
                header('location:family-report');    
            }
        } else {
            $status = false;
            $msg = "Invalid Username or password. Please try again";
            
            setSession($status, $msg);
            
            header('location:login');
        }
    } else {
        $status = false;
        $msg = "Invalid Username or password. Please try again";
        
        setSession($status, $msg);
        
        header('location:login');
    }
    
}
?>