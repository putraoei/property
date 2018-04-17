<?php
$id = $_GET['id'];

$sql = "select * from tabel_berita where idtabel_berita=:id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();
?>
<section class="content-header">
      <h1>Edit Berita</h1>
      <ol class="breadcrumb">
        <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
		<li><a href="index.php?page=berita">Berita</a></li>
        <li class="active">Edit Berita</li>
      </ol>
</section>
<div class="box-header with-border">
</div>
<form class="form-horizontal" enctype="multipart/form-data" id="eventform" action="process/berita/process_edit.php" method="post">
	<div class="box-body">
	<div class="form-group">
		<label class="col-sm-2 control-label">Judul</label>
		<div class="col-sm-7">
			<div class="eight wide column">
			<input type="text" class="form-control" name="judul" value="<?php echo $row['judul']; ?>">
			</div>
		</div>
	</div>
	<?php if($_SESSION['role']=="admin"){?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Penulis</label>
		<div class="col-sm-7">
		<div class="eight wide column">
			<select class="form-control select2" name="nama_penulis" >
				
				<?php
				$sql= "SELECT * FROM tabel_penulis";
				foreach($db->query($sql) as $rows){
					if($rows['id_penulis']==$row['tabel_penulis_id_penulis'])
					{
						?>
						<option selected value="<?php echo $rows['id_penulis'];?>"><?php echo $rows['nama_penulis']; ?></option>
						<?php
					}
				else
				{
				?>
				<option value="<?php echo $rows['id_penulis'];?>"><?php echo $rows['nama_penulis']; ?></option>
				<?php
				}
				}
				?>
			</select>
		</div>
		</div>
	</div>
	<?php }else{ ?>
		<input type="hidden" name="nama_penulis" value="<?php echo $_SESSION['id'];?>">
	<?php } ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Kategori</label>
		<div class="col-sm-7">
		<div class="eight wide column">
	<select class="form-control select2" name="id_kategori">
				<?php
				for($i=1;$i<=7;$i++){
					if($i==$row['kategori'])
					{
						?>
						<option selected value="<?php echo $i;?>"><?php if($i=="1"){echo "Olahraga";}elseif($i=="2"){echo "Teknologi";}elseif($i=="3"){echo "Finansial";}elseif($i=="4"){echo "Otomotif";}elseif($i=="5"){echo "Perjalanan";}elseif($i=="6"){echo "Kriminal";}else{echo "Entertainment";} ?></option>
						<?php
					}
				else
				{
				?>
				<option value="<?php echo $i;?>"><?php if($i=="1"){echo "Olahraga";}elseif($i=="2"){echo "Teknologi";}elseif($i=="3"){echo "Finansial";}elseif($i=="4"){echo "Otomotif";}elseif($i=="5"){echo "Perjalanan";}elseif($i=="6"){echo "Kriminal";}else{echo "Entertainment";}?></option>
				<?php
				}
				
				}
				?>
				
			</select>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Foto</label>
		<div class="col-sm-7">
		<div class="eight wide column">
			<img style='width:80%; height:80%;' src="<?php echo $row['footage']."?dummy=".rand(0, 1000); ?>">
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-7">
		<div class="eight wide column">
			<input type="file" name="foto" id="gambar"/>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Isi</label>
		<div class="col-sm-7">
		<div class="eight wide column">
				<textarea class="form-control" name="isi" style="height:258px;"><?php echo $row['konten'];?></textarea>
		</div>
		</div>
	</div>
	<input type="hidden" name="fotolama" value="<?php echo $row['footage']; ?>"/>
	
	<?php if($_SESSION['role']=="admin"){?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Status Berita</label>
		<div class="col-sm-7">
		<div class="eight wide column">
			<select class="form-control select2" name="status_berita">
				<option value="1" <?php if($row['status_berita']=="1"){echo "selected";}?>>Ditinjau</option>
				<option value="2" <?php if($row['status_berita']=="2"){echo "selected";}?>>Diterbitkan</option>
			</select>
		</div>
		</div>
	</div>
	<?php }else{?>
	<input type="hidden" name="status_berita" value="<?php echo $row['status_berita']; ?>">
	<?php } ?>
	</div>
	<input type="hidden" name="idberita" value="<?php echo $id; ?>">
	<?php if($_SESSION['role']=="admin"){?>
	<input type="hidden" name="id_admin" value="<?php echo $_SESSION['id']; ?>">
	<?php }else{?>
	<input type="hidden" name="id_admin" value="<?php echo "0"; ?>">
	<?php	
	}
	?>
	<div class="box-footer">
        <span style="float: right;">
			<a href="index.php?page=berita" class="btn btn-default">Cancel</a>
			<button type="submit" class="btn btn-info">Next</button>
		</span>
    </div>
</form>

<script>
	$().ready(function() {
    $('#eventform').validate({
        rules: {
				judul: {
					required: true,
				},
				nama_penulis: {
					required: true,
				},
				isi: {
					required: true,
				}
		},
		messages: {
				judul: {
					required: "Please Input Judul Berita",
				},
				nama_penulis: {
					required: "Please Select Penulis Berita",
				},
				isi: {
					required: "Please Input Isi Berita",
				},
		},
				errorPlacement: function ( error, element ) {
					error.addClass( "ui red pointing label transition" );
					error.insertAfter( element.parent() );
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".row" ).addClass( errorClass );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".row" ).removeClass( errorClass );
				}
    });
});
	</script>