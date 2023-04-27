<?php  
include "includes/database.php";	
include "includes/user.php";

$database = new database;
$db = $database->connect();
$user = new user($db);
$error = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
	$user->user_email = $_REQUEST['email'];
	$user->user_password = sha1($_REQUEST['password']);
	$stmt = $user->login();
	
	if($stmt->rowCount()){
		$row=$stmt->fetch();
		session_start();
		$_SESSION['user_id'] = $row['user_id'];
		header("location:index.php");
	}else{
		$error = "Invalid login!";
	}
}
//echo $error;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Admin</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body class="bg-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto pt-5">
                <div class="card card-container">
                    <div class="card-header">
                        <h3>Login Administrator</h3>
                        <?php 
                          if($error){ ?>
                          <div class="alert alert-danger">  <?php echo $error ?>                           
                          </div>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <form method="post" action="login.php">
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email">
                            
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                          </div>
                          <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
 
</body>

</html>