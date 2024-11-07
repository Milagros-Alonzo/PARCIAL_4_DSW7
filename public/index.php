
    <?php
    include '../app/views/layout/header.php';
    if (!isset($_SESSION['sesion'])) {
        $_SESSION['sesion'] = false;
    }
    if (isset($_SESSION['sesion']) && $_SESSION['sesion']) {
        include '../app/views/auth/login.php';
    } else {
        include '../app/views/layout/dasboard_libros.php';
    }


    include '../app/views/layout/footer.php';
    ?>
