<!doctype html>
<html class="no-js" lang="en">

<?php 

    include '../dbconnect.php';
    include 'cek.php';

    if(isset($_POST['update'])){
        $id = $_POST['id']; //iddata
        $idx = $_POST['idx']; //idbarang
        $tanggal = $_POST['tgl']; //idbarang
        $jam = $_POST['jam'];
        $jumlah = $_POST['jumlah'];
        $penerima = $_POST['penerima'];
        $opd = $_POST['opd'];
        $no_hp = $_POST['no_hp'];
         $nama_petugas=$_SESSION['user'];
        $ket_kel = $_POST['ket_kel'];
        $foto=$_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];
       

        $lihatstock = mysqli_query($conn,"select * from sstock_brg where idx='$idx'"); //lihat stock barang itu saat ini
        $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
        $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

        $lihatdataskrg = mysqli_query($conn,"select * from sbrg_keluar where id='$id'"); //lihat qty saat ini
        $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
        $qtyskrg = $preqtyskrg['jumlah'];//jumlah skrg


        if($jumlah >= $qtyskrg && $foto!= ''){
            //ternyata inputan baru lebih besar jumlah keluarnya, maka kurangi lagi stock barang
            $hitungselisih = $jumlah-$qtyskrg;
            $kurangistock = $stockskrg-$hitungselisih;
            $foto=$_FILES['foto']['name'];
            $file_tmp = $_FILES['foto']['tmp_name'];  

            move_uploaded_file($file_tmp, 'gambar/'.$foto);
            $query = mysqli_query($conn,"update sstock_brg set stock='$kurangistock' where idx='$idx'");
            $updatedata1 = mysqli_query($conn,"update sbrg_keluar set tgl='$tanggal',jam='$jam',jumlah='$jumlah',penerima='$penerima',opd='$opd',no_hp='$no_hp',nama_petugas='$nama_petugas',ket_kel='$ket_kel',foto='$foto' where id='$id'");

                   }else{
                  
                      $updatedata1 = mysqli_query($conn,"update sbrg_keluar set tgl='$tanggal',jam='$jam',jumlah='$jumlah',penerima='$penerima',opd='$opd',no_hp='$no_hp',nama_petugas='$nama_petugas',ket_kel='$ket_kel'where id='$id'");
                      
                    if($updatedata1 && @$query){
                        echo " <div class='alert alert-success'>
                    <strong>Success!</strong> Redirecting you back in 1 seconds.
                </div>
                <meta http-equiv='refresh' content='1; url= keluar.php'/>  ";
                    }else {
                       echo "<div class='alert alert-success'>
                    <strong>Failed!</strong> Redirecting you back in 3 seconds.
                </div>
                <meta http-equiv='refresh' content='3; url= keluar.php'/> ";
                    }
                }

            }


        if(isset($_POST['hapus'])){

        @$jumlah2 = $_POST['jumlah'];
        $pengembali=$_POST['pengembali'];
        $id = $_POST['id'];
        $idx = $_POST['idx'];

        $lihatstock = mysqli_query($conn,"select * from sstock_brg where idx='$idx'"); //lihat stock barang itu saat ini
        $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
        $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

        $lihatdataskrg = mysqli_query($conn,"select * from sbrg_keluar where id='$id'"); //lihat qty saat ini
        $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
        $qtyskrg = $preqtyskrg['jumlah'];//jumlah skrg

        $adjuststock = $stockskrg+$qtyskrg;

        $kembali = mysqli_query($conn,"update sstock_brg set stock='$adjuststock' where idx='$idx'");
         $updatedata1 = mysqli_query($conn,"update sbrg_keluar set status='kembali',pengembali='$pengembali' where id='$id'");



        if($jumlah2 >= $qtyskrg && $foto!= ''){
            //ternyata inputan baru lebih besar jumlah keluarnya, maka kurangi lagi stock barang
            $hitungselisih = $jumlah2-$qtyskrg;
            $kurangistock = $stockskrg-$hitungselisih;
            $foto=$_FILES['foto']['name'];
            $file_tmp = $_FILES['foto']['tmp_name'];  

            move_uploaded_file($file_tmp, 'gambar/'.$foto);
          $queryx = mysqli_query($conn,"update sstock_brg set stock='$adjuststock' where idx='$idx'");

            $updatedata1 = mysqli_query($conn,"update sbrg_keluar set status='kembali',foto='$foto',pengembali='$pengembali' where id='$id'");

                      
                    if($updatedata1 && @$queryx){
                        echo " <div class='alert alert-success'>
                    <strong>Success!</strong> Redirecting you back in 1 seconds.
                </div>
                <meta http-equiv='refresh' content='1; url= keluar.php'/>  ";
                    }else {
                       echo "<div class='alert alert-success'>
                    <strong>Failed!</strong> Redirecting you back in 3 seconds.
                </div>
                <meta http-equiv='refresh' content='3; url= keluar.php'/> ";
                    }
                }

            }

            

	?>

<head>
    <meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventory | Diskominfo Provsu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<!-- Start datatable css -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-144808195-1');
	</script>
	
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start-->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <header class="sidebar-header">INVENTORY</header>

            <div class="main-menu">
                <div class="menu-inner">
                    <nav>

                        <ul class="metismenu" id="menu">
                             <li>
                               <a href="index.php"><i class="ti-pin2"></i><span>Catatan</span></a>  
                            </li>
                           
                            <li>
                                <a href="stock.php"><i class="ti-notepad"></i><span>Stock Barang</span></a>
                            </li>

                            <li>
                                <a href="admin.php"><i class="ti-user"></i><span>Data Admin</span></a>
                            </li>

                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Transaksi Data
                                    </span></a>
                                <ul class="active">
                                    <li><a href="masuk.php">Barang dikembalikan</a></li>
                                    <li class="active"><a href="keluar.php">Barang Dipinjamkan</a></li>
                                </ul>
                            </li>
                          
                            <li>
                               <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar ?')">Logout</a>
                                
                            </li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <h2>Hi, <?=$_SESSION['user'];?>!</h2>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li><h3><div class="date">
								<script type='text/javascript'>
						<!--
						var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
						var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
						var date = new Date();
						var day = date.getDate();
						var month = date.getMonth();
						var thisDay = date.getDay(),
							thisDay = myDays[thisDay];
						var yy = date.getYear();
						var year = (yy < 1000) ? yy + 1900 : yy;
						document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);		
						//-->
						</script></b></div></h3>

						</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span>Barang dipinjamkan</span></li>
                            </ul>
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
               
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Barang dipinjamkan</h2>
									<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah</button>
                                </div>
                                <div class="market-status-table mt-4">
                                    <div class="table-responsive">
										 <table id="dataTable3" class="table table-hover"><thead class="thead-dark">
											<tr>
												<th>No</th>
												<th>Barang</th>
												<th>Tanggal Pinjam</th>
												<th>Jam</th>
												<th>Jumlah</th>
                                                <th>Penerima/ Jabatan</th>
                                                <th>OPD Penerima</th>
                                                <th>No HP</th>
                                                <th>Nama Petugas</th>
                                                <th>Keterangan</th>
                                                <th>Surat Pengantar</th>
												<th>Status</th>
												<th>Opsi</th>
											</tr></thead><tbody>
											<?php 
											$brg=mysqli_query($conn,"SELECT * FROM sbrg_keluar sb, sstock_brg st where status='pinjam' AND st.idx=sb.idx ORDER BY id DESC");
											$no=1;
											while($b=mysqli_fetch_array($brg)){
                                                $idb = $b['idx'];
                                                $id = $b['id'];

												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $b['kode_barang'] ?> <?php echo $b['nama'] ?> <?php echo $b['serial_number'] ?></td>
                                                    <td><?php $tanggals=$b['tgl']; echo date("d-M-Y", strtotime($tanggals)) ?></td>
													
                                                    <td><?php echo $b['jam'] ?></td>
													<td><?php echo $b['jumlah'] ?></td>
                                                    <td><?php echo $b['penerima'] ?></td>
                                                    <td><?php echo $b['opd'] ?></td>
													<td><?php echo $b['no_hp'] ?></td>
                                                   <td><?php echo $b['nama_petugas'] ?></td>
                                                    <td><?php echo $b['ket_kel'] ?></td>
                                                    <td><a href="gambar/<?php echo $b['foto']; ?>">link</a></td>
                                                     <td><?php echo $b['status'] ?></td>
                                                    <td><button data-toggle="modal" data-target="#edit<?=$id;?>" class="btn btn-warning">Edit</button> 
                                                        <button data-toggle="modal" data-target="#edit2<?=$id;?>" class="btn btn-danger">Kembali</button> 
                                                         
                                                         </td>
												</tr>		

                                                <!-- The Modal -->
                                                <div class="modal fade" id="edit<?=$id;?>">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            
                                                            <!-- Modal body -->
                                                            <div class="modal-body">

                                                            
                                                            <label for="nama">Barang</label>
                                                            <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $b['nama'] ?> <?php echo $b['kode_barang'] ?> <?php echo $b['serial_number'] ?>" disabled>

                                                             <label for="tgl">Tanggal</label>
                                                            <input type="date" id="tgl" name="tgl" class="form-control" value="<?php echo $b['tgl'] ?>">


                                                             <label for="jam">Jam</label>
                                                            <input type="times" id="jam" name="jam" class="form-control" value="<?php echo $b['jam'] ?>">


                                                             <label for="jumlah">Jumlah</label>
                                                            <input type="text" id="jumlah" name="jumlah" class="form-control" value="<?php echo $b['jumlah'] ?>">

                                                         <label for="penerima">Penerima/ Jabatan</label>
                                                            <input type="text" id="penerima" name="penerima" class="form-control" value="<?php echo $b['penerima'] ?>" >

                                                            <label for="opd">OPD Penerima</label>
                                                            <input type="text" id="opd" name="opd" class="form-control" value="<?php echo $b['opd'] ?>">

                                                            <label for="no_hp">No HP</label>
                                                            <input type="text" id="no_hp" name="no_hp" class="form-control" value="<?php echo $b['no_hp'] ?>">

                                                            <label for="nama_petugas">Nama Petugas</label>
                                                              <input type="text" id="nama_petugas" name="nama_petugas" class="form-control" value="<?php echo $b['nama_petugas'] ?>" disabled>
                                                          

                                                              <label for="foto">Surat Pengantar</label>
                                                              <img src="gambar/<?php echo $file; ?>">
                                                              <input type="file" name="foto" class="form-control" />

                                                            <label for="ket_kel">Keterangan</label>
                                                            <input type="text" id="ket_kel" name="ket_kel" class="form-control" value="<?php echo $b['ket_kel'] ?>">


                                                            

                                                            </div>
                                                            

                                                            
                                                            <input type="hidden" name="id" value="<?=$id;?>">
                                                            <input type="hidden" name="idx" value="<?=$idb;?>">

                                                            
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success" name="update">Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>

                                                     <!-- The Modal -->
                                                <div class="modal fade" id="edit2<?=$id;?>">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Barang Kembali</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            
                                                            <!-- Modal body -->
                                                            <div class="modal-body">

                                                            
                                                            <label for="nama">Barang</label>
                                                            <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $b['nama'] ?> <?php echo $b['kode_barang'] ?> <?php echo $b['serial_number'] ?>" disabled>

                                                             <label for="tgl">Tanggal</label>
                                                            <input type="date" id="tgl" name="tgl" class="form-control" value="<?php echo $b['tgl'] ?>" disabled>


                                                             <label for="jam">Jam</label>
                                                            <input type="times" id="jam" name="jam" class="form-control" value="<?php echo $b['jam'] ?>" disabled>


                                                             <label for="jumlah">Jumlah</label>
                                                            <input type="text" id="jumlah" name="jumlah" class="form-control" value="<?php echo $b['jumlah'] ?>" disabled>

                                                         <label for="penerima">Penerima/ Jabatan</label>
                                                            <input type="text" id="penerima" name="penerima" class="form-control" value="<?php echo $b['penerima'] ?>" disabled>

                                                            <label for="opd">OPD Penerima</label>
                                                            <input type="text" id="opd" name="opd" class="form-control" value="<?php echo $b['opd'] ?>" disabled>

                                                            <label for="no_hp">No HP</label>
                                                            <input type="text" id="no_hp" name="no_hp" class="form-control" value="<?php echo $b['no_hp'] ?>" disabled>

                                                            <label for="nama_petugas">Nama Petugas</label>
                                                              <input type="text" id="nama_petugas" name="nama_petugas" class="form-control" value="<?php echo $b['nama_petugas'] ?>" disabled>
                                                          

                                                              <label for="foto">Surat Pengantar</label>
                                                              <img src="gambar/<?php echo $file; ?>">
                                                              <input type="file" name="foto" class="form-control" disabled/>

                                                            <label for="ket_kel">Keterangan</label>
                                                            <input type="text" id="ket_kel" name="ket_kel" class="form-control" value="<?php echo $b['ket_kel'] ?>" disabled>

                                                            <label for="status">Status</label>
                                                            <input type="text" id="status" name="status" class="form-control" value="<?php echo $b['status'] ?>" disabled>

                                                              <label for="pengembali">Pengembali</label>
                                                            <input type="text" id="pengembali" name="pengembali" class="form-control" required="">


                                                            

                                                            </div>
                                                            

                                                            
                                                            <input type="hidden" name="id" value="<?=$id;?>">
                                                            <input type="hidden" name="idx" value="<?=$idb;?>">

                                                            
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success" name="hapus">Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>

                                                        <!-- The Modal -->
                                                    <div class="modal fade" id="del<?=$id;?>">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form method="post">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                        
                                                            
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                            Barang sudah selesai dipinjam?
                                                            <br>
                                                            *Stock barang akan bertambah
                                                            <input type="hidden" name="id" value="<?=$id;?>">
                                                            <input type="hidden" name="idx" value="<?=$idb;?>">
                                                            </div>
                                                            
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success" name="hapus">Kembali</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>





												<?php 
											}
											?>
										</tbody>
										</table>
                                    </div></div>
									<a href="exportbrgklr.php" target="_blank" class="btn btn-info">Export Data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>By UINSU</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
	
	<!-- modal input -->
			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Input Barang dipinjamkan</h4>
						</div>
						<div class="modal-body">
							<form action="barang_keluar_act.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Nama Barang</label>
									<select name="idx" class="form-control">

									<option selected>Pilih barang
									<?php
									$det=mysqli_query($conn,"select * from sstock_brg order by nama ASC")or die(mysqli_error());
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['idx'] ?>"><?php echo $d['nama'] ?> <?php echo $d['serial_number'] ?>, Kode barang. <?php echo $d['kode_barang'] ?> --- Stock : <?php echo $d['stock'] ?></option>
                                    </option>
										<?php
                                        }
                                        ?>  
									</select>

									<br>
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input name="tgl" type="date" class="form-control" required>
                                    </div>

								</div>

                                    <div class="form-group">
                                        <label>Jam</label>
                                        <input name="jam" type="time" class="form-control" placeholder="Jam" required>
                                    </div>

    								<div class="form-group">
    									<label>Jumlah</label>
    									<input name="qty" type="number" min="1" class="form-control" placeholder="Qty" required>
    								</div>
    								<div class="form-group">
    									<label>Penerima dan Jabatan</label>
    									<input name="penerima" type="text" class="form-control" placeholder="Penerima barang" required="">
    								</div>

                                    <div class="form-group">
                                        <label>OPD Penerima</label>
                                        <input name="opd" type="text" class="form-control" placeholder="OPD Penerima Barang" required="">
                                    </div>

                                    <div class="form-group">
                                        <label>No HP</label>
                                        <input name="no_hp" type="text" class="form-control" placeholder="No HP Penerima Barang" required="">
                                    </div>


                                    <div class="form-group">
                                        <label>Petugas</label>
                                        <input name="nama_petugas" value="<?=$_SESSION['user'];?>" type="text" class="form-control" placeholder="Petugas" disabled >
                                        </div>
                                    
                                            

    								<div class="form-group">
    									<label>Keterangan</label>
    									<input name="ket_kel" type="text" class="form-control" placeholder="Keterangan" required="">
    								</div>

                                    <div class="form-group">
                                        <label>Surat Pengantar</label>
                                        <input name="foto" type="file"  class="form-control" placeholder="Upload foto surat pengantar" required="">

                                    </div>

                                    <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="custom-select form-control" >
                                    <option selected>Pilih status</option>
                                    <option value="pinjam">Pinjam</option>
                                    <option value="kembali">Kembali</option>
                            
                                    </select>
								
    							<div class="modal-footer">
    								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    								<input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
    							</div>
						    </form>
                        </div>

					</div>
				</div>
			</div>

              <div class="modal fade" id="del<?=$id;?>">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form method="post">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                        
                                                            
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                            Barang sudah selesai dipinjam?
                                                            <br>
                                                            *Stock barang akan bertambah
                                                            <input type="hidden" name="id" value="<?=$id;?>">
                                                            <input type="hidden" name="idx" value="<?=$idb;?>">
                                                            </div>
                                                            
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success" name="hapus">Kembali</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>

	
	<script>
		$(document).ready(function() {
		$('input').on('keydown', function(event) {
			if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
			   var $t = $(this);
			   event.preventDefault();
			   var char = String.fromCharCode(event.keyCode);
			   $t.val(char + $t.val().slice(this.selectionEnd));
			   this.setSelectionRange(1,1);
			}
		});
	
	
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>
	
    <!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
	<!-- Start datatable js -->
	 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
	
	<script>
		$(document).ready(function() {
		$('input').on('keydown', function(event) {
			if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
			   var $t = $(this);
			   event.preventDefault();
			   var char = String.fromCharCode(event.keyCode);
			   $t.val(char + $t.val().slice(this.selectionEnd));
			   this.setSelectionRange(1,1);
			}
		});
	});
	</script>
</body>

</html>
