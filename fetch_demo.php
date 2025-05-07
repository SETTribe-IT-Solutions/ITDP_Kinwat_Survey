<html>
<head>
<title>Fetch Query in PHP</title>
</head>
<body>
<?php
$con = mysqli_connect('localhost', 'u196817721_ST_pardhiForm', 'ST_pardhiSurveyForm@1234', 'u196817721_pardhi_survey');
$sql = "SELECT * FROM familyDetails";
$result = mysqli_query($con, $sql) or die("query faield");

$row = mysqli_fetch_assoc($result);
// echo"<pre>";
// print_r($row);
// echo"</pre>";

?>
 <table id="employee_data" class="table table-striped table-bordered table-hover">
       <thead>
        
        <tr class="table table-hover" style="background-color: black;color: white">
            
        <th>id</th>
        <th>first name</th>
        <th>last name</th>
        <th>username</th>
        <th>password   </th>
        <th>conform password</th>
       
        
        </tr>
           </thead>



<?php
    // while($row = mysqli_fetch_array($result))
    {
      ?>
        
        <tr style="background-color:darkgray;" >
        <td style="color:white"> <?php echo $row['sr_no']; ?> </td>
        <td style="color:white"> <?php echo $row['familyId']; ?> </td>
        <td style="color:white"> <?php echo $row['memberId'] ;?> </td>
        <td style="color:white"> <?php echo $row['name']; ?> </td>
        <td style="color:white"> <?php echo $row['caste'] ;?> </td>
        <td style="color:white"> <?php echo $row['incomeNo'] ;?> </td>
        </tr>
            </table>


</body>
<?php
}
?>
</html>