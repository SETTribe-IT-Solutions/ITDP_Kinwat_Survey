<?php
include('include/con.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <title>
        land Family Details
    </title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.8" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php
    include('include/side-navbar.php');
    ?>
    <main class="main-content position-relative border-radius-lg ">


        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <?php
                            if(isset($_GET['memberId'])){
                                $memberId= $_GET['memberId'];
                            ?>
                            <h4 class="card-title">घर / शेतीविषयक माहिती -
                            <?php 
                            $q = mysqli_query($con, "SELECT name FROM familyDetails WHERE memberId = '$memberId' ORDER BY sr_no ASC LIMIT 1");
                            $r = mysqli_fetch_assoc($q);
                            echo $r['name'];
                            ?>
                            </h4>
                            <?php 
                            } else {
                                
                            ?>
                            <h4 class="card-title">घर / शेतीविषयक माहिती </h4>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="card-body p-3">
                            <form action="land-details-db" method="POST" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $_GET['familyId'] ?>" name="familyId">
                                <input type="hidden" value="<?php echo $_GET['memberId'] ?>" name="memberId">
                                <?php
                                $q = mysqli_query($con, "SELECT * FROM landDetails WHERE memberId = '$memberId'");
                                $r = mysqli_fetch_assoc($q);
                                
                                if($r['ownedLand'] != ""){
                                    if($r['ownedLand'] == 1){
                                        $script .= '$("#ownedLandYes").click();';
                                    } else {
                                        $script .= '$("#ownedLandNo").click();';
                                        
                                        if($r['ownHome'] != ""){
                                            if($r['ownHome'] == 1){
                                                $script .= '$("#ownHomeYes").click();';
                                            } else {
                                                $script .= '$("#ownHomeNo").click();';
                                            }
                                        }
                                    }
                                }
                                
                                if($r['house'] != ""){
                                    if($r['house'] == 1){
                                        $script .= '$("#gharYes").click();';
                                    } else {
                                        $script .= '$("#gharNo").click();';
                                    }
                                }
                                
                                if($r['houseType'] != ""){
                                    if($r['houseType'] == "कच्च"){
                                        $script .= '$("#houseTypeKachch").click();';
                                    } else if($r['houseType'] == "पक्क") {
                                        $script .= '$("#houseTypePakk").click();';
                                    }
                                }
                                
                                if($r['tapConnection'] != ""){
                                    if($r['tapConnection'] == 1){
                                        $script .= '$("#tapConnectionYes").click();';
                                    } else {
                                        $script .= '$("#tapConnectionNo").click();';
                                    }
                                }
                                
                                if($r['electricityConnection'] != ""){
                                    if($r['electricityConnection'] == 1){
                                        $script .= '$("#electricityConnectionYes").click();';
                                    } else {
                                        $script .= '$("#electricityConnectionNo").click();';
                                    }
                                }
                                
                                if($r['toiletFacility'] != ""){
                                    if($r['toiletFacility'] == 1){
                                        $script .= '$("#toiletFacilityYes").click();';
                                    } else {
                                        $script .= '$("#toiletFacilityNo").click();';
                                    }
                                }
                                
                                if($r['toiletFacility'] != ""){
                                    if($r['toiletFacility'] == 1){
                                        $script .= '$("#toiletFacilityYes").click();';
                                    } else {
                                        $script .= '$("#toiletFacilityNo").click();';
                                    }
                                }
                                
                                if($r['gasConnection'] != ""){
                                    if($r['gasConnection'] == 1){
                                        $script .= '$("#gasConnectionYes").click();';
                                    } else {
                                        $script .= '$("#gasConnectionNo").click();';
                                    }
                                }
                                
                                if($r['ifr_cfrDone'] != ""){
                                    if($r['ifr_cfrDone'] == 1){
                                        $script .= '$("#ifr_cfrDoneYes").click();';
                                    } else {
                                        $script .= '$("#ifr_cfrDoneNo").click();';
                                    }
                                }
                                
                                if($r['proposalDone'] != ""){
                                    if($r['proposalDone'] == 1){
                                        $script .= '$("#proposalDoneYes").click();';
                                    } else {
                                        $script .= '$("#proposalDoneNo").click();';
                                    }
                                }
                                
                                if($r['sendProposal'] != ""){
                                    if($r['sendProposal'] == 1){
                                        $script .= '$("#sendProposalYes").click();';
                                    } else {
                                        $script .= '$("#sendProposalNo").click();';
                                    }
                                }
                                
                                if($r['landToSold'] != ""){
                                    if($r['landToSold'] == 1){
                                        $script .= '$("#landToSoldYes").click();';
                                    } else {
                                        $script .= '$("#landToSoldNo").click();';
                                    }
                                }
                                
                                ?>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">स्वतःची शेती आहे का?</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" id="ownedLandYes"
                                                                    name="ownedLand" value="1" onclick="showInput();" />
                                                                <label class="form-control-label" id="ownedLandYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" id="ownedLandNo" class="form-check-input"
                                                                    name="ownedLand" value="1"
                                                                    onclick="showDropdown();" />
                                                                <label class="form-control-label" for="ownedLandNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="inputFile" style="display:none;">
                                                        <label class="form-control-label">७/१२</label><br>
                                                        <input type="file" class="form-control" id="fileInput" />
                                                        <?php
                                                        if(!empty($r['satbara'])){
                                                        ?>
                                                        Last selected file - <a href="uploadedFiles/<?php echo $r['satbara'] ?>"><?php echo $r['satbara'] ?></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <script>
                                                        function showInput() {
                                                            document.getElementById("inputFile").style.display = "block";
                                                            document.getElementById("dropdownList").style.display = "none";
                                                            document.getElementById("area").style.display = "block";
                                                        }
                                                        function showDropdown() {
                                                            document.getElementById("inputFile").style.display = "none";
                                                            document.getElementById("dropdownList").style.display = "block";
                                                            document.getElementById("area").style.display = "none";
                                                        }
                                                    </script>

                                                    <div id="dropdownList" style="display:none;">
                                                        <label class="form-control-label">इतर कोणाची शेती करता का?</label><br>
                                                        <select id="dropdown" class="form-select" name="landType">
                                                            <option value="" selected="" disabled="">-- निवडा --</option>
                                                            <option value="नाही">नाही</option>
                                                            <option value="मक्ता / बटाई">मक्ता / बटाई</option>
                                                            <option value="अतिक्रमण">अतिक्रमण</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="area" style="display:none">
                                        <div class="form-group">
                                            <label class="form-control-label">क्षेत्रफळ</label><br>
                                            <input type="text" class="form-control" value="<?php echo $r['area'] ?>" id="area" name="area">
                                            <!--<label class="form-control-label" for="janAarogyaYes">होय</label>-->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">घर आहे का?</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" onclick="showData()"
                                                        name="house" value="1" id="gharYes">
                                                    <label class="form-control-label" for="gharYes">होय</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" onclick="hideData()"
                                                        name="house" value="0" id="gharNo">
                                                    <label class="form-control-label" for="gharNo">नाही</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="dataDiv" style="display:none;">

                                        <!--<div id="dataDiv">-->
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <label class="form-control-label">घराचा प्रकार</label>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" 
                                                                name="houseType" value="कच्च" id="houseTypeKachch">
                                                            <label class="form-control-label" for="houseTypeKachch">कच्च</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" 
                                                                name="houseType" value="पक्क" id="houseTypePakk">
                                                            <label class="form-control-label" for="houseTypePakk">पक्क</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" id="roomNo"># खोल्या</label><br>
                                                    <input type="text" class="form-control" value="<?php echo $r['roomNo'] ?>" id="roomNo" name="roomNo">
                                                    <!--<label class="form-control-label" for="janAarogyaYes">होय</label>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="caste">नळ</label><br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="tapConnection" value="1" id="tapConnectionYes">
                                                                <label class="form-control-label" for="tapConnectionYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="tapConnection" value="0" id="tapConnectionNo">
                                                                <label class="form-control-label" for="tapConnectionNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--<div class="row">-->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="caste">विज जोडणी</label><br>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="electricityConnection" value="1" id="electricityConnectionYes">
                                                                <label class="form-control-label" for="electricityConnectionYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="electricityConnection" value="0" id="electricityConnectionNo">
                                                                <label class="form-control-label" for="electricityConnectionNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label class="form-control-label" for="aadharNo">शौचालय</label><br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" name="toiletFacility" id="toiletFacilityYes" class="form-check-input"
                                                                    value="1" />
                                                                <label class="form-control-label" for="toiletFacilityYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" name="toiletFacility" id="toiletFacilityNo" class="form-check-input"
                                                                    value="0" />
                                                                <label class="form-control-label" for="toiletFacilityNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="incomeNo">गॅस कनेक्शन?</label>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="gasConnection" value="1" id="gasConnectionYes">
                                                                <label class="form-control-label" for="gasConnectionYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="gasConnection" value="0" id="gasConnectionNo">
                                                                <label class="form-control-label" for="gasConnectionNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="education">IFR / CFR मंजूर आहे काय?</label>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" name="ifr_cfrDone" id="ifr_cfrDoneYes" class="form-check-input"
                                                                    value="1"
                                                                    onclick="document.querySelector('.fiel').style.display = 'none';document.querySelector('#reg').style.display = 'none';" />
                                                                <label class="form-control-label" for="ifr_cfrDoneYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" name="ifr_cfrDone" value="0" id="ifr_cfrDoneNo"
                                                                    class="form-check-input"
                                                                    onclick="document.querySelector('.fiel').style.display = 'block';" />
                                                                <label class="form-control-label" for="ifr_cfrDoneNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 fiel" style="display:none">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">प्रस्तावित आहे काय??</label><br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="proposalDone" value="1" id="proposalDoneYes"
                                                                    onclick="document.querySelector('#reg').style.display = 'none';">
                                                                <label class="form-control-label" for="proposalDoneYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="proposalDone" value="0" id="proposalDoneNo"
                                                                    onclick="document.querySelector('#reg').style.display = 'block';">
                                                                <label class="form-control-label" for="proposalDoneNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6" id="reg" style="display:none">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">प्रस्ताव पाठवयाचा आहे का?</label><br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="sendProposal" value="1" id="sendProposalYes"
                                                                    >
                                                                <label class="form-control-label"
                                                                    for="sendProposalYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="sendProposal" value="0" id="sendProposalNo"
                                                                    >
                                                                <label class="form-control-label"
                                                                    for="sendProposalNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="pakkaGharNoDiv" style="display:none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="caste">स्वतःची जागा आहे का?</label><br>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="ownHome" value="1" id="ownHomeYes" onclick="document.getElementById('areaHome').style.display='block'">
                                                                <label class="form-control-label" for="ownHomeYes">होय</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="ownHome" value="0" id="ownHomeNo" onclick="document.getElementById('areaHome').style.display='none'">
                                                                <label class="form-control-label" for="ownHomeNo">नाही</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6" id="areaHome" style="display:none">
                                                <div class="form-group">
                                                    <label class="form-control-label">क्षेत्रफळ</label><br>
                                                    <input type="text" class="form-control" value="<?php echo $r['homeArea'] ?>" id="homeArea" name="homeArea">
                                                    <!--<label class="form-control-label" for="janAarogyaYes">होय</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function showData() {
                                            document.getElementById("dataDiv").style.display = "block";
                                            document.getElementById("pakkaGharNoDiv").style.display = "none";
                                        }
                                        function hideData() {
                                            document.getElementById("dataDiv").style.display = "none";
                                            document.getElementById("pakkaGharNoDiv").style.display = "block";
                                        }
                                       
                                    </script>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name">जागा विकणे आहे ?</label><br>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="landToSold" value="1" id="landToSoldYes">
                                                            <label class="form-control-label" for="landToSoldYes">होय</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" name="landToSold" value="0" id="landToSoldNo">
                                                            <label class="form-control-label" for="landToSoldNo">नाही</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 landToSoldDiv">
                                            <div class="form-group">
                                                <label class="form-control-label">७/१२ अपलोड करा</label>
                                                <input type="file" class="form-control" id="landToSoldSatbara" name="landToSoldSatbara" />
                                                <?php
                                                if(!empty($r['landToSoldSatbara'])){
                                                ?>
                                                Last selected file - <a href="uploadedFiles/<?php echo $r['landToSoldSatbara'] ?>"><?php echo $r['landToSoldSatbara'] ?></a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 landToSoldDiv">
                                            <div class="form-group">
                                                <label class="form-control-label" id="landToSoldArea">क्षेत्रफळ (sqft)</label>
                                                <input type="text" class="form-control" id="landToSoldArea" value="<?php echo $r['landToSoldArea'] ?>" name="landToSoldArea" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-success" type="submit" name="submit">Submit</button>
                                        </div>
                                        <div class="col-6">
                                            <a href="family-report"><button class="btn btn-info" type="button"
                                                    name="submit">Back</button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        require_once('include/footer.php');
        ?>
        </div>
    </main>

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
        });
        
        $(".landToSoldDiv").hide();
        $("input[name=landToSold]").on('click', function () {
            console.log($(this).val());
            if ($(this).val() == "1") {
                $(".landToSoldDiv").show();
            } else {
                $(".landToSoldDiv").hide();
            }    
        })
        function isInputNumberMobile(evt) {

            var ch = String.fromCharCode(evt.which);

            if (!(/[0-9]/.test(ch))) {
                evt.preventDefault();
                if (!$('#mobileNo').val().match('[0-9]{10}')) {
                    // alert("Enter Valid Mobile Number...");

                    return;
                }
            }

        }

        function isInputNumberAadhar(evt) {

            var ch = String.fromCharCode(evt.which);

            if (!(/[0-9]/.test(ch))) {
                evt.preventDefault();
                if (!$('#aadhar_number').val().match('[0-9]{12}')) {
                    // alert("Enter Valid Mobile Number...");

                    return;
                }
            }

        }
        <?php
        echo $script;
        ?>
    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

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
    
</body>

</html>