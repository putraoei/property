<?php
session_start();
require_once("../../koneksi/koneksi.php");

$username = $_POST['username_p'];
$nama = $_POST['nama_p'];
$password = $_POST['pass_p'];
$email = $_POST['email_p'];
$alamat = $_POST['alamat_p'];
$pass = password_hash($password, PASSWORD_BCRYPT);

//fungsi untuk menyimpan data penulis ke database
function add_table_penulis($username,$nama,$pass,$email,$alamat,$db){
	$sql = "insert into tabel_penulis(username_penulis,nama_penulis,password_penulis,email_penulis,alamat_penulis) values (:username_p,:nama_p,:pass_p,:email_p,:alamat_p)";
	$stmt =$db->prepare($sql);
	$stmt->execute(['username_p'=> $username,
					'nama_p'	=> $nama,
					'pass_p'	=> $pass,
					'email_p'	=> $email,
					'alamat_p'	=> $alamat]);
}
//menggunakan fungsi untuk menyimpan ke database
add_table_penulis($username,$nama,$pass,$email,$alamat,$db);
//pesan jika data penulis berhasil disimpan
$_SESSION['pesan']="Data Penulis telah ditambahkan";
$_SESSION['jenis_pesan'] ="info";
//mengarahkan ke laman utama penulis
header("Location: ../../index.php?page=penulis"); 
?>