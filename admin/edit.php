<?php
include('includes/dbconnection.php');
session_start();
if(isset($_SESSION['aid'])){
    $productName = $_POST['productName'];
    $cost = $_POST['cost'];
    $category = $_POST['category'];
    //start of photo file
    if(is_uploaded_file($_FILES['photo']['tmp_name']))
    {
    $file=$_FILES['photo'];
    $fileName=$_FILES['photo']['name'];
    $fileType=$_FILES['photo']['type'];
    $fileExt=explode('.',$fileName);//remove the strings before '.'
    $fileActExt= strtolower(end($fileExt));
    $fileNewName = uniqid('',true).".".$fileActExt;
  
  if(move_uploaded_file($_FILES['photo']['tmp_name'],"uploads/{$fileNewName}"))
    {
      $img=$fileNewName;
    }
    else{
      echo"<p>Your File could not be uploaded because: ";
      switch ($_FILES['photo']['error']) {
        case 1:
          echo"File size exceeds Limit set by PHP";
          break;
        case 2:
        echo"File size exceeds limits set by browser";
        break;
        case 3:
        echo "File was only partially uploaded";
        break;
        case 4:
        echo "No file was uploaded";
        break;
        case 6:
        echo "No temporary directory";
        break;
        default:
          echo"Unforeseen Error !";
          break;
      }//end of switch
      echo".</p>";
    }//end of error (else) condition
    //end of photo file
//send to db
$updt="UPDATE product
SET product_name='$productName', product_price='$cost', 
category_id='$category', product_image='$img' 
WHERE product_id='{$_POST['id']}'";
$updtQuery = mysqli_query($conn, $updt);
if($updtQuery)
{
    $pid = $_POST['id'];
    $msg = "Edit Successfull";
    header("Location: editProduct.php?msg=$msg&id=$pid");
}
else {
    $pid = $_POST['id'];
    $msg = "Failure, Please Try Again";
    header("Location: editProduct.php?msg=$msg&id=$pid");
}
    }
//end of is uploaded 
else{
    $updt="UPDATE product
    SET product_name='$productName', product_price='$cost',  category_id='$category' 
    WHERE product_id='{$_POST['id']}'";
    $updtquery = mysqli_query($conn, $updt);
    if($updtquery)
    {
        $pid = $_POST['id'];
        $msg = "Edit Successfull";
        header("Location: editProduct.php?msg=$msg&id=$pid");
    }
    else {
        $pid = $_POST['id'];
        $msg = "Failure, Please Try Again";
        header("Location: editProduct.php?msg=$msg&id=$pid");
    }
}
//end
}//end of session checker IF
else {
    header('login.php');
}
?>