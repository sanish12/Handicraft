<?php
$conn=mysqli_connect('localhost','root','','handicraft_new');
if(mysqli_connect_errno())
{
  die("Database Connection Failed !".mysqli_connect_error()."(".mysqli_connect_errno().")");
}
?>
