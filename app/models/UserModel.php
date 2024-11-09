<?php
class UserModel {
    private $db;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct($db) {
        $this->db = $db;
    }

    // Registrar un nuevo usuario
    public function register($email, $nombre, $google_id) {
        $query = "INSERT INTO usuarios (email, nombre, google_id) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $email, $nombre, $google_id); // 'sss' indica que son tres strings
        return $stmt->execute();
    }

    // Obtener un usuario por su google_id
    public function getByGoogleId($google_id) {
        $query = "SELECT * FROM usuarios WHERE google_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $google_id); // 's' indica que es un string
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar información del usuario (por ejemplo, nombre)
    public function update($google_id, $nombre) {
        $query = "UPDATE usuarios SET nombre = ? WHERE google_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $nombre, $google_id);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function delete($google_id) {
        $query = "DELETE FROM usuarios WHERE google_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $google_id);
        return $stmt->execute();
    }
}
?>