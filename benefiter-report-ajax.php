<?php
include('include/con.php');

if(isset($_GET['dataTable'])){
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = mysqli_real_escape_string($con,$_POST['search']['value']); // Search value
    
    
    
    // $taluka = $_POST['taluka'];
    
    
 
    $searchBytaluka = $_POST['searchBytaluka'];
    $searchBygaav = $_POST['searchBygaav'];
    $searchByyojana = $_POST['searchByyojana'];
      $searchByyear = $_POST['searchByyear'];
    $searchByamount = $_POST['searchByamount'];
    
    $searchQuery = " ";
    if($searchBytaluka != ''){
        $taluka = " AND taluka = '".$searchBytaluka."'";
    }
      if($searchBygaav != ''){
        $village = " AND village = '".$searchBygaav."'";
    }
     if($searchByyojana != ''){
        $yojana_name = " AND yojana_name = '".$searchByyojana."'";
    } 
      if($searchByyear != ''){
        $year = " AND year = '".$searchByyear."'";
    }
   if($searchByamount != ''){
        $amount = " AND amount = '".$searchByamount."'";
    }
    
   
    ## Search 
    $searchQuery = " ";
    if($searchValue != ''){
    	$searchQuery = " AND (yojana_sr_no LIKE '%".$searchValue."%' OR 
            benefiter_name LIKE '%".$searchValue."%' OR 
            taluka	 LIKE'%".$searchValue."%' OR 
            village	 LIKE'%".$searchValue."%' OR
            caste	 LIKE'%".$searchValue."%' OR 
            yojana_name	 LIKE'%".$searchValue."%' OR 
            year	 LIKE'%".$searchValue."%' OR 
            amount   LIKE'%".$searchValue."%' ) ";
    }
    


    
    
    
    
    
    ## Total number of records without filtering
    $sel = mysqli_query($con,"SELECT COUNT(*) AS allcount FROM benefiter_data");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];
    
    ## Total number of records with filtering
    $sel = mysqli_query($con,"SELECT COUNT(*) AS allcount FROM benefiter_data WHERE 1 ".$searchQuery.$taluka.$village.$yojana_name.$year.$amount);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];
    
    $sr_no = 1;
    ## Fetch records
    $empQuery = "SELECT * FROM benefiter_data WHERE 1 ".$searchQuery.$taluka.$village.$yojana_name.$year.$amount." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();
    
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
                "yojana_sr_no" => $row['yojana_sr_no'],
                "benefiter_name" => $row['benefiter_name'],
                "village" => $row['village'],
                "taluka" => $row['taluka'],
                "caste" => $row['caste'],
                "yojana_name" => $row['yojana_name'],
                "year" => $row['year'],
                "amount" => $row['amount']
        	);
        $sr_no++;
    }
    
    
    ## Response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );
    
    echo json_encode($response);
}
?>