<?php
###############################
## File Name: dosen-edit.php ##
###############################

// GET URL DATA


$pesan="";
if(isset($_SESSION['pesan'])&& isset($_SESSION['jenis_pesan'])){
	$pesan="<div class='notif notif-$_SESSION[jenis_pesan]'>$_SESSION[pesan]</div>";
	$_SESSION['pesan']= null;
	$_SESSION['jenis_pesan']= null;
}

$id = $_GET['id'];

$sql = "select * from tabel_berita where idtabel_berita=:id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();
?>



<section class="content-header">
      <h1>View Berita</h1>
</section>
<?php echo $pesan; ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <!--<a href="#"><i style="margin-left: 25%;" class="fa fa-circle-o text-blue"></i></a>-->
				  <h4><b>Judul</b></h4>
				  
				  <p style="margin-left: 15%; color:blue;" class="pull-default"><?php echo $row['judul']; ?></p>
                </li>
                <li class="list-group-item">
				<!--<a href="#"><i style="margin-left: 25%;" class="fa fa-circle-o text-blue"></i></a>-->
                  <h4><b>Nama Penulis</b></h4>
				 
				  <p  style="margin-left: 15%; color: blue;" class="pull-default"><?php
				$sql= "SELECT * FROM tabel_penulis";
				foreach($db->query($sql) as $rows){
					if($rows['id_penulis']==$row['tabel_penulis_id_penulis'])
					{
						 echo $rows['nama_penulis']; 
					}
				}
				?></p>
                </li>
				<li class="list-group-item">
				<!--<a href="#"><i style="margin-left: 25%;" class="fa fa-circle-o text-blue"></i></a>-->
                  <h4><b>Kategori</b></h4>
				  
				  <p  style="margin-left: 15%; color: blue;"  class="pull-default"><?php if($row['kategori']=="1"){echo "Olahraga";}elseif($row['kategori']=="2"){echo "Teknologi";}elseif($row['kategori']=="3"){echo "Finansial";}elseif($row['kategori']=="4"){echo "Otomotif";}elseif($row['kategori']=="5"){echo "Perjalanan";}elseif($row['kategori']=="6"){echo "Kriminal";}else{echo "Entertainment";} ?></p>
                </li>		
				<li class="list-group-item">
				<!--<a href="#"><i style="margin-left: 25%;" class="fa fa-circle-o text-blue"></i></a>-->
                  <h4><b>Foto</b></h4>
				  
				  <img style='margin-left: 15%; width:70%; height:25%;'  class="pull-default" src="<?php echo $row['footage']."?dummy=".rand(0, 1000);?>">
                </li>
				<li class="list-group-item">
				<!--<a href="#"><i style="margin-left: 25%;" class="fa fa-circle-o text-blue"></i></a>-->
                  <h4><b>Isi</b></h4>
				  
				  <p style="margin-left: 15%; color:blue; white-space: pre-wrap; padding-right:11.3em; text-align:justify;" class="pull-default"><?php echo $row['konten']; ?></p>
                </li>
				<li class="list-group-item">
				<!--<a href="#"><i style="margin-left: 25%;" class="fa fa-circle-o text-blue"></i></a>-->
                  <h4><b>Status Berita</b></h4>
				  <br/>
				  <p  style="margin-left: 15%; color: blue;" class="pull-default"><?php if($row['status_berita']=="2"){echo "Diterbitkan";}else{echo "Ditinjau";} ?></p>
                </li>
              </ul>
			  
			  
			<div class="box-footer">
        <span style="float: right;">
			<a href="index.php?page=berita"  class="btn btn-default">Back</a>
			<?php if($_SESSION['role']=="admin"){?>
				<a href="index.php?page=berita-edit&id=<?php echo $id; ?>" class="btn btn-info">Edit</a>
			<?php }?>
			
		</span>
    </div>
             
            </div>
          </div>
		</div>
	</div>
</section>
		