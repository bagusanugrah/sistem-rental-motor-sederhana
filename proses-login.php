<?php
//koneksi database
include 'koneksi.php';

//mengambil data dari form
$role = $_POST['role'];
$username = $_POST['username'];
$password = $_POST['password'];

//jika form login ada yang kosong
if($username == "" || $password == ""){
    echo "<script>
            alert('Form tidak boleh ada yang kosong!');
            document.location='login.php';
        </script>";
} else {//jika form tidak ada yang kosong
    //jika login sebagai pemilik
    if($role == 'pemilik'){
        $cekdata = mysqli_query($koneksi, "SELECT * FROM pemilik WHERE username='$username'");

        //jika username ada di database
        if(mysqli_num_rows($cekdata) > 0){
            //dapatkan password si username dari database
            //$cekpassword berupa objek, diubah menjadi array dengan fungsi mysqli_fetch_array()
            $cekpassword = mysqli_query($koneksi, "SELECT password FROM pemilik WHERE username='$username'");
            //jika password yang diinputkan pada form sama dengan password yang di database
            if($password == mysqli_fetch_array($cekpassword)[0]){
                //jalankan session
                session_start();
                //buat session username
                $_SESSION['username'] = $username;
                //buat session role
                $_SESSION['role'] = $role;
                //redirect ke dashboard
                echo "<script>
                        document.location='dashboard-pemilik.php?id=$username';
                    </script>";
            } else {
                echo "<script>
                        alert('password salah!');
                        document.location='login.php';
                    </script>";
            }
        } else{//jika username tidak ada di database
            echo "<script>
                        alert('akun belum terdaftar!');
                        document.location='login.php';
                    </script>";
        }
    }

    //jika login sebagai penyewa
    if($role == 'penyewa'){
        $cekdata = mysqli_query($koneksi, "SELECT * FROM penyewa WHERE username='$username'");

        //jika username ada di database
        if(mysqli_num_rows($cekdata) > 0){
            //dapatkan password si username dari database
            //$cekpassword berupa objek, diubah menjadi array dengan fungsi mysqli_fetch_array()
            $cekpassword = mysqli_query($koneksi, "SELECT password FROM penyewa WHERE username='$username'");
            //jika password yang diinputkan pada form sama dengan password yang di database
            if($password == mysqli_fetch_array($cekpassword)[0]){
                //jalankan session
                session_start();
                //buat session username
                $_SESSION['username'] = $username;
                //buat session role
                $_SESSION['role'] = $role;
                //redirect ke dashboard
                echo "<script>
                        document.location='dashboard-penyewa.php?id=$username';
                    </script>";
            } else {
                echo "<script>
                        alert('password salah!');
                        document.location='login.php';
                    </script>";
            }
        } else{//jika username tidak ada di database
            echo "<script>
                        alert('akun belum terdaftar!');
                        document.location='login.php';
                    </script>";
        }
    }
}

?>