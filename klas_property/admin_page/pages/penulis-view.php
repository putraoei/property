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
if($_SESSION['role']=="admin"){
$id = $_GET['id'];}else
{$id=$_SESSION['id'];}

$sql = "select * from tabel_penulis where id_penulis=:id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();
?>



<section class="content-header">
      <h1>View Penulis</h1>
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
				  <h4><b>Username</b></h4>
				  
				  <p style="margin-left: 15%; color:blue;" class="pull-default"><?php echo $row['username_penulis']; ?></p>
                </li>
                <li class="list-group-item">
				<!--<a href="#"><i style="margin-left: 25%;" class="fa fa-circle-o text-blue"></i></a>-->
                  <h4><b>Nama</b></h4>
				 
				  <p  style="margin-left: 15%; color: blue;" class="pull-default"><?php echo $row['nama_penulis']; ?></p>
                </li>
				<li class="list-group-item">
				<!--<a href="#"><i style="margin-left: 25%;" class="fa fa-circle-o text-blue"></i></a>-->
                  <h4><b>Email</b></h4>
				  
				  <p  style="margin-left: 15%; color: blue;"  class="pull-default"><?php echo $row['email_penulis']; ?></p>
                </li>				
				<li class="list-group-item">
				<!--<a href="#"><i style="margin-left: 25%;" class="fa fa-circle-o text-blue"></i></a>-->
                  <h4><b>Alamat</b></h4>
				  <br/>
				  <p  style="margin-left: 15%; color: blue;" class="pull-default"><?php echo $row['alamat_penulis']; ?></p>
                </li>
              </ul>
			  
			  
			<div class="box-footer">
        <span style="float: right;">
			<?php if($_SESSION['role']=="admin"){?>
			<a href="index.php?page=penulis" class="btn btn-default">Back</a>
			<?php }?>
			<a href="index.php?page=penulis-edit&id=<?php echo $id; ?>" class="btn btn-info">Edit</a>
		</span>
    </div>
             
            </div>
          </div>
		</div>
	</div>
</section>
		