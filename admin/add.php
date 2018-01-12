<?php
include('includes/dbconnection.php');
session_start();
if(isset($_SESSION['aid'])){
    $productName = $_POST['productName'];
    $cost = $_POST['cost'];
    $category = $_POST['category'];
    //start of photo file
    $file=$_FILES['photo'];
    $fileName=$_FILES['photo']['name'];
    $fileType=$_FILES['photo']['type'];
    $fileExt=explode('.',$fileName);//remove the strings before '.'
    $fileActExt= strtolower(end($fileExt));
    $fileNewName = uniqid('',true).".".$fileActExt;
  
  if(move_uploaded_file($_FILES['photo']['tmp_name'],"uploads/{$fileNewName}"))
    {
      
      $img=$fileNewName;
      echo $img;
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
$sql="INSERT INTO product
(product_name, product_price, category_id, product_image)
VALUES
('$productName', '$cost', '$category', '$img')";
$query = mysqli_query($conn, $sql);
$check = mysqli_affected_rows($conn);
if($check>0)
{
    $msg = "New Product Added";
    header("Location: addProduct.php?msg=$msg");
}
else {
    $msg = "Failure, Please Try Again";
    header("Location: addProduct.php?msg=$msg");
}
//end
}//end of session checker IF
else {
    header('index.php');
}
?>