<?php  
    include "admin/includes/database.php";
    include "admin/includes/blogs.php";
    include "admin/includes/user.php";
    include "admin/includes/categories.php";
    include "admin/includes/subscribe.php";
    include "admin/includes/contacts.php";

    $database= new  database;
    $db = $database->connect();
    $blog_contacts= new contacts($db);
    $user = new user($db);
    $cate = new categories($db);
    $blog = new blogs($db);
    $blog_subscribe = new subscribes($db);

    if($_SERVER['REQUEST_METHOD']=='POST') {

        if($_REQUEST['subscribe'] =='subscribe') {
            $blog_subscribe->s_sub_email=$_GET['dEmail'];
        } else { 
           $blog_contacts->c_fullname=$_REQUEST['cName'];
           $blog_contacts->c_email=$_REQUEST['cEmail'];
           $blog_contacts->c_phone=$_REQUEST['cPhone'];
           $blog_contacts->c_message=$_REQUEST['cMessage'];
           if($blog_contacts->add()) {
                $status = "Contact successfuly !!!";
           }
        }
    }
    
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Contact - Calvin</title>
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
    ================================================== -->\
    <?php include "header_s.php" ?>
    <!-- end s-header -->


    <!-- content
    ================================================== -->
    <section class="s-content">
        <?php if(isset($status)){ ?>
                <div class="alert alert-success">
                    <?php echo $status?>
                </div>

        <?php } ?>
        <div class="row">
            <div class="column large-12">

                <article class="s-content__entry">

                    <div class="s-content__media">
                        <img src="images/thumbs/contact/contact-1050.jpg" 
                                srcset="images/thumbs/contact/contact-2100.jpg 2100w, 
                                        images/thumbs/contact/contact-1050.jpg 1050w, 
                                        images/thumbs/contact/contact-525.jpg 525w" sizes="(max-width: 2100px) 100vw, 2100px" alt="">
                    </div> <!-- end s-content__media -->

                    <div class="s-content__entry-header">
                        <h1 class="s-content__title">Get In Touch With Us.</h1>
                    </div> <!-- end s-content__entry-header -->

                    <div class="s-content__primary">

                        <div class="s-content__page-content">

                            <p class="lead">
                            Lorem ipsum Deserunt est dolore Ut Excepteur nulla occaecat magna occaecat Excepteur nisi esse veniam 
                            dolor consectetur minim qui nisi esse deserunt commodo ea enim ullamco non voluptate consectetur minim 
                            aliquip Ut incididunt amet ut cupidatat.
                            </p> 

                            <div class="row block-large-1-2 block-tab-full s-content__blocks">
                                <div class="column">
                                    <h4>Where to Find Us</h4>
                                    <p>
                                    1600 Amphitheatre Parkway<br>
                                    Mountain View, CA<br>
                                    94043 US
                                    </p>
                                </div>

                                <div class="column">
                                    <h4>Contact Info</h4>
                                    <p>
                                    someone@yourdomain.com<br>
                                    info@yourdomain.com <br>
                                    Phone: (+63) 555 1212
                                    </p> 
                                </div>
                            </div> <!-- end s-content__blocks -->

                            <form name="cForm" id="cForm" class="s-content__form" method="post" action="" onsubmit="check_all()">
                                <fieldset>

                                    <div class="form-field">
                                        <input name="cName" type="text" id="cName" class="h-full-width h-remove-bottom" placeholder="Your Name" value="" onblur="check_name()">
                                        <p id="message_name"></p>
                                    </div>

                                    <div class="form-field">
                                        <input name="cEmail" type="text" id="cEmail" class="h-full-width h-remove-bottom" placeholder="Your Email" value="" onblur="check_email()">
                                        <p id="message_email"></p>
                                    </div>

                                    <div class="form-field">
                                        <input name="cPhone" type="text" id="cPhone" class="h-full-width h-remove-bottom" placeholder="Phone"  value="" onblur="check_phone()">
                                        <p id="message_phone"></p>
                                    </div>

                                    <div class="message form-field">
                                        <textarea name="cMessage" id="cMessage" class="h-full-width" placeholder="Your Message" ></textarea>
                                    </div>

                                    <br>
                                    <button type="submit" class="submit btn btn--primary h-full-width">Submit</button>

                                </fieldset>
                            </form> <!-- end form -->

                        </div> <!-- end s-entry__page-content -->

                    </div> <!-- end s-content__primary -->
                </article> <!-- end entry -->

            </div> <!-- end column -->
        </div> <!-- end row -->

    </section> <!-- end s-content -->


    <!-- footer
    ================================================== -->
    <?php include "footer.php" ?>
     <!-- end s-footer -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
        function check_name() {
            var status = false;
            var regexName=/\w+/;
            var message = "";
            if(document.cForm.cName.value==""){
                message = "Name is required...";
                document.cForm.cName.focus();
            } else {
                if(regexName.test(document.cForm.cName.value)==false){
                    message= "Name is invalid...";
                    document.cForm.cName.focus();
                    
                }
                status=true;
            }
            document.getElementById("message_name").innerHTML=message;
            document.getElementById("message_name").style.color='red';
            return status;
        }
        function check_email() {
            var status = false;
            var regexEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var message = "";
            if(document.cForm.cEmail.value==""){
                message = "Email is required...";
                document.cForm.cEmail.focus();
            } else {
                if(regexEmail.test(document.cForm.cEmail.value)==false){
                    message= "Email is invalid...";
                    document.cForm.cEmail.focus();
                    
                }
                status=true;
            }
            document.getElementById("message_email").innerHTML=message;
            document.getElementById("message_email").style.color='red';
            return status;
        }
        function check_phone() {
            var status = false;
            var regexPhone=/\d{10}/;
            var message = "";
            if(document.cForm.cPhone.value==""){
                message = "Email is required...";
                document.cForm.cPhone.focus();
            } else {
                if(regexPhone.test(document.cForm.cPhone.value)==false){
                    message= "Email is invalid...";
                    document.cForm.cPhone.focus();
                }
                 status=true;
            }
            document.getElementById("message_phone").innerHTML=message;
            document.getElementById("message_phone").style.color='red';
            return status;
        }
        function  check_all() {
            if(check_name() && check_email() && check_phone()){
                return true;
            } else 
                return false;
        }
    </script>
</body>

</html>