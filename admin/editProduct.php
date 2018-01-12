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
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="pages-profile.php" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Category</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="products.php" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Products</span></a></li>
                    </ul>
                    <div class="text-center m-t-30">
                    <form action="logout.php" method="POST">
                        <button type="submit" name="submit" class="btn waves-effect waves-light btn-info hidden-md-down"> LOGOUT</a>
                    </form>
                    </div>
                </nav> 
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
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
                        <h3 class="text-themecolor">Edit Product</h3>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                <?php
if(isset($_GET['msg'])){
    echo"<div class='alert alert-success'>
    <strong>Message: </strong>".$_GET['msg']."
  </div>";
}
$getProduct = "SELECT * FROM product WHERE product_id='{$_GET['id']}'";
$getProductQuery = mysqli_query($conn, $getProduct);
$rowcount = mysqli_num_rows($getProductQuery);
if($rowcount>0)
{
    $result = mysqli_fetch_assoc($getProductQuery);
?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
<form action="edit.php" method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Product Name</label>
      <input type="text" name="productName" class="form-control" id="inputEmail4" value="<?php echo $result['product_name'] ?>" required>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputFile">Product Image (Upload a new file to replace old file, else ignore) </label>
    <input type="file" name="photo" class="form-control" id="inputFile">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Cost</label>
      <input type="number" name="cost" class="form-control" id="inputCity" value="<?php echo $result['product_price'] ?>" required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Category</label>
      <select id="inputState" name="category" class="form-control" required>
      <?php
      $option = "SELECT * FROM category WHERE category_id='{$result['category_id']}'";
      $optionQuery = mysqli_query($conn, $option);
      $cat = mysqli_fetch_assoc($optionQuery);
      ?>
        <option value="<?php echo $result['category_id'] ?>" selected><?php echo $cat['category_name'] ?></option>
<?php
$sql="SELECT * FROM category";
$query = mysqli_query($conn, $sql);
while($cresult=mysqli_fetch_assoc($query))
{
?>
        <option value="<?php echo $cresult['category_id'] ?>"><?php echo $cresult['category_name']  ?></option>
<?php
}
?>
      </select>
    </div>
  </div>
 <input type="hidden" name="id" value="<?php echo $result['product_id'] ?>"/>
  <button type="submit" class="btn btn-primary">Edit</button>
</form>
                            </div>
                        </div>
                    </div>
<?php
}
else {
    header("Location: products.php?msg=No Such Prodcut");
}

?>
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