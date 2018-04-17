<?php // process/logout.php
session_start();

//hapus semua variabel session
$_SESSION['login'] = null;
$_SESSION['role'] = null;

//redirect ke halaman login
header('Location: ../login.php'); 

?>