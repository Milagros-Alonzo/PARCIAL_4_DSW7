<?php
// Archivo: app/controllers/AuthController.php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../src/database/database.php';

class AuthController {
    private $db;
    private $userModel;

    public function __construct() {
        // Crear una instancia de la clase Database
        $database = new Database();
        $this->db = $database->getConnection();
        // Crear una instancia del modelo UserModel
        $this->userModel = new UserModel($this->db);
    }

    public function register($email, $nombre, $google_id) {
        if ($this->userModel->getByGoogleId($google_id)) {
            return "El usuario ya está registrado.";
        } else {
            if ($this->userModel->register($email, $nombre, $google_id)) {
                return "Usuario registrado exitosamente.";
            } else {
                return "Hubo un error al registrar al usuario.";
            }
        }
    }

    public function verifyUser($google_id) {
        $user = $this->userModel->getByGoogleId($google_id);
        return $user ? $user : null;
    }
}
?>
