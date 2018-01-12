<?php
    include('includes/dbconnection.php');
    session_start();
    if(isset($_SESSION['aid']))
    {
        $sql = "DELETE FROM product WHERE product_id='{$_GET['id']}'";
        $delete = mysqli_query($conn, $sql);
        if($delete)
        {
            $msg = "Successfully Deleted";
            header("Location: products.php?msg=$msg");    
        }
        else {
            $msg = "Unforseen Error";
            header("Location: products.php?msg=$msg");
        }

    }
    else {
        header('Location: index.php');
    }
?>