<?php

session_start();
include 'dbconnect.php';

if(isset($_SESSION['role'])){
	header("location:stock");
}

if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			echo "Username atau Password salah!";
		}else if($_GET['pesan'] == "logout"){
			echo "Anda berhasil keluar dari sistem";
		}else if($_GET['pesan'] == "belum_login"){
			echo "Anda harus Login";
		}else if($_GET['pesan'] == "noaccess"){
			echo "Akses Ditutup";
	}
}


if(isset($_POST['btn-login']))
{
 $uname = mysqli_real_escape_string($conn,$_POST['username']);
 $upass = mysqli_real_escape_string($conn,md5($_POST['password']));

// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"select * from slogin where username='$uname' and password='$upass';");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
 if($data['role']=="admin"){
		// buat session login dan username
		$_SESSION['user'] = $data['nickname'];
		$_SESSION['user_login'] = $data['username'];
		$_SESSION['id'] = $data['id'];
		$_SESSION['role'] = "stock";
		header("location:stock");

 }else{
  header("location:index.php?pesan=gagal");

 }
	}
		}

?>

<!DOCTYPE html>
<html>
<br>
<br>
<head>
	<title>Aplikasi Inventory Barang</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>

		<h1>Aplikasi Inventory Barang <br/> Diskominfo Provinsi Sumatera Utara</h1>


			<div class="kotak_login">
		<p class="tulisan_login">Silahkan login</p>
				
					
                <form method="post">

                    <div class="form-group">
                        <input type="text" class="form_login" placeholder="Username" name="username" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form_login" placeholder="Password" name="password" type="password" required>
                    </div>

                    <button type="submit" class="tombol_login" name="btn-login">Masuk</button>
			
                </form>
			
			<br>
        </div>
    </div>
  </body>
</html>
