
<?php
require_once("../koneksi/connect.php");
require_once("../koneksi/koneksi.php");
session_start();
ini_set('max_execution_time', 0);
require_once('../process/berita/text_preprocessing.php');
require_once('../process/berita/stemming_nazief.php');
$kategori=$_POST['id_kategori'];

$textpre = new text_preprocessing;
$stemming_nazief = new stemming_nazief;
$rs_nazief = Array();
$tampung_nazief = Array();

$kata_awal = $_POST['isi'];
$exploded2 = explode(" ",$textpre->start($kata_awal));

	//melakukan stemming ke setiap kata
	foreach ($exploded2 as $rs_nazief){
		$tampung_nazief[] = preg_replace('/[0-9]+/', '', $stemming_nazief->stemming($rs_nazief));
	}
	//menggabungkan menjadi kalimat
	$imploded_hasil_nazief=implode(" ", $tampung_nazief);
	/* echo $imploded_hasil_nazief;
	echo "<br>".$kategori; */
	
	function isi_dataset($kategori,$imploded_hasil_nazief,$idadmin,$db){
	$sql = "insert into tabel_dataset(kategori,konten,admin_idadmin) values (:jenis_kategori,:kontennya,:admin)";
	$stmt =$db->prepare($sql);
	$stmt->execute(['jenis_kategori' => $kategori,
					'kontennya'	=> $imploded_hasil_nazief,
					'admin'	=> $idadmin]);
	}

echo "<b>kalimat masukkan :</b><br>".$kata_awal."<br>";
echo "<br><b>Hasil stemming :</b><br>".$imploded_hasil_nazief;
//isi_dataset($kategori,$imploded_hasil_nazief,0,$db);
$_SESSION['pesan']="Data Latih telah ditambahkan";
$_SESSION['jenis_pesan'] ="info";
//header("Location: pelatihan.php");
?>
