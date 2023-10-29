<?php 
// koneksi database
include 'koneksi.php';
 
//jalankan session
session_start();

// menangkap data id yang di kirim dari url
$plat_nomor = $_GET['idmotor'];
//dapatkan data motor dari database
$getmotor = mysqli_query($koneksi, "SELECT * FROM motor WHERE plat_nomor='$plat_nomor'");
$motor = mysqli_fetch_array($getmotor);
$id_pemilik = $motor['id_pemilik'];
$merek = $motor['merek'];
$tipe = $motor['tipe'];
$biaya = $motor['sewa_perhari'];
$username = '';


//jika session username tidak diatur
if(!isset($_SESSION['username'])){
    //redirect ke halaman login
    echo "<script>
            document.location='login.php';
        </script>";
}else{//jika session username diatur
    //nilai session username ditampung ke dalam variabel username
    $username = $_SESSION['username'];

    //jika username pada query parameter id bukanlah pemilik yang login
    if($id_pemilik != $username){
        //redirect ke dashboard pemilik terkait
        echo "<script>
                document.location='dashboard-pemilik.php?id=$username';
            </script>";
    } else{//jika username pada query parameter id adalah pemilik yang login
        // menghapus data dari database
        $hapus = mysqli_query($koneksi,"delete from motor where plat_nomor='$plat_nomor'");

        //jika berhasil hapus data motor
        if($hapus){
            //redirect ke dashboard pemilik
            echo "<script>
                    alert('Hapus data motor berhasil!');
                    document.location='dashboard-pemilik.php?id=$username';
                </script>";
        } else{//jika gagal hapus data motor
            echo "<script>
                    alert('Hapus data motor gagal!');
                    document.location='dashboard-pemilik.php?id=$username';
                </script>";
        }
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