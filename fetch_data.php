<?php
include('include/con.php');
$taluka=$_POST['taluka'];
$q = mysqli_query($con, "SELECT DISTINCT village FROM benefiter_data where taluka='$taluka'");
echo "<option value='' selected disabled>-- गावा निवडा --</option> ";

while($r = mysqli_fetch_assoc($q)){
                                                        if($_REQUEST['village'] == $r['village']){
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                    ?>
                                                    <option value="<?php echo $r['village'] ?>" <?php echo $selected ?>><?php echo $r['village'] ?></option>
                                                    <?php
                                                    }
                                                    ?>