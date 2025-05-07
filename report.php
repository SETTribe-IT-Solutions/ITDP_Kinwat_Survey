<?php 
session_start();
include('include/con.php');

$familyDetails = array();
$q = mysqli_query($con, "SELECT `COLUMN_NAME`, `DATA_TYPE` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='u196817721_kvnt_pardhi' AND `TABLE_NAME`='familyDetails' AND `COLUMN_NAME` !='sr_no' AND `COLUMN_NAME` !='createdId' AND `COLUMN_NAME` !='dateTime' AND `COLUMN_NAME` !='status'  AND `COLUMN_NAME` !='remark' AND `COLUMN_NAME` !='familyId' AND `COLUMN_NAME` !='memberId' AND `COLUMN_NAME` !='eduction' AND `COLUMN_NAME` !='ifsc' AND `COLUMN_NAME` !='familyHead' AND `COLUMN_NAME` !='familyPhoto' AND `COLUMN_NAME` !='name' AND `COLUMN_NAME` != 'election';");
while($r = mysqli_fetch_assoc($q)){
    $familyDetails[$r['COLUMN_NAME']] = $r['DATA_TYPE'];
}

$educationDetails = array();
$q = mysqli_query($con, "SELECT `COLUMN_NAME`, `DATA_TYPE` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='u196817721_kvnt_pardhi' AND `TABLE_NAME`='educationDetails' AND `COLUMN_NAME` !='srNo' AND `COLUMN_NAME` !='createdId'  AND `COLUMN_NAME` !='dateTime' AND `COLUMN_NAME` !='status' AND `COLUMN_NAME` !='familyId' AND `COLUMN_NAME` !='memberId' AND `COLUMN_NAME` != 'remark' AND `COLUMN_NAME` !='schoolName' ;");
while($r = mysqli_fetch_assoc($q)){
    $educationDetails[$r['COLUMN_NAME']] = $r['DATA_TYPE'];
}

$livelihoodDetails = array();
$q = mysqli_query($con, "SELECT `COLUMN_NAME`, `DATA_TYPE` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='u196817721_kvnt_pardhi' AND `TABLE_NAME`='livelihood' AND `COLUMN_NAME` !='srNo' AND `COLUMN_NAME` !='createdId' AND `COLUMN_NAME` !='dateTime' AND `COLUMN_NAME` !='status' AND `COLUMN_NAME` !='familyId' AND `COLUMN_NAME` !='memberId'  AND `COLUMN_NAME` != 'remark' AND `COLUMN_NAME` != 'gharkul';");
while($r = mysqli_fetch_assoc($q)){
    $livelihoodDetails[$r['COLUMN_NAME']] = $r['DATA_TYPE'];
}

$landDetails = array();
$q = mysqli_query($con, "SELECT `COLUMN_NAME`, `DATA_TYPE` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='u196817721_kvnt_pardhi' AND `TABLE_NAME`='landDetails' AND `COLUMN_NAME` !='srNo' AND `COLUMN_NAME` !='createdId' AND `COLUMN_NAME` !='dateTime' AND `COLUMN_NAME` !='status' AND `COLUMN_NAME` !='familyId' AND `COLUMN_NAME` !='memberId'  AND `COLUMN_NAME` != 'remark';");
while($r = mysqli_fetch_assoc($q)){
    $landDetails[$r['COLUMN_NAME']] = $r['DATA_TYPE'];
}


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
                            <h4 class="card-title">कौटुंबिक अहवाल</h4>
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
                                                        <select required name="taluka" class="form-control"  id="taluka">
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
                                                
                                                
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <h6 class="form-control-label" for="name">बेडा</h6>
                                                        <!--<input type="text" class="form-control" id="name" name="name">-->
                                                        <select name="beda" class="form-control"  id="name" required>
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
                                            
                                            <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="example"></label></div>
                                                


                                            <table class="table" id="dataTables-example"
                                                style="<?php echo $display ?>width:100%">
                                                
                                                
                                                <tr style="background-color:#415a8c; color:#f7f8fa ;">
                                                    <th rowspan="2">बेडा </th>
                                                    <th rowspan="2">आडनाव </th>
                                                    <th rowspan="2">नाव </th>
                                                    <th rowspan="2">वडिलांचे / पतीचे नाव</th>
                                                    <!--<th>नाव</th>-->
                                                    <th rowspan="2">लिंग</th>
                                                    <th rowspan="2">जन्मतारीख</th>
                                                    <th rowspan="2">वय</th>
                                                    <th rowspan="2">मोबाईल क्र.</th>
                                                    <th rowspan="2">जात</th>
                                                    <th rowspan="2">आधार क्र.</th>
                                                    <th rowspan="2">इनकम सर्टिफिकेट क्र.</th>
                                                    <th rowspan="2">खाते क्रमांक</th>
                                                    <th rowspan="2">उत्पन्नाचे प्रमाणपत्र क्र.</th>
                                                    <th rowspan="2">शिधापत्रिका क्र.</th>

                                                    <th rowspan="2">सध्याचा मुक्काम (गावाचे नाव)</th>
                                                    <th rowspan="2">कायमस्वरूपी निवासस्थान</th>
                                                    <th rowspan="2">अपंग?</th>
                                                    <th rowspan="2">जात प्रमाणपत्र?</th>
                                                    <th rowspan="2">अपंग प्रमाणपत्र क्र.</th>
                                                    <th rowspan="2">जनआरोग्य नोंदणी आहे का?</th>
                                                    <th rowspan="2">निराधार?</th>
                                                    <th colspan="10">शिक्षण तपशील</th>
                                                    <th colspan="11">उपजीविका तपशील</th>
                                                    <th colspan="4">शेतीचा / शेत जमिनीचा तपशील</th>
                                                    <th colspan="7">घराचा / घराच्या जमिनीचा तपशील</th>
                                                    <th colspan="8"></th>
                                                    <th colspan="8">योजनांचा लाभ</th>
                                                </tr>
                                                <tr style="background-color:#415a8c; color:#f7f8fa ;">
                                                    <!--<th colspan="16"></th>-->
                                                    <th>शिक्षण</th>
                                                    <th>पदवीचे नावॉ</th>
                                                    <th>बाल आरोग्य नोंदणी आहे का?</th>
                                                    
                                                    <th>नोंदणी करायची आहे का?</th>
                                                    <th>अंगणवाडी नाव</th>
                                                    <th>बालसंस्कार केंद्रामध्ये जातो का ?</th>
                                                    <th>शाळेत जातो / जाते का?</th>
                                                    <th>कोणत्या शाळेत जातो / जाते? </th>
                                                    <!--<th></th>-->
                                                    <th>वर्ग</th>
                                                    <th>कारणे</th>
                                                    <!-- उपजीविका तपशील -->
                                                    <th>व्यवसाय </th>
                                                    <th>स्वतःची जागा आहे का?</th>
                                                    <th>क्षेत्रफळ</th>
                                                    <th>पिकाचा / धान्याचा प्रकार</th>
                                                    <th>प्राणी</th>
                                                    <th>पाळीव प्राण्यांची संख्या</th>
                                                    <th>प्राण्यांसाठी शेड आहे का?</th>
                                                    <th>खाजगी नोकरी</th>
                                                    <th>व्यवसायाचा प्रकार</th>
                                                    <th>मिळकत (रु.)</th>
                                                    <th>बचत गटाचे सदस्य आहात काय?</th>
                                                    <th>स्वतःची शेती आहे का?</th>
                                                    <th>७/१२</th>
                                                    <th>इतर कोणाची शेती करता का?</th>
                                                    <th>क्षेत्रफळ (हेक्टर)</th>
                                                    <th>घर आहे का?</th>
                                                    <th>घराचा प्रकार</th>
                                                    <th># खोल्या</th>
                                                    <th>नळ?</th>
                                                    <th>विज जोडणी?</th>
                                                    <th>शौचालय?</th>
                                                    <th>गॅस कनेक्शन</th>
                                                    <th>IFR / CFR ?</th>
                                                    <th>प्रस्तावित आहे काय?</th>
                                                    <th>प्रस्ताव पाठवयाचा आहे का?</th>
                                                    <th>स्वतःची घराची जागा आहे का?</th>
                                                    <th>क्षेत्रफळ (चौ. फुट)</th>
                                                    
                                                    <th>जागा विकणे आहे ?</th>
                                                    <th>७/१२ </th>
                                                    <th>क्षेत्रफळ (sqft)</th>
                                                    
                                                    <!-- योजनांचा लाभ -->
                                                    <th>प्रकल्प कार्यालयाचे लाभार्थी आहात काय?</th>
                                                    <th>लाभ घेतलेल्या योजना निवडा</th>
                                                    <th>घरकुल योजनेचा लाभ घेतला का ?</th>
                                                    <th>घरकुल पाहिजे आहे का ?</th>
                                                    <th>घरकुल अंतर्गत घर बांधले आहे का  ?</th>
                                                </tr>
                                                
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>6</th>
                                                    <th>7</th>
                                                    <th>8</th>
                                                    <th>9</th>
                                                    <th>10</th>
                                                    <th>11</th>
                                                    <th>12</th>
                                                    <th>13</th>
                                                    <th>14</th>
                                                    <th>15</th>
                                                    <th>16</th>
                                                    <th>17</th>
                                                    <th>18</th>
                                                    <th>19</th>
                                                    <th>20</th>
                                                    <th>21</th>
                                                    <th>22</th>
                                                    <th>23</th>
                                                    <th>24</th>
                                                    <th>25</th>
                                                    <th>26</th>
                                                    <th>27</th>
                                                    <th>28</th>
                                                    <th>29</th>
                                                    <th>30</th>
                                                    <th>31</th>
                                                    <th>32</th>
                                                    <th>33</th>
                                                    <th>34</th>
                                                    <th>35</th>
                                                    <th>36</th>
                                                    <th>37</th>
                                                    <th>38</th>
                                                    <th>39</th>
                                                    <th>40</th>
                                                    <th>41</th>
                                                    <th>42</th>
                                                    <th>43</th>
                                                    <th>44</th>
                                                    <th>45</th>
                                                    <th>46</th>
                                                    <th>47</th>
                                                    <th>48</th>
                                                    <th>49</th>
                                                    <th>50</th>
                                                    <th>51</th>
                                                    <th>52</th>
                                                    <th>53</th>
                                                    <th>54</th>
                                                    <th>55</th>
                                                    <th>56</th>
                                                    <th>57</th>
                                                    <th>58</th>
                                                    <th>59</th>
                                                    <th>60</th>
                                                    <th>61</th>
                                                    <th>62</th>
                                                    <th>63</th>
                                                    <th>64</th>
                                                    <th>65</th>
                                                    <th>66</th>
                                                </tr>
                                                <?php
                                                $now = new DateTime();
                                                if(isset($_REQUEST['beda'])){
                                                    $beda = "AND beda = '".$_REQUEST['beda']."'";
                                                }
                                                
                                                if($_SESSION['userId'] == "user_id001"){
                                                    $query = mysqli_query($con,"SELECT * FROM familyDetails WHERE 1 $beda ") or die("errror");
                                                } else {
                                                    $query = mysqli_query($con,"SELECT * FROM familyDetails WHERE createdId = '$userId' $beda ") or die("errror");    
                                                }
                                                while($result = mysqli_fetch_assoc($query)){
                                                    $memberId = $result['memberId'];
                                                    
                                                    $bday = $result['dob'];
                                                    $dob = new DateTime($bday);
                                                    $diff = $now->diff($dob);
                                                    $age = $diff->y;
                                                    $fullAge = $age."y ".$diff->m."m ".$diff->d."d";
                                                ?>
                                                <tr>
                                                    <?php
                                                    foreach ($familyDetails as $columns => $dataType){
                                                        if($dataType == "tinyint"){
                                                            if($result[$columns] == 1){
                                                                $result[$columns] = "होय";
                                                            } else {
                                                                $result[$columns] = "नाही";
                                                            }
                                                        }
                                                        
                                                        if($columns == "name"){
                                                            if($result['familyHead'] == ""){
                                                                $head = "(Family Head)";
                                                            } else {
                                                                $head = "";
                                                            }
                                                        } else if($columns == "age") {
                                                            $result[$columns] = $fullAge;
                                                        } else {
                                                            $head = "";
                                                        }
                                                        
                                                        if(empty($result[$columns])){
                                                            $result[$columns] = "-";
                                                        }
                                                    ?>
                                                    <td>
                                                        <?php echo $result[$columns] ?><span style="color:red">
                                                            <?php echo $head ?>
                                                        </span>
                                                    </td>
                                                    <?php
                                                    }
                                                    
                                                    $age_6 = "registerBalAargya, wantToRegister, anganwadiName";
                                                    $age_18 = "goToSchool, schoolName, schoolType, class, reasonNoGoschool";
                                                    $age_degree = "education, degreeName";  
                                                    if($age >=0 && $age <=6){
                                                       $columns_name = $age_6;
                                                    } else if($age >6 && $age <=18){
                                                        $columns_name = $age_18;
                                                    } else if($age > 18){
                                                        $columns_name = $age_degree;
                                                    }
                                                    $q = mysqli_query($con, "SELECT $columns_name FROM educationDetails WHERE memberId = '$memberId'");
                                                    $r = mysqli_fetch_assoc($q);
                                                    foreach ($educationDetails as $columns => $dataType){
                                                        if($r[$columns] != ""){
                                                            if($dataType == "tinyint"){
                                                                if($r[$columns] == 1){
                                                                    $r[$columns] = "होय";
                                                                } else {
                                                                    $r[$columns] = "नाही";
                                                                }
                                                            }
                                                        }
                                                        
                                                        if(empty($r[$columns])){
                                                            $r[$columns] = "-";
                                                        }
                                                    ?>
                                                    <td>
                                                        <?php echo $r[$columns]; ?>
                                                    </td>
                                                    <?php
                                                    }
                                                    
                                                    $q = mysqli_query($con, "SELECT * FROM livelihood WHERE memberId = '$memberId'");
                                                    $r = mysqli_fetch_assoc($q);
                                                    foreach ($livelihoodDetails as $columns => $dataType){
                                                        if($dataType == "tinyint"){
                                                            if($r[$columns] == 1){
                                                                $r[$columns] = "होय";
                                                            } else {
                                                                $r[$columns] = "नाही";
                                                            }
                                                        }
                                                        
                                                        if(empty($r[$columns])){
                                                            $r[$columns] = "-";
                                                        }
                                                    ?>
                                                    <td>
                                                        <?php echo $r[$columns] ?>
                                                    </td>
                                                    <?php
                                                    }
                                                    
                                                    $q = mysqli_query($con, "SELECT * FROM landDetails WHERE memberId = '$memberId'");
                                                    $r = mysqli_fetch_assoc($q);
                                                    $count = mysqli_num_rows($q);
                                                    foreach ($landDetails as $columns => $dataType){
                                                        if($count <=0){
                                                            $r[$columns] = "-";
                                                        } else {
                                                        
                                                            if($dataType == "tinyint"){
                                                                if($r[$columns] == 1){
                                                                    $r[$columns] = "होय";
                                                                } else {
                                                                    $r[$columns] = "नाही";
                                                                }
                                                            }
                                                            
                                                            if($columns == "landToSold"){
                                                                if($r[$columns] == 1){
                                                                    $r[$columns] = "होय";
                                                                } else if($r[$columns] == 0) {
                                                                    $r[$columns] = "नाही";
                                                                } else {
                                                                    $r[$columns] = "-";
                                                                }
                                                            }
                                                        }
                                                        
                                                        
                                                    ?>
                                                    <td>
                                                        <?php echo $r[$columns] ?>
                                                    </td>
                                                    <?php
                                                    }
                                                    
                                                    $q = mysqli_query($con, "SELECT * FROM schemesDetails WHERE memberId = '$memberId'");
                                                    if(mysqli_num_rows($q) <=0 ){
                                                        $appledForPO = "-";
                                                        $schemeName = "-";
                                                        $gharkul = "-";
                                                        $needGharkul = "-";
                                                        $gharkulHouse = "-";
                                                        $reason = "-";
                                                    }
                                                    $i=1;
                                                    while($r = mysqli_fetch_assoc($q)){
                                                        if($i == 1){
                                                            $schemeName .= $r['name'];
                                                        } else {
                                                            $schemeName .= ", ".$r['name'];
                                                        }
                                                        $appledForPO = $r['appledForPO'];
                                                        if($r['gharkul'] != ''){
                                                            if($r['gharkul'] == 1){
                                                                $gharkul = "होय";
                                                            } else {
                                                                $gharkul = "नाही";
                                                            }
                                                        }
                                                        
                                                        if($r['needGharkul'] != ''){
                                                            if($r['needGharkul'] == 1){
                                                                $needGharkul = "होय";
                                                            } else {
                                                                $needGharkul = "नाही";
                                                            }
                                                        }
                                                        
                                                        if($r['gharkulHouse'] != ''){
                                                            if($r['gharkulHouse'] == 1){
                                                                $gharkulHouse = "होय";
                                                            } else {
                                                                $gharkulHouse = "नाही";
                                                            }
                                                        }
                                                        
                                                        if($r['reason'] != ''){
                                                            $reason = $r['reason'];
                                                        }
                                                        $i++;
                                                    }
                                                    if(!empty($appledForPO)){
                                                        if($appledForPO == 1){
                                                            $appledForPO = "होय";
                                                        } else if($appledForPO == "0") {
                                                            $appledForPO = 'नाही';
                                                        }
                                                    }
                                                    ?>
                                                    <td>
                                                        <?php echo $appledForPO ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $schemeName ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $gharkul ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $needGharkul ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $gharkulHouse ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $reason ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>

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