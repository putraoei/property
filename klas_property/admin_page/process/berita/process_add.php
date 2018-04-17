<?php
session_start();
ini_set('max_execution_time', 0);

		require_once("../../koneksi/koneksi.php");
		require_once('../../koneksi/connect.php');
		require_once('text_preprocessing.php');
		require_once('stemming_nazief.php');
		require_once('klasifikasi.php');


class tambah_berita{

	public $rs_nazief = Array();
	public $tampung_nazief = Array();
	

	private function mulai($db){
	$text_preprocessing = new text_preprocessing();
	$kata_awal = $_POST['isi'];
	$exploded2 = explode(" ",$text_preprocessing->start($kata_awal));

	//melakukan stemming ke setiap kata
	$stemming_nazief = new stemming_nazief();
	foreach ($exploded2 as $rs_nazief){
		$tampung_nazief[] = preg_replace('/[0-9]+/', '', $stemming_nazief->stemming($rs_nazief));
	}
	//menggabungkan menjadi kalimat
	$imploded_hasil_nazief=implode(" ", $tampung_nazief);
	$isi_dataset = array();
		
	//dipotong menjadi kata bertujuan untuk menata ulang array
	$ekstrak = str_word_count($imploded_hasil_nazief, 1, 'àáãç3');
	$jlh_kata = str_word_count($kata_awal, 1, 'àáãç3');
	echo "jumlah kata".count($jlh_kata)."<br>";
	$klasifikasi = new klasifikasi();
	$kategori= $klasifikasi->pilih_kategori($ekstrak,$db);
	return $kategori;
	}
	
	public function simpan($db){
		$judul = $_POST['judul'];
		$nama_penulis = $_POST['nama_penulis'];
		$isi = $_POST['isi'];
		$status_berita = $_POST['status_berita'];
		date_default_timezone_set("Asia/Jakarta");
		$time_test=date("Y-m-d H:i:s");
		$kategori=$this->mulai($db);

		if($_SESSION['role']=="admin"){
			$idadmin = $_SESSION['id'];
		}else{
			$idadmin = "0";
		}

		require_once("../../includes/function.php");
		require_once("../berita/upload-foto.php"); 
		$path_foto=$final_path;


		//fungsi menyimpan ke database
			$sql = "insert into tabel_berita(tabel_penulis_id_penulis,judul,tanggal_post,kategori, footage,konten,status_berita,admin_idadmin) values (:penulis,:judul,:tanggal,:kategori,:foto, :konten,:status,:admin_idadmin)";
			$stmt =$db->prepare($sql);
			$stmt->execute(['penulis'	=> $nama_penulis,
							'judul'		=> $judul,
							'tanggal'	=> $time_test,
							'kategori'	=> $kategori,
							'foto'		=> $path_foto,
							'konten'	=> $isi,
							'status'	=> $status_berita,
							'admin_idadmin'	=> $idadmin,]);
		
		//pesan jika berhasil ditambahkan
		$_SESSION['pesan']="Data Berita telah ditambahkan";
		$_SESSION['jenis_pesan'] ="info";
		//mengarahkan ke laman utama berita
		header("Location: ../../index.php?page=berita");
	}
	
}
$tambah_berita = new tambah_berita;
$tambah_berita->simpan($db);
//echo "<meta http-equiv='Location' content='../../index.php?page=berita'>";
?>
