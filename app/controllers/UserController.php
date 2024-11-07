<?php
// Archivo: app/controllers/UserController.php

// Incluir el modelo de usuario
require_once 'app/models/UserModel.php';
// Incluir la función de conexión a la base de datos
require_once '../config/database.php';

class UserController {

    private $userModel;

    // Constructor: inicializa el modelo de usuarios con la conexión a la base de datos
    public function __construct() {
        // Obtener la conexión a la base de datos
        $db = getDBConnection();
        $this->userModel = new UserModel($db); // Pasar la conexión a UserModel
    }

    // Actualizar la información de un usuario (por ejemplo, su nombre)
    public function updateUser($google_id, $nombre) {
        if ($this->userModel->update($google_id, $nombre)) {
            return "Usuario actualizado exitosamente.";
        } else {
            return "Hubo un error al actualizar el usuario.";
        }
    }

    // Eliminar un usuario
    public function deleteUser($google_id) {
        if ($this->userModel->delete($google_id)) {
            return "Usuario eliminado exitosamente.";
        } else {
            return "Hubo un error al eliminar el usuario.";
        }
    }
}
?>
