<?php
ob_start();
include('includes/dbconnection.php');
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_SESSION['aid'])){
        header('Location: dashboard.php');
    }
    else {
        $name = $_POST['name'];
        $pw = $_POST['pw'];
        $sql = "SELECT * FROM adm WHERE username='$name'";
        $query= mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($query);
        if($rowcount>0)
        {
            $result = mysqli_fetch_assoc($query);
            $hashedPwdCheck = password_verify($pw, $result['password']);
            if($hashedPwdCheck == true){
                session_start();
                $_SESSION['aid'] = $result['user_id'];
                header("Location: dashboard.php");
            }
            else {
                $msg = "Authentication Mismatch";
                header("Location: index.php?msg=$msg");
            }
        }
        else {
            $msg = "No Such Username";
            header("Location: index.php?msg=$msg");
        }
        
    }
}
else {
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="includes/css/signin.css" rel="stylesheet">
  </head>

  <body>
<?php
if(isset($_GET['msg'])){
    echo"<div class='alert alert-warning'>
    <strong>Warning! </strong>".$_GET['msg']."
  </div>";
}
?>

    <div class="container">

      <form class="form-signin" action="index.php" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">User Name</label>
        <input type="text" name="name" id="inputEmail" class="form-control" placeholder="User Name" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="pw" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>
<?php
}
ob_end_flush();
?>