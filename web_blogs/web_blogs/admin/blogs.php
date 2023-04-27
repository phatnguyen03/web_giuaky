<?php
include "check_login.php";
include "includes\database.php";
include "includes\categories.php";
include "includes\blogs.php";
$database = new database;
$db = $database->connect();
$cate = new categories($db);
$blogs = new blogs($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
        /*if($_REQUEST['frm']=='edit'){
            $blogs->blog_name=$_REQUEST['blog_name'];
            $blogs->category_id=$_REQUEST['category_id'];
            $blogs->blog_summary=$_REQUEST['blog_summary'];
            $blogs->blog_content=$_REQUEST['blog_content'];
            $blogs->blog_main_image=$_FILES['blog_main_image']['name'];
            $blogs->blog_alt_image=$_FILES['blog_alt_image']['name'];
            $blogs->blog_place=$_REQUEST['blog_place'];
            if($blogs->update()){
                $status = "Update blog successfully!";
            }
        }*/
        
        if($_REQUEST['frm']=='delete'){
            $blogs->blog_id = $_REQUEST['id'];
            $blogs->blog_main_image=$_REQUEST['blog_main_image'];
            $blogs->blog_alt_image=$_REQUEST['blog_alt_image'];
            if(isset($blogs->blog_main_image)){
                $path="../uploads/main/".'/'.$_REQUEST['blog_main_image'];
                unlink($path);
            }
            if(isset($blogs->blog_alt_image)){
                $path="../uploads/alt/";
                unlink($path.'/'.$_REQUEST['blog_alt_image']);
            }
            if($blogs->delete()){
                $status = "Delete blog successfully!";
            }

        }

        
}

if(isset($_GET['add'])){
    $status = "Add blog post successfully!";
}
if(isset($_GET['update'])){
    $status = "Update blog post successfully!";
}
$stmt = $blogs->read_all();
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
        <!-- Font awesome -->
        <script src="http://kit.fontawesome.com/d8627d2dca.js" crossorigin="anonymous"></script>
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
                            Blogs
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
                            <!--   Kitchen Sink -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <button class="btn btn-danger">Delete all</button>
                                    <a href="write_blog.php" class="btn btn-primary" >Add blog post</a>
                                </div>
                                
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Blog Name</th>
                                                    <th>Category Name</th>
                                                    <th>Date created</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $num = 1;
                                                while($row = $stmt->fetch()){
                                                $cate->category_id = $row['category_id'];
                                                $cate->read();
                                                ?>
                                                <tr>
                                                    <td style="width:5%"><?php echo $num ?></td>
                                                    <td style="width:35%"><?php echo $row['blog_name'] ?></td>
                                                    <td style="width:20%"><?php echo $cate->category_name ?></td>
                                                    <td style="width:20%"><?php echo $row['blog_date_created'] ?></td>
                                                    <td style="width:20%"><a href="edit_blog.php?blog_id=<?php echo $row['blog_id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pencil"></i>Edit</a>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="<?php echo '#modal_delete'.$row['blog_id'] ?>"><i class="fa-solid fa-trash"></i>Delete</button>
                                                </td>
                                            </tr>
                                            
                                            <!-- Modal delete -->
                                                <div class="modal fade" id="<?php echo 'modal_delete'.$row['blog_id'] ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form role="form" name="frm_category_delete" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Delete category</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            Are you sure? you want delete this blog.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="frm" value="delete">
                                                                    <input type="hidden" name="id" value="<?php echo $row['blog_id'] ?>">
                                                                    <input type="hidden" name="blog_main_image" value="<?php echo $row['blog_main_image'] ?>">
                                                                    <input type="hidden" name="blog_alt_image" value="<?php echo $row['blog_alt_image'] ?>">
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
                        <!-- End  Kitchen Sink -->
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