<?php

function fetchBooks($query)
{
    // Tu clave API
    $apiKey = "AIzaSyBlL0dWLqcDoU7ZQ6MqL0SoLLm_OqaWkMU";

    // Formateamos la URL de la solicitud con la consulta y la clave API
    $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query) . "&key=" . $apiKey;

    // Inicializamos cURL
    $ch = curl_init();

    // Configuramos las opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutamos la solicitud
    $response = curl_exec($ch);

    // Verificamos si hubo un error
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return null;
    }

    // Cerramos cURL
    curl_close($ch);

    // Decodificamos el JSON
    $data = json_decode($response, true);

    // Retornamos los resultados
    return $data;
}

$books_array = array();
$books = fetchBooks('love');
// Ejemplo de uso

/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['bookName'])) {
        if (!empty($_POST['bookName'])) {
            $query = $_POST['bookName'];
            $books = fetchBooks($query);

            if ($books && isset($books['items'])) {
                $books_array = []; // Initialize array for storing books
                foreach ($books['items'] as $book) {
                    $books_array[] = array(
                        'Id' => $book['id'],
                        'UserId' => 00,
                        'GoogleBooksId' => $book['id'],
                        'Titulo' => $book['volumeInfo']['title'],
                        'Autor' => implode(", ", $book['volumeInfo']['authors'] ?? []),
                        'ImagenPortada' => $book['volumeInfo']['imageLinks']['thumbnail'] ?? "",
                        'ReseñaPersonal' => $book['volumeInfo']['description'] ?? "No disponible",
                        'FechaGuardado' => $book['volumeInfo']['publishedDate'] ?? "",
                    );
                }
                header('Content-Type: application/json');
                echo json_encode($books_array);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se encontraron resultados.']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'campo vacio']);
        }
    }
    exit;
}
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST['bookName'];
    echo $query;
    if (isset($_POST['bookName'])) {
        if (!empty($_POST['bookName'])) {
            $query = $_POST['bookName'];
            echo $query;
            $books = fetchBooks($query);
        }
    }
}

if ($books && isset($books['items'])) {
    $books_array = []; // Initialize array for storing books
    foreach ($books['items'] as $book) {
        $books_array[] = array(
            'Id' => $book['id'],
            'UserId' => 00,
            'GoogleBooksId' => $book['id'],
            'Titulo' => $book['volumeInfo']['title'],
            'Autor' => implode(", ", $book['volumeInfo']['authors'] ?? []),
            'ImagenPortada' => $book['volumeInfo']['imageLinks']['thumbnail'] ?? "",
            'ReseñaPersonal' => $book['volumeInfo']['description'] ?? "No disponible",
            'FechaGuardado' => $book['volumeInfo']['publishedDate'] ?? "",
        );
    }
}


// Configuración de la paginación
$itemsPorPagina = 3;
$totalItems = count($books_array);
$totalPaginas = ceil($totalItems / $itemsPorPagina);

// Obtener el número de página actual desde la URL
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$paginaActual = max(1, min($totalPaginas, $paginaActual));

// Obtener el subconjunto de datos para la página actual
$inicio = ($paginaActual - 1) * $itemsPorPagina;
$arrayDatosPorPagina = array_slice($books_array, $inicio, $itemsPorPagina);
