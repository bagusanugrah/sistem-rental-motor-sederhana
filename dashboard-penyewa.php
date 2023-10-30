<?php
    //jalankan session
    session_start();

    $username = '';

    //jika session username tidak diatur
    if (!isset($_SESSION['username'])){
        //redirect ke halaman login
        echo "<script>
                document.location='login.php';
            </script>";
    }else{//jika session username diatur
        //nilai session username ditampung ke dalam variabel username
        $username = $_SESSION['username'];
        //username yang didapat dari query parameter id
        $id_penyewa = $_GET['id'];

        //jika username pada query parameter id bukanlah penyewa yang login
        if($id_penyewa != $username){
            //redirect ke dashboard penyewa terkait
            echo "<script>
                    document.location='dashboard-penyewa.php?id=$username';
                </script>";
        }
    }

    //jika session role diatur dan session role bernilai 'pemilik'
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'pemilik'){
        //nilai session username ditampung ke dalam variabel username
        $username = $_SESSION['username'];
        //redirect ke dashboard pemilik
        echo "<script>
                document.location='dashboard-pemilik.php?id=$username';
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
                <table class="table table-bordered table-striped text-center">
                    <tr>
                        <th>No.</th>
                        <th>Merek Motor</th>
                        <th>Tipe Motor</th>
                        <th>Plat Nomor</th>
                        <th>Biaya Sewa Perhari</th>
                        <th>Nama Pemilik</th>
                        <th>No. HP Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                    <?php 
                        include 'koneksi.php';
                        $no = 1;
                        $data = mysqli_query($koneksi,"SELECT * FROM motor ORDER BY created_at");
                        while($d = mysqli_fetch_array($data)){
                            $plat_nomor = $d['plat_nomor'];
                            $merek = $d['merek'];
                            $tipe = $d['tipe'];
                            $sewa_perhari = $d['sewa_perhari'];

                            //cari data penyewaan berdasarkan plat nomor
                            $get_penyewaan = mysqli_query($koneksi, "SELECT * FROM penyewaan WHERE plat_nomor='$plat_nomor'");
                            if($get_penyewaan->num_rows==0){//jika plat nomor tidak terdapat dalam tabel penyewaan
                            //maka tampilkan data motor
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $merek ?></td>
                        <td><?php echo $tipe ?></td>
                        <td><?php echo $plat_nomor ?></td>
                        <td>Rp<?php echo $sewa_perhari ?></td>
                        <?php 
                            //ambil data pemilik dari database berdasarkan id_pemilik dari tabel motor
                            $id_pemilik = $d['id_pemilik'];
                            $getpemilik = mysqli_query($koneksi, "SELECT * FROM pemilik WHERE username='$id_pemilik'");
                            $pemilik = mysqli_fetch_array($getpemilik);
                            $nama = $pemilik['nama'];
                            $nohp = $pemilik['no_hp'];
                        ?>
                        <td><?php echo $nama ?></td>
                        <td><?php echo $nohp ?></td>
                        <td>
                            <a href="<?php echo "sewa.php?idmotor=$plat_nomor" ?>" class="btn btn-primary"> Sewa </a>
                        </td>
                    </tr>
                    <?php 
                            }
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
                History Transaksi Rental
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <tr>
                        <th>No.</th>
                        <th>Motor</th>
                        <th>Pemilik</th>
                        <th>Tanggal Penyewaan</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Biaya</th>
                    </tr>
                    <?php 
                        $no = 1;
                        //ambil data penyewaan berdasarkan id_penyewa
                        $data = mysqli_query($koneksi,"SELECT * FROM penyewaan WHERE id_penyewa='$username' ORDER BY id_penyewaan");
                        while($d = mysqli_fetch_array($data)){
                            $id_penyewaan = $d['id_penyewaan'];
                            $plat_nomor = $d['plat_nomor'];
                            $merek = $d['merek_motor'];
                            $tipe = $d['tipe_motor'];
                            $sewa_perhari = $d['sewa_perhari'];
                            $tgl_penyewaan = $d['tgl_penyewaan'];
                            $plat_no_penyewaan = $plat_nomor;

                            if($plat_no_penyewaan!=''){
                                //ambil data motor dengan plat_nomor tersebut
                                $getmotor = mysqli_query($koneksi,"SELECT * FROM motor WHERE plat_nomor='$plat_nomor'");
                                $motor = mysqli_fetch_array($getmotor);
                                //dapatkan id_pemilik
                                $id_pemilik = $motor['id_pemilik'];

                                //cari pemilik dengan id_pemilik tersebut
                                $getpemilik = mysqli_query($koneksi,"SELECT * FROM pemilik WHERE username='$id_pemilik'");
                                $pemilik = mysqli_fetch_array($getpemilik);
                                //dapatkan nama dan nohp
                                $nama_pemilik = $pemilik['nama'];
                                $nohp_pemilik = $pemilik['no_hp'];
                            }

                            //ambil data pengembalian berdasarkan id_penyewaan
                            $getpengembalian = mysqli_query($koneksi,"SELECT * FROM pengembalian WHERE id_penyewaan='$id_penyewaan'");
                            $pengembalian = '';
                            //jika ada ditemukan data pengembalian berdasarkan id_penyewaan
                            if($getpengembalian->num_rows>0){
                                //ambil data pengembalian
                                $pengembalian = mysqli_fetch_array($getpengembalian);
                                $tgl_pengembalian = $pengembalian['tgl_pengembalian'];
                                $plat_nomor = $pengembalian['plat_nomor'];
                                $jumlah_hari = round((strtotime($tgl_pengembalian) - strtotime($tgl_penyewaan)) / (60 * 60 * 24));
                                if($jumlah_hari == 0){
                                    $jumlah_hari = 1;
                                }
                                $biaya = $jumlah_hari * $sewa_perhari;

                                if($plat_no_penyewaan==''){
                                    //ambil data motor dengan plat_nomor tersebut
                                    $getmotor = mysqli_query($koneksi,"SELECT * FROM motor WHERE plat_nomor='$plat_nomor'");
                                    $motor = mysqli_fetch_array($getmotor);
                                    //dapatkan id_pemilik
                                    $id_pemilik = $motor['id_pemilik'];
    
                                    //cari pemilik dengan id_pemilik tersebut
                                    $getpemilik = mysqli_query($koneksi,"SELECT * FROM pemilik WHERE username='$id_pemilik'");
                                    $pemilik = mysqli_fetch_array($getpemilik);
                                    //dapatkan nama dan nohp
                                    $nama_pemilik = $pemilik['nama'];
                                    $nohp_pemilik = $pemilik['no_hp'];
                                }
                            }
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $plat_nomor ?><br><?php echo $merek ?><br><?php echo $tipe ?><br><?php echo "Rp$sewa_perhari/hari" ?></td>
                        <td><?php echo $nama_pemilik ?><br><?php echo $nohp_pemilik ?></td>
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
                                    echo "Rp$biaya";
                                }
                            ?>
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
			<a class="text-dark" href="https://github.com/bagusanugrah/sistem-rental-motor-sederhana" target="_blank" title="Github">Penyewaan Motor</a>
		</div>
		<!-- Copyright -->
	</footer>
    <script src="js/bootstrap5.js"></script>
</body>
</html>