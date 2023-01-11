<?php
session_start(); 
include '../dbconnect.php';
$barang=$_POST['idx']; //id barang
$tanggal=$_POST['tgl'];
$jam=$_POST['jam'];
$qty=$_POST['qty'];
$penerima=$_POST['penerima'];
$opd=$_POST['opd'];
$no_hp=$_POST['no_hp'];
$ket_kel=$_POST['ket_kel'];
$foto = $_FILES['foto']['name'];


$dt=mysqli_query($conn,"select * from sstock_brg where idx='$barang'");
$data=mysqli_fetch_array($dt);
$sisa=$data['stock']-$qty;
$query1 = mysqli_query($conn,"update sstock_brg set stock='$sisa' where idx='$barang'");

if($_POST['simpan']){
      $ekstensi_diperbolehkan = array('png','jpg');
      $foto = $_FILES['foto']['name'];
      $barang=$_POST['idx']; //id barang
      $tanggal=$_POST['tgl'];
      $jam=$_POST['jam'];
      $qty=$_POST['qty'];
      $penerima=$_POST['penerima'];
      $opd=$_POST['opd'];
      $no_hp=$_POST['no_hp'];
      $status=$_POST['status'];
      $nama_petugas=$_SESSION['user'];
      $source = $_FILES['foto']['tmp_name'];
      $folder = './gambar/';

  
    move_uploaded_file($source, $folder.$foto);

          $query2 = mysqli_query($conn,"INSERT INTO sbrg_keluar (idx,tgl,jam,jumlah,penerima,opd,no_hp,nama_petugas,ket_kel,foto,status) values('$barang','$tanggal','$jam','$qty','$penerima','$opd','$no_hp','$nama_petugas','$ket_kel','$foto','$status')");

          if($query1 && $query2){

     echo " <div class='alert alert-success'>
    <strong>Success!</strong> Redirecting you back in 1 seconds.
  </div>
<meta http-equiv='refresh' content='1; url= keluar.php'/>  ";
                } else {
                   echo "<div class='alert alert-warning'>
    <strong>Upload gagal!</strong> Redirecting you back in 1 seconds.
  </div>
 <meta http-equiv='refresh' content='1; url= keluar.php'/> ";
                }

            }
        ?>
<html>
<head>
  <title>Barang Keluar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>