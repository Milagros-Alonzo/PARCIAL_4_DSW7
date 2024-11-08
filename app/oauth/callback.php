<?php
session_start();
require_once 'GoogleOAuth.php';
<<<<<<< HEAD
require_once __DIR__ . '/../../config/config.php';  // Ruta al archivo config.php

// Cargar el archivo .env desde la raíz del proyecto
loadEnv(__DIR__ . '/../../.env');  // Corregimos la ruta para subir al directorio raíz
=======
require_once __DIR__ . '/../../src/config.php';  // Ruta al archivo config.php

// Cargar el archivo .env desde la raíz del proyecto
loadEnv(__DIR__ . '/../../public/.env');  // Corregimos la ruta para subir al directorio raíz
>>>>>>> 2f23a7bc328f41b0f56059eac88060d12c7bf710

// Obtener las variables del archivo .env
$client_secret = getenv('CLIENT_SECRET');
$client_id = getenv('CLIENT_ID');
$redirect_uri = getenv('REDIRECT_URI');

// Inicializar GoogleOAuth
$googleOAuth = new GoogleOAuth($client_id, $client_secret, $redirect_uri);

// Verifica si el código de autorización fue proporcionado en la URL
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $access_token = $googleOAuth->getAccessToken($code);
    if ($access_token) {
        $user_data = $googleOAuth->getUserInfo($access_token);
        echo "Bienvenido, " . htmlspecialchars($user_data['name']);
    } else {
        echo "Error al obtener el access token.";
    }
} else {
    echo "No se recibió el código de autorización.";
}
?>
