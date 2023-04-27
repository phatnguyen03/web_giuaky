<?php
include "check_login.php";
include "includes\database.php";
include "includes\categories.php";

$database = new database;
$db = $database->connect();
$categories = new categories($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
    if($_REQUEST['frm']=='edit'){
        $categories->category_id = $_REQUEST['id'];
        $categories->category_name = $_REQUEST['category_name'];
        $categories->category_description = $_REQUEST['category_description'];
        if($categories->update()){
            $status = "Update category successfully!";
        }
    }
    if($_REQUEST['frm']=='add'){
        $categories->category_name = $_REQUEST['category_name'];
        $categories->category_description = $_REQUEST['category_description'];
        if($categories->add()){
            $status = "Add category successfully!";
        }
    }
    if($_REQUEST['frm']=='delete'){
        $categories->category_id = $_REQUEST['id'];
        if($categories->delete()){
            $status = "Delete category successfully!";
        }
    }
}

$stmt = $categories->read_all();

/*echo "<pre>";
print_r($stmt->fetchall());
echo "</pre>";*/
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
                            Blog categories
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
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_add">Add category</button>
                            </div>
                            <!-- Modal add -->
                            <div class="modal fade" id="modal_add">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form role="form" name="frm_category_add" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Add category</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">                                
                                                    <div class="form-group">
                                                        <label>Category name</label>
                                                        <input class="form-control" name="category_name" id="category_name">                           
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <input class="form-control" name="category_description" id="category_description">                           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="frm" value="add">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal end --> 
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category</th>
                                                <th>Description</th>
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
                                                <td style="width:30%"><?php echo $row['category_name'] ?></td>
                                                <td style="width:45%"><?php echo $row['category_description'] ?></td>
                                                <td style="width:20%"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="<?php echo '#modal_edit'.$row['category_id'] ?>"><i class="fa-solid fa-pencil"></i>Edit</button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="<?php echo '#modal_delete'.$row['category_id'] ?>"><i class="fa-solid fa-trash"></i>Delete</button>
                                                </td>
                                            </tr>                                            

                                            <!-- Modal edit -->
                                            <div class="modal fade" id="<?php echo 'modal_edit'.$row['category_id'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form role="form" name="frm_category_edit" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title" id="myModalLabel">Edit category</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">                                
                                                                    <div class="form-group">
                                                                        <label>Category name</label>
                                                                        <input class="form-control" name="category_name" id="category_name" value="<?php echo $row['category_name'] ?>">                           
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <input class="form-control" name="category_description" id="category_description" value="<?php echo $row['category_description'] ?>">                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="frm" value="edit">
                                                            <input type="hidden" name="id" value="<?php echo $row['category_id'] ?>">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal end edit -->

                                            <!-- Modal delete -->
                                            <div class="modal fade" id="<?php echo 'modal_delete'.$row['category_id'] ?>">
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
                                                                    Are you sure? you want delete this category.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="frm" value="delete">
                                                            <input type="hidden" name="id" value="<?php echo $row['category_id'] ?>">
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