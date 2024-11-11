<?php
session_start();

include_once 'app/views/layout/header.php';

//var_dump("sesion en el index ".$_SESSION['sesion']);
if (isset($_SESSION['sesion']) && $_SESSION['sesion']) {
    
    include_once 'app/views/layout/dasboard.php';
} else {
   // var_dump("sesion en el login index valor: ".$_SESSION['sesion']. 'exite ?'.isset($_SESSION['sesion']));
    include_once 'public/login.php';
}

include_once 'app/views/layout/footer.php';
?>
