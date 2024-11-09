<?php

function fetchBooks($query)
{
    $apiKey = "AIzaSyBlL0dWLqcDoU7ZQ6MqL0SoLLm_OqaWkMU";
    $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query) . "&key=" . $apiKey;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return null;
    }
    curl_close($ch);

    $data = json_decode($response, true);
    return $data;
}

function resumenTexto($texto)
{
    $maxChar = 200;
    // Verifica si el texto tiene más de 500 caracteres
    if (strlen($texto) > $maxChar) {
        // Devuelve solo los primeros 500 caracteres
        return substr($texto, 0, $maxChar);
    }
    // Si el texto es de 500 caracteres o menos, lo devuelve tal cual
    return $texto;
}


//&& isset($_POST['action'])&&$_POST['action']==='SearchBook'
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bookName'])) {
    $query = $_POST['bookName'];

    if (!empty($query)) {
        $books = fetchBooks($query);

        if ($books && isset($books['items'])) {
            // Guardar en la sesión los datos de los libros
            $_SESSION['books'] = [];
            foreach ($books['items'] as $book) {
                $_SESSION['books'][] = array(
                    'Id' => $book['id'],
                    'UserId' => 00,
                    'GoogleBooksId' => $book['id'],
                    'Titulo' => $book['volumeInfo']['title'],
                    'Autor' => implode(", ", $book['volumeInfo']['authors'] ?? []),
                    'ImagenPortada' => $book['volumeInfo']['imageLinks']['thumbnail'] ?? "",
                    'ReseñaPersonal' => resumenTexto($book['volumeInfo']['description'] ?? "No disponible"),
                    'FechaGuardado' => $book['volumeInfo']['publishedDate'] ?? "",
                );
            }
        } else {
            echo json_encode(['error' => 'No se encontraron resultados.']);
        }
    } else {
        echo json_encode(['error' => 'campo vacio']);
    }

// die();
}

// Si no se han buscado libros previamente
if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [];
}

// Si no se han buscado libros previamente
if (!isset($_SESSION['action'])) {
    $_SESSION['action'] = 'Libros';
}
$books_array = $_SESSION['books'];


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
