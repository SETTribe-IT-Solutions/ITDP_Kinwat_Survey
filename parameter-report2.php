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
    <title>
        Parameter Report
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
    
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">

    <style>
        .table thead th, .center{
            text-align:center;
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
                            <h4 class="card-title">Parameter Report</h4>
                        </div>
                        
                        <div class="card-body p-3">
                            <div class="conatiner">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <?php 
                                                foreach ($_REQUEST['parameter'] as $parameter){
                                                    $explode = explode(';', $parameter);
                                                    $parameter = $explode[0];
                                                    $value = $_REQUEST[$parameter];
                                                    
                                                    if($parameter == "casteCertificate" || $parameter == "disabled_handicap" || $parameter == "janAarogya" || $parameter == "niradhar"){
                                                        $tableName = "familyDetails";
                                                    } else if($parameter == "ownedLand" || $parameter == "shade" || $parameter == "pr_gov" || $parameter == "shg"){
                                                        $tableName = "livelihood";
                                                    } else if($parameter == "education"){
                                                        $tableName = "educationDetails";
                                                    } else if($parameter == "ownedFarm" || $parameter == "ghar"){
                                                        if($parameter == "ownedFarm"){
                                                            $parameter = "ownedLand";
                                                        }
                                                        $tableName = "landDetails";
                                                    }
                                                    
                                                    $filter .= " AND ".$tableName.".".$parameter." = '".$value."'";
                                                }
                                                
                                                $sql = "SELECT COUNT(DISTINCT(familyDetails.memberId)) as 'total' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE 1 $filter";
                                                
                                                $q = mysqli_query($con, $sql);
                                                $r = mysqli_fetch_assoc($q);
                                                $encryptedQuery = base64_encode("SELECT DISTINCT(familyDetails.memberId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE 1 $filter");
                                                ?>
                                                <h5 class="card-title">Total Entries - <a href="parameter-report-details?q=<?php echo $encryptedQuery; ?>"><?php echo $r['total'] ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <?php
                                                        foreach ($_REQUEST['parameter'] as $parameter){
                                                            $explode = explode(';', $parameter);
                                                            $parameter = $explode[0];
                                                            $value = $_REQUEST[$parameter];
                                                            if($value == "1"){
                                                                $val = "होय";
                                                            } else {
                                                                $val = "नाही";
                                                            }
                                                        ?>
                                                        <th><?php echo $explode[1]. " (".$val.")"; ?></th>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        foreach ($_REQUEST['parameter'] as $parameters){
                                                            $explode = explode(';', $parameters);
                                                            $parameter = $explode[0];;
                                                            $value = $_REQUEST[$parameter];
                                                            if($parameter == "casteCertificate" || $parameter == "disabled_handicap" || $parameter == "janAarogya" || $parameter == "niradhar"){
                                                                $tableName = "familyDetails";
                                                            } else if($parameter == "ownedLand" || $parameter == "shade" || $parameter == "pr_gov" || $parameter == "shg"){
                                                                $tableName = "livelihood";
                                                            } else if($parameter == "education"){
                                                                $tableName = "educationDetails";
                                                            } else if($parameter == "ownedFarm" || $parameter == "ghar"){
                                                                if($parameter == "ownedFarm"){
                                                                    $parameter = "ownedLand";
                                                                }
                                                                $tableName = "landDetails";
                                                            }
                                                            $q = mysqli_query($con, "SELECT COUNT($parameter) as '$parameter' FROM $tableName WHERE $parameter = '{$value}'");
                                                            $r =mysqli_fetch_assoc($q);
                                                        ?>
                                                        <td class="center"><a href="parameter-report-details?parameter=<?php echo $parameter."&".$parameter."=".$value."&tableName=".$tableName; ?>"><?php echo $r[$parameter]; ?></a></td>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </tbody>
                                            </table>    
                                        </div>
                                    </div>
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
    echo $dataTable;
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
            $('#example').DataTable({
                'responsive': true
            });
        });
    </script>
</body>

</html>