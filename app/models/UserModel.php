<?php

class UserModel {
    private $db;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct($db) {
        $this->db = $db;
    }

    // Registrar un nuevo usuario
    public function register($email, $nombre, $google_id) {
        $query = "INSERT INTO usuarios (email, nombre, google_id) 
                  VALUES (:email, :nombre, :google_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':google_id', $google_id);
        return $stmt->execute();
    }

    // Obtener un usuario por su google_id
    public function getByGoogleId($google_id) {
        $query = "SELECT * FROM usuarios WHERE google_id = :google_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':google_id', $google_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar información del usuario (por ejemplo, nombre)
    public function update($google_id, $nombre) {
        $query = "UPDATE usuarios SET nombre = :nombre WHERE google_id = :google_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':google_id', $google_id);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function delete($google_id) {
        $query = "DELETE FROM usuarios WHERE google_id = :google_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':google_id', $google_id);
        return $stmt->execute();
    }
}
?>
