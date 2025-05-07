<?php 
session_start();
if(!isset($_SESSION['userId'])){
    header('location:index');
}
include('include/sweetAlert.php');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .active .icon i {
        color: #fff !important;
    }
    
    .navbar-vertical .navbar-nav .nav-item .nav-link .icon i {
        color: #000 !important;
    }
    
    @media screen and (min-width: 1024px) {
        .header-img {
            width: 25rem;
        }
    }
</style>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header" style="overflow: hidden;">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0">
            <span class="ms-1 font-weight-bold">सर्वेक्षण व नोंदणी पोर्टल</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="w-auto " id="">
        <ul class="navbar-nav">
            <?php 
            if($_SESSION['userId'] == "user_id001"){
                $home = "admin-dashboard";
            ?>
            <li class="nav-item">
                <a class="nav-link  active" href="admin-dashboard">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <?php 
            } else {
                $home = "family-report";
            }
            ?>
            
            <li class="nav-item">
                <a class="nav-link " href="beda-select">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02"></i>
                    </div>
                    <span class="nav-link-text ms-1">परिवार जोडा</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="family-report2">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <span class="nav-link-text ms-1">पारिवारीक माहिती</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="individual-list">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-building-add"></i>
                    </div>
                    <span class="nav-link-text ms-1">Allocate Family</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link  " href="report2">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67"></i>
                    </div>
                    <span class="nav-link-text ms-1">रिपोर्ट</span>
                </a>
            </li>
            
            <!--<li class="nav-item">
                <a class="nav-link  " href="parameter-report">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-ui-04"></i>
                    </div>
                    <span class="nav-link-text ms-1">Parameter Wise Report</span>
                </a>
            </li>-->
            
            
            <!--<li class="nav-item">
                <a class="nav-link" href="uploadedFiles/new%20PDF.pdf">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-ui-04"></i>
                    </div>
                    <span class="nav-link-text ms-1">पारधी लाभार्थ्यांची यादी</span>
                </a>
            </li>-->
        </ul>
    </div>
</aside>
<main class="main-content position-relative border-radius-lg ps">
    

<nav class="" id="navbarBlur" navbar-scroll="true" style="padding:0px">
    <div class="container-fluid px-3" >
        <img src="media/itdpK_logo.jpg?v=1" class="img-fluid header-img">
    </div>
</nav>
<!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <div class="collapse navbar-collapse mt-sm-0 me-md-0 me-sm-4" id="navbar" style="justify-content:flex-end">
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link text-body font-weight-bold px-0" href="<?php echo $home ?>">
                                <i class="bi bi-house" style="font-size: 18px;"></i>
                                <span class="d-sm-inline d-none">Home</span>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center ps-3">
                            <a onclick="loginfun('logout')" class="nav-link text-body font-weight-bold px-0">
                                <i class="bi bi-power " style="font-size: 18px;"></i>
                                <span class="d-sm-inline d-none">Log Out</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
<!--<script -->
</main>