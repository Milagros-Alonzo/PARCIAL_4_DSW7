<?php
// Cargar el archivo .env y definir las variables de entorno
function loadEnv($path)
{
    if (!file_exists($path)) {
        echo "Error: El archivo .env no existe en la ruta: $path";
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Llamar a la función para cargar las variables del archivo .env
//loadEnv(__DIR__ . '/../public/.env');

// Definir la URL base para la aplicación
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));

// Definir la conexión a la base de datos
getenv('DB_HOST');
getenv('DB_NAME');
getenv('DB_USER');
getenv('DB_PASS');
getenv('DB_PORT');


define('API_URL_BOOK', getenv('API_URL_BOOK'));
define('API_KEY_BOOK', getenv('API_KEY_BOOK'));
/*
$db = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

// Verificar la conexión
if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}

*/
