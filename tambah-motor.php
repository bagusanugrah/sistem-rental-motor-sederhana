<?php
//koneksi database
include 'koneksi.php';

//mengambil data dari form
$iduser = $_POST['iduser'];
$plat = strtoupper($_POST['plat']);
$merek = $_POST['merek'];
$tipe = $_POST['tipe'];
$biaya = $_POST['biaya'];

//jika form registrasi ada yang kosong
if($plat == "" || $merek == ""|| $tipe == "" || $biaya == ""){
    echo "<script>
            alert('Form tidak boleh ada yang kosong!');
            document.location='rentalkan-motor.php?id=$iduser';
        </script>";
} else {//jika form tidak ada yang kosong
    //jika plat terdiri dari selain dari aphanumeric dan spasi
    if(!(ctype_alnum($plat) || strpos($plat, ' '))){
        echo "<script>
                alert('plat tidak boleh selain dari huruf, angka, dan spasi!');
                document.location='rentalkan-motor.php?id=$iduser';
            </script>";
    } else {//jika plat terdiri dari bukan selain alphanumeric
        $cekdata = mysqli_query($koneksi, "SELECT * FROM motor WHERE plat_nomor='$plat'");

        //jika plat nomor belum terdaftar
        if(mysqli_num_rows($cekdata) == 0){
            //inputkan semua data dari form ke database
            $simpan = mysqli_query($koneksi, "INSERT INTO motor(plat_nomor, merek, tipe, sewa_perhari, id_pemilik) VALUES('$plat', '$merek', '$tipe', '$biaya', '$iduser')");

            //jika berhasil inputkan data ke database
            if($simpan){
                //redirect ke dashboard pemilik
                echo "<script>
                        document.location='dashboard-pemilik.php?id=$iduser';
                    </script>";
            } else{//jika gagal inputkan data ke database
                echo "<script>
                        alert('Proses rentalkan motor gagal!');
                        document.location='rentalkan-motor.php?id=$iduser';
                    </script>";
            }
        } else{
            echo "<script>
                        alert('Plat nomor sudah ada!');
                        document.location='rentalkan-motor.php?id=$iduser';
                    </script>";
        }
    }
}



?>