<?php
session_start();
require_once 'assets/connection.php';
require_once 'assets/inject.php';

//check if the user is logged in
if(!isset($_SESSION['email'])){
    header('Location: index.php?errormsg=You are not logged in');
    exit();
}

$unit_id = mysql_entities_fix_string($conn, $_POST['unit_id']);

//get the polling unit results from the announced_pu_results table 
$sql = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = '$unit_id'";
$result = mysqli_query($conn, $sql) or die("Error fetching polling unit results");

if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_assoc($result)){
    $party = $row['party_abbreviation'];
    $score = $row['party_score'];
    $entered_by = $row['entered_by_user'];
    $date_entered = $row['date_entered'];
   
    echo "<tr>
            <td>$party</td>
            <td>$score</td>
            <td>$entered_by</td>
            <td>$date_entered</td>
   
        </tr>";
}
}else{
    echo "<tr>
            <td colspan='4'>No result for this polling unit</td>
        </tr>";
}





?>