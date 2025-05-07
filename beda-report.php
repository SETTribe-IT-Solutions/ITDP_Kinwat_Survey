<?php 
session_start();
include('include/con.php');
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
    
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php
    include('include/side-navbar.php');
    ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h4 class="card-title">बेडा माहिती</h4>
                            <a href="beda-details"><button class="btn btn-info" type="button">बेडा भरा</button></a>
                        </div>
                        <div class="card-body p-3">
                            <div class="conatiner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">

                                            <table id="example" class="table" style="width:100%">
                                                <thead>
                                                    <tr style="background-color:#415a8c; color:#f7f8fa ;">
                                                        <th>बेडा :</th>
                                                        <!--<th>Village:</th>-->
                                                        <th>तालुका:</th>
                                                        <th>जिल्हा:</th>
                                                        <!--<th>Gut Gram Panchayat:</th>-->
                                                        <th>पाण्याची टाकी?:</th>
                                                        <th>नळ कनेक्शन?:</th>
                                                        <th>वीज कनेक्शन?:</th>
                                                        <th>पक्का रस्ता?:</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con,"SELECT `srNo`, `name`, `village`, `taluka`, `district`, `gutGramPanchayat`, `waterTank`, `tapSupply`, `electricityConnection`, `constructedRoad`, `remark`, `createdId`, `dateTime` FROM `bedaDetails` WHERE 1") or die("errror");
                                                    while($fetch = mysqli_fetch_assoc($query)){
                                                        if($fetch['waterTank'] == 1){
                                                            $fetch['waterTank'] = 'होय';
                                                        } else {
                                                            $fetch['waterTank'] = 'नाही';
                                                        }
                                                        
                                                        if($fetch['tapSupply'] == 1){
                                                            $fetch['tapSupply'] = 'होय';
                                                        } else {
                                                            $fetch['tapSupply'] = 'नाही';
                                                        }
                                                        
                                                        if($fetch['electricityConnection'] == 1){
                                                            $fetch['electricityConnection'] = 'होय';
                                                        } else {
                                                            $fetch['electricityConnection'] = 'नाही';
                                                        }
                                                        
                                                        if($fetch['constructedRoad'] == 1){
                                                            $fetch['constructedRoad'] = 'होय';
                                                        } else {
                                                            $fetch['constructedRoad'] = 'नाही';
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $fetch['name'] ?>
                                                        </td>
                                                        <!--<td>
                                                            <?php echo $fetch['village'] ?>
                                                        </td>-->
                                                        
                                                        <td>
                                                            <?php echo $fetch['taluka'] ?>
                                                        </td>
                                                        
                                                        <td>
                                                            <?php echo $fetch['district'] ?>
                                                        </td>
                                                        <!--<td>
                                                            <?php echo $fetch['gutGramPanchayat'] ?>
                                                        </td>-->
                                                        <td>
                                                            <?php echo $fetch['waterTank'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $fetch['tapSupply'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $fetch['electricityConnection'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $fetch['constructedRoad'] ?>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                        $dataTable .= "<script>
                                                                            $(document).ready(function () {
                                                                                
                                                                                /*$('#memberTable".$familyId."').DataTable({
                                                                                    'responsive': true,
                                                                                    'bPaginate': false,
                                                                                    'bFilter': false,
                                                                                    'bInfo': false
                                                                                });*/
                                                                            });    
                                                                            
                                                                        </script>";
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
        $(document).ready(function () {
            $('#example').DataTable({
                'responsive': true
            });
        });
    </script>
</body>

</html>