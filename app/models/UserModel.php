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
    public function register($email, $nombre, $google_id = null, $password_hash = null) {
        $query = "INSERT INTO usuarios (email, nombre, google_id, pass_user) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $email, $nombre, $google_id, $password_hash); // 'ssss' indica que son cuatro strings
        return $stmt->execute();
    }

    // Obtener un usuario por su email
    public function getByEmail($email) {
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email); // 's' indica que es un string
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
            return (int) $result['id']; // Asegurarte de que el id es un entero
        } else {
            return null; // Si no se encuentra el usuario
        }
    }
    
    // Obtener un usuario por su google_id
    public function getByGoogleId($google_id)
    {
        $query = "SELECT * FROM usuarios WHERE google_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $google_id); // 's' indica que es un string
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar información del usuario (por ejemplo, nombre)
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
    }}

    /*public function login($email,$pass)
    {
        // Consulta SQL para verificar si existe el usuario con el email y password_hash especificados
        $query = "SELECT EXISTS (SELECT 1  FROM usuarios  WHERE email = ? 
                  AND pass_user = ? )";
        // Preparar y ejecutar la consulta
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

}*/
/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    // var_dump($user["password"]);
    // die();
    if ($user && password_verify($password, $user["password"])) {
        if ($user["is_verified"]) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["is_admin"] = $user["is_admin"];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Tu cuenta aún no ha sido verificada. Revisa tu correo.";
        }
    } else {
        echo "Usuario o contraseña incorrectos
}*/


?>
