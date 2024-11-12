<?php
class UserModel
{
    private $db;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Registrar un nuevo usuario
    public function register($email, $nombre, $pass)
    {
        $query = "INSERT INTO usuarios (email, nombre, pass_user) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $email, $nombre, $pass); // 'sss' indica que son tres strings
        return $stmt->execute();
    }

    // Registrar un nuevo usuario credenciales de google
    public function registerGoogle($email, $nombre, $google_id)
    {
        $query = "INSERT INTO usuarios (email, nombre, google_id) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $email, $nombre, $google_id); // 'sss' indica que son tres strings
        return $stmt->execute();
    }


    // Obtener un usuario por su email
    public function getByEmail($email)
    {
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // Devolver el usuario si existe
    }

    // Obtener un usuario por su google_id
    public function getIdUser($google_id)
    {
        $query = "SELECT id FROM usuarios WHERE google_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $google_id); // 's' indica que es un string
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        // Si el usuario existe, devuelve el id. Si no, devuelve null
        if ($result) {
            return (int) $result['id'];
        } else {
            return null; // Si no se encuentra el usuario
        }
    }

    // Obtener un usuario por su google_id
    public function getByGoogleId($google_id)
    {
        $query = "SELECT * FROM usuarios WHERE google_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $google_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar información 
    public function update($google_id, $nombre)
    {
        $query = "UPDATE usuarios SET nombre = ? WHERE google_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $nombre, $google_id);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function delete($google_id)
    {
        $query = "DELETE FROM usuarios WHERE google_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $google_id);
        return $stmt->execute();
    }

    public function login($email, $pass)
    {
        // Consulta SQL para verificar si existe el usuario con el email
        $query = "SELECT 1 FROM usuarios WHERE email = ? AND pass_user = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        // Verificar si se encontró al menos una fila
        return $result->num_rows > 0;
    }
}
