<?php
############################
## File Name: koneksi.php ##
############################

try{
	$dsn = 'mysql:host=localhost; dbname=property';
	$db = new PDO($dsn, 'root', '');
}catch(PDOException $e){
	echo $e->getMessage();
	die();
}