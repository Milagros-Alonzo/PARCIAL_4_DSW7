<?php
require  __DIR__ . '/../../controllers/BookController.php';

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


/*
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    google_books_id VARCHAR(255) NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255),
    imagen_portada VARCHAR(255),
    reseña_personal TEXT,
    fecha_guardado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

*/
function listarFavoritos($user_id)
{
    $bookController = new BookController();
    $books_array = $bookController->getBooksByUser($user_id);
    //print_r($books_array);
    $_SESSION['books'] = [];
    foreach ($books_array as $book) {
        $_SESSION['books'][] = array(
            'Id' => $book['id'],
            'UserId' => $book['user_id'],
            'GoogleBooksId' => $book['google_books_id'],
            'Titulo' => $book['titulo'],
            'Autor' => $book['autor'],
            'ImagenPortada' => $book['imagen_portada'],
            'ResenaPersonal' => $book['reseña_personal'],
            'Descripcion' => $book['descripcion'],
            'FechaGuardado' => $book['fecha_guardado'],
        );
    }
}

function eliminarBoookFavoritos($google_books_id, $user_id)
{
    $bookController = new BookController();
    $bookController->deleteBook($google_books_id, $user_id);
}
function agregarFavoritos($array)
{
    $bookController = new BookController();
    $bookController->saveBook($array['user_id'], $array['google_books_id'], $array['titulo'], $array['autor'], $array['imagen_portada'], $array['reseña_personal'],$array['descripion']);
}
function searchBook($query)
{
    if (!empty($query)) {
        $books = fetchBooks($query);

        if ($books && isset($books['items'])) {
            // Guardar en la sesión los datos de los libros
            $_SESSION['books'] = [];
            foreach ($books['items'] as $book) {
                $_SESSION['books'][] = array(
                    'Id' => $book['id'],
                    'UserId' => $_SESSION['userId'],
                    'GoogleBooksId' => $book['id'],
                    'Titulo' => $book['volumeInfo']['title'],
                    'Autor' => implode(", ", $book['volumeInfo']['authors'] ?? []),
                    'ImagenPortada' => $book['volumeInfo']['imageLinks']['thumbnail'] ?? "",
                    'Descripcion' => resumenTexto($book['volumeInfo']['description'] ?? "No disponible"),
                    'FechaGuardado' => $book['volumeInfo']['publishedDate'] ?? "",
                );
            }
        } else {
            echo json_encode(['error' => 'No se encontraron resultados.']);
        }
    } else {
        echo json_encode(['error' => 'campo vacio']);
    }
}
