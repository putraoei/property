<?php
$id = $_GET['id'];

$sql = "select * from tabel_penulis where id_penulis=:id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();
?>
<section class="content-header">
      <h1>Edit Penulis
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
		<li><a href="index.php?page=penulis">Penulis</a></li>
        <li class="active">Edit Penulis</li>
      </ol>
</section>
<div class="box-header with-border">
</div>
<form class="form-horizontal" id="eventform" action="process/penulis/edit_process.php" method="post">
	<div class="box-body">
	<div class="form-group">
		<label class="col-sm-2 control-label">Username</label>
		<div class="col-sm-4">
			<div class="eight wide column">
			<input type="text" class="form-control" name="username_p" placeholder="Input Username" value="<?php echo $row['username_penulis'] ?>">
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Penulis</label>
		<div class="col-sm-4">
		<div class="eight wide column">
			<input type="text" class="form-control" name="nama_p" placeholder="Input Nama" value="<?php echo $row['nama_penulis'] ?>">
		</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Password</label>
		<div class="col-sm-4">
		<div class="eight wide column">
			<input type="password" class="form-control form-password" name="pass_p" placeholder="Biarkan kosong untuk menggunakan password lama">
			<input type="hidden" class="form-control" name="passwordlama" value="<?php echo $row['password_penulis'] ?>" />
			<br><input type="checkbox" class="form-checkbox"> Show password
		</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Email</label>
		<div class="col-sm-4">
		<div class="eight wide column">
			<input type="text" class="form-control" name="email_p" placeholder="Input Email" value="<?php echo $row['email_penulis'] ?>">
		</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Alamat</label>
		<div class="col-sm-4">
		<div class="eight wide column">
			<textarea class="form-control" name="alamat_p" placeholder="Input Alamat" style="height:210px;"><?php echo $row['alamat_penulis'] ?></textarea>
		</div>
		</div>
	</div>
	<input type="hidden" class="form-control" name="id_p" value="<?php echo $id ?>" />
	
		<div class="box-footer">
        <span style="float: right;">
			<?php if($_SESSION['role']=="admin"){?>
			<a href="index.php?page=penulis" class="btn btn-default">Cancel</a>
			<?php }else {
			$idkah = $_SESSION['id'];?>
			<a href="index.php?page=penulis-view&id=<?php echo $idkah;?>" class="btn btn-default">Cancel</a>
			<?php }?>
			<button type="submit" class="btn btn-info">Next</button>
		</span>
    </div>
	</div>
</form>

<script>
	$().ready(function() {
    $('#eventform').validate({
        rules: {
				username_p: {
					required: true,
				},
				nama_p: {
					required: true,
				},
				pass_p: {
					minlength: 8,
				},
				email_p: {
					required: true,
				},
				alamat_p: {
					required: true,
				}
		},
		messages: {
				username_p: {
					required: "Please Input Username Penulis",
				},
				nama_p: {
					required: "Please Select Nama Penulis",
				},
				pass_p: {
					minlength: "Password must be at least 8 characters long",
				},
				email_p: {
					required: "Please Input Email Penulis",
				},
				alamat_p: {
					required: "Please Input Alamat Penulis",
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

 $(document).ready(function() {
      var cek = $('.form-checkbox').val();
      $('.form-checkbox').click(function() {
        if ($(this).is(':checked')) {
          $('.form-password').attr('type', 'text');
        } else {
          $('.form-password').attr('type', 'password');
        }
      });
    });
	</script>