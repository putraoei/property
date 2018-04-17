<?php
	//session_start();
	$pesan="";
	if(isset($_SESSION['pesan'])&& isset($_SESSION['jenis_pesan'])){
		$pesan="<div class='notif notif-$_SESSION[jenis_pesan]'>$_SESSION[pesan]</div>";
		$_SESSION['pesan']=null;
		$_SESSION['jenis_pesan']=null;
		
	}
?>
<section class="content-header">
      <h1>
        Tambah Berita
        <small>Input Berita</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
		<li><a href="index.php?page=berita">Berita</a></li>
        <li class="active">Tambah Berita</li>
      </ol>
</section>
<div class="box-header with-border">
</div>
<?php echo $pesan; ?>
<form class="form-horizontal" enctype="multipart/form-data" id="eventform" action="process/berita/process_add.php" method="post">
	<div class="box-body">
	<div class="form-group">
		<label class="col-sm-2 control-label">Judul</label>
		<div class="col-sm-7">
			<div class="eight wide column">
			<input type="text" class="form-control" name="judul" placeholder="Input Judul">
			</div>
		</div>
	</div>
	<?php if($_SESSION['role']=="admin"){ ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Penulis</label>
		<div class="col-sm-7">
		<div class="eight wide column">
			<select class="form-control select2" name="nama_penulis">
			
				<option value="" Selected>Pilih Penulis</option> 
				<?php
				$sql= "SELECT * FROM tabel_penulis";
				foreach($db->query($sql) as $row){
				?>
				<option value="<?php echo $row['id_penulis']?>"><?php echo $row['nama_penulis'] ?></option>
				<?php
				}
				?>
			</select>
		</div>
		</div>
	</div>
	<?php }else{
				
				?>
			<input type="hidden" name="nama_penulis" value="<?php echo $_SESSION['id'];?>">
				<?php 
				}?>
		<div class="form-group">
		<label class="col-sm-2 control-label">Foto</label>
		<div class="col-sm-7">
		<div class="eight wide column">
			<input type="file" name="foto" id="gambar"/>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Isi</label>
		<div class="col-sm-7">
		<div class="eight wide column" > <!--style="height:255px;"-->
				<textarea name="isi" class="form-control" placeholder="Input Isi Berita" style="height:258px;"></textarea>
		</div>
		</div>
	</div>
	
	<?php if($_SESSION['role']=="admin"){?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Status Berita</label>
		<div class="col-sm-7">
		<div class="eight wide column">
			<select class="form-control select2" name="status_berita">
				<option value="" Selected>Pilih Status</option> 
				<option value="1">Ditinjau</option>
				<option value="2">Diterbitkan</option>
			</select>
		</div>
		</div>
	</div>
	<?php }else{?>
	<input type="hidden" name="status_berita" value="1">
	<?php } ?>
	
		<div class="box-footer">
        <span style="float: right;">
			<a href="index.php?page=berita" class="btn btn-default">Cancel</a>
			<button type="submit" class="btn btn-info">Next</button>
		</span>
    </div>
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
				},
				status_berita: {
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
				status_berita: {
					required: "Please Input Status Berita",
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