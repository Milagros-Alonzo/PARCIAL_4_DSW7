<?php
// Archivo: app/controllers/UserController.php

// Incluir el modelo de usuario

require_once __DIR__ . '/../src/database/database.php';
require_once __DIR__  . '/../models/UserModel.php';
// Incluir la función de conexión a la base de datos

class UserController
{

    private $userModel;
    private $db;

    // Constructor: inicializa el modelo de usuarios con la conexión a la base de datos
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    // Actualizar la información de un usuario (por ejemplo, su nombre)
    public function updateUser($google_id, $nombre)
    {
        if ($this->userModel->update($google_id, $nombre)) {
            return "Usuario actualizado exitosamente.";
        } else {
            return "Hubo un error al actualizar el usuario.";
        }
    }

    // Eliminar un usuario
    public function deleteUser($google_id)
    {
        if ($this->userModel->delete($google_id)) {
            return "Usuario eliminado exitosamente.";
        } else {
            return "Hubo un error al eliminar el usuario.";
        }
    }


    public function getId($google_id)
    {
        return $this->userModel->getIdUser($google_id);
    }

    public function getByGoogleId($google_id)
    {
        return $this->userModel->getByGoogleId($google_id);
    }

    public function getByEmail($email)
    {
        return $this->userModel->getByEmail($email);
    }

    public function login($email, $pass)
    {
        $res =  $this->userModel->login($email, $pass);
        return $res;
    }


    // Registrar un nuevo usuario
    public function register($email, $nombre,  $pass)
    {
        return $this->userModel->register($email, $nombre, $pass);
    }

    public function registerGoogle($email, $nombre, $google_id)
    {
        return $this->userModel->registerGoogle($email, $nombre, $google_id);
    }
}
