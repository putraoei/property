<?php 
class klasifikasi{
public $hasil_scoring_akhir= Array();
public $hasil_scoring = Array();
public $hasil_scoring2 = Array();

private function tampung_dataset($kategori,$db){
	$tampungan_sementara= array();
	$isi=array();
	$sql = "SELECT konten from tabel_dataset where kategori=:nokategori";
	$stmt =$db->prepare($sql);
	$stmt->execute(['nokategori'=> $kategori]);
	/* $row = $stmt->fetch();
	$isi[]=$row['konten']; */
		 /* echo "<br><br>".$isi;  */
	 foreach($stmt as $result){
		$tampungan_sementara[] = $result['konten'];
		/* echo "<br><br>".$result['konten']; */
	}
	return implode(" ", $tampungan_sementara); 
}

private function scoring($i,$ekstrak,$isi_dataset){
	//inisialisasi variabel
	$potongan_nazief = Array();
	$hasil_scoring = Array();
	$hasil_scoring2 = Array();
	//perulangan untuk 5 kategori
	$nilaix= count(str_word_count($_POST['isi'], 1, 'àáãç3'));
	$hasil_scoring_akhir[$i]=0;
	$hasil_scoring[$i]=0;
	$hasil_scoring2[$i]=0;
	$kata_nazief= true;
	$potongan1= "-";
	$kumpulan_potongan2[$i]= "";
	//perulangan untuk pencocokan kata hasil stemming dengan dataset
		foreach ($ekstrak as $potongan_nazief){
			$kata_nazief = strpos($isi_dataset, $potongan_nazief);
			$scoring_percobaan = substr_count($isi_dataset, $potongan_nazief);
			//jika kata ditemukan hasil_scoring +1
			 if ($kata_nazief == true) {
				++$hasil_scoring[$i];
				//echo $potongan_nazief." ";
			}	
			$kata_2= $potongan1." ".$potongan_nazief;
			/* echo $kata_2; */
			$uji2 = strpos($isi_dataset, $kata_2);
			if ($uji2 == true){
				$hasil_scoring2[$i]=$hasil_scoring2[$i]+1;
				$kumpulan_potongan2[$i]= $kumpulan_potongan2[$i].", ".$kata_2;
			}
			$potongan1= $potongan_nazief;
		}
		
		$hasil_scoring_akhir[$i]= $nilaix - ($hasil_scoring[$i]*0.2 + $hasil_scoring2[$i]*0.8);
		// echo "<br>".$kumpulan_potongan2[$i];
		
		/* echo "<br>";
		if($i=="1"){echo "Persamaan 1 kata di olahraga ".$hasil_scoring[$i]."<br>";}
		elseif($i=="2"){echo "Persamaan 1 kata di teknologi ".$hasil_scoring[$i]."<br>";}
		elseif($i=="3"){echo "Persamaan 1 kata di finansial ".$hasil_scoring[$i]."<br>";}
		elseif($i=="4"){echo "Persamaan 1 kata di otomotif ".$hasil_scoring[$i]."<br>";}
		elseif($i=="5"){echo "Persamaan 1 kata di perjalanan ".$hasil_scoring[$i]."<br>";}
		elseif($i=="6"){echo "Persamaan 1 kata di kriminal ".$hasil_scoring[$i]."<br>";}
		elseif($i=="7"){echo "Persamaan 1 kata di entertainment ".$hasil_scoring[$i]."<br>";}
		
		
		
		if($i=="1"){echo "Persamaan 2 kata di olahraga ".$hasil_scoring2[$i]."<br>";}
		elseif($i=="2"){echo "Persamaan 2 kata di teknologi ".$hasil_scoring2[$i]."<br>";}
		elseif($i=="3"){echo "Persamaan 2 kata di finansial ".$hasil_scoring2[$i]."<br>";}
		elseif($i=="4"){echo "Persamaan 2 kata di otomotif ".$hasil_scoring2[$i]."<br>";}
		elseif($i=="5"){echo "Persamaan 2 kata di perjalanan ".$hasil_scoring2[$i]."<br>";}
		elseif($i=="6"){echo "Persamaan 2 kata di kriminal ".$hasil_scoring2[$i]."<br>";}
		elseif($i=="7"){echo "Persamaan 2 kata di entertainment ".$hasil_scoring2[$i]."<br>";}
		
		if($i=="1"){echo "Hasil Perhitungan jarak olahraga ".$hasil_scoring_akhir[$i]."<br>";}
		elseif($i=="2"){echo "Hasil Perhitungan jarak teknologi ".$hasil_scoring_akhir[$i]."<br>";}
		elseif($i=="3"){echo "Hasil Perhitungan jarak finansial ".$hasil_scoring_akhir[$i]."<br>";}
		elseif($i=="4"){echo "Hasil Perhitungan jarak otomotif ".$hasil_scoring_akhir[$i]."<br>";}
		elseif($i=="5"){echo "Hasil Perhitungan jarak perjalanan ".$hasil_scoring_akhir[$i]."<br>";}
		elseif($i=="6"){echo "Hasil Perhitungan jarak kriminal ".$hasil_scoring_akhir[$i]."<br>";}
		elseif($i=="7"){echo "Hasil Perhitungan jarak entertainment ".$hasil_scoring_akhir[$i]."<br><br>";}  */
		return $hasil_scoring_akhir[$i];
	}
	
public function pilih_kategori($ekstrak,$db){
	
	for($i=1;$i<=7;$i++){
		$isi_dataset[$i]=$this->tampung_dataset($i,$db);	
	}
	
	for($i=1;$i<=7;$i++){
		$hasil_scoring_akhir[$i]= $this->scoring($i,$ekstrak,$isi_dataset[$i]);
	}
	
	if($hasil_scoring_akhir[1]==min($hasil_scoring_akhir)){
		$kategori="1";
	}else if($hasil_scoring_akhir[2]==min($hasil_scoring_akhir)){
		$kategori="2";
	}else if($hasil_scoring_akhir[3]==min($hasil_scoring_akhir)){
		$kategori="3";
	}else if($hasil_scoring_akhir[4]==min($hasil_scoring_akhir)){
		$kategori="4";
	}else if($hasil_scoring_akhir[5]==min($hasil_scoring_akhir)){
		$kategori="5";
	}else if($hasil_scoring_akhir[6]==min($hasil_scoring_akhir)){
		$kategori="6";
	}else if($hasil_scoring_akhir[7]==min($hasil_scoring_akhir)){
		$kategori="7";
	}
	return $kategori;
}
}
