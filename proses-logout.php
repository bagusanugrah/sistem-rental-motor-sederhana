<?php
    //jalankan session
    session_start();
    //kosongkan session username
    $_SESSION['username'] = '';
    //kosongkan session role
    $_SESSION['role'] = '';
    //lepas session username
    unset($_SESSION['username']);
    //lepas session role
    unset($_SESSION['role']);
    //lepas session
    session_unset();
    //matikan session
    session_destroy();
    //redirect ke halaman login
    echo "<script>
            document.location='login.php';
        </script>";
?>