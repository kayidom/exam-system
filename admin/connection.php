<?php
//Fetch Data from Mysql in PHP using PDO Data object
$dsn ='mysql:host=localhost;dbname=oes';
$username ='root';
$password = '';

try{

	$db = new PDO($dsn, $username,$password);
} catch(PDOException $e){
$error_Messamage = $e->getMessage();

//include'./error/database_error.php';
exit();

}
	?>

