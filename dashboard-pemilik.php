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
				<a href="login.php" class="btn btn-dark">Logout</a>
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
                    <a href="rentalkan-motor.php" class="btn btn-success">+ Rentalkan Motor</a>
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
                    
                    <tr>
                        <td>1</td>
                        <td>Honda</td>
                        <td>Beat</td>
                        <td>B 1234 AB</td>
                        <td>Rp50000</td>
                        <td>
                            <a href="" class="btn btn-warning"> Edit </a>
                            <a href="" class="btn btn-danger"> Hapus </a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <!-- Akhir Card Tabel -->

    </div>
    <div class="container">
        <!-- Awal Card Tabel -->
        <div class="card mt-3 mb-3">
            <div class="card-header bg-dark text-white">
                Motor Yang Dirental
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No.</th>
                        <th>Merek Motor</th>
                        <th>Tipe Motor</th>
                        <th>Plat Nomor</th>
                        <th>Nama Penyewa</th>
                        <th>No. HP Penyewa</th>
                        <th>Tgl Penyewaan</th>
                        <th>Tgl Pengembalian</th>
                        <th>Biaya</th>
                    </tr>
                    
                    <tr>
                        <td>1</td>
                        <td>Honda</td>
                        <td>Beat</td>
                        <td>B 1234 AB</td>
                        <td>Paijo</td>
                        <td>0812345678</td>
                        <td>12/10/2023</td>
                        <td>13/10/2023</td>
                        <td>Rp150000</td>
                    </tr>
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