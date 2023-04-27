<?php 
    include "check_login.php";
	include "includes\database.php";
    include "includes\blogs.php";
    include "includes\categories.php";
    include "check_files_upload.php";

    $database = new database;
    $db = $database->connect();
    $blogs = new blogs($db);
    $cate = new categories($db);
    $stmt_cate =$cate->read_all();
    $stmt_blog=$blogs->read_all();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $blogs->blog_id = $_REQUEST['id'];
        $blogs->blog_name=$_REQUEST['blog_name'];
        $blogs->category_id=$_REQUEST['category_id'];
        $blogs->blog_summary=$_REQUEST['blog_summary'];
        $blogs->blog_content=$_REQUEST['blog_content'];
        $blogs->blog_main_image=$_FILES['blog_main_image']['name'];
        $blogs->blog_alt_image=$_FILES['blog_alt_image']['name'];
        $blogs->blog_place=$_REQUEST['blog_place'];

        if(isset($_FILES['blog_main_image'])){

            $fileUpload = $_FILES['blog_main_image'];
            $uploadPath = "../uploads/main/";
            $file=validateUploadFile($fileUpload,$uploadPath);
            if($file!=false){

                 move_uploaded_file($fileUpload['tmp_name'], $uploadPath.$fileUpload['name']);
            } else {
                echo "Upload faild!!!";
            }
        }
        if(isset($_FILES['blog_alt_image'])){
            $fileUpload = $_FILES['blog_alt_image'];
            $uploadPath = "../uploads/alt/";
            $file=validateUploadFile($fileUpload,$uploadPath);
            if($file!=false){
                 move_uploaded_file($fileUpload['tmp_name'], $uploadPath.$fileUpload['name']);
            }else {
                echo "Upload faild!!!";
            }
        }
        if($blogs->update()){
            header('location:blogs.php?update=success');
        }

    }


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

    <!-- Summer Note -->
    <!-- include libraries(jQuery, bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
                            Update a blog
                        </h1>    
                    </div>
                </div>
                <!-- /. ROW  -->        
            
                <div class="row">
                    <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Blog Post
                        </div>
                    <?php 
		            	$num=1;
		            	if($row = $stmt_blog->fetch()) {

            		?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Post name</label>
                                            <input class="form-control" name="blog_name" value="<?php echo $row['blog_name']?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Catepory</label>
                                            <select class="form-control" name="category_id">
                                                <option>Select category</option>
                                                <?php 
                                                    while ($row_cate = $stmt_cate->fetch()) {
                                                        echo "<option value='".$row_cate['category_id']."'>".$row_cate['category_name']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Blog main image</label>
                                            <input type="file" name="blog_main_image" value="<?php echo $row['blog_main_image']?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Blog alt image</label>
                                            <input type="file" name="blog_alt_image" value="<?php echo $row['blog_alt_image']?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Blog summary</label>
                                            <textarea id="blog_summary" class="form-control" rows="3" name="blog_summary"><?php echo $row['blog_summary'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Blog content</label>
                                            <textarea id="blog_content" class="form-control" rows="3" name="blog_content" ><?php echo $row['blog_content'] ?></textarea>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Blog home place</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="blog_place" id="blog_place1" value="1" >1
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="blog_place" id="blog_place2" value="2">2
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="blog_place" id="blog_place3" value="3">3
                                            </label>
                                        </div>
                
                                        <button type="submit" class="btn btn-primary">Submit Button</button>
                                        <input type="hidden" name="id" value="<?php echo $row['blog_id'] ?>">
                                        <button type="reset" class="btn btn-warning">Reset Button</button>
                                    </form>
                                </div>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <?php
                           		$num++;  
                            }
                        ?> 
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
    <!-- <script src="assets/js/jquery-1.10.2.js"></script> -->
    <!-- Bootstrap Js -->
    <!-- <script src="assets/js/bootstrap.min.js"></script> -->
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script>
      $('#blog_summary').summernote({
        placeholder: 'Hello Pro',
        tabsize: 2,
        height: 100
      });
      $('#blog_content').summernote({
        placeholder: 'Hello Pro',
        tabsize: 2,
        height: 100
      });
    </script>
</body>

</html>