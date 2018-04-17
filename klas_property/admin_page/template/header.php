<header class="main-header">
		<a href="../" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		
			<span class="logo-mini"></span>
			<span class="logo-lg"><b>Portal</b> Berita</span>
			<!-- logo for regular state and mobile devices -->
			<?php
			$sql2 = "select * from setting where id_setting= 2";
			$stmt2 = $db->prepare($sql2);
			$stmt2->execute();
			$row2 = $stmt2->fetch();
			?>
			<span class="logo-lg"><b><?php echo $row2['value']; ?></span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!--<img src="<?php echo $row['foto'];?>" class="user-image" alt="User Image">-->
							<span class="hidden-xs"><?php echo $_SESSION['name'] ?></span>
						</a>
						<!--<ul class="dropdown-menu">
							
							<li class="user-header">
								<<img src="<?php echo $row['foto'];?>" class="img-circle" alt="User Image">

								<p>
									<?php echo $_SESSION['name'] ?> - <?php echo $_SESSION['role'] ?>
								</p>
							</li>
							
							<li class="user-footer">
								<div class="pull-left">
									<a href="index.php?page=profile" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
								<a href="koneksi/logout.php" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>-->
					</li>
				</ul>
			</div>
		</nav>
	</header>