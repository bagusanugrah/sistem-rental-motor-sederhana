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
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $d['merek'] ?></td>
                        <td><?php echo $d['tipe'] ?></td>
                        <td><?php echo $d['plat_nomor'] ?></td>
                        <td><?php echo $d['sewa_perhari'] ?></td>
                        <td>
                            <a href="edit-motor.php?idmotor=<?php echo $d['plat_nomor'] ?>" class="btn btn-warning"> Edit </a>
                            <a href="hapus.php?idmotor=<?php echo $d['plat_nomor'] ?>" class="btn btn-danger"> Hapus </a>
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
    <div class="container-fluid">
        <!-- Awal Card Tabel -->
        <div class="card mt-3 mb-3">
            <div class="card-header bg-dark text-white">
                Motor Yang Dirental
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No.</th>
                        <th>Plat Nomor</th>
                        <th>NIK Penyewa</th>
                        <th>Nama Penyewa</th>
                        <th>No. HP Penyewa</th>
                        <th>Tgl Penyewaan</th>
                        <th>Tgl Pengembalian</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                        $no = 1;

                        //dapatkan data motor dari pemilik motor yang sedang login
                        $data = mysqli_query($koneksi,"SELECT * FROM motor WHERE id_pemilik='$username' ORDER BY created_at");
                        while($d = mysqli_fetch_array($data)) {
                            $plat_nomor = $d['plat_nomor'];

                            //cari plat nomor di tabel penyewaan
                            $getpenyewaan = mysqli_query($koneksi, "SELECT * FROM penyewaan WHERE plat_nomor='$plat_nomor'");

                            //jika plat nomor ada di tabel penyewaan
                            var_dump(mysqli_fetch_array($getpenyewaan));
                            if(mysqli_fetch_array($getpenyewaan)){
                                while($penyewaan = mysqli_fetch_array($getpenyewaan)){
                                    $id_penyewaan = $penyewaan["id_penyewaan"];
                                    $id_penyewa = $penyewaan['id_penyewa'];
                                    $id_motor = $penyewaan['plat_nomor'];
                                    $merek_motor = $penyewaan['merek_motor'];
                                    $tipe_motor = $penyewaan['tipe_motor'];
                                    $sewa_perhari = $penyewaan['sewa_perhari'];
                                    $tgl_penyewaan = $penyewaan['tgl_penyewaan'];

                                    //dapatkan data penyewa
                                    $getpenyewa = mysqli_query($koneksi, "SELECT * FROM penyewa WHERE username='$id_penyewa'");
                                    $penyewa = mysqli_fetch_array($getpenyewa);
                                    $nik_penyewa = $penyewa['nik'];
                                    $nama_penyewa = $penyewa['nama'];
                                    $nohp_penyewa = $penyewa['no_hp'];
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $id_motor ?></td>
                        <td><?php echo $nik_penyewa ?></td>
                        <td><?php echo $nama_penyewa ?></td>
                        <td><?php echo $nohp_penyewa ?></td>
                        <td><?php echo $tgl_penyewaan ?></td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                        <a href="<?php echo "dikembalikan.php?idpenyewaan=$idpenyewaan" ?>" class="btn btn-primary"> Dikembalikan </a>
                        </td>
                    </tr>
                    <?php
                                }
                            }
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