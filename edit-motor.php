<?php
    include 'koneksi.php';

    //jalankan session
    session_start();
    //jika session username tidak diatur
    $username = '';
    if(!isset($_SESSION['username'])){
        //redirect ke halaman login
        echo "<script>
                document.location='login.php';
            </script>";
    }else{//jika session username diatur
        //nilai session username ditampung ke dalam variabel username
        $username = $_SESSION['username'];
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

    //ambil nilai dari query parameter idmotor kemudian tampung di variabel $plat_nomor
    $plat_nomor = $_GET['idmotor'];
    //dapatkan data motor dari database
    $getmotor = mysqli_query($koneksi, "SELECT * FROM motor WHERE plat_nomor='$plat_nomor'");
    $motor = mysqli_fetch_array($getmotor);
    $id_pemilik = $motor['id_pemilik'];
    $merek = $motor['merek'];
    $tipe = $motor['tipe'];
    $biaya = $motor['sewa_perhari'];

    //jika pemilik yang login bukanlah pemilik motor yang diedit datanya
    if($username != $id_pemilik){
        //redirect ke dashboard pemilik terkait
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
    <title>Edit Informasi</title>
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
				<a href="login.php" class="btn btn-dark">Logout</a>
			</div>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-6 m-auto">
				<div class="text-left mb-3 mt-3">
					<a href="dashboard-pemilik.php?id=<?php echo $id_pemilik ?>" class="btn btn-secondary">< Kembali ke Dashboard</a>
				</div>
				<!-- Awal Card Form -->
				<div class="card mt-3 mb-3">
				<div class="card-header bg-dark text-white">
					Edit Informasi Motor
				</div>
				<div class="card-body">
					<form method="post" action="update-motor.php">
						<input type="hidden" name="idpemilik" value="<?php echo $id_pemilik ?>">
						<input type="hidden" name="idmotor" value="<?php echo $_GET['idmotor'] ?>">
						<div class="form-group">
							<label for="plat">Plat Nomor Motor</label>
							<input id="plat" type="text" name="plat" value="<?php echo $plat_nomor ?>" class="form-control" required>
						</div><br>
						<div class="form-group">
							<label for="merek">Merek Motor</label>
							<input id="merek" type="text" name="merek" value="<?php echo $merek ?>" class="form-control" required>
						</div><br>
						<div class="form-group">
							<label for="tipe">Tipe Motor</label>
							<input id="tipe" type="text" name="tipe" value="<?php echo $tipe ?>" class="form-control" required>
						</div><br>
						<div class="input-group">
							<span class="input-group-text" id="mata-uang">Rp</span>
							<input id="biaya" placeholder="Biaya Sewa Perhari" type="number" name="biaya" value="<?php echo $biaya ?>" class="form-control" required>
						</div><br>
						<button type="submit" class="btn btn-primary" name="update">Update</button>
						<button type="reset" class="btn btn-danger" name="reset">Reset</button>

					</form>
				</div>
				</div>
				<!-- Akhir Card Form -->
			</div>
		</div>
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