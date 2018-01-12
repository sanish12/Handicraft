<?php
    include('includes/dbconnection.php');
    session_start();
    if(isset($_SESSION['aid']))
    {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Asri Admin Panel</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
#edit-show{
    display: block;
    margin-top: -550px; 
}
</style>
</head>

<body class="fix-header card-no-border fix-sidebar">
<?php
include('templates/header.php');
?>    
<!-- header file -->
<?php
include('templates/sidebar.php');
?>
<!-- sidebar file -->

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Category Management</h3>
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                            <form action="category.php?task=new" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-12">Category Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Enter Category" name="category" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">CREATE</button>
                                        </div>
                                    </div>
                            </form>
                            </div><!-- end of card div -->
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                            <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Categories</h4>
                                    <?php
                                    if(isset($_GET['msg'])){
    echo"<div class='alert alert-success'>
    <strong>Message: </strong>".$_GET['msg']."
  </div>";
}    ?>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category Name</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $get = "SELECT * FROM category ORDER BY category_id ASC";
                                            $getQuery = mysqli_query($conn, $get);
                                            $rowcount = mysqli_num_rows($getQuery);
                                            if($rowcount>0)
                                            {
                                                while($result=mysqli_fetch_assoc($getQuery)){
                                                    $count = 1;
                                            ?>
                                                <tr>
                                                    <td class="category-id"><?php echo $result['category_id'] ?></td>
                                                    <td class="category-name"><?php echo $result['category_name'] ?></td>
                                                    <td class="edit-category">Edit</td>
                                                    <td><a href="category.php?task=delete&id=<?php echo $result['category_id'] ?>">Delete</a></td>
                                                </tr>
                                                
                                                <?php
                                                $count++;
                                                }
                                            }
                                            else {
                                                echo"<p>No products yet</p>";
                                            }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end of table div-->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <div class="row">
                <div id="edit-not-show" class="col-lg-4 col-xlg-3 col-md-5 invisible" style="margin-top: -180px;">
                        <div class="card">
                            <div class="card-body">
                            <form action="category.php?task=edit" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-12">Edit Category</label>
                                        <div class="col-md-12">
                                            <input id="category-destination" type="text" placeholder="Enter Category" name="category" class="form-control form-control-line" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="category_id" id="hidden-input" value="-1"/>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Edit</button>
                                        </div>
                                    </div>
                            </form>
                            </div><!-- end of card div -->
                        </div>
                    </div>
                <div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php 
            include('templates/footer.php');
            ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <script>
        var category_id;
        var category_name;
        $(".edit-category").on('click',function(){
            $("#edit-not-show").removeClass("invisible");
            $("#edit-not-show").addClass("visible");
            $(this).closest('tr').find(".category-id").each(function(){
                category_id = $(this).text();
                $("#hidden-input").attr("value",category_id.trim());
            });
            $(this).closest('tr').find(".category-name").each(function(){
                category_name = $(this).text();
                $("#category-destination").attr("value",category_name.trim());
            });
            
        });
        


    </script>
</body>

</html>
<?php
    }
    else {
        header('Location: index.php');
    }
?>