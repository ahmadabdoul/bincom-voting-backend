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
<title>Question 2</title>
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
                    <li><a href="question-1.php">Question 1</a></li>
                    <li class="active"><a href="question-2.php">Question 2</a></li>
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
                <p class="text text-warning">NOTE: The displayed LGAs/polling units and their associated results are only LGAs/polling units under Delta State</p>
                <div class="form-group">
                    <select id="lga" class="form-control" required>
                        <option value="">--select LGA--</option>
                        <?php
                        //get lga from lga table
                        $sql = "SELECT * FROM lga";
                        $result = mysqli_query($conn, $sql) or die("Error fetching LGAs");
                        while($row = mysqli_fetch_assoc($result)){
                            $lga = $row['lga_name'];
                            $lga_id = $row['lga_id'];
                            echo "<option value='$lga_id'>$lga</option>";
                        }
                        ?>

                    </select>
                </div>
                
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

          
           


            //get polling unit results when polling unit is selected
            $('#searchbtn').click(function(e){
                e.preventDefault();
                var lga_id = $('#lga').val();
                $.ajax({
                    url: 'question-2-process.php',
                    method: 'POST',
                    data: {lga_id: lga_id},
                    success: function(data){
                        $('#result').html(data);
                    }
                });
            });
        });
    </script>

</body>

</html>