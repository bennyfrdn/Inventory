<?php 
include '../dbconnect.php';
$kode_barang=$_POST['kode_barang'];
$nama=$_POST['nama'];
$serial_number=$_POST['serial_number'];
$stock=$_POST['stock'];
$satuan=$_POST['satuan'];
$lokasi=$_POST['lokasi'];
$keterangan=$_POST['keterangan'];
	  
$query = mysqli_query($conn,"insert into sstock_brg values('','$kode_barang','$nama','$serial_number','$stock','$satuan','$lokasi','$keterangan')");
if ($query){

echo " <div class='alert alert-success'>
    <strong>Success!</strong> Redirecting you back in 1 seconds.
  </div>
<meta http-equiv='refresh' content='1; url= stock.php'/>  ";
} else { echo "<div class='alert alert-warning'>
    <strong>Failed!</strong> Redirecting you back in 1 seconds.
  </div>
 <meta http-equiv='refresh' content='1; url= stock.php'/> ";
}
 
?>
 
  <html>
<head>
  <title>Tambah Barang</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>