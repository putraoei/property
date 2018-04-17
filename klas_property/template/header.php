<?php
session_start();
function cek_active($pagenya){
if($_GET['code']== $pagenya){
	echo "active";
}

/*  if($_GET['page'] == null){
	echo "active";
} */
}
?>

<div id="header">
			<div class="container">
				<!-- Logo -->
				<div id="logo">
					<h1><a href="index.php?page=main&code=main">Portal Berita</a></h1>
				</div>
				
				<!-- Nav -->
				<nav id="nav">
					<div style="display:inline-block;">
						<form>
						  <input type="text" name="search" placeholder="Search..">
						</form>
					</div>
					<?php 
					if(isset($_SESSION['login']) && $_SESSION['login']=="1"){
						echo "<div style='float:right;'><a href='admin_page/index.php?page=berita-add'><button class='dropbtn'>Tulis Berita</button></a></div>";
					}?>
					<div class="dropdown" style="">
					  <button class="dropbtn">Kategori &#x25BC;</button>
					  <div class="dropdown-content">
						<a href="index.php?page=main&code=olahraga">Olahraga</a>
						<a href="index.php?page=main&code=teknologi">Teknologi</a>
						<a href="index.php?page=main&code=finansial">Finansial</a>
						<a href="index.php?page=main&code=otomotif">Otomotif</a>
						<a href="index.php?page=main&code=perjalanan">Perjalanan</a>
						<a href="index.php?page=main&code=kriminal">Kriminal</a>
						<a href="index.php?page=main&code=entertainment">Entertainment</a>
					  </div>
					</div>
					
					<!--<ul>
						<li class="<?php cek_active("olahraga"); ?>"><a href="index.php?page=main&code=olahraga">Olahraga</a></li>
						<li class="<?php cek_active("teknologi"); ?>"><a href="index.php?page=main&code=teknologi">Teknologi</a></li>
						<li class="<?php cek_active("finansial"); ?>"><a href="index.php?page=main&code=finansial">Finansial</a></li>
						<li class="<?php cek_active("otomotif"); ?>"><a href="index.php?page=main&code=otomotif">Otomotif</a></li>
						<li class="<?php cek_active("perjalanan"); ?>"><a href="index.php?page=main&code=perjalanan">Perjalanan</a></li>
					</ul>-->
				</nav>
			</div>
		</div>