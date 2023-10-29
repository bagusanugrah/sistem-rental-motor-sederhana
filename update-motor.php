<?php
//koneksi database
include 'koneksi.php';

//mengambil data dari form
$id_pemilik = $_POST['idpemilik'];//dari hidden input
$id_motor = $_POST['idmotor'];//dari hidden input
$plat = strtoupper($_POST['plat']);//dari inputan user
$merek = $_POST['merek'];
$tipe = $_POST['tipe'];
$biaya = $_POST['biaya'];

//jika form registrasi ada yang kosong
if($plat == "" || $merek == ""|| $tipe == "" || $biaya == ""){
    echo "<script>
            alert('Form tidak boleh ada yang kosong!');
            document.location='edit-motor.php?idmotor=$id_motor';
        </script>";
} else {//jika form tidak ada yang kosong
    //jika plat terdiri dari selain dari aphanumeric dan spasi
    if(!(ctype_alnum($plat)) && !(strpos($plat, ' '))){
        echo "<script>
                alert('plat tidak boleh selain dari huruf, angka, dan spasi!');
                document.location='edit-motor.php?idmotor=$id_motor';
            </script>";
    } else {//jika plat terdiri dari bukan selain alphanumeric
        //inputkan semua data dari form ke database
        $update = mysqli_query($koneksi, "UPDATE motor SET plat_nomor='$plat', merek='$merek', tipe='$tipe', sewa_perhari=$biaya where plat_nomor='$id_motor'");

        //jika berhasil update data motor
        if($update){
            //redirect ke dashboard pemilik
            echo "<script>
                    document.location='dashboard-pemilik.php?id=$id_pemilik';
                </script>";
        } else{//jika gagal update data motor
            echo "<script>
                    alert('Update data motor gagal!');
                    document.location='edit-motor.php?idmotor=$id_motor';
                </script>";
        }
    }
}



?>