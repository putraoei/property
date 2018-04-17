<!DOCTYPE HTML>
<!--
	Autonomy by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Portal Berita</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/simplePagination.css" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="js/jquery.simplePagination.js"></script>
		<link rel="stylesheet" href="css/simplePagination.css" />
		<noscript>
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
		<style> 
		input[type=text] {
			float: right;
			width: 130px;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius: 4px;
			font-size: 16px;
			background-color: white;
			background-image: url('http://www.clker.com/cliparts/z/1/T/u/9/2/search-icon-hi.png');
			background-size: 20px 20px; 
			background-position: 10px 10px; 
			background-repeat: no-repeat;
			padding: 12px 20px 12px 40px;
			-webkit-transition: width 0.4s ease-in-out;
			transition: width 0.4s ease-in-out;
		}

		input[type=text]:focus {
			width: 100%;
		}
		</style>
	</head>
	<body class="homepage">

		<!-- Header -->
		<?php 
		require_once("admin_page/koneksi/koneksi.php"); 
		require_once("admin_page/koneksi/mysqli.php"); 
		require_once("template/header.php"); ?>
				
				<?php
				
				
				$code="main";
				
				if(isset($_GET['page'])){
					$page=$_GET['page'];
					if(isset($_GET['code'])){
						$code=$_GET['code'];
						echo "<div id='banner".$code."' >&nbsp;</div>";}
					else{
                    $code="main";
					}
                }else{
                    $page="main";
					if (($code=="main")&&($page=="main")){
						echo "<div id='bannerindex'>&nbsp;</div>";
					}
				}

                include_once("pages/" . $page . ".php");
				?>
				
		<?php require_once("template/bottom.php") ?>
		<!-- Copyright -->
		<?php require_once("template/footer.php") ?>
	</body>
</html>