<?php
// Incluir el archivo de configuración para cargar las variables de entorno y la conexión a la base de datos
require_once '../app/controllers/UserController.php';

// Inicializar el modelo de usuario usando la conexión a la base de datos definida en config.php
$userController = new UserController();

// Verificar si se está haciendo una solicitud POST para el registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los campos del formulario
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
    $pass = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validaciones básicas
    if (empty($name) || empty($email) || empty($pass)) {
        //echo 'todos los campos son obligatorios';
        echo "Todos los campos son obligatorios'";
    } else {

        if (!$email) {
            echo "Correo electrónico no válido.";
            exit;
        }
        // Registrar el usuario
  
        if ($userController->getByEmail($email)) {
            echo "El correo electrónico ya está registrado. Por favor, usa otro.";
        } else {
            if ($userController->register($email, $name, $pass)) {
        
            } else {
                echo "Error al registrar el usuario. Por favor, intenta de nuevo.";
            }
        }
    }
    header('Location: ../index.php');
    exit();
}
