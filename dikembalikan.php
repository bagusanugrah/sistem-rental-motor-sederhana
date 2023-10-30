<?php
    // koneksi database
    include 'koneksi.php';

    //jalankan session
    session_start();

    //tampung nilai query parameter idpenyewaan ke variabel $id_penyewaan
    $id_penyewaan = $_GET['idpenyewaan'];
    //dapatkan data penyewaan dari database berdasarkan id_penyewaan
    $getpenyewaan = mysqli_query($koneksi, "SELECT * FROM penyewaan WHERE id_penyewaan='$id_penyewaan'");
    $penyewaan = mysqli_fetch_array($getpenyewaan);
    $id_pemilik = $penyewaan['id_pemilik'];
    $tgl_penyewaan = $penyewaan['tgl_penyewaan'];

    //jika session username tidak diatur
    if (!isset($_SESSION['username'])){
        //redirect ke halaman login
        echo "<script>
                document.location='login.php';
            </script>";
    }else{//jika session username diatur
        //nilai session username ditampung ke dalam variabel username
        $username = $_SESSION['username'];

        //jika pemilik yang login bukanlah pemilik motor
        if($username != $id_pemilik){
            //redirect ke dashboard pemilik
            echo "<script>
                    document.location='dashboard-pemilik.php?id=$username';
                </script>";
        } else{//jika pemilik yang login adalah pemilik motor
            $tgl_hari_ini = date("Y-m-d");
            //masukkan tgl_penyewaan dan id_penyewaan dari tabel penyewaan ke tabel pengembalian
            $simpan = mysqli_query($koneksi, "INSERT INTO pengembalian(tgl_penyewaan, tgl_pengembalian, id_penyewaan) VALUES('$tgl_penyewaan', '$tgl_hari_ini', '$id_penyewaan')");
        
            //jika berhasil kembalikan motor
            if($simpan){
                //redirect ke dashboard penyewa
                echo "<script>
                        alert('Pengembalian motor berhasil!');
                        document.location='dashboard-pemilik.php?id=$username';
                    </script>";
            } else{//jika gagal kembalikan motor
                echo "<script>
                        alert('Proses pengembalian motor gagal! $tgl_penyewaan $id_penyewaan $tgl_hari_ini');
                        //document.location='dashboard-pemilik.php?id=$username';
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