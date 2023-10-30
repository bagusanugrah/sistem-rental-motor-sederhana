<?php
    //jalankan session
    session_start();

    //jika session username dan role diatur dan session role bernilai 'penyewa'
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && $_SESSION['role'] == 'penyewa'){
		//nilai session username ditampung ke dalam variabel username
		$username = $_SESSION['username'];
        //redirect ke dashboard penyewa
        echo "<script>
                document.location='dashboard-penyewa.php?id=$username';
            </script>";
    }
    
    //jika session username dan role diatur dan session role bernilai 'pemilik'
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && $_SESSION['role'] == 'pemilik'){
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
    <title>Registrasi</title>
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
				<a href="login.php" class="btn btn-dark">Login</a>
			</div>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-6 m-auto">
				<div class="text-left mb-3 mt-3">
					<a href="login.php" class="btn btn-secondary">< Login</a>
				</div>
				<!-- Awal Card Form -->
				<div class="card mt-3 mb-3">
				<div class="card-header bg-dark text-white">
					Pendaftaran
				</div>
				<div class="card-body">
					<form method="post" action="proses-registrasi.php">
						<div class="form-group">
							<label>Daftar Sebagai</label>
							<select name="role" class="form-select" aria-label="Default select example" required>
								<option value="">-- Pilih Salah Satu --</option>
								<option value="pemilik">Pemilik Motor</option>
								<option value="penyewa">Penyewa Motor</option>
							</select>
						</div><br>
						<div class="form-group">
							<label for="nik">NIK</label>
							<input id="nik" type="text" name="nik" value="" class="form-control" required>
						</div><br>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input id="nama" type="text" name="nama" value="" class="form-control" required>
						</div><br>
						<div class="form-group">
							<label for="nohp">No. HP</label>
							<input id="nohp" type="text" name="nohp" value="" class="form-control" required>
						</div><br>
						<div class="form-group">
							<label for="username">Username</label>
							<input id="username" type="text" name="username" value="" class="form-control" required>
						</div><br>
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" type="password" name="password" value="" class="form-control" required>
						</div><br>
						<button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
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
			<a class="text-dark" href="https://github.com/bagusanugrah/sistem-rental-motor-sederhana" target="_blank" title="Github">Penyewaan Motor</a>
		</div>
		<!-- Copyright -->
	</footer>
    <script src="js/bootstrap5.js"></script>
</body>
</html>