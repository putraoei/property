<?php
session_start();
require_once("../../koneksi/koneksi.php");

$idberita = $_POST['idberita'];
$judul = $_POST['judul'];
$nama_penulis = $_POST['nama_penulis'];
$kategori = $_POST['id_kategori'];
$isi = $_POST['isi'];
$status_berita = $_POST['status_berita'];
$idadmin= $_POST['id_admin'];

if ($_FILES['foto']['name']==null){
	$final_path=$_POST['fotolama'];
}else{
require_once("../../includes/function.php");
require_once("../berita/upload-foto.php"); 
}

/* echo $idberita."<br>";
echo $judul."<br>";
echo $nama_penulis."<br>";
echo $kategori."<br>";
echo $isi."<br>";
echo $status_berita."<br>";
echo $idadmin."<br>"; */
//fungsi mengubah data berita di database
function edit_table_berita($nama_penulis,$judul,$kategori,$final_path,$isi,$status_berita,$idadmin,$idberita,$db){
	$sql = "UPDATE tabel_berita SET tabel_penulis_id_penulis=:penulis, judul=:judul_berita, kategori=:kategori_berita, footage=:foto_berita,konten=:konten_berita, status_berita=:status, admin_idadmin=:admin_id where idtabel_berita=:idberita";
	$stmt =$db->prepare($sql);
	$stmt->execute(['penulis' => $nama_penulis,
					'judul_berita' => $judul,
					'kategori_berita' => $kategori,
					'foto_berita' => $final_path,
					'konten_berita' => $isi,
					'status' => $status_berita,
					'admin_id' => $idadmin,
					'idberita' => $idberita ]);
}

//menggunakan fungsi
edit_table_berita($nama_penulis,$judul,$kategori,$final_path,$isi,$status_berita,$idadmin,$idberita,$db);
//pesan jika berita berhasil di ubah
$_SESSION['pesan']="Data Berita telah diubah";
$_SESSION['jenis_pesan'] ="info";
//mengarahkan ke laman utama berita
header("Location: ../../index.php?page=berita"); 
?>