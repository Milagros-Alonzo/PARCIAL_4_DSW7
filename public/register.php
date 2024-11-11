<?php
// Incluir el archivo de configuración para cargar las variables de entorno y la conexión a la base de datos
require_once '../config/config.php';
require_once '../app/models/UserModel.php';

// Inicializar el modelo de usuario usando la conexión a la base de datos definida en config.php
$userModel = new UserModel($db);

// Verificar si se está haciendo una solicitud POST para el registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los campos del formulario
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validaciones básicas
    if (empty($name) || empty($email) || empty($password)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    if (!$email) {
        echo "Correo electrónico no válido.";
        exit;
    }

    // Encriptar la contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Registrar el usuario
    if ($userModel->getByEmail($email)) {
        echo "El correo electrónico ya está registrado. Por favor, usa otro.";
    } else {
        if ($userModel->register($email, $name, null, $password_hash)) {
            // Registro exitoso: Redirigir al dashboard del usuario
            header('Location: index.php');
            exit(); // Asegurarse de terminar el script después de la redirección
        } else {
            echo "Error al registrar el usuario. Por favor, intenta de nuevo.";
        }
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
