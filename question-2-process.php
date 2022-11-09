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


//party array
$party = array();
//total score array
$total_score = array();

$polling_units = array();

//get party name from the party table


$sql = "SELECT * FROM party";
$result = mysqli_query($conn, $sql) or die("Error fetching party name");

if(mysqli_num_rows($result)>0){
while($party_r = mysqli_fetch_assoc($result)){
  $total_score['partyname'] = $party_r['partyname'];

}
}else{
    echo "No party found";
}


//get the polling units from the polling_unit table 
$sql = "SELECT * FROM polling_unit WHERE lga_id = '$lga_id'";
$result = mysqli_query($conn, $sql) or die("An error occured");

if(mysqli_num_rows($result)>0){
//print_r($result);
while($rows = mysqli_fetch_assoc($result)){
    $unit_id = $rows['uniqueid'];
    //get the polling unit results from the announced_pu_results table
    $sql2 = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = '$unit_id'";
    $result_pol = mysqli_query($conn, $sql2) or die("Error fetching polling unit results");

    if(mysqli_num_rows($result_pol)>0){
    while($row = mysqli_fetch_assoc($result_pol)){
        //add to the total score array according to the party name
        $score = array("partyname"=>$row['party_abbreviation'], "score"=>$row['party_score']);
        //add score to party total score
        $total_score[$row['party_abbreviation']] += $row['party_score'];

        
    }
    }else{
        echo "<tr>
                <td colspan='4'>No result for this polling unit</td>
            </tr>";
    }

//
    



}
print_r($total_score);


}else{
    echo "<tr>
            <td colspan='4'>No result for this polling unit</td>
        </tr>";
}





?>