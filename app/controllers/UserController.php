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

    /*
    Fatal error: Uncaught Error: Call to a member function getIdUser()
     on null in C:\laragon\www\PARCIALES\PARCIAL_4_DSW7
     \app\controllers\UserController.php:45 Stack trace:
      #0 C:\laragon\www\PARCIALES\PARCIAL_4_DSW7\app\src\
      libros\libros.php(73): UserController->getId('102978050687378...')
       #1 C:\laragon\www\PARCIALES\PARCIAL_4_DSW7\app\src\libros\dasboard.php(39):
        agregarFavoritos(Array) #2 {main} thrown in
         C:\laragon\www\PARCIALES\PARCIAL_4_DSW7
         \app\controllers\UserController.php on line 45 */
    public function getId($google_id)
    {

        return $this->userModel->getIdUser($google_id);
    }

    public function login($email, $pass)
    {
        $res =  $this->userModel->login($email, $pass);
        var_dump($res);
        die();
        /*
        if ($this->userModel->login($email, $pass) == 1) {
            return true;
        } else {
            return false ;
        }*/
    }

    // Método en el modelo UserModel para obtener el usuario por email


    // Método en el controlador UserController para iniciar sesión
    /*public function login($email, $pass)
{
    // Llamar al modelo para obtener los datos del usuario por email
    $user = $this->userModel->login($email);

    // Verificar si el usuario existe y si la contraseña es correcta
    if ($user && password_verify($pass, $user['pass_user'])) {
        // Iniciar la sesión
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['is_admin'] = $user['is_admin']; // Asumiendo que hay una columna 'is_admin'

        echo "Inicio de sesión exitoso."; // Mensaje de prueba

        // Puedes redirigir al dashboard si lo deseas
        header("Location: ../user/dashboard.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}*/
}

// Código de prueba
/*$resultado = new UserController();
$resultado->login("alonzomilagros24@gmail.com", "1234");

}

$resultado = new userController();
$resultado->login("alonzomilagros24@gmail.com","1234");

var_dump($resultado);
die();*/
?>