<?php
session_start();

include_once '../app/views/layout/header.php';

if (isset($_SESSION['sesion']) && $_SESSION['sesion']) {
    include_once '../app/views/layout/dasboard.php';
} else {
    include_once 'login.php';
}

include_once '../app/views/layout/footer.php';
?>
