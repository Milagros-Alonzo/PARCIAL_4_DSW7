<?php

// Archivo: app/controllers/AuthController.php

require_once __DIR__ . '/../controllers/UserController.php';

class AuthController {
    
    private $userController;

    public function __construct() {
        $this->userController = new UserController();
    }                                                                                                          

    public function registerGoogle($email, $nombre, $google_id) {
        if ($this->userController->getByGoogleId($google_id)) {
        } else {
            if ($this->userController->registerGoogle($email, $nombre, $google_id)) {
            } else {
                return "Hubo un error al registrar al usuario.";
            }
        }
    }

    public function verifyUser($google_id) {
        $user = $this->userController->getByGoogleId($google_id);
        return $user ? $user : null;
    }
}
?>