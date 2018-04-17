<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel" style="height : 70px;">
        <!--<div class="pull-left image">
		 
          <img src=""   class="img-square" alt="User Image">
        </div>-->
        <div class="pull-left info">
          <?php echo $_SESSION['name'] ?>
		  <br>
		  <br>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
	  
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="index.php?page=dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
		<li><a href="index.php?page=berita"><i class="fa fa-files-o"></i> <span>Berita</span></a></li>
		<?php 
		if($_SESSION['role']=="admin"){?>
		<li><a href="index.php?page=penulis"><i class="fa fa-user"></i> <span>Penulis</span></a></li>
		<?php 
		
		}else{
			$idkah = $_SESSION['id'];?>
		<li><a href="index.php?page=penulis-view"><i class="fa fa-user"></i> <span>Penulis</span></a></li>
		<?php
		}
		?>
		<li><a href="koneksi/logout.php" onclick="notifyMe()"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
		</ul>
	 
	
		</section>
    <!-- /.sidebar -->
	</aside>