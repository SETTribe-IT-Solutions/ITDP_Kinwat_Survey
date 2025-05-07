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
    <main class="main-content position-relative border-radius-lg ">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h4 class="card-title">पारिवारीक माहिती</h4>
                            <a href="beda-select"><button class="btn btn-info" type="button">कुटुंब अ‍ॅड करा  </button></a>
                            <?php 
                            if(isset($_SESSION['token'])){
                            ?>
                            <a href="report?download=" target="_blank"><button type="button" class="btn btn-secondary">Download</button></a>
                            <?php 
                            }
                            ?>
                        </div>
                        <?php
                        /*$sql = "SELECT * FROM familyDetails ";
                        $result = mysqli_query($con, $sql) or die("query faield");
                        
                        while($row = mysqli_fetch_assoc($result)){
                            
                        }*/
                        
                        ?>
                        
                        <div class="card-body p-3">
                            <div class="conatiner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">

                                            <table id="example" class="table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>कुटुंब प्रमुख</th>
                                                        <th>Action : </th>
                                                        <th>सदस्य:</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    
                                                    <?php
                                                    if($_SESSION['userId'] == "user_id001"){
                                                        $query = mysqli_query($con,"SELECT DISTINCT(familyId), name FROM familyDetails WHERE memberId LIKE '%_1'") or die("errror");
                                                    } else {
                                                        $query = mysqli_query($con,"SELECT DISTINCT(familyId), name FROM familyDetails WHERE createdId = '$userId' AND memberID LIKE '%_1' GROUP BY familyId;") or die("errror");    
                                                    }
                                                    while($fetch = mysqli_fetch_assoc($query)){
                                                        $familyId = $fetch['familyId'];
                                                    ?>
                                                    
                                                    <tr>
                                                        <td>
                                                            <?php echo $fetch['name'] ?>
                                                        </td>
                                                        <td>
                                                            <a href="schemes-details?familyId=<?php echo $familyId ?>"><button type="button" class="btn btn-success m-3">योजनांचा लाभ</button></a>
                                                            
                                                            <a href="family-details?familyId=<?php echo $familyId ?>&member="><button type="button" class="btn btn-primary m-3">सदस्य जोडा
                                                            </button></a>
                                                            
                                                            <a href="family-photo?familyId=<?php echo $familyId ?>"><button type="button" class="btn btn-secondary m-3">परिवार छायाचित्र 
                                                            </button></a>
                                                            
                                                            <a href="bank_details?familyId=<?php echo $familyId ?>"><button type="button" class="btn btn-danger m-3">खाते क्रमांक जोडा  
                                                            </button></a>

                                                        </td>
                                                        <td>
                                                            <table class="table" id="memberTable<?php echo $familyId ?>">
                                                                <thead>
                                                                    <tr>
                                                                        <th>नाव</th>
                                                                        <th>लिंग</th>
                                                                        <th>जन्म तारिख</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $q = mysqli_query($con,"SELECT * FROM familyDetails WHERE familyId = '$familyId'") or die("errror");
                                                                    while($r = mysqli_fetch_assoc($q)){
                                                                        $memberId = $r['memberId'];
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php echo $r['name'] ?>
                                                                           <!--// <a href="schemes-details.php"><button type="button" class="btn">Scheme Detail</button></a>-->
                                                                        </td>
                                                                        <td style="text-transform: capitalize;">
                                                                            <?php echo $r['gender'] ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo date('d-m-Y', strtotime($r['dob'])); ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="education-details?memberId=<?php echo $memberId ?>"><button class="btn btn-primary"
                                                                                    type="button">शैक्षणिक माहिती</button></a>
                                                                                    
                                                                                    <?php 
                                                                                      $bday = $r['dob'];
                                        
                                        $dob = new DateTime($bday);
                                        $now = new DateTime();
                                        $diff = $now->diff($dob);
                                        $age = $diff->y;
                                                                                    if($age>18){
                                                                                        ?>
                                                                                     
                                                                            <a href=" livelyhood_details?memberId=<?php echo $memberId ?>"><button
                                                                                    class="btn btn-primary" type="button">राहणीमान
                                                                                    </button></a>
                                                                            <a href="land-details?memberId=<?php echo $memberId ?>"><button class="btn btn-primary"
                                                                                    type="button">घर / शेतीविषयक माहिती</button></a>
                                                                                       <?php
                                                                                    }
                                                                                    ?>
                                                                            <!--<a href="education-details.php"><button class="btn btn-primary"></button></a>-->
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
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