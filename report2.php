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
        Family Report
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
        @media screen and (max-width: 600px) {
            .mobile {
                display:none;
            }
        }
        
        @media screen and (max-width: 640px)
.dataTables_wrapper .dataTables_filter {
    margin-top: 0.5em;
}
@media screen and (max-width: 640px)
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: center;
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
                            <h4 class="card-title">अहवाल</h4>
                        </div>
                        <div class="card-body p-3">
                            <div class="conatiner">
                                <?php 
                                if(isset($_GET['download'])){
                                    $display = "display:none;";
                                ?>
                                <h4>Pardhi Survey Form file download.</h4>
                                <p>File is downloaded on your device. Kindly check Downloads section of your browser if
                                    you are unable to locate the file.</p>
                                <button type="button" class="btn btn-primary"
                                    onclick="ExportToExcel('xlsx')">Download</button>
                                <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <h6 class="form-control-label" for="aadharNo">तालुका</h6>
                                                        <!--<input type="text" class="form-control" id="" name="taluka">-->
                                                        <select name="taluka" class="form-control"  id="taluka">
                                                            <option value="" selected="" >-- तालुका निवडा --</option>
                                                            <?php
                                                            $q = mysqli_query($con, "SELECT DISTINCT taluka FROM master");
                                                            while($r = mysqli_fetch_assoc($q)){
                                                                if($_REQUEST['taluka'] == $r['taluka']){
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                            ?>
                                                            <option value="<?php echo $r['taluka'] ?>" <?php echo $selected ?>><?php echo $r['taluka'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <h6 class="form-control-label" for="name">गाव</h6>
                                                        <!--<input type="text" class="form-control" id="name" name="name">-->
                                                        <select name="beda" class="form-control"  id="name">
                                                            <option value="" selected >-- गाव निवडा --</option>
                                                            <?php
                                                            if(isset($_REQUEST['taluka'])){
                                                                $taluka = $_REQUEST['taluka'];
                                                                $q = mysqli_query($con, "SELECT beda FROM master WHERE taluka = '$taluka'");
                                                                while($r = mysqli_fetch_assoc($q)){
                                                                    if($_REQUEST['beda'] == $r['beda']){
                                                                        $selected = "selected";
                                                                    } else {
                                                                        $selected = "";
                                                                    }
                                                            ?>
                                                            <option  value="<?php echo $r['beda'] ?>" <?php echo $selected ?>><?php echo $r['beda'] ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        
                                                        <div id="otherBeda">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-2" style="display: flex;align-items: flex-end;">
                                                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary mobile" style="<?php echo $display ?>"
                                            onclick="ExportToExcel('xlsx')"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">तालुका</th>
                                                        <th rowspan="2">गाव</th>
                                                        <th rowspan="2">लोकसंख्या</th>
                                                        <?php
                                                        $questionIds = array();
                                                        $q = mysqli_query($con, "SELECT * FROM questionsMaster WHERE type = 'yes_no'");
                                                        while($r = mysqli_fetch_assoc($q)){
                                                            array_push($questionIds, $r['id']);
                                                        ?>
                                                        <th colspan="2"><?php echo $r['question'] ?></th>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                        foreach ($questionIds as $questionId) {
                                                        ?>
                                                        <th>हो</th>
                                                        <th>नाही</th>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    if(isset($_GET['taluka']) && !empty($_GET['taluka'])){
                                                        $talukaCondition = "AND taluka = '".$_GET['taluka']."'";
                                                    } else {
                                                        
                                                    }
                                                    
                                                    if(isset($_GET['beda']) && !empty($_GET['beda'])){
                                                        $bedaCondition = "AND beda = '".$_GET['beda']."'";;
                                                    }
                                                    
                                                    
                                                    
                                                    $q = mysqli_query($con, "SELECT DISTINCT taluka FROM master WHERE 1 $talukaCondition");
                                                    while($r = mysqli_fetch_assoc($q)){
                                                        $taluka = $r['taluka'];
                                                        
                                                        $q0 = mysqli_query($con, "SELECT beda FROM master WHERE taluka = '$taluka' $bedaCondition ");
                                                        while($r0 = mysqli_fetch_assoc($q0)){
                                                        $beda = $r0['beda'];
                                                        
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $taluka ?></td>
                                                        <td><?php echo $beda ?></td>
                                                        <td>
                                                            <?php
                                                            $q2 = mysqli_query($con, "SELECT COUNT(memberId) as population FROM familyDetails WHERE taluka = '$taluka' AND beda = '$beda'");
                                                            $r2 = mysqli_fetch_assoc($q2);
                                                            echo $r2['population'];
                                                            ?>
                                                        </td>
                                                        <?php
                                                        foreach ($questionIds as $questionId) {
                                                            foreach ([1, 0] as $answer){
                                                                $q3 = mysqli_query($con, "SELECT COUNT(memberId) as 'answerCount' FROM questionsAnswer WHERE questionId = $questionId AND answer = $answer AND taluka = '$taluka' AND beda = '$beda'");
                                                                $r3 = mysqli_fetch_assoc($q3);
                                                                $answerCount = $r3['answerCount']
                                                                ?>
                                                                <td><?php echo $answerCount ?></td>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    <?php
                                                        }
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
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

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
        <?php 
        if (isset($_GET['download'])) {
        ?>
                ExportToExcel('XLSX');
        <?php
        }
        ?>

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('dataTables-example');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('Pardhi Suvery Form.' + (type || 'xlsx')));
        }
        
        $("#taluka").on('change', function(){
            var taluka = $(this).val();
            $("#name").html("Please Wait");
            $.ajax({
                type : 'POST',
                url  : 'beda-details-db',
                data : {talukaS:taluka},
                success:function(data){
                    $("#name").html(data);
                }
            })
        })
    </script>
</body>

</html>