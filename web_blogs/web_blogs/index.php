<?php  
    include "admin/includes/database.php";
    include "admin/includes/user.php";
    include "admin/includes/categories.php";
    include "admin/includes/blogs.php";
    include "admin/includes/subscribe.php";

    $database = new database;
    $db = $database->connect();

    $user = new user($db);
    $cate = new categories($db);
    $blog = new blogs($db);
    $blog_subscribe = new subscribes($db);
    if($_SERVER['REQUEST_METHOD']=='POST') {
        if($_REQUEST['subscribe'] =='subscribe') {
            $blog_subscribe->s_sub_email=$_GET['dEmail'];
        }
    }

    $count_user_access = 'admin/count_ip_access.txt';
    $ip_access = 'admin/ip_access.txt';
    function counting () {
        $ip=$_SERVER['REMOTE_ADDR'];
        global $count_user_access,$ip_access;
        $arr_ip = file($ip_access,FILE_IGNORE_NEW_LINES);
        if(!in_array($ip_access,$arr_ip)) {
            $current_value = (file_exists($count_user_access)) ? file_get_contents($count_user_access):0;
            file_put_contents($ip_access, $ip."\n",FILE_APPEND);
            file_put_contents($count_user_access,++$current_value);
        }
    }
    counting ();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Calvin</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script defer src="js/fontawesome/all.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

</head>

<body id="top">
    <!-- preloader
    ================================================== -->
    <div id="preloader"> 
    	<div id="loader"></div>
    </div>

    <!-- header
    ================================================== -->
    <?php  
    include "header.php";
    ?>
    <!-- end s-header -->

    <!-- banner
    ================================================== -->
    <?php  
    include "banner.php";
    ?>
    <!-- end s-banner -->

    <!-- content
    ================================================== -->
    <?php  
    include "content.php";
    ?>
    <!-- end s-content -->


    <!-- footer
    ================================================== -->
    <?php  
    include "footer.php";
    ?>
    <!-- end s-footer -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>

</html>