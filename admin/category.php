<?php
    include('includes/dbconnection.php');
    session_start();
    if(isset($_SESSION['aid']))
    {
        if($_GET['task']=="new")
        {
               $category = $_POST['category'];
                $sql = "INSERT into category (category_name) VALUES ('$category')";
                $sqlQuery = mysqli_query($conn, $sql);
                if($sqlQuery)
                {
                    header("Location: pages-profile.php?msg=Success");
                }
                else {
                    header("Location: pages-profile.php?msg=Failure");
                }
        }
           
        
        elseif($_GET['task']=="edit")
        {
            $category = $_POST['category'];
            $catId = $_POST['category_id'];
            if($catId !=-1)
            {
                
            $find = "UPDATE category SET category_name='$category' WHERE category_id='$catId'";
                $findQuery = mysqli_query($conn, $find);
                if($findQuery){
                header("Location: pages-profile.php?msg=Edit Success");
                }
                else {
                    header("Location: pages-profile.php?msg=Edit Failure");
                }
            
             }//end of catID IF 
             else {
                 header("Location: pages-profile.php?msg=Atish Script Error");
             }
        
        }
        elseif($_GET['task']=="delete")
        {
            
            $delete = "DELETE FROM category WHERE category_id='{$_GET['id']}'";
            $query = mysqli_query($conn, $delete);
            if($query){
                header("Location: pages-profile.php?msg=Delete Success");
            }
            else {
                header("Location: pages-profile.php?msg=Delete Failed");
            }
        }

    }
    else {
        header('Location: index.php');
    }
?>