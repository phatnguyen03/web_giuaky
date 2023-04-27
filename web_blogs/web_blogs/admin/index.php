<?php  
    include "check_login.php";
    include "includes\database.php";
    include "includes\contacts.php";
    include "includes\subscribe.php";
    include "includes\blogs.php";
    $database = new database;
    $db=$database->connect();
    $blog_contacts= new contacts($db);
    $blog_subscribers = new subscribes($db);
    $blogs = new blogs($db);

    $total_contacts = $blog_contacts->total();
    $total_subscribers = $blog_subscribers->total();
    $total_blogs = $blogs->total();
    
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
</head>

<body>
    <div id="wrapper">
        <?php include "includes/header.php"; ?>
        <!--/. NAV TOP  -->
        <?php include "includes/sidebar.php" ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Dashboard <small>Summary of your App</small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->

                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-envelope fa-5x"></i>
                                <h3><?php echo $total_contacts; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Email Contact

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="fa fa-book fa-5x"></i>
                                <h3><?php echo $total_blogs; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                Blogs

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-bell fa-5x"></i>
                                <h3><?php echo $total_subscribers; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Subscribers

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="fa fa-users fa-5x"></i>
                                <?php 
                                    $file = file('count_ip_access.txt');
                                    
                                        foreach ($file as $value) {
                                            if($value){
                                                echo "<h3>".$value."</h3>";
                                            }
                                            else {
                                                echo "<h3>0</h3>";
                                            }
                                        }
                                ?>
                                
                            </div>
                            <div class="panel-footer back-footer-brown">
                                Visitors

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                </div>
                <!-- /. ROW  -->

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