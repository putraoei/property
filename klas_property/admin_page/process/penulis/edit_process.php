<?php
session_start();
require_once("../../koneksi/koneksi.php");

$id = $_POST['id_p'];
$username = $_POST['username_p'];
$nama = $_POST['nama_p'];
$password = $_POST['pass_p'];
$email = $_POST['email_p'];
$alamat = $_POST['alamat_p'];

if ($password==null){
$pass = $_POST['passwordlama'];
}else{
$pass = password_hash($password, PASSWORD_BCRYPT);
}

echo $id."<br>";
echo $username."<br>";
echo $nama."<br>";
echo $pass."<br>";
echo $email."<br>";
echo $alamat."<br>";

//fungsi untuk mengubah data di database
function edit_table_penulis($username,$nama,$pass,$email,$alamat, $id, $db){
	$sql = "UPDATE tabel_penulis SET username_penulis=:username_p, nama_penulis=:nama_p, password_penulis=:pass_p, email_penulis=:email_p, alamat_penulis=:alamat_p where id_penulis=:id_p";
	$stmt =$db->prepare($sql);
	$stmt->execute(['username_p' => $username,
					'nama_p' => $nama,
					'pass_p' => $pass,
					'email_p' => $email,
					'alamat_p' => $alamat,
					'id_p' => $id]);
}
//menggunakan fungsi ubah data di database
edit_table_penulis($username,$nama,$pass,$email,$alamat, $id, $db);
//pesan jika data penulis berhasil diubah
$_SESSION['pesan']="Data Penulis telah diubah";
$_SESSION['jenis_pesan'] ="info";
//mengarahkan ke laman utama penulis
		if($_SESSION['role']=="admin"){
			header("Location: ../../index.php?page=penulis");
		}else {
			header('Location: ../../index.php?page=penulis-view');
		}
?>