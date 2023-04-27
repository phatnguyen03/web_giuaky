
<?php  
include "check_login.php";
include "includes\database.php";
include "includes\user.php";
include "check_files_upload.php";

	$database = new database;
	$db = $database->connect();
	$user = new user($db);
	$user->user_id=$_SESSION['user_id'];
	 
	$pathImage = "../images/avatars/";
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if($_REQUEST['frm']=='edit') {
			$user->user_fullname = $_REQUEST['user_fullname'];
			$user->user_email = $_REQUEST['user_email'];
			$user->user_password = sha1($_REQUEST['user_password']);
			$user->user_phone = $_REQUEST['user_phone'];
			$user->user_infor = $_REQUEST['user_infor'];
            $user->user_image = $_FILES['user_image']['name'];
            
			if(isset($_FILES['user_image'])){
                
                $fileUpload = $_FILES['user_image'];
                $file=validateUploadFile($fileUpload,$pathImage);
                if($file!=false){

                     move_uploaded_file($fileUpload['tmp_name'], $pathImage.$fileUpload['name']);
                }
            }
    			
		}
        if($user->update()){
            $status = "Update user profile successfully";
        }
    }
      $row=$user->read(); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blogs | Dashboard</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/card.css">
</head>

<body>
    <div id="wrapper">
        <?php include "includes/header.php"; ?>
        <!--/. NAV TOP  -->
        <?php include "includes/sidebar.php" ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                
                <!-- /. ROW  -->
                <h2>User Profile</h2>
                <?php 
                	if(isset($status)){ ?>
                        <div class="alert alert-success">
                            <?php echo $status?>
                        </div>
                <?php 
            		} 

                ?> 
					<div class="card">
					  <img src="<?php echo $pathImage.$row['user_image']; ?>" alt="<?php echo $row['user_infor']; ?>">
					  <h1><?php echo $row['user_fullname']; ?></h1>
					  <p class="title"><?php echo $row['user_email']; ?></p>
					  <p><?php echo $row['user_phone']; ?></p>
					  <p><?php echo $row['user_infor']; ?></p>
					  <div class="menu-contact">
					    <a href="#"><i class="fa fa-google"></i></a>  
					    <a href="#"><i class="fa fa-linkedin"></i></a>  
					    <a href="#"><i class="fa fa-facebook"></i></a> 
					  </div>
					  <p><button data-toggle="modal" data-target="<?php echo '#modal_edit'.$row['user_id'] ?>">Edit</button></p>
					</div>

                <!-- /. ROW  -->

                <!-- Modal Edit  -->
                <div class="modal fade" id="<?php echo 'modal_edit'.$row['user_id'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form role="form" name="frm_userProfile_edit" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">                                
                                                                    <div class="form-group">
                                                                        <label>Full name</label>
                                                                        <input class="form-control" name="user_fullname" id="user_fullname" value="<?php echo $row['user_fullname'] ?>">                           
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input class="form-control" name="user_email" id="user_email" value="<?php echo $row['user_email'] ?>">                           
                                                                    </div>
                                                                     <div class="form-group">
                                                                        <label>Password</label>
                                                                        <input type="Password"class="form-control" name="user_password" id="user_password" value="<?php echo $row['user_password']; ?>">                           
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Phone</label>
                                                                        <input class="form-control" name="user_phone" id="user_phone" value="<?php echo $row['user_phone'] ?>">                           
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Info</label>
                                                                        <input class="form-control" name="user_infor" id="user_infor" value="<?php echo $row['user_infor'] ?>">                           
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Avatar</label>
                                                                        <input type="file"  name="user_image" id="user_image">                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="frm" value="edit">
                                                            <input type="hidden" name="id" value="<?php echo $row['user_id'] ?>">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                            <button style="margin-left: 0px !important; margin-top: 10px;" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                <!-- End modal edit -->

                <footer><p>Copyright 2023 Tan phat</p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>

</body>

</html>