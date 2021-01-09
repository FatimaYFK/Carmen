<?php
//logout.php
echo session_id();

session_start();

session_destroy();

header("location:login.php");

?>