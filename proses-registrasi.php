<?php
//koneksi database
include 'koneksi.php';

//mengambil data dari form
$role = $_POST['role'];
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$username = $_POST['username'];
$password = $_POST['password'];

//jika daftar sebagai pemilik
if($role == 'pemilik'){
    $cekdata = mysqli_query($koneksi, "SELECT * FROM pemilik WHERE username='$username'");

    //jika username belum terdaftar
    if(mysqli_num_rows($cekdata) == 0){
        //inputkan semua data dari form ke database
        $simpan = mysqli_query($koneksi, "INSERT INTO pemilik VALUES('$username', '$nik', '$nama', '$nohp', '$password')");

        //jika berhasil inputkan data ke database
        if($simpan){
            //redirect ke halaman login
            header('location:login.php');
        } else{//jika gagal inputkan data ke database
            echo "<script>
					alert('Registrasi gagal!');
					document.location='registrasi.php';
			     </script>";
        }
    } else{
        echo "<script>
					alert('username sudah ada!');
					document.location='registrasi.php';
			     </script>";
    }
}

//jika daftar sebagai penyewa
if($role == 'penyewa'){
    $cekdata = mysqli_query($koneksi, "SELECT * FROM penyewa WHERE username='$username'");

    //jika username belum terdaftar
    if(mysqli_num_rows($cekdata) == 0){
        //inputkan semua data dari form ke database
        $simpan = mysqli_query($koneksi, "INSERT INTO penyewa VALUES('$username', '$nik', '$nama', '$nohp', '$password')");

        //jika berhasil inputkan data ke database
        if($simpan){
            //redirect ke halaman login
            header('location:login.php');
        } else{//jika gagal inputkan data ke database
            echo "<script>
					alert('Registrasi gagal!');
					document.location='registrasi.php';
			     </script>";
        }
    } else{
        echo "<script>
					alert('username sudah ada!');
					document.location='registrasi.php';
			     </script>";
    }
}
?>