<?php 
session_start();
include('include/con.php');
$userId = $_SESSION['userId'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--data table-->

    <!--data table end-->



    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <!--<title>
        Parameter Report
    </title>-->
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.10" rel="stylesheet" />
    
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">

    <style>
        .table thead th{
            font-size: 16px !important;
            color: #344767 !important;
        }
        .table thead th, .center{
            text-align:center !important;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php
    include('include/side-navbar.php');
    ?>
    <main class="main-content position-relative border-radius-lg ">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Report</h4>
                        </div>
                        
                        <div class="card-body p-3">
                            <div class="conatiner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a onclick="window.history.back();">
                                            <button type="button" class="btn btn-primary">Back</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table table-responsive" id="example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>नाव</th>
                                                <th>आधार क्र.</th>
                                                <th>जात </th>
                                                <th>जन्म दिनांक</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $srNo = 1;
                                            if(isset($_GET['q'])){
                                                if(isset($_GET['beda']) && !empty($_GET['beda'])){
                                                    $bedaFilter = " AND beda = '{$_GET['beda']}'";
                                                }
                                                $sql = base64_decode($_GET['q']).$bedaFilter;
                                            }
                                            $q = mysqli_query($con, $sql);
                                            while($r = mysqli_fetch_assoc($q)){
                                                $q1 = mysqli_query($con, "SELECT familyId FROM familyDetails WHERE memberId = '{$r['memberId']}'");
                                                $r1 = mysqli_fetch_assoc($q1);
                                                $familyId = $r1['familyId'];
                                            ?>
                                            <tr>
                                                <td class="center"><?php echo $srNo++; ?></td>
                                                <td><?php echo $r['name'] ?></td>
                                                <td class="center"><?php echo $r['aadharNo'] ?></td>
                                                <td><?php echo $r['caste'] ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($r['dob'])); ?></td>
                                                <?php
                                                if($r['accountNo'] == "0"){
                                                ?>
                                                <td>
                                                    <a href="bank_details?familyId=<?php echo $familyId ?>&q=<?php echo $_GET['q'] ?>"><button type="button" class="btn btn-danger m-3">खाते क्रमांक जोडा</button></a>
                                                </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
        $("#casteCertificateDiv").hide();
        $("#casteCertificate").on('click', function () {
            if(!checkbox.isSelected()){
                console.log('Checked');
            }
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
    
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/datatables.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

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
    
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('dataTables-example');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('Pardhi Suvery Form.' + (type || 'xlsx')));
        }
        
        $(document).ready(function () {
            const dataTableBasic = new simpleDatatables.DataTable("#example", {
                fixedHeight: true
            });
            // $('#example').DataTable({
            //     'responsive': true
            // });
        });
    </script>
</body>

</html>