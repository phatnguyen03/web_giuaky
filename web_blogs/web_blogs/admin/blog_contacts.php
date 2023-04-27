<?php 
    include "check_login.php";
    include "includes\database.php";
    include "includes\contacts.php";
    $database= new  database;
    $db = $database->connect();
    $blog_contacts= new contacts($db);

    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if($_REQUEST['frm']=='delete'){
            $blog_contacts->c_contact_id = $_REQUEST['id'];
            if($blog_contacts->delete()){
                $status = "Delete contact successfully!";
            }
        }
    }
    $stmt = $blog_contacts->read_all();
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
                            Blog contacts
                        </h1>
                        <?php if(isset($status)){ ?>
                            <div class="alert alert-success">
                                <?php echo $status?>
                            </div>
                            <?php } ?>   
                    </div>
                </div>
                <!-- /. ROW  -->        

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <button class="btn btn-danger">Delete all</button>
                                    <!-- <a href="write_blog.php" class="btn btn-primary" >Add contact</a> -->
                                </div>
                                
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Message</th>
                                                    <th>Date Create</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $num = 1;
                                                while($row = $stmt->fetch()){
                                                ?>
                                                <tr>
                                                    <td style="width:5%"><?php echo $num ?></td>
                                                    <td style="width:15%"><?php echo $row['c_fullname'] ?></td>
                                                    <td style="width:15%"><?php echo $row['c_email'] ?></td>
                                                    <td style="width:15%"><?php echo $row['c_phone'] ?></td>
                                                    <td style="width:15%"><?php echo $row['c_message'] ?></td>
                                                    <td style="width:15%"><?php echo $row['c_date_created'] ?></td>
                                                    <td style="width:20%"><!-- <a href="edit_blog.php?blog_id="" class="btn btn-warning btn-sm"><i class="fa-solid fa-pencil"></i>Edit</a> -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="<?php echo '#modal_delete'.$row['c_contact_id'] ?>"><i class="fa-solid fa-trash"></i>Delete</button>
                                                </td>
                                            </tr>
                                            
                                            <!-- Modal delete -->
                                                <div class="modal fade" id="<?php echo 'modal_delete'.$row['c_contact_id'] ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form role="form" name="frm_category_delete" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Delete contact</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            Are you sure? you want delete this contact.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="frm" value="delete">
                                                                    <input type="hidden" name="id" value="<?php echo $row['c_contact_id'] ?>">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- Modal end delete -->
                                            <?php
                                            $num++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>                   
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