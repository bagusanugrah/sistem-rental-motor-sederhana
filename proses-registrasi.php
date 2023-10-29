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

//jika form registrasi ada yang kosong
if($role == "" || $nik == ""|| $nama == "" || $nohp == "" || $username == "" || $password == ""){
    echo "<script>
            alert('Form tidak boleh ada yang kosong!');
            document.location='registrasi.php';
        </script>";
} else {//jika form tidak ada yang kosong
    //jika username terdiri dari selain dari aphanumeric dan titik
    if(!(ctype_alnum($username) || strpos($username, '.'))){
        echo "<script>
                alert('username tidak boleh selain dari huruf, angka, atau titik!');
                document.location='registrasi.php';
            </script>";
    } else {//jika username terdiri dari bukan selain alphanumeric dan titik
        //jika username bukan lowercase
        if($username != strtolower($username)){
            echo "<script>
                    alert('username harus lowercase!');
                    document.location='registrasi.php';
                </script>";
        } else{//jika username lowercase
            //jika daftar sebagai pemilik
            if($role == 'pemilik'){
                $cekdata = mysqli_query($koneksi, "SELECT * FROM pemilik WHERE username='$username'");

                //jika username belum terdaftar
                if(mysqli_num_rows($cekdata) == 0){
                    //inputkan semua data dari form ke database
                    $simpan = mysqli_query($koneksi, "INSERT INTO pemilik(username, nik, nama, no_hp, password) VALUES('$username', '$nik', '$nama', '$nohp', '$password')");

                    //jika berhasil inputkan data ke database
                    if($simpan){
                        //redirect ke halaman login
                        echo "<script>
                                document.location='login.php';
                            </script>";
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
                    $simpan = mysqli_query($koneksi, "INSERT INTO penyewa(username, nik, nama, no_hp, password) VALUES('$username', '$nik', '$nama', '$nohp', '$password')");

                    //jika berhasil inputkan data ke database
                    if($simpan){
                        //redirect ke halaman login
                        echo "<script>
                                document.location='login.php';
                            </script>";
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
        }
    }
}



?>