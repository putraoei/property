<?php


class stemming_nazief{
//fungsi untuk mengecek kata dalam tabel dictionary
private function cekKamus($kata){ 
	$sql = mysql_query("SELECT * from tabel_rootword where data_rootword ='$kata' LIMIT 1");
	$result = mysql_num_rows($sql);
	
	if($result==1){
		return true; // True jika ada
	}else{
		return false; // jika tidak ada FALSE
	}
}

//fungsi untuk menghapus suffix seperti -ku, -mu, -kah, dsb
private function Del_Inflection_Suffixes($kata){ 
	$kataAsal = $kata;
	
	if(preg_match('/([km]u|nya|[kl]ah|pun)\z/i',$kata)){ // Cek Inflection Suffixes
		$__kata = preg_replace('/([km]u|nya|[kl]ah|pun)\z/i','',$kata);
		return $__kata;
	}
	return $kataAsal;
}

// Cek Prefix Disallowed Sufixes (Kombinasi Awalan dan Akhiran yang tidak diizinkan)
private function Cek_Prefix_Disallowed_Sufixes($kata){

	if(preg_match('/^(be)[[:alpha:]](i)\z/i',$kata)){ // be- dan -i
		return true;
	}

	if(preg_match('/^(se)[[:alpha:]](i|kan)\z/i',$kata)){ // se- dan -i,-kan
		return true;
	}
	
	if(preg_match('/^(di)[[:alpha:]](an)\z/i',$kata)){ // di- dan -an
		return true;
	}
	
	if(preg_match('/^(me)[[:alpha:]](an)\z/i',$kata)){ // me- dan -an
		return true;
	}
	
	if(preg_match('/^(ke)[[:alpha:]](i|kan)\z/i',$kata)){ // ke- dan -i,-kan
		return true;
	}
	return false;
}

// Hapus Derivation Suffixes ("-i", "-an" atau "-kan")
private function Del_Derivation_Suffixes($kata){
	$kataAsal = $kata;
	if(preg_match('/(i|an)\z/i',$kata)){ // Cek Suffixes
		$__kata = preg_replace('/(i|an)\z/i','',$kata);
		if($this->cekKamus($__kata)){ // Cek Kamus
			return $__kata;
		}else if(preg_match('/(kan)\z/i',$kata)){
			$__kata = preg_replace('/(kan)\z/i','',$kata);
			if($this->cekKamus($__kata)){
				return $__kata;
			}
		}
/*– Jika Tidak ditemukan di kamus –*/
	}
	return $kataAsal;
}

// Hapus Derivation Prefix ("di-", "ke-", "se-", "te-", "be-", "me-", atau "pe-")
private function Del_Derivation_Prefix($kata){
	$kataAsal = $kata;
	//for($j=1; $j<=3;$j++){
	/* —— Tentukan Tipe Awalan ————*/
	if(preg_match('/^(di|[ks]e)/',$kata)){ // Jika di-,ke-,se-
		$__kata = preg_replace('/^(di|[ks]e)/','',$kata);
		if($this->cekKamus($__kata)){return $__kata;}
		$__kata = $this->Del_Derivation_Suffixes($__kata);//recoding
		if($this->cekKamus($__kata)){
			return $__kata;
		}else{
		if(preg_match('/^(diper)/',$kata)){ //diper-
			$__kata = preg_replace('/^(diper)/','',$kata);
				return $__kata;			
		}
		}
	}
	
	if(preg_match('/^(ke[bt]er)/',$kata)){  //keber- dan keter-
			$__kata = preg_replace('/^(ke[bt]er)/','',$kata);
				return $__kata;
		}
	
	if(preg_match('/^([bt]e)/',$kata)){ //Jika awalannya adalah "te-","ter-", "be-","ber-"
		
		$__kata = preg_replace('/^([bt]e[lr])/','',$kata);
		if($this->cekKamus($__kata)){return $__kata;}		
		$__kata = $this->Del_Derivation_Suffixes($__kata);//recoding
		if($this->cekKamus($__kata)){
			return $__kata;
		}else{
		
		$__kata = preg_replace('/^([bt]e)/','',$kata);
			return $__kata;
		}
	}
	
	if(preg_match('/^([mp]e)/',$kata)){
		
		$__kata = preg_replace('/^([mp]e)/','',$kata);
		if($this->cekKamus($__kata)){return $__kata;}
		$__kata = $this->Del_Derivation_Suffixes($__kata);//recoding
		if($this->cekKamus($__kata)){
			return $__kata;
		}else{
		if(preg_match('/^(memper)/',$kata)){
			$__kata = preg_replace('/^(memper)/','',$kata);
			return $__kata;			
		}
		if(preg_match('/^([mp]eng)/',$kata)){
			$__kata = preg_replace('/^([mp]eng)/','',$kata);
			if($this->cekKamus($__kata)){return $__kata;}
			$__kata = $this->Del_Derivation_Suffixes($__kata);//recoding
			if($this->cekKamus($__kata)){
				return $__kata;
			}else{
			$__kata = preg_replace('/^([mp]eng)/','k',$kata);
			return $__kata;
			}
		}
		if(preg_match('/^([mp]eny)/',$kata)){
			$__kata = preg_replace('/^([mp]eny)/','s',$kata);
			return $__kata;
		}
		if(preg_match('/^([mp]e[lr])/',$kata)){
			$__kata = preg_replace('/^([mp]e[lr])/','',$kata);
				return $__kata;
		}
		if(preg_match('/^([mp]en)/',$kata)){
			$__kata = preg_replace('/^([mp]en)/','t',$kata);
			if($this->cekKamus($__kata)){return $__kata;}
			$__kata = $this->Del_Derivation_Suffixes($__kata);//recoding
			if($this->cekKamus($__kata)){
				return $__kata;
			}else{
			$__kata = preg_replace('/^([mp]en)/','',$kata);
				return $__kata;
			}
		}
		}	
		if(preg_match('/^([mp]em)/',$kata)){
			$__kata = preg_replace('/^([mp]em)/','p',$kata);
			if($this->cekKamus($__kata)){return $__kata;}
			$__kata = $this->Del_Derivation_Suffixes($__kata);
			if($this->cekKamus($__kata)){
				return $__kata;
			}else{
				
			$__kata = preg_replace('/^([mp]em)/','',$kata);
			return $__kata;
			}		
		}
		}
	return $kataAsal;
}


private function step2($kata){
	$first=$kata;
	for ($i = 1; $i <= 3; $i++) {//batas recoding
		$kata = $this->Del_Inflection_Suffixes($kata);
		/* echo $kata . "<br>"; */
		if($this->cekKamus($kata)){
			$i+3;//menghentikan perulangan
			return $kata;
		}else{		
		$kata = $this->Del_Derivation_Suffixes($kata);
		/* echo $kata. "<br>"; */
		if($this->cekKamus($kata)){
			$i+3;//menghentikan perulangan
			return $kata;
		}else{
		$cekkata = $this->Cek_Prefix_Disallowed_Sufixes($kata);
		/* echo $kata. "<br>"; */
		if($cekkata==true){
			$i+3;//menghentikan perulangan
			return $kata;
		}else{
		$kata = $this->Del_Derivation_Prefix($kata);
		/* echo $kata. "<br>"; */
		if($this->cekKamus($kata)){
			$i+3;//menghentikan perulangan
			return $kata;
		}}}}}
		return $first;
}

//fungsi pencarian akar kata
public function stemming($kata1){ 
	$cekKata = $this->cekKamus($kata1);
	if($cekKata == true){ // Cek Kamus
		return $kata1; // Jika Ada maka kata tersebut adalah kata dasar
	}else{ //jika tidak ada dalam kamus maka dilakukan stemming
			$step1 = $this->step2($kata1);
			return $step1;
	}
}
}
?>