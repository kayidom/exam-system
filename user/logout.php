<?php
session_start();
if(isset($_SESSION['email']))
{
	unset($_SESSION['email']);
}
header("location:userlogin.php");
session_destroy();
?>