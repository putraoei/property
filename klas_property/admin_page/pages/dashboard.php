    <!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Dashboard
        <!--<small>Control panel</small>-->
      </h1>
      <!--<ol class="breadcrumb">
        <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>-->
    </section>
	
<section class="content">
      <!-- Small boxes (Stat box) -->
    <section class="col-lg-7 connectedSortable">
		<div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
				<thead>
				<tr>
					<th>Kategori</th>
					<th>Jumlah</th>
				</tr>
				</thead>
				<tbody>
			<?php
			if($_SESSION['role']=="admin"){
			$sql = "select distinct(kategori) as kategori from tabel_berita order by kategori ASC";
			
			foreach($db->query($sql) as $row){
			?>
				<tr>
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
				
				$marking_kategori=$row['kategori'];
				?>
				<td><?php echo $kategorinya; ?></td>
				
				<?php 
				$sql = "select count(*) as jumlah from tabel_berita where kategori=:mark";
				$stmt =$db->prepare($sql);
				$stmt->execute(['mark'=> $marking_kategori]);
				$row = $stmt->fetch();
				$jlh= $row['jumlah'];
				
				?>
				<td><?php echo $jlh; ?></td>

				</tr>
			<?php
			}
			}else{
				$id= $_SESSION['id'];
				$sql= "select distinct(kategori) as kategori from tabel_berita where tabel_penulis_id_penulis =:id order by kategori ASC";
				$new = $db->prepare($sql);
				$new->execute(['id' => $id]);
				foreach($new as $row){
				?>
				<tr>
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
				
				$marking_kategori=$row['kategori'];
				?>
				<td><?php echo $kategorinya; ?></td>
				
				<?php 
				$sql = "select count(*) as jumlah from tabel_berita where kategori=:mark and tabel_penulis_id_penulis=:id";
				$stmt =$db->prepare($sql);
				$stmt->execute(['mark'=> $marking_kategori,
								'id' => $id]);
				$row = $stmt->fetch();
				$jlh= $row['jumlah'];
				
				?>
				<td><?php echo $jlh; ?></td>

				</tr>
			<?php
				}
			}
			?>
			</tbody>
			</table>
			</div>
          </div>
	</section>
	
	<section class="col-lg-5 ">
		<div style="display:flex;">
		<div class="col-lg-3 col-xs-6" style="width:300px;">
          <!-- small box -->
		  <a href="index.php?page=berita">
          <div class="small-box bg-aqua">
            <div class="inner">
			<h3>Berita</h3>
				<?php
				if($_SESSION['role']=="admin"){
					$sql = "select count(*) from tabel_berita";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$row = $stmt->fetch();
				}else{
					$id= $_SESSION['id'];
					$sql="select count(*) from tabel_berita inner join tabel_penulis on tabel_berita.tabel_penulis_id_penulis=tabel_penulis.id_penulis where id_penulis=:id";
					$stmt = $db->prepare($sql);
					$stmt->execute(['id' => $id]);
					$row = $stmt->fetch();
				}
				?>
              <h3><?php echo $row['count(*)']; ?></h3>

              
            </div>
            <div class="icon">
				<br/>
              <i class="ion ion-ios-paper"></i>
            </div>
            <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
          </div>
		  </a>
        </div>
		</div>
		
		<div style="display:flex;">
		<div class="col-lg-3 col-xs-6" style="width:300px;">
          <!-- small box -->
		  <a href="index.php?page=berita">
          <div class="small-box bg-green">
            <div class="inner">
			<h3>Ditinjau</h3>
              <?php
				if($_SESSION['role']=="admin"){
					$sql = "select count(*) from tabel_berita where status_berita='1'";
					$stmt = $db->prepare($sql);
					$stmt->execute();
					$row = $stmt->fetch();
				}else{
					$id= $_SESSION['id'];
					$sql="select count(*) from tabel_berita inner join tabel_penulis on tabel_berita.tabel_penulis_id_penulis=tabel_penulis.id_penulis where id_penulis=:id and status_berita='1'";
					$stmt = $db->prepare($sql);
					$stmt->execute(['id' => $id]);
					$row = $stmt->fetch();
				}
				?>
             <h3><?php echo $row['count(*)']; ?></h3>
            </div>
            <div class="icon">
			<br/>
              <i class="fa fa-file"></i>
            </div>
             <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
          </div>
		  </a>
        </div>
		</div>
	</section>	
</section>