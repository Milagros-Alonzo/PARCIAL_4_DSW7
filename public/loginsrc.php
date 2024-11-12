<?php
require_once '../app/controllers/UserController.php';
$userController = new UserController();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validaciones básicas
    if (empty($email) || empty($password)) {
        echo "Todos los campos son obligatorios.";
        exit;
    } else {
        if ($userController->login($email, $password) == true) {
            $_SESSION['sesion'] = true;
            $_SESSION['loginGoogle'] = false;
            $userInfo = $userController->getByEmail($email);
            $_SESSION['userId'] =   $userInfo['id'];
            $_SESSION['userSesionName'] = $userInfo['nombre'];

            header('Location: ../index.php'); // Redirige a index.php si el login es exitoso
            exit(); // Importante: detener el script después de la redirección
        } else {
            echo "Error: credenciales incorrectas.";
        }
    }
}
