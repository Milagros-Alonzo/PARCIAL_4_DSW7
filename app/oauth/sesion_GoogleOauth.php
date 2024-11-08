<?php
// Inicialización de variables
<<<<<<< HEAD
require_once __DIR__ . '/../../config/config.php';// Incluye el archivo de configuración
=======
require_once __DIR__ . '/../../src/config.php';// Incluye el archivo de configuración
>>>>>>> 2f23a7bc328f41b0f56059eac88060d12c7bf710
loadEnv(__DIR__ . '/../../public/.env');  // Carga el archivo .env desde la raíz del proyecto

// Obtener las variables de entorno
$client_id = getenv('CLIENT_ID');
$redirect_uri = getenv('REDIRECT_URI');
$scope = getenv('SCOPE');

// URL de autorización
$auth_url = "https://accounts.google.com/o/oauth2/auth?"
    . "response_type=code"
    . "&client_id=$client_id"
    . "&redirect_uri=" . urlencode($redirect_uri)
    . "&scope=" . urlencode($scope)
    . "&access_type=offline";

// Mostrar enlace para iniciar sesión con Google
echo "<a href='$auth_url'>Iniciar sesión con Google</a>";
?>
