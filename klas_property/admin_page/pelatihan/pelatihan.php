<section class="content-header">
 	<h1>Pelatihan</h1>
	
	<section class="content">
	<?php
		$pesan="";
	if(isset($_SESSION['pesan'])&& isset($_SESSION['jenis_pesan'])){
	$pesan="<div class='notif notif-$_SESSION[jenis_pesan]'>$_SESSION[pesan]</div>";
	$_SESSION['pesan']= null;
	$_SESSION['jenis_pesan']= null;
	}
	echo $pesan;
	
	require_once("../koneksi/koneksi.php");
	?>
      <div class="row">
        <div class="col-xs-12">
              <?php
					$sql = "select count(*) from tabel_dataset where kategori='1'";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$row = $stmt->fetch();
				?>
             <h4>Olahraga <?php echo $row['count(*)']; ?></h4>
			 <?php
					$sql = "select count(*) from tabel_dataset where kategori='2'";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$row = $stmt->fetch();
				?>
             <h4>Teknologi <?php echo $row['count(*)']; ?></h4>
			 <?php
					$sql = "select count(*) from tabel_dataset where kategori='3'";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$row = $stmt->fetch();
				?>
             <h4>Finansial <?php echo $row['count(*)']; ?></h4>
			 <?php
					$sql = "select count(*) from tabel_dataset where kategori='4'";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$row = $stmt->fetch();
				?>
             <h4>Otomotif <?php echo $row['count(*)']; ?></h4>
			 <?php
					$sql = "select count(*) from tabel_dataset where kategori='5'";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$row = $stmt->fetch();
				?>
             <h4>Perjalanan <?php echo $row['count(*)']; ?></h4>
			 <?php
					$sql = "select count(*) from tabel_dataset where kategori='6'";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$row = $stmt->fetch();
				?>
             <h4>Kriminal <?php echo $row['count(*)']; ?></h4>
			 <?php
					$sql = "select count(*) from tabel_dataset where kategori='7'";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$row = $stmt->fetch();
				?>
             <h4>Entertaintment <?php echo $row['count(*)']; ?></h4>
 	<form method="post" action="process_pengujian.php">
		<select class="form-control select2" name="id_kategori">
				<option value="" >Pilih Kategori</option>
				<option value="1" >Olahraga</option>
				<option value="2" >Teknologi</option>
				<option value="3" >Finansial</option>
				<option value="4" >Otomotif</option>
				<option value="5" >Perjalanan</option>
				<option value="6" >Kriminal</option>
				<option value="7" selected>Entertaintment</option>
			</select>
			<br>
			<br>
		<textarea name="isi" rows="20" cols="70"></textarea>
		<br>
		
			<input type="submit" name="submit" value="Submit">		
		
 	</form><br/>	 
	 </div>
	 </div>
	</section>
	 
</section>