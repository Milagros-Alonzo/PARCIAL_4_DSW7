<?php
// Archivo: app/controllers/AuthController.php

// Incluir la clase UserModel para acceder a las funciones del modelo de usuario
require_once 'app/models/UserModel.php';

// Incluir la función de conexión a la base de datos (solo una vez con la ruta correcta)
require_once '../config/database.php';

class AuthController {

    private $db;
    private $userModel;

    public function __construct() {
        // Obtener la conexión a la base de datos
        $this->db = getDBConnection();

        // Crear una instancia del modelo UserModel
        $this->userModel = new UserModel($this->db);
    }

    // Registro de un nuevo usuario (Google OAuth)
    public function register($email, $nombre, $google_id) {
        // Verificar si el usuario ya está registrado por Google ID
        if ($this->userModel->getByGoogleId($google_id)) {
            return "El usuario ya está registrado.";
        } else {
            // Registrar al nuevo usuario
            if ($this->userModel->register($email, $nombre, $google_id)) {
                return "Usuario registrado exitosamente.";
            } else {
                return "Hubo un error al registrar al usuario.";
            }
        }
    }

    // Verificación de usuario por Google ID
    public function verifyUser($google_id) {
        // Buscar el usuario por Google ID
        $user = $this->userModel->getByGoogleId($google_id);
        if ($user) {
            return $user; // Usuario encontrado
        } else {
            return null; // Usuario no encontrado
        }
    }
}
?>
