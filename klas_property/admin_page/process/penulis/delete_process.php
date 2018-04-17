<?php
include_once("../../koneksi/koneksi.php");
session_start();
//menampung id penulis
$id = $_GET['id'];
//menghapus penulis berdasar dari id penulis
$sql = "DELETE FROM tabel_penulis where id_penulis = :id";
$stmt = $db->prepare($sql);
$stmt->execute(['id'=>$id]);
//pesan jika data penulis sudah di hapus
$_SESSION['pesan']="Data penulis berhasil di hapus.";
$_SESSION['jenis_pesan']="danger";
//diarahkan ke laman utama penulis
header('Location: ../../index.php?page=penulis');
?>
