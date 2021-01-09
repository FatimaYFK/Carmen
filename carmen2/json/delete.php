<?php
$connect = mysqli_connect("127.0.0.1", "root", "", "carmen");
if(isset($_POST["register_user_id"]))
{
 $query = "DELETE FROM register_user WHERE register_user_id = '".$_POST["register_user_id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>