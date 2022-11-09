<?php
session_start();
require_once 'assets/connection.php';
require_once 'assets/inject.php';

if(isset($_GET['errormsg'])){
    $errormsg = $_GET['errormsg'];
}

if(isset($_POST['submit'])){
    $email = mysql_entities_fix_string($conn, $_POST['email']);

    $sql = "SELECT * FROM agentname WHERE email = '$email'";
    $result = mysqli_query($conn, $sql) or die("An Error Occured");
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $_SESSION['email'] = $email;
        header('Location: question-1.php');
        exit();
    }else{
        $errormsg = "Invalid Email";
    }

}

?>

<html>
<head>
<title>Bincom Login</title>
<!-- bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>


    <!-- login form -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text text-danger"><?php echo @$errormsg; ?></p>
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="submit" type="submit" value="Login">

                                </div>
                    </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>


</html>
