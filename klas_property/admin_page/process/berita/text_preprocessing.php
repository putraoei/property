<?php
class text_preprocessing{
	public $stopword = array();
	
	public function start($str){
	//casefolding atau mengubah semua karakter ke huruf kecil 
	$str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
	//hilangkan special karakter
	$str = str_replace(' ', '-', $str);
	$str = preg_replace('/[^A-Za-z0-9\ - ? “ ” ! ]/', ' ', $str);
	//$str = preg_replace('/ /', '', $str);
	$str = str_replace('-', ' ', $str);
	$str = str_replace('  ', ' ', $str);
	$str = str_replace('   ', ' ', $str);
	$str = str_replace('    ', ' ', $str);
	return $this->cut($str); 
	}
		
	//tokenizing atau memotong kalimat menjadi kata
	private function cut($str){
	$exploded1=explode(" ",$str);
	$str = str_replace(' ', '-', $exploded1);
	$str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
	$str = str_replace('-', ' ', $str);
	return $this->sword($str);
	}
	//menghilangkan stopword
	private function sword($str){
	$sql = mysql_query("SELECT data_stopword from tabel_stopword");
	while($result = mysql_fetch_array($sql)){
			$stopword[] = $result['data_stopword'];
	}
	$result_stop = array_diff($str,$stopword);
	//menata susunan array dengan mengabungkan menjadi kalimat
	$imploded1=implode(" ", $result_stop);
	return $imploded1;
	}
}
?>