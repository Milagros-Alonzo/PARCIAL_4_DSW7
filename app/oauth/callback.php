<?php
session_start();
require_once 'GoogleOAuth.php';
require_once __DIR__ . './../../src/config.php';  // Ruta al archivo config.php
require_once __DIR__ . './../controllers/AuthController.php';
// Cargar el archivo .env desde la raíz del proyecto
loadEnv(__DIR__ . '/../../public/.env');  // Corregimos la ruta para subir al directorio raíz

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
        $_SESSION['userId'] = $user_data['id'];
        // var_dump($user_data);
        // die();
        $_SESSION['userSesionName'] = $user_data['name'];
        $email = $user_data['email'];
        $nombre = $user_data['name'];
        $google_id = $user_data['id'];

        $auth = new AuthController(); //si la autorizacion fue proporcionada se realiza el registro
        $auth->registerGoogle($email, $nombre, $google_id);

        $_SESSION['sesion'] = true;
        $_SESSION['loginGoogle'] = true;
        echo "<pre>";
        var_dump($user_data);
        echo "</pre>";

        
    } else {
        echo "Error al obtener el access token.";
    }
} else {
    echo "No se recibió el código de autorización.";
}

header("Location: ../../index.php");
exit();
