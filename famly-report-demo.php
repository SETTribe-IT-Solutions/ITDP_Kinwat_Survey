<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   
             
           <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
          <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <!--data table end-->
    
    
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <title>
       Family List
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.8" rel="stylesheet" />
    
    
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php
    include('include/side-navbar.php');
    ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"></a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Family List</li>
                    </ol>
                    <!--<h6 class="font-weight-bolder mb-0">Dashboard</h6>-->
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign In</span>
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
        <div class="container-fluid py-4">

            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Family List</h4>
                            <a href="family-details"><button class="btn btn-info" type="button">Add Family</button></a>
                        </div>
                        <div class="card-body p-3">
                            <div class="conatiner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                
                             <table id="example" class="table" style="width:100%">
        <thead>

               
            <tr>
                
                <th>Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>MO.NO</th>
                <th>Education</th>
                <th>Action</th>
             
            </tr>
            
        </thead>
        <tbody>
                        <?php
            include('include/con.php');
            
            $query = mysqli_query($con,"SELECT * FROM familyDetails") or die("errror");
            while($fetch = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td><?php echo $fetch['name'] ?></td>
                     <td style="text-transform:capitalize"><?php echo $fetch['gender'] ?></td>
                      <td><?php echo date('d-m-Y', strtotime($fetch['dob'])); ?></td>
                       <td><?php echo $fetch['mobileNo'] ?></td>
                        <td><?php echo $fetch['eduction'] ?></td>
                        <td>
                            <a href="education-details"><button class="btn btn-primary" type="button">Education</button></a>
                            <a href=" livelyhood_details"><button class="btn btn-primary" type="button">Livelihood Details</button></a>
                            <a href="land-details"><button class="btn btn-primary" type="button">Land Details</button></a>
                             <!--<a href="education-details.php"><button class="btn btn-primary"></button></a>-->
                        </td>
                </tr>
                
                 <?php
            }
            ?>
        </tbody>
           
    </table>
    </div>
    </div></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('include/footer.php'); ?>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/js/plugins/chartjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        $("#disabledCertificateDiv").hide();
        $("input[name=disabled_handicap]").on('click', function () {
            if ($(this).val() == "1") {
                $("#disabledCertificateDiv").show();
            } else {
                $("#disabledCertificateDiv").hide();
            }
        })
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
    
    <?php 
    
    require_once('include/sweetAlert.php');
    if(isset($_SESSION['status'])){
        $status = $_SESSION['status'];
        $msg = $_SESSION['msg'];
        if($status != true){
            toastMsg('error', $msg);
        } else {
            toastMsg('success', $msg);
        }
        unset($_SESSION['status']);
        unset($_SESSION['msg']);
    }
    
    ?>
   <script>
   $(document).ready(function () {
    $('#example').DataTable();
});
</script>
</body>

</html>
 

