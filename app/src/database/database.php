<?php
// Archivo: app/src/database/database.php
class Database {
    private $conn;
    
    public function __construct() {
        // Cargar el archivo de configuración
        
        require_once __DIR__ . '/../../../src/config.php';
        loadEnv(__DIR__ . '/../../../public/.env');

        // Conectar a la base de datos
        $this->connect();
    }

    private function connect() {
        try {
            $this->conn = new mysqli(
                getenv('DB_HOST'),
                getenv('DB_USER'),
                getenv('DB_PASS'),
                getenv('DB_NAME'),
                getenv('DB_PORT')
            );

            if ($this->conn->connect_error) {
                throw new Exception("Error de conexión: " . $this->conn->connect_error);
            }

            // Mensaje de éxito
            //echo "Conexión establecida exitosamente";
        } catch (Exception $e) {
            echo "Excepción capturada: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
