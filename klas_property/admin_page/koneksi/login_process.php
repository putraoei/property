<!DOCTYPE html>
<html>
<?php //process/login_process.php
session_start();
include_once("koneksi.php");

//form data
$username = $_POST['username'];
$pass = $_POST['pass'];

//cek apakah ada user yang punya email tsb

$sql = "SELECT * FROM admin WHERE username = :username";
$stmt = $db->prepare($sql);
$stmt->execute(['username' => $username]);

$row = $stmt->fetch();

if($row != null){
	$passdb= $row['password'];
	$id=$row['idadmin'];
	$role= "admin";
	
}else{
	echo 'test';
	$sql2 = "SELECT * FROM tabel_penulis WHERE username_penulis = :username";
	$stmt2 = $db->prepare($sql2);
	$stmt2->execute(['username' => $username]);
	$row2 = $stmt2->fetch();
	
	//if($row2!=null){
	$passdb= $row2['password_penulis'];
	$role= "penulis";
	$id=$row2['id_penulis'];
	//}else{
		//header('Location: ../login.php');
		//$msg = "Tidak ada Akun dengan Username ".$username;
		//echo "<script type='text/javascript'>alert('$msg'); window.location.href='../login.php';</script>";
		
	//}
	
	
} 

if(PASSWORD_VERIFY($pass,$passdb)){
		//berhasil login
		$_SESSION['login']=1;
		$_SESSION['role']=$role;
		$_SESSION['id']=$id;
		$_SESSION['name']= $username;
		echo "<script type='text/javascript'>notifybenar();</script>";
		echo "<body onload='notifybenar()'>.";
		//header('Location: ../index.php');
	}else{
		echo "<script type='text/javascript'>notifysalah(); </script>";
		echo "<body onload='notifysalah()'>.";
	}
	/* echo $passdb;
	echo $role;
	echo $id; */
?>	
<script type='text/javascript'>
document.addEventListener('DOMContentLoaded', function () {
  if (!Notification) {
    alert('Desktop notifications not available in your browser. Try Chromium.'); 
    return;
  }

  if (Notification.permission !== "granted")
    Notification.requestPermission();
});

function notifysalah() {
  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('Admin Bot', {
      icon: "http://www.pvhc.net/img183/txeqymsdkkhldnstgfzi.png",
      body: "Username & Password doesn't match !",
    });

    notification.onload = function () {
      window.open("http://stackoverflow.com/a/13328397/1269037");      
    };
  }
  window.location.href='../login.php';
}

function notifybenar() {
  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('Admin Bot', {
      icon: "http://www.pvhc.net/img183/txeqymsdkkhldnstgfzi.png",
      body: "You are logged in, Welcome !",
    });

    notification.onload = function () {
      window.open("http://stackoverflow.com/a/13328397/1269037");      
    };
  }
  window.location.href='../index.php';
}
</script>
</body>
</html>

