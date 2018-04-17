<?php
$id= $_GET['id'];
$sql = "select * from tabel_berita inner join tabel_penulis on tabel_berita.tabel_penulis_id_penulis = tabel_penulis.id_penulis where idtabel_berita=:id";
$new = $db->prepare($sql);
$new->execute(['id' => $id]);
$row = $new->fetch();
//$foto = preg_replace('/[^A-Za-z0-9\ - ? “ ”  ! ]/', '', $row['footage']);
/* $foto = preg_replace('/^(uploads/)/', '', $row['footage']);
$foto = preg_replace('/(jpg)\z/i','.jpg',$foto); */
//echo $foto;
?>
<div id="featured">
	<div class="container" style="background: #cce6ff;padding:4em 2em;">
		<div class="row">
			<div class="9u">
				<section>
					<header style="margin-bottom:-0.1em;">
						<h2 style="font-size:2em;"><?php echo $row['judul']; ?></h2>
						<h3><?php echo $row['nama_penulis']; ?></h3>
						<br>
					</header>
					<a href="#" class="image full"><img src="admin_page/<?php echo $row['footage']; ?>"alt="" style="height:40%;"></a>
					<p style="font-family:arial;font-size:1em;text-align:justify;white-space: pre-wrap;"><?php echo $row['konten']; ?></p>
					
				</section>
			</div>
			<div class="3u">
				<section>
					<header style="margin-top:2.5em; margin-bottom:0em;">
						<h2>Berita Lainnya</h2>
					</header>
				</section>
				<?php 
				$kategori2= $row['kategori'];
				$sql = "select * from tabel_berita where kategori=:kategorix and not idtabel_berita <=> :id order by rand() limit 2";
				$new = $db->prepare($sql);
				$new->execute(['id' => $id,
								'kategorix' => $kategori2]);
				foreach($new as $row){
				?>
				<section>
					<a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" class="image full"><img src="admin_page/<?php echo $row['footage']; ?>" alt=""></a>
					<header>
						<h2><a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" style="text-decoration:none; color:black;"><div style="margin-bottom:-2em;"><?php echo $row['judul']; ?></div></a></h2>
					</header>
					<p style="font-family:arial;"><?php echo substr(substr($row['konten'],0,90), 0, strrpos(substr($row['konten'],0,90), ' '))?>. . . . . </p>	
					<br>
				</section>
				<?php } ?>
			</div>		
		</div>
	</div>
</div>