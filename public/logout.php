<?php
session_start();
//session_unset(); // Destruir todas las variables de sesión
session_destroy();
header("Location: ../index.php");
exit();
?>
