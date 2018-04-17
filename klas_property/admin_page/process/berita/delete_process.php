<?php
include_once("../../koneksi/koneksi.php");
session_start();
//ambil id berita yang di hapus
$id = $_GET['id'];
//fungsi menghapus gambar berita
function delete_gambar($id,$db){
	$sql = "select * FROM tabel_berita where idtabel_berita = :id";
	$stmt = $db->prepare($sql);
	$stmt->execute(['id'=>$id]);
	$row = $stmt->fetch();
	$filename =  "../../".$row['footage'];
	$filename2 = explode("/",$row['footage']);
	print_r($filename2);
	$filename_tmp =  "../../uploads/tmp/".$filename2[1];
	unlink($filename);
	unlink($filename_tmp);
	//menggunakan fungsi hapus berita di database
	hapus($id,$db);
}
//fungsi menghapus berita di database
function hapus($id,$db){
	$sql = "DELETE FROM tabel_berita where idtabel_berita = :id";
	$stmt = $db->prepare($sql);
	$stmt->execute(['id'=>$id]);
	$_SESSION['pesan']="Data berita berhasil di hapus.";
	$_SESSION['jenis_pesan']="danger";
	header('Location: ../../index.php?page=berita');
}
//menggunakan fungsi hapus
delete_gambar($id,$db);
?>
