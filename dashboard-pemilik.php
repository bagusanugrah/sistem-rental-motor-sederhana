<?php
    //jalankan session
    session_start();
    //jika session username tidak diatur
    if(!isset($_SESSION['username'])){
        //redirect ke halaman login
        echo "<script>
                document.location='login.php';
            </script>";
    }else{//jika session username diatur
        //nilai session username ditampung ke dalam variabel username
        $username = $_SESSION['username'];
        //username yang didapat dari query parameter id
        $id_pemilik = $_GET['id'];

        //jika username pada query parameter id bukanlah pemilik yang login
        if($id_pemilik != $username){
            //redirect ke dashboard pemilik terkait
            echo "<script>
                    document.location='dashboard-pemilik.php?id=$username';
                </script>";
        }
    }

    //jika session role diatur dan session role bernilai 'penyewa'
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'penyewa'){
        //nilai session username ditampung ke dalam variabel username
        $username = $_SESSION['username'];
        //redirect ke dashboard penyewa
        echo "<script>
                document.location='dashboard-penyewa.php?id=$username';
            </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css/bootstrap5.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-secondary" data-bs-theme="dark">
		<div class="container">
			<a class="navbar-brand" href="#">Rental Motor</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				
			</ul>
			<div class="d-flex">
				<a href="proses-logout.php" class="btn btn-dark">Logout</a>
			</div>
			</div>
		</div>
	</nav>
	<div class="container">
        <!-- Awal Card Tabel -->
        <div class="card mt-3">
            <div class="card-header bg-dark text-white">
                Daftar Motor
            </div>
            <div class="card-body">
                <div class="text-left mb-3">
                    <a href="rentalkan-motor.php?id=<?php echo $_GET['id'] ?>" class="btn btn-success">+ Rentalkan Motor</a>
                </div>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No.</th>
                        <th>Merek Motor</th>
                        <th>Tipe Motor</th>
                        <th>Plat Nomor</th>
                        <th>Biaya Sewa Perhari</th>
                        <th>Aksi</th>
                    </tr>
                    <?php 
                        include 'koneksi.php';
                        $no = 1;
                        $username = $_GET['id'];
                        //dapatkan data motor
                        $data = mysqli_query($koneksi,"SELECT * FROM motor WHERE id_pemilik='$username' ORDER BY created_at");
                        while($d = mysqli_fetch_array($data)){
                            $plat_nomor = $d['plat_nomor'];
                            $merek = $d['merek'];
                            $tipe = $d['tipe'];
                            $sewa_perhari = $d['sewa_perhari'];

                            //cari data penyewaan berdasarkan plat nomor
                            $get_penyewaan = mysqli_query($koneksi, "SELECT * FROM penyewaan WHERE plat_nomor='$plat_nomor'");
                            
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $merek ?></td>
                        <td><?php echo $tipe ?></td>
                        <td><?php echo $plat_nomor ?></td>
                        <td><?php echo $sewa_perhari ?></td>
                        <td>
                        <?php
                            if(!mysqli_fetch_array($get_penyewaan)){//jika plat nomor tidak terdapat dalam tabel penyewaan
                                //maka tampilkan tombol aksi
                        ?>
                            <a href="edit-motor.php?idmotor=<?php echo $d['plat_nomor'] ?>" class="btn btn-warning"> Edit </a>
                            <a href="hapus.php?idmotor=<?php echo $d['plat_nomor'] ?>" class="btn btn-danger"> Hapus </a>
                        </td> 
                        <?php
                            }
                        ?>
                    </tr>
                    <?php 
                        }
                    ?>
                </table>

            </div>
        </div>
        <!-- Akhir Card Tabel -->

    </div>
    <div class="container">
        <!-- Awal Card Tabel -->
        <div class="card mt-3 mb-3">
            <div class="card-header bg-dark text-white">
                Motor Yang Disewa
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No.</th>
                        <th>Motor</th>
                        <th>Penyewa</th>
                        <th>Tgl Penyewaan</th>
                        <th>Tgl Pengembalian</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                    </tr>
                    <?php 
                        $no = 1;
                        $id_penyewaan = '';
                        //ambil data penyewaan berdasarkan id_pemilik
                        $data = mysqli_query($koneksi,"SELECT * FROM penyewaan WHERE id_pemilik='$username' ORDER BY id_penyewaan");
                        while($d = mysqli_fetch_array($data)){
                            $id_penyewaan = $d['id_penyewaan'];
                            $id_penyewa = $d['id_penyewa'];
                            $plat_nomor = $d['plat_nomor'];
                            $merek = $d['merek_motor'];
                            $tipe = $d['tipe_motor'];
                            $sewa_perhari = $d['sewa_perhari'];
                            $tgl_penyewaan = $d['tgl_penyewaan'];

                            //ambil data penyewa berdasarkan username penyewa
                            $getpenyewa = mysqli_query($koneksi,"SELECT * FROM penyewa WHERE username='$id_penyewa'");
                            $penyewa = mysqli_fetch_array($getpenyewa);
                            $nik_penyewa = $penyewa['nik'];
                            $nama_penyewa = $penyewa['nama'];
                            $nohp_penyewa = $penyewa['no_hp'];
                            

                            //ambil data pengembalian berdasarkan id_penyewaan
                            $getpengembalian = mysqli_query($koneksi,"SELECT * FROM pengembalian WHERE id_penyewaan='$id_penyewaan'");
                            $pengembalian = '';
                            //jika ada ditemukan data pengembalian berdasarkan id_penyewaan
                            if(mysqli_fetch_array($getpengembalian)){
                                //ambil data pengembalian
                                $pengembalian = mysqli_fetch_array($getpengembalian);
                                $tgl_pengembalian = $pengembalian['tgl_pengembalian'];
                                $jumlah_hari = round((strtotime($tgl_pengembalian) - strtotime($tgl_penyewaan)) / (60 * 60 * 24));
                                $biaya = $jumlah_hari * $sewa_perhari;
                            }
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $plat_nomor ?><br><?php echo $merek ?><br><?php echo $tipe ?><br><?php echo "Rp$sewa_perhari/hari" ?></td>
                        <td><?php echo $nik_penyewa ?><br><?php echo $nama_penyewa ?><br><?php echo $nohp_penyewa ?></td>
                        <td><?php echo $tgl_penyewaan ?></td>
                        <td>
                            <?php
                                if($pengembalian==''){
                                    echo '-';
                                } else{
                                    echo $tgl_pengembalian;
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if($pengembalian==''){
                                    echo '-';
                                } else{
                                    echo $biaya;
                                }
                            ?>
                        </td>
                        <td>
                        <a href="<?php echo "dikembalikan.php?idpenyewaan=$id_penyewaan" ?>" class="btn btn-primary"> Dikembalikan </a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>

            </div>
        </div>
        <!-- Akhir Card Tabel -->
    </div>
	<footer class="bg-light text-center text-lg-start">
		<!-- Copyright -->
		<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
			© 2023 Copyright:
			<a class="text-dark" href="#" target="_blank" title="Github">Penyewaan Motor</a>
		</div>
		<!-- Copyright -->
	</footer>
    <script src="js/bootstrap5.js"></script>
</body>
</html>