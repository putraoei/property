<?php 
$nama_file_foto = $_FILES['foto']['name'];
$ukuran_file_foto = $_FILES['foto']['size'];
$tmp_file_foto = $_FILES['foto']['tmp_name'];

//dapatkan ekstensi file foto yg di upload
$ext_foto = explode(".", $nama_file_foto);
$ext_foto = end($ext_foto);
$ext_foto = strtolower($ext_foto);

//daftar ekstensi gambar yang diperbolehkan untuk foto

$ext_boleh = array ("jpg","png","gif");
//ukuran minimun foto yg boleh di upload adalah 2mb
$ukuran_boleh=2*1024*1024;

$nama_foto = preg_replace('/[^A-Za-z0-9\ - ? “ ” ! ]/', '-', $judul);
if ($ext_foto=="jpeg"){
	$ext_foto="jpg";
}

//periksa apakah file valid(extensi dan ukuran memenuhi syarat)
if(in_array($ext_foto, $ext_boleh)&& $ukuran_file_foto <= $ukuran_boleh)
{
	$file_original='../../uploads/tmp/' . $nama_foto . "." . $ext_foto;
	move_uploaded_file($tmp_file_foto, $file_original);
	
	$final_path= '../../uploads/' . $nama_foto . "." . $ext_foto;
	resizeImage($file_original, $final_path,500,500,80);
	
	$final_path= 'uploads/' . $nama_foto . "." . $ext_foto;
}else{
	$_SESSION['pesan']="file foto berita tidak valid";
	$_SESSION['jenis_pesan']="danger";
header('Location: ../index.php?page=berita-add');
}
