<?php
##########################
## File Name: dosen.php ##
##########################


$pesan="";
if(isset($_SESSION['pesan'])&& isset($_SESSION['jenis_pesan'])){
	$pesan="<div class='notif notif-$_SESSION[jenis_pesan]'>$_SESSION[pesan]</div>";
	$_SESSION['pesan']= null;
	$_SESSION['jenis_pesan']= null;
}
if($_SESSION['role']=="admin"){
$sql = "select * from tabel_penulis";
?>
<section class="content-header">
      <h1>Penulis</h1>
</section>
<?php echo $pesan ?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h1 class="box-title">Data Penulis</h1>
			  <a href="index.php?page=penulis-add" style="float: right;" class="btn btn-primary">Tambah</a>
            </div>
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
				<thead>
				<tr>
					<th>No.</th>
					<th>Username</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Alamat</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
			<?php
			$i = 1;
			
			foreach($db->query($sql) as $row){
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row['username_penulis']; ?></td>
				<td><?php echo $row['nama_penulis']; ?></td>
				<td><?php echo $row['email_penulis']; ?></td>
				<td><?php echo $row['alamat_penulis']; ?></td>
				<td>
					<a href="index.php?page=penulis-view&id=<?php echo $row['id_penulis']?>" class="label label-warning">View</a>
					<a href="index.php?page=penulis-edit&id=<?php echo $row['id_penulis']?>" class="label label-primary">Edit</a>
					<?php
					$sql2 = "select * from tabel_berita inner join tabel_penulis on tabel_berita.tabel_penulis_id_penulis=tabel_penulis.id_penulis where tabel_penulis.id_penulis=:id";
					$stmt2 = $db->prepare($sql2);
					$stmt2->execute(['id' => $row['id_penulis']]);
					$row2 = $stmt2->fetch();
					if($row2!=null)
					{
				  ?>
					<a href="" class="label label-danger slt" data-id="" data-toggle="modal" data-target="#myModal1" >Delete</a>
					<?php
					}
					else
					{
					?>
						<a href="" class="label label-danger dlt" data-id="<?php echo $row['id_penulis']; ?>" data-toggle="modal" data-target="#myModal" >Delete</a>
				  <?php 
					}
					$i++;
			
					?>
				</td>
			</tr>
			<?php
			}
			?>
			</tbody>
			</table>
			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
	  </div>
	</section>
<?php }else{?>
		<meta http-equiv="refresh" content="0; URL='index.php?page=penulis-view'" />
<?php	/* header('Location: ../../index.php?page=penulis-view'); */
}?>	
<script type="text/javascript">
  $(document).on("click", ".dlt", function () {
     var ids = $(this).data('id');
     $(".modal-body a").attr('href', 'process/penulis/delete_process.php?id='+ids);
  });
</script>
?>