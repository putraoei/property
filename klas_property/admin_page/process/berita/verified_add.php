<?php
class simpan{
$judul = $_POST['judul'];
$nama_penulis = $_POST['nama_penulis'];
$isi = $_POST['isi'];
$status_berita = $_POST['status_berita'];
date_default_timezone_set("Asia/Jakarta");
$time_test=date("Y-m-d H:i:s");


if($_SESSION['role']=="admin"){
	$idadmin = $_SESSION['id'];
}else{
	$idadmin = "0";
}

require_once("../../includes/function.php");
require_once("../berita/upload-foto.php"); 
$path_foto=$final_path;


//fungsi menyimpan ke database
function isi_table_berita($nama_penulis,$judul,$time_test,$kategori,$pathfoto,$isi,$status_berita,$idadmin,$db){
	$sql = "insert into tabel_berita(tabel_penulis_id_penulis,judul,tanggal_post,kategori, footage,konten,status_berita,admin_idadmin) values (:penulis,:judul,:tanggal,:kategori,:foto, :konten,:status,:admin_idadmin)";
	$stmt =$db->prepare($sql);
	$stmt->execute(['penulis'	=> $nama_penulis,
					'judul'		=> $judul,
					'tanggal'	=> $time_test,
					'kategori'	=> $kategori,
					'foto'		=> $pathfoto,
					'konten'	=> $isi,
					'status'	=> $status_berita,
					'admin_idadmin'	=> $idadmin,]);
}
//menggunakan fungsi
isi_table_berita($nama_penulis,$judul,$time_test,$kategori,$path_foto,$isi,$status_berita,$idadmin,$db);
//pesan jika berhasil ditambahkan
$_SESSION['pesan']="Data Berita telah ditambahkan";
$_SESSION['jenis_pesan'] ="info";
//mengarahkan ke laman utama berita
//header("Location: ../../index.php?page=berita");
}
?> 
<!--<meta http-equiv="Location" content="../../index.php?page=berita">-->

