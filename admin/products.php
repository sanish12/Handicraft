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
    <title>Admin Pro Admin Template - The Ultimate Bootstrap 4 Admin Template</title>
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
                        <h3 class="text-themecolor">Manage Products</h3>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-3">
            <button class="btn btn-primary"><a href="addProduct.php" style="color:white;">Add Products</a></button>
            <!-- dropdown -->
            <div class="dropdown mt-2">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Select Category
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <?php
    $categorySql = "SELECT * FROM category";
    $CategoryQuery = mysqli_query($conn, $categorySql);
    $rowcount = mysqli_num_rows($CategoryQuery);
    if($rowcount>0)
    {
        while($showCategory=mysqli_fetch_assoc($CategoryQuery))
        {
  ?>  
  <a class="dropdown-item" href="showProductsByCategory.php?catid=<?php echo $showCategory['category_id']?>"><?php echo $showCategory['category_name']?></a>
<?php
        }
    }
    else {
        ?>
        <a class="dropdown-item" href="#">No categories</a>
    <?php
    }
?>  
</div>
</div>
            <!-- end of dropdown -->
        </div>
        </div><!--end of options div-->
        <div content="" style="height: 20px;"></div>
<!-- gold products -->
<div class="row">
<?php
if(isset($_GET['msg'])){
    echo"<div class='alert alert-success'>
    <strong>Message ! </strong>".$_GET['msg']."
  </div>";
}
?>
    </div>
<div content="" style="height: 20px;"></div>
    <div class="row">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Last 10 Products Added</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $get = "SELECT * FROM product ORDER BY product_id DESC";
                                        $getQuery = mysqli_query($conn, $get);
                                        $rowcount = mysqli_num_rows($getQuery);
                                        if($rowcount>0)
                                        {
                                            while($result=mysqli_fetch_assoc($getQuery)){
                                        ?>
                                            <tr>
                                                <td><?php echo $result['product_id'] ?></td>
                                                <td><img src="uploads/<?php echo $result['product_image'] ?>" height="50" width="50"/></td>
                                                <td><?php echo $result['product_name'] ?></td>
                                                <td><?php echo $result['product_price'] ?></td>
                                                <td><a href="editProduct.php?id=<?php echo $result['product_id'] ?>">Edit</a></td>
                                                <td><a href="deleteProduct.php?id=<?php echo $result['product_id'] ?>">Delete</a></td>
                                            </tr>
                                            <?php
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
</body>

</html>
<?php
    }
    else {
        header('Location: index.php');
    }
?>