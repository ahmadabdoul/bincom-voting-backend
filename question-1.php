<?php
session_start();
require_once 'assets/connection.php';
require_once 'assets/inject.php';

//check if the user is logged in
if(!isset($_SESSION['email'])){
    header('Location: index.php?errormsg=You are not logged in');
    exit();
}

?>


<html>
<head>
<title>Bincom Agent Dashboard</title>
<!-- bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
    <!-- dashboard -->
    
        <!-- navbar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Bincom</a>
                </div>
                <ul class="nav navbar">
                    <li class="active"><a href="">Question 1</a></li>
                    <li><a href="question-2.php">Question 2</a></li>
                    <li><a href="question-3">Question 3</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>     
        <!-- end of navbar -->

        <!-- question 1 -->

        <div class="container">
            <div class="row">
            <form class="form">
                <p class="text text-warning">NOTE: The displayed polling units and their associated results are only polling units under Delta State</p>
                <div class="form-group">
                    <select id="unit" class="form-control" required>
                        <option value="">--select polling unit--</option>
                        <?php
                        //get polling units from polling_unit table
                        $sql = "SELECT * FROM polling_unit WHERE uniqueid BETWEEN 1 AND 109";
                        $result = mysqli_query($conn, $sql) or die("Error fetching polling units");
                        while($row = mysqli_fetch_assoc($result)){
                            $unit = $row['polling_unit_name'];
                            $unit_id = $row['uniqueid'];
                            echo "<option value='$unit_id'>$unit</option>";
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="searchbtn" value="Search">
                </div>
            </form>    
        </div>
        <div class="row">
            <!-- display results -->
            <table class="table table-bordered table-striped" id="pu_table">
                <thead>
                    <tr>
                        <th>Party</th>
                        <th>Score</th>
                        <th>Entered By</th>
                        <th>Date Entered</th>
                    </tr>
                </thead>
                <tbody id="result">
                    
                </tbody>
        </div>
        </div>

    <script>
        $(document).ready(function(){
            //get polling unit id
            $('#searchbtn').click(function(e){
                e.preventDefault();
                var unit_id = $('#unit').val();
                if(unit_id == ""){
                    alert("Please select a polling unit");
                }else{
                    //get results
                    $.ajax({
                        url: 'question-1-process.php',
                        method: 'POST',
                        data: {unit_id: unit_id},
                        success: function(data){
                            $('#result').html(data);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>