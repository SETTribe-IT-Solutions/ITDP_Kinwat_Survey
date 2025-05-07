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
            text-align: center;
        }
        
        .exportShow{
            display: none;
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
                            <h4 class="card-title">Parameter Wise Report</h4>
                        </div>
                        
                        <div class="card-body p-3">
                            <form action="parameter-report" method="GET">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5 class="form-control-label" for="aadharNo" style="font-size:20px;" >तालुका</h5>
                                            <!--<input type="text" class="form-control" id="" name="taluka">-->
                                            <select  name="taluka" class="form-control"  id="taluka">
                                                <option value="" selected="" disabled="">-- तालुका निवडा --</option>
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
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5 class="form-control-label" for="name">बेडा</h5>
                                            <!--<input type="text" class="form-control" id="name" name="name">-->
                                            <select name="beda" class="form-control"  id="name" >
                                                <option value="" selected disabled>-- बेडा निवडा --</option>
                                                <?php
                                                if(isset($_REQUEST['beda'])){
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
                                    
                                    <div class="col-md-3" >
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="casteCertificate;जात प्रमाणपत्र ?" class="form-check-input" id="casteCertificate">
                                            <label class="form-control-label" for="casteCertificate" style="font-size:13px;">जात प्रमाणपत्र ?</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3" >
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="accountNo;खाते क्रमांक ?" class="form-check-input" id="accountNo">
                                            <label class="form-control-label" for="accountNo" style="font-size:13px;">खाते क्रमांक ?</label>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-3" >
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]"  value="disabled_handicap;अपंग ?" class="form-check-input" id="disabled_handicap">
                                            <label class="form-control-label" for="disabled_handicap" style="font-size:13px;">अपंग ?</label>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="parameter[]" value="janAarogya;जनआरोग्य नोंदणी आहे का ?" id="janAarogya">
                                            <label class="form-control-label" for="janAarogya" style="font-size:13px;">जनआरोग्य नोंदणी आहे का ?</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="parameter[]" value="niradhar;निराधार ?" id="niradhar">
                                            <label class="form-control-label" for="niradhar" style="font-size:13px;">निराधार ?</label>
                                        </div>
                                    </div>
                                    
                                    
                                     <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]"   value="ownedLand;स्वतःची जागा आहे का ?" class="form-check-input" id="ownedLand">
                                            <label class="form-control-label" for="ownedLand" style="font-size:13px;">स्वतःची जागा आहे का ?</label>
                                        </div>
                                       
                                    </div>
                                  
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]"  value="shade;प्राण्यांसाठी शेड आहे का ?" class="form-check-input" id="shade">
                                            <label class="form-control-label" for="shade" style="font-size:13px;">प्राण्यांसाठी शेड आहे का ?</label>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="private_government;नोकरी ?" class="form-check-input" id="private_government">
                                            <label class="form-control-label" for="private_government" style="font-size:13px;">नोकरी ?</label>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="shg;बचत गटाचे सदस्य आहात काय ?" class="form-check-input" id="shg">
                                            <label class="form-control-label" for="shg" style="font-size:13px;">बचत गटाचे सदस्य आहात काय ?</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="parameter[]" value="education;शिक्षण ?" id="education">
                                            <label class="form-control-label" for="education" style="font-size:13px;">शिक्षण ?</label>
                                        </div>
                                        
                                        
                                        <div class="form-group" style="display: none" id="educationDiv">
                                            <select name="education" class="form-control">
                                                <option value="" selected="" disabled="">-- शिक्षण निवडा --</option>
                                                <option value="Primary school">Primary school</option> 
                                                <option value="Secondary school">Secondary school</option>
                                                <option value="10 Pass">10 Pass</option>
                                                <option value="12 Pass">12 Pass</option>
                                                <option value="Degree">Degree</option>
                                                <option value="Illiterate">Illiterate</option>
                                                <option value="other">इतर</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="goToSchool;शाळेत जातो / जाते का ?" class="form-check-input" id="goToSchool">
                                            <label class="form-control-label" for="goToSchool" style="font-size:13px;">शाळेत जातो / जाते का ?</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="registerBalAargya;बाल आरोग्य नोंदणी आहे का ?" class="form-check-input" id="registerBalAargya">
                                            <label class="form-control-label" for="registerBalAargya" style="font-size:13px;">बाल आरोग्य नोंदणी आहे का ?</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="childcareCenter;बाल आरोग्य नोंदणी आहे का ?" class="form-check-input" id="childcareCenter">
                                            <label class="form-control-label" for="childcareCenter" style="font-size:13px;">बालसंस्कार केंद्रामध्ये जातो का ?</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="appledForPO;प्रकल्प कार्यालयाचे लाभार्थी आहात काय ?" class="form-check-input" id="appledForPO">
                                            <label class="form-control-label" for="appledForPO" style="font-size:13px;">प्रकल्प कार्यालयाचे लाभार्थी आहात काय ?</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="ownedFarm;स्वतःची शेती आहे का ?" class="form-check-input" id="ownedFarm">
                                            <label class="form-control-label" for="ownedFarm" style="font-size:13px;">स्वतःची शेती आहे का</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="gharkul;घरकुल योजनेचा लाभ घेतला का ?" class="form-check-input" id="gharkul">
                                            <label class="form-control-label" for="gharkul" style="font-size:13px;">घरकुल योजनेचा लाभ घेतला का ?</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="ownHome;घर आहे का ?" class="form-check-input" id="ownHome">
                                            <label class="form-control-label" for="ownedLand" style="font-size:13px;">घर आहे का ?</label>
                                        </div>   
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="parameter[]" value="landToSold;जागा विकणे आहे ?" class="form-check-input" id="landToSold">
                                            <label class="form-control-label" for="landToSold" style="font-size:13px;">जागा विकणे आहे ?</label>
                                        </div>   
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="row" style="display: none" id="ownHomeDiv">
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="parameter[]" value="houseType;घराचा प्रकार ?" class="form-check-input" id="houseType">
                                                    <label class="form-control-label" for="houseType" style="font-size:13px;">घराचा प्रकार ?</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="parameter[]" value="tapConnection;नळ ?" class="form-check-input" id="tapConnection">
                                                    <label class="form-control-label" for="tapConnection" style="font-size:13px;">नळ ?</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="parameter[]" value="electricityConnection;विज जोडणी ?" class="form-check-input" id="electricityConnection">
                                                    <label class="form-control-label" for="electricityConnection" style="font-size:13px;">विज जोडणी ?</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="parameter[]" value="toiletFacility;शौचालय ?" class="form-check-input" id="toiletFacility">
                                                    <label class="form-control-label" for="toiletFacility" style="font-size:13px;">शौचालय ?</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="parameter[]" value="gasConnection;शौचालय ?" class="form-check-input" id="gasConnection">
                                                    <label class="form-control-label" for="gasConnection" style="font-size:13px;">गॅस कनेक्शन ?</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="parameter[]" value="ifr_cfrDone;IFR / CFR मंजूर आहे काय ?" class="form-check-input" id="ifr_cfrDone">
                                                    <label class="form-control-label" for="ifr_cfrDone">IFR / CFR मंजूर आहे काय ?</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mt-2" style="display: flex;align-items: flex-end;">
                                        <button type="submit" class="btn btn-success" name="filter">Show</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <?php 
                if(isset($_REQUEST['filter'])){
                    
                    if(isset($_REQUEST['beda'])){
                        $bedaFilter = " AND familyDetails.beda = '".$_REQUEST['beda']."'";
                    }
                    
                    /*foreach ($_REQUEST['parameter'] as $parameter){
                        $explode = explode(';', $parameter);
                        $parameter = $explode[0];
                        $value = $_REQUEST[$parameter];
                        
                        $script .= '$("#'.$parameter.'").click();';
                        
                        if($parameter == "education"){
                            // $script .= '$("#educationDiv select option[value='.$value.']").attr("selected", "selected"); ';
                            $script .= "$('#educationDiv select').val('$value');";
                        }
                        
                        if($parameter == "casteCertificate" || $parameter == "disabled_handicap" || $parameter == "janAarogya" || $parameter == "niradhar"){
                            $tableName = "familyDetails";
                        } else if($parameter == "ownedLand" || $parameter == "gharkul" || $parameter == "shade" || $parameter == "private_government" || $parameter == "shg" ||  $parameter == "private_government"){
                            $tableName = "livelihood";
                        } else if($parameter == "education" || $parameter == "goToSchool" || $parameter == "registerBalAargya"){
                            $tableName = "educationDetails";
                        } else if($parameter == "ownedFarm" || $parameter == "ownHome" || $parameter == "houseType" || $parameter == "tapConnection" || $parameter == "toiletFacility" || $parameter == "ifr_cfrDone" || $parameter == "gasConnection"){
                            if($parameter == "ownedFarm"){
                                $parameter = "ownedLand";
                            }
                            $tableName = "landDetails";
                        } else if($parameter == "appledForPO"){
                            $tableName = "schemesDetails";
                        }
                        
                        $filter .= " AND ".$tableName.".".$parameter." = '".$value."'";
                    }*/
                    
                    
                    $q = mysqli_query($con, "SELECT COUNT(DISTINCT(familyDetails.memberId)) as 'totalMember', COUNT(DISTINCT(familyDetails.familyId)) as 'totalFamily' FROM familyDetails;");
                    $r = mysqli_fetch_assoc($q);
                    $totalFamily = $r['totalFamily'];
                    $totalMember = $r['totalMember'];
                    
                    $sql = "SELECT COUNT(DISTINCT(familyDetails.memberId)) as 'countMember', COUNT(DISTINCT(familyDetails.familyId)) as 'countFamily' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE 1 $filter $bedaFilter";
                    
                    $q = mysqli_query($con, $sql);
                    $r = mysqli_fetch_assoc($q);
                    $countMember = $r['countMember'];
                    $countFamily = $r['countFamily'];
                    
                    
                    $encryptedQuery = base64_encode("SELECT DISTINCT(familyDetails.memberId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE 1 $filter")."&beda=".$_REQUEST['beda'];
                ?>
                <div class="col-lg-12 mt-5 text-end">
                    <button class="btn btn-primary" onclick="ExportToExcel('xlsx')" type="button">Download Excel</button>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"># Family's - <?php echo $totalFamily ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"># Member's - <?php echo $totalMember; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="card z-index-2">
                        <div class="card-body p-3">
                            <div class="conatiner">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table" id="parameterTable">
                                                <thead>
                                                    <tr style="background-color:#415a8c; color:#f7f8fa ;">
                                                        <td></td>
                                                        <?php
                                                        foreach ($_REQUEST['parameter'] as $parameters){
                                                            $explode = explode(';', $parameters);
                                                            $parameter = $explode[0];
                                                            if($parameter == "casteCertificate" || $parameter == "gharkul" || $parameter == "childcareCenter" || $parameter == "landToSold"){
                                                                $colspan = "colspan='3'";
                                                            } else {
                                                                $colspan = "colspan='2'";
                                                            }
                                                        ?>
                                                        <th <?php echo $colspan ?>><?php echo $explode[1]; ?></th>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        
                                                        <?php
                                                        foreach ($_REQUEST['parameter'] as $parameters){
                                                            $explode = explode(';', $parameters);
                                                            $parameter = $explode[0];
                                                            if($parameter == "private_government"){
                                                        ?>
                                                        <th>खाजगी नोकरी</th>
                                                        <th>शासकीय</th>
                                                        <?php
                                                            } else if($parameter == "education"){
                                                        ?>
                                                        <th colspan="2"><?php echo $_REQUEST[$parameter]; ?></th>
                                                        <?php
                                                            } else if($parameter == "casteCertificate" || $parameter == "gharkul" || $parameter == "childcareCenter" || $parameter == "landToSold"){
                                                        ?>
                                                        <th>होय</th>
                                                        <th>नाही</th>
                                                        <th>भरलेला नाही</th>
                                                        <?php
                                                            } else if($parameter == "accountNo"){
                                                        ?>
                                                        <th>भरलेला </th>
                                                        <th>भरलेला नाही</th>
                                                        <?php
                                                            } else {
                                                        ?>
                                                        <th>होय</th>
                                                        <th>नाही</th>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <!--<td>Family</td>-->
                                                        <?php
                                                        /*foreach ($_REQUEST['parameter'] as $parameters){
                                                            $explode = explode(';', $parameters);
                                                            $parameter = $explode[0];;
                                                            $value = $_REQUEST[$parameter];
                                                            if($parameter == "casteCertificate" || $parameter == "disabled_handicap" || $parameter == "janAarogya" || $parameter == "niradhar"){
                                                                $tableName = "familyDetails";
                                                            } else if($parameter == "ownedLand" || $parameter == "shade" || $parameter == "private_government" || $parameter == "shg" ||  $parameter == "private_government"){
                                                                $tableName = "livelihood";
                                                            } else if($parameter == "education" || $parameter == "goToSchool" || $parameter == "registerBalAargya"){
                                                                $tableName = "educationDetails";
                                                            } else if($parameter == "ownedFarm" || $parameter == "ownHome" || $parameter == "houseType" || $parameter == "tapConnection" || $parameter == "toiletFacility" || $parameter == "ifr_cfrDone" || $parameter == "gasConnection"){
                                                                if($parameter == "ownedFarm"){
                                                                    $parameter = "ownedLand";
                                                                }
                                                                $tableName = "landDetails";
                                                            } else if($parameter == "appledForPO"){
                                                                $tableName = "schemesDetails";
                                                            }
                                                            $sql1 = "SELECT COUNT(DISTINCT(familyDetails.familyId)) as 'familyId' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '1' $bedaFilter;";
                                                            
                                                            $encryptedQuery = "SELECT DISTINCT(familyDetails.familyId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '1'";
                                                            $q1 = mysqli_query($con, $sql1) or die($con->error);
                                                            $r1 = mysqli_fetch_assoc($q1);
                                                            
                                                            $sql2 = "SELECT COUNT(DISTINCT(familyDetails.familyId)) as 'familyId' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '0' $bedaFilter;";
                                                            
                                                            $encryptedQuery2 = "SELECT DISTINCT(familyDetails.familyId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '0'";
                                                            $q2 = mysqli_query($con, $sql2) or die($con->error);
                                                            $r2 = mysqli_fetch_assoc($q2);
                                                        ?>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r1['familyId']; ?></a></td>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery2)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r2['familyId']; ?></a></td>
                                                        <?php
                                                        }*/
                                                        ?>
                                                    <tr>
                                                        <td>Members</td>
                                                        <?php
                                                        foreach ($_REQUEST['parameter'] as $parameters){
                                                            $explode = explode(';', $parameters);
                                                            $parameter = $explode[0];;
                                                            $value1 = 1;
                                                            $value2 = 0;
                                                            
                                                            $script .= '$("#'.$parameter.'").click();';
                        
                                                            if($parameter == "education"){
                                                                $script .= "$('#educationDiv select').val('$value');";
                                                            }
                                                            
                                                            
                                                            if($parameter == "casteCertificate" || $parameter == "disabled_handicap" || $parameter == "janAarogya" || $parameter == "accountNo" || $parameter == "niradhar"){
                                                                
                                                                $tableName = "familyDetails";
                                                                
                                                            } else if($parameter == "ownedLand" || $parameter == "shade" || $parameter == "private_government" || $parameter == "shg" ||  $parameter == "private_government"){
                                                                $value1 = "Private";
                                                                $value2 = "Government";
                                                                
                                                                $tableName = "livelihood";
                                                                
                                                            } else if($parameter == "education" || $parameter == "goToSchool" || $parameter == "childcareCenter" || $parameter == "registerBalAargya"){
                                                                if($parameter == "education"){
                                                                    $value1 = $_REQUEST[$parameter];
                                                                }
                                                                
                                                                $tableName = "educationDetails";
                                                                
                                                            } else if($parameter == "ownedFarm" || $parameter == "ownHome" || $parameter == "houseType" || $parameter == "tapConnection" || $parameter == "toiletFacility" || $parameter == "ifr_cfrDone" || $parameter == "gasConnection" || $parameter == "landToSold"){
                                                                if($parameter == "ownedFarm"){
                                                                    $parameter = "ownedLand";
                                                                }
                                                                
                                                                $tableName = "landDetails";
                                                                
                                                            } else if($parameter == "appledForPO"  || $parameter == "gharkul"){
                                                                
                                                                $tableName = "schemesDetails";
                                                                
                                                            }
                                                            $sql1 = "SELECT COUNT(DISTINCT(familyDetails.memberId)) as 'memberId' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '$value1' $bedaFilter;";
                                                            
                                                            $encryptedQuery = "SELECT DISTINCT(familyDetails.memberId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '$value1'";
                                                            $q1 = mysqli_query($con, $sql1) or die($con->error);
                                                            $r1 = mysqli_fetch_assoc($q1);
                                                            
                                                            $sql2 = "SELECT COUNT(DISTINCT(familyDetails.memberId)) as 'memberId' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '$value2' $bedaFilter;";
                                                            
                                                            $encryptedQuery2 = "SELECT DISTINCT(familyDetails.memberId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '$value2'";
                                                            $q2 = mysqli_query($con, $sql2) or die($con->error);
                                                            $r2 = mysqli_fetch_assoc($q2);
                                                            if($parameter == "education"){
                                                        ?>
                                                        <td class="center" colspan="2"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r1['memberId']; ?></a></td>
                                                        <?php
                                                            } else if($parameter == "casteCertificate" || $parameter == "childcareCenter" || $parameter == "landToSold"){
                                                                
                                                                
                                                                
                                                                $sql3 = "SELECT COUNT(DISTINCT(familyDetails.memberId)) as 'memberId' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '' $bedaFilter;";
                                                                $q3 = mysqli_query($con, $sql3) or die($con->error);
                                                                $r3 = mysqli_fetch_assoc($q3);
                                                                
                                                                $encryptedQuery3 = "SELECT DISTINCT(familyDetails.memberId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = ''";
                                                                
                                                                // echo $sql3."<br>";
                                                                
                                                                if($parameter == "childcareCenter"){
                                                                    $year = date("Y-m-d",strtotime("-6 year"));
                                                                    $q4 = mysqli_query($con, "SELECT COUNT(memberId) as 'childCnt' FROM familyDetails WHERE dob > '$year'");
                                                                    $r4 = mysqli_fetch_assoc($q4);
                                                                    $r3['memberId'] = $r4['childCnt'] - ($r1['memberId'] + $r2['memberId']);
                                                                }
                                                                
                                                        ?>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r1['memberId']; ?></a></td>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery2)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r2['memberId']; ?></a></td>
                                                        
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery3)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r3['memberId']; ?></a></td>
                                                        <?php
                                                            } else if($parameter == "gharkul"){
                                                                $sql3 = "SELECT COUNT(DISTINCT(familyDetails.familyId)) as 'memberId' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = '' $bedaFilter;";
                                                                $q3 = mysqli_query($con, $sql3) or die($con->error);
                                                                $r3 = mysqli_fetch_assoc($q3);
                                                                
                                                                $encryptedQuery3 = "SELECT DISTINCT(familyDetails.familyId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE $tableName.$parameter = ''";
                                                                
                                                                // echo $sql3."<br>";
                                                                
                                                        ?>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r1['memberId']; ?></a></td>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery2)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r2['memberId']; ?></a></td>
                                                        
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery3)."&beda=".$_REQUEST['beda']; ?>"><?php echo $totalFamily - ($r1['memberId'] + $r2['memberId']); ?></a></td>
                                                        <?php
                                                            } else if($parameter == "accountNo"){
                                                                
                                                                
                                                                $sql1 = "SELECT COUNT(DISTINCT(familyDetails.memberId)) as 'memberId' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE familyDetails.accountNo != '' $bedaFilter;";
                                                            
                                                                $encryptedQuery = "SELECT DISTINCT(familyDetails.memberId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE familyDetails.accountNo != ''";
                                                                $q1 = mysqli_query($con, $sql1) or die($con->error);
                                                                $r1 = mysqli_fetch_assoc($q1);
                                                                
                                                                $sql2 = "SELECT COUNT(DISTINCT(familyDetails.memberId)) as 'memberId' FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE familyDetails.accountNo = '' $bedaFilter;";
                                                                
                                                                $encryptedQuery2 = "SELECT DISTINCT(familyDetails.memberId), familyDetails.name, familyDetails.aadharNo, familyDetails.dob, familyDetails.caste, familyDetails.accountNo FROM `familyDetails` LEFT JOIN educationDetails on familyDetails.memberId = educationDetails.memberId LEFT JOIN livelihood ON familyDetails.memberId = livelihood.memberId LEFT JOIN landDetails ON familyDetails.memberId = landDetails.memberId LEFT JOIN schemesDetails ON familyDetails.memberId = schemesDetails.memberId WHERE familyDetails.accountNo = ''";
                                                                $q2 = mysqli_query($con, $sql2) or die($con->error);
                                                                $r2 = mysqli_fetch_assoc($q2);
                                                        ?>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r1['memberId']; ?></a></td>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery2)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r2['memberId']; ?></a></td>
                                                        <?php
                                                            } else {
                                                        ?>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r1['memberId']; ?></a></td>
                                                        <td class="center"><a href="parameter-report-details?q=<?php echo base64_encode($encryptedQuery2)."&beda=".$_REQUEST['beda']; ?>"><?php echo $r2['memberId']; ?></a></td>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th><span class="exportShow"># Family's </span></th>
                                                        <td><span class="exportShow"><?php echo $totalFamily ?></span></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th><span class="exportShow"># Member's</span></th>
                                                        <td><span class="exportShow"><?php echo $totalMember ?></span></td>
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
                <?php
                }
                ?>
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
        
        
        $("#education").on('click', function () {
            if(this.checked){
                $("#educationDiv").show();
                $("#educationDiv select").attr('required', '');
            } else {
                $("#educationDiv").hide();
                $("#educationDiv select").removeAttr('required');
            }
        })
        
        
        
        $("#ownHome").on('click', function () {
            if(this.checked){
                $("#ownHomeDiv").show();
                $("#ownHomeDiv div div input").prop("checked", false);
            } else {
                $("#ownHomeDiv").hide();
                $("#ownHomeDiv div div input").prop("checked", true);
            }
        })
        
        

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
        <?php 
        echo $script;
        ?>
        
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
    ?>
    <script>
    
        function ExportToExcel(type, fn, dl) {
            /*// $(".exportShow").css('display', 'block !important');
            var arr = $('.exportShow').map(function () {
                    $(this).css('display', 'block');
            }).get();*/
            $(".exportShow").show();
            var elt = document.getElementById('parameterTable');
            console.log(elt);
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl  ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('Pardhi Suvery Form - Parameter Repot.' + (type || 'xlsx')));
            
            // $(".exportShow").hide();
            /*var arr = $('.exportShow').map(function () {
                    $(this).css('display', 'none');
            }).get();*/
        }
    </script>
</body>

</html>