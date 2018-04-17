<div id="marketing">
	<div class="container" style="background: #cce6ff; padding: 2em 2em;">
		<div class="row">
			<div class="3u">
				<section>
					<header style="margin-bottom:-0em;">
						<h2 style="color:black;">Berita Terbaru</h2>
					</header>
					<ul class="style1">
						<?php 
						$sql = "select * from tabel_berita where kategori=1 order by tanggal_post DESC limit 1";
						$row = $db->query($sql);
						$row = $row->fetch();
						?>
						<li class="first"><a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>"><img src="admin_page/<?php echo $row['footage']; ?>" width="80" height="80" alt=""></a>
							<a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" style="text-decoration:none;"><p style="color:black;font-weight: bold;"><?php echo $row['judul']; ?></p></a>
						</li>
						
						<?php 
						$sql = "select * from tabel_berita where kategori=2 order by tanggal_post DESC limit 1";
						$row = $db->query($sql);
						$row = $row->fetch();
						?>
						<li><a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>"><img src="admin_page/<?php echo $row['footage']; ?>" width="80" height="80" alt=""></a>
							<a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" style="text-decoration:none;"><p style="color:black;font-weight: bold;"><?php echo $row['judul']; ?></p></a>
						</li>
						
						<?php 
						$sql = "select * from tabel_berita where kategori=3 order by tanggal_post DESC limit 1";
						$row = $db->query($sql);
						$row = $row->fetch();
						?>
						<li><a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>"><img src="admin_page/<?php echo $row['footage']; ?>" width="80" height="80" alt=""></a>
							<a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" style="text-decoration:none;"><p style="color:black;font-weight: bold;"><?php echo $row['judul']; ?></p></a>
						</li>
					</ul>
				</section>
			</div>
			<div class="3u">
				<section>
					<header style="margin-bottom:-0em;">
						<h2>&nbsp</h2>
					</header>
					<ul class="style1">
						<?php 
						$sql = "select * from tabel_berita where kategori=4 order by tanggal_post DESC limit 1";
						$row = $db->query($sql);
						$row = $row->fetch();
						?>
						<li class="first"><a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>"><img src="admin_page/<?php echo $row['footage']; ?>" width="80" height="80" alt=""></a>
							<a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" style="text-decoration:none;"><p style="color:black;font-weight: bold;"><?php echo $row['judul']; ?></p></a>
						</li>
						<?php 
						$sql = "select * from tabel_berita where kategori=5 order by tanggal_post DESC limit 1";
						$row = $db->query($sql);
						$row = $row->fetch();
						?>
						<li><a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>"><img src="admin_page/<?php echo $row['footage']; ?>" width="80" height="80" alt=""></a>
							<a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" style="text-decoration:none;"><p style="color:black;font-weight: bold;"><?php echo $row['judul']; ?></p></a>
						</li>
						
					</ul>
				</section>
			</div>
			<div class="6u">
				<section>
					<header style="margin-bottom:-0em;">
						<h2 style="color:black;">Berita Sekilas</h2>
					</header>
					<?php 
						if(isset($_GET['id'])){
						$sql = "select * from tabel_berita where not idtabel_berita <=> :id order by rand() limit 1";
						$new = $db->prepare($sql);
						$new->execute(['id' => $id]);
						$row = $new->fetch();
						}else{
						$sql = "select * from tabel_berita order by rand() limit 1";
						$row = $db->query($sql);
						$row = $row->fetch();
						}
						?>
					<a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" class="image full"><img src="admin_page/<?php echo $row['footage']; ?>" height="200" alt=""></a>
					<h3><a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" style="text-decoration:none;font-weight:bold;font-size:130%;color:black;"><?php echo $row['judul']; ?></a></h3>
					<p><a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" style="text-decoration:none;color:black;"><?php echo substr(substr($row['konten'],0,200), 0, strrpos(substr($row['konten'],0,200), ' '))?>. . . . . . . . . .</a></p>
				</section>
			</div>
		</div>
	</div>
</div>