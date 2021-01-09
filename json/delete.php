<?php
$connect = mysqli_connect("localhost", "root", "", "carmen");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM register_user WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>