

<?php
if(isset($_GET['search'])){
	$cari=$_GET['search'];
	$sql = "select * from tabel_berita where judul like '%".$cari."%' order by tanggal_post DESC";
}elseif ($code=="main"){
	$sql = "select * from tabel_berita where status_berita='2' order by tanggal_post DESC";
}elseif ($code=="olahraga"){
	$sql = "select * from tabel_berita where status_berita='2' and kategori='1' order by tanggal_post DESC";
}elseif ($code=="teknologi"){
	$sql = "select * from tabel_berita where status_berita='2' and kategori='2' order by tanggal_post DESC";
}elseif ($code=="finansial"){
	$sql = "select * from tabel_berita where status_berita='2' and kategori='3' order by tanggal_post DESC";
}elseif ($code=="otomotif"){
	$sql = "select * from tabel_berita where status_berita='2' and kategori='4' order by tanggal_post DESC";
}elseif ($code=="perjalanan"){
	$sql = "select * from tabel_berita where status_berita='2' and kategori='5' order by tanggal_post DESC";
}elseif ($code=="kriminal"){
	$sql = "select * from tabel_berita where status_berita='2' and kategori='6' order by tanggal_post DESC";
}elseif ($code=="entertainment"){
	$sql = "select * from tabel_berita where status_berita='2' and kategori='7' order by tanggal_post DESC";
}
?>

<div id="featured">
	<div class="container" style="background: #cce6ff;padding:4em 2em;">
		<div class="row">
		<?php
		$i = 1;
		foreach($db->query($sql) as $row){
		?>
			<div class="3u">
				<section>
					<a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" class="image full"><img src="admin_page/<?php echo $row['footage'];?>" alt="" style="height:200px"></a>
					<header>
					<?php
					if($row['kategori']=="1"){
						$kategori="olahraga";
					}elseif ($row['kategori']=="2"){
						$kategori="teknologi";
					}elseif ($row['kategori']=="3"){
						$kategori="finansial";
					}elseif ($row['kategori']=="4"){
						$kategori="otomotif";
					}elseif ($row['kategori']=="5"){
						$kategori="perjalanan";
					}elseif ($row['kategori']=="6"){
						$kategori="kriminal";
					}elseif ($row['kategori']=="7"){
						$kategori="entertainment";
					}
					if ($code=="main"){	
					?>
					<h4><a href="index.php?page=main&code=<?php echo $kategori ?>" style="text-decoration:none; color:brown;"><div style="height:2.7ex;"><?php echo $kategori; ?></div></a></h4>
					<?php } ?>
						<h2><a href="index.php?page=content&id=<?php echo $row['idtabel_berita'] ?>" style="text-decoration:none; color:black;"><div style="height:7.3ex;"><?php echo $row['judul']; ?></div></a></h2>
					</header>
					<!--<p><?php echo substr(substr($row['konten'],0,90), 0, strrpos(substr($row['konten'],0,90), ' '))?>. . . . . . . . . .</p>-->
				</section>
			</div>
		<?php } ?>
		</div>
				<?php  
		/* $limit="10";
        $sql2 = "SELECT COUNT(idtabel_berita) FROM tabel_berita";  
        $rs_result = mysqli_query($conn, $sql2);  
        $row = mysqli_fetch_row($rs_result);  
        $total_records = $row[0];  
        $total_pages = ceil($total_records / $limit);  
        $pagLink = "<div class='simple-pagination' style='text-align:center;;'><span class='dark-theme'><nav class='simple-pagination'><ul class='simple-pagination'>";  
        for ($i=1; $i<=$total_pages; $i++) {  
                     $pagLink .= "<li style='display: inline;'><a href='index.php?page=".$i."'>".$i."</a></li>";  
        };  
        echo $pagLink . "</ul></nav></span></div>";   */
        ?>
	</div>
</div>

        <script type="text/javascript">
            $(document).ready(function(){
            $('.pagination').pagination({
                    items: <?php echo $total_records;?>,
                    itemsOnPage: <?php echo $limit;?>,
                    cssStyle: 'dark-theme',
                    currentPage : <?php echo $page;?>,
                    hrefTextPrefix : 'index.php?page='
                });
				$(function() {
				$(selector).pagination('prevPage');
				});
                });
				
            </script>
			