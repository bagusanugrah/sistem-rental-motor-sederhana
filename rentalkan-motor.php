<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
					<a href="dashboard-pemilik.php" class="btn btn-secondary">< Kembali ke Dashboard</a>
				</div>
				<!-- Awal Card Form -->
				<div class="card mt-3 mb-3">
				<div class="card-header bg-dark text-white">
					Rantalkan Motor Anda
				</div>
				<div class="card-body">
					<form method="post" action="tambah-motor.php">
						<div class="form-group">
							<label for="nik">Plat Nomor Motor</label>
							<input id="nik" type="text" name="plat" value="" class="form-control" required>
						</div><br>
						<div class="form-group">
							<label for="nama">Merek Motor</label>
							<input id="nama" type="text" name="merek" value="" class="form-control" required>
						</div><br>
						<div class="form-group">
							<label for="nohp">Tipe Motor</label>
							<input id="nohp" type="text" name="tipe" value="" class="form-control" required>
						</div><br>
						<div class="input-group">
							<span class="input-group-text" id="mata-uang">Rp</span>
							<input id="biaya" placeholder="Biaya Sewa Perhari" type="number" name="biaya" value="" class="form-control" required>
						</div><br>
						<button type="submit" class="btn btn-primary" name="rentalkan">Rentalkan</button>
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