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
$sql = "select * from tabel_berita inner join tabel_penulis on tabel_berita.tabel_penulis_id_penulis=tabel_penulis.id_penulis order by tanggal_post DESC";
}else{
$sql = "select * from tabel_berita inner join tabel_penulis on tabel_berita.tabel_penulis_id_penulis=tabel_penulis.id_penulis where id_penulis=:id order by tanggal_post DESC";	
}
?>
<section class="content-header">
      <h1>Berita</h1>
</section>
<?php echo $pesan ?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h1 class="box-title">Data Berita</h1>
			  <a href="index.php?page=berita-add" style="float: right;" class="btn btn-primary">Tambah</a>
            </div>
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
				<thead>
				<tr>
					<th>No.</th>
					<th>Judul</th>
					<th>Penulis</th>
					<th>Kategori</th>
					<th>Tanggal Post</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
			<?php
			$i = 1;
			if($_SESSION['role']=="admin"){
			foreach($db->query($sql) as $row){
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row['judul']; ?></td>
				<td><?php echo $row['nama_penulis']; ?></td>
				<?php if($row['kategori'] =="1"){
					$kategorinya="Olahraga";
				}elseif($row['kategori'] =="2"){
					$kategorinya="Teknologi";
				}elseif($row['kategori'] =="3"){
					$kategorinya="Finansial";
				}elseif($row['kategori'] =="4"){
					$kategorinya="Otomotif";
				}elseif($row['kategori'] =="5"){
					$kategorinya="Perjalanan";
				}elseif($row['kategori'] =="6"){
					$kategorinya="Kriminal";
				}elseif($row['kategori'] =="7"){
					$kategorinya="Entertainment";
				}else{$kategorinya="Belum ditentukan";}
				?>
				<td><?php echo $kategorinya; ?></td>
				<td><?php echo $row['tanggal_post']; ?></td>
				<?php if($row['status_berita'] =="1"){
					$statusnya="Ditinjau";
				}elseif($row['status_berita'] =="2"){
					$statusnya="Diterbitkan";
				}else{$statusnya="Belum ditentukan";}
				?>
				<td><?php echo $statusnya; ?></td>
				<td>
					<a href="index.php?page=berita-view&id=<?php echo $row['idtabel_berita']?>" class="label label-warning">View</a>
					<a href="index.php?page=berita-edit&id=<?php echo $row['idtabel_berita']?>" class="label label-primary">Edit</a>
					<?php
					$sql2 = "select * from tabel_berita where idtabel_berita = :id";
					$stmt2 = $db->prepare($sql2);
					$stmt2->execute(['id' => $row['idtabel_berita']]);
					$row2 = $stmt2->fetch();
					if($row2==null)
					{
				  ?>
					<a href="" class="label label-danger slt" data-id="" data-toggle="modal" data-target="#myModal1" >Delete</a>
					<?php
					}
					else
					{
						
					?>
						<a href="" class="label label-danger dlt" data-id="<?php echo $row['idtabel_berita']; ?>" data-toggle="modal" data-target="#myModal" >Delete</a>
				  <?php 
					}
					$i++;
			}
					?>
				</td>
			</tr>
			<?php
			$i++;
			}
			
			else{
				$id= $_SESSION['id'];
				$new = $db->prepare($sql);
				$new->execute(['id' => $id]);
				foreach($new as $row){
					?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row['judul']; ?></td>
				<td><?php echo $row['nama_penulis']; ?></td>
				<?php if($row['kategori'] =="1"){
					$kategorinya="Olahraga";
				}elseif($row['kategori'] =="2"){
					$kategorinya="Teknologi";
				}elseif($row['kategori'] =="3"){
					$kategorinya="Finansial";
				}elseif($row['kategori'] =="4"){
					$kategorinya="Otomotif";
				}elseif($row['kategori'] =="5"){
					$kategorinya="Perjalanan";
				}elseif($row['kategori'] =="6"){
					$kategorinya="Kriminal";
				}elseif($row['kategori'] =="7"){
					$kategorinya="Entertainment";
				}else{$kategorinya="Belum ditentukan";}
				?>
				<td><?php echo $kategorinya; ?></td>
				<td><?php echo $row['tanggal_post']; ?></td>
				<?php if($row['status_berita'] =="1"){
					$statusnya="Ditinjau";
				}elseif($row['status_berita'] =="2"){
					$statusnya="Diterbitkan";
				}else{$statusnya="Belum ditentukan";}
				?>
				<td><?php echo $statusnya; ?></td>
				<td>
					<a href="index.php?page=berita-view&id=<?php echo $row['idtabel_berita']?>" class="label label-warning">View</a>
					<?php if($row['status_berita'] =="1"){
					echo "<a href='index.php?page=berita-edit&id=" . $row['idtabel_berita'] ."' class='label label-primary'>Edit</a>";
					
					$sql2 = "select * from tabel_berita where idtabel_berita = :id";
					$stmt2 = $db->prepare($sql2);
					$stmt2->execute(['id' => $row['idtabel_berita']]);
					$row2 = $stmt2->fetch();
					if($row2==null)
					{
				  ?>
					<a href="" class="label label-danger slt" data-id="" data-toggle="modal" data-target="#myModal1" >Delete</a>
					<?php
					}
					else
					{
						
					?>
						<a href="" class="label label-danger dlt" data-id="<?php echo $row['idtabel_berita']; ?>" data-toggle="modal" data-target="#myModal" >Delete</a>
				  <?php 
					}
					}
				$i++;	
			}
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
	
<script type="text/javascript">
  $(document).on("click", ".dlt", function () {
     var ids = $(this).data('id');
     $(".modal-body a").attr('href', 'process/berita/delete_process.php?id='+ids);
  });
</script>