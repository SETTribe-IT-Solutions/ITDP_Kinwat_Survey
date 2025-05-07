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
                            <h4 class="card-title">पारधी लाभार्थ्यांची यादी</h4>
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
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="taluka" style="font-size:20px;" >तालुका</label>
                                                <select  name="taluka" class="form-control"  id="taluka" onchange="fetch()">
                                                    <option value="" selected="" disabled="">-- तालुका निवडा --</option>
                                                    <?php
                                                    $q = mysqli_query($con, "SELECT DISTINCT taluka FROM benefiter_data");
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
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="village" style="font-size:20px;">गावा</label>
                                                <select  name="taluka" class="form-control"  id="gaav">
                                                    <option value="" selected="" disabled="">-- गावा निवडा --</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <table class="table table-responsive" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>अ.क्र. योजना निहाय</th>
                                                <th>लाभार्थ्याचे नांव</th>
                                                <th>गावाचे नांव </th>
                                                <th>तालूका</th>
                                                <th>जात</th>
                                                <th>योजनेचे नांव</th>
                                                <th>सन</th>
                                                <th>रक्कम</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
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
    
        $("#taluka").on('change', function(){
            var taluka = $(this).val();
            if(taluka != ""){
                $.ajax({
                    url  : 'benefiter-report-ajax',
                    type : 'POST',
                    data : {taluka:taluka},
                    success:function(data){
                        
                    }
                })
            }
        })
        
        $(document).ready(function(){
            var dataTable = $('#dataTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'benefiter-report-ajax?dataTable=',
                    'data': function(data){
                        var district = $('#district').val();
                        data.district = district;
                    }
                },
                'responsive': true,
                'columns': [
                    {data:'yojana_sr_no'},
                    {data:'benefiter_name'},
                    {data:'village'},
                    {data:'taluka'},
                    {data:'caste'},
                    {data:'yojana_name'},
                    {data:'year'},
                    {data:'amount'},
                ]
            });
            dataTable.draw();
        });
        
        
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
    <script>
        function fetch(){
    var taluka = document.getElementById("taluka").value;
    $.ajax('fetch_data.php', {
    type: 'POST',  // http method
    data: { taluka: taluka},  // data to submit
    success: function (data) {
        
       document.getElementById('gaav').innerHTML = data;
   
    }
});

}
    </script>
</body>

</html>