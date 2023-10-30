<?php
    // koneksi database
    include 'koneksi.php';

    //jalankan session
    session_start();

    $id_motor = $_GET['idmotor'];//plat nomor yang didapat dari query parameter idmotor
    //dapatkan data motor dari database
    $getmotor = mysqli_query($koneksi, "SELECT * FROM motor WHERE plat_nomor='$id_motor'");
    $motor = mysqli_fetch_array($getmotor);
    $id_pemilik = $motor['id_pemilik'];
    $merek = $motor['merek'];
    $tipe = $motor['tipe'];
    $sewa_perhari = $motor['sewa_perhari'];

    //jika session username tidak diatur
    if (!isset($_SESSION['username'])){
        //redirect ke halaman login
        echo "<script>
                document.location='login.php';
            </script>";
    }else{//jika session username diatur
        //nilai session username ditampung ke dalam variabel username
        $username = $_SESSION['username'];
        $tgl_hari_ini = date("Y-m-d");
        //masukkan data motor yang dipilih ke tabel penyewaan
        $simpan = mysqli_query($koneksi, "INSERT INTO penyewaan(tgl_penyewaan, merek_motor, tipe_motor, plat_nomor, id_pemilik, sewa_perhari, id_penyewa) VALUES('$tgl_hari_ini', '$merek', '$tipe', '$id_motor', '$id_pemilik', '$sewa_perhari', '$username')");
    
        //jika berhasil sewa motor
        if($simpan){
            //redirect ke dashboard penyewa
            echo "<script>
                    alert('Sewa motor berhasil!');
                    document.location='dashboard-penyewa.php?id=$username';
                </script>";
        } else{//jika gagal sewa motor
            echo "<script>
                    alert('Proses sewa motor gagal!');
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