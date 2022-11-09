<?php
session_start();
require_once 'assets/connection.php';
require_once 'assets/inject.php';

//check if the user is logged in
if(!isset($_SESSION['email'])){
    header('Location: index.php?errormsg=You are not logged in');
    exit();
}

$lga_id = mysql_entities_fix_string($conn, $_POST['lga_id']);

//get the polling unit results from the announced_pu_results table 
$sql = "SELECT * FROM polling_unit WHERE lga_id = '$lga_id'";
$result = mysqli_query($conn, $sql) or die("Error fetching polling unit results");

if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_assoc($result)){
    $unit = $row['polling_unit_name'];
    $unit_id = $row['uniqueid'];
    echo "<option value='$unit_id'>$unit</option>";
}
}else{
    echo "
            <option>No result for this LGA</option>
        ";
}





?>