<?php
require  __DIR__ . '/../../controllers/BookController.php';
require  __DIR__ . '/../../controllers/UserController.php';

// require_once  __DIR__ . '/../../../config/config.php';
// loadEnv(__DIR__ . '/../../../public/.env');

define('API_URL_BOOK', 'https://www.googleapis.com/books/v1/volumes?q=');
define('API_KEY_BOOK', 'AIzaSyBlL0dWLqcDoU7ZQ6MqL0SoLLm_OqaWkMU');

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

    $url =  API_URL_BOOK . urlencode($query) . "&key=" . API_KEY_BOOK;

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

function returnUserActiveId($user_id)
{
    $userController = new UserController();
    if ($_SESSION['loginGoogle']) {
        return $userController->getId($user_id);
    } else {
        return  $user_id;
    }
}

function listarFavoritos($user_id)
{
    $bookController = new BookController();


    //print_r($books_array);
    $userIdActive = returnUserActiveId($user_id);

    $books_array = $bookController->getBooksByUser($userIdActive);

    $_SESSION['books'] = [];
    foreach ($books_array as $book) {
        $_SESSION['books'][] = array(
            'Id' => $book['google_books_id'],
            'UserId' => $book['user_id'],
            'GoogleBooksId' => $book['google_books_id'],
            'Titulo' => $book['titulo'],
            'Autor' => $book['autor'],
            'ImagenPortada' => $book['imagen_portada'],
            'ResenaPersonal' => $book['reseña_personal'],
            'Descripcion' => $book['descripcion'],
            'FechaGuardado' => $book['fecha_guardado'],
            'FechaPublicacion' => $book['fecha_publicacion'],
        );
    }

}

function eliminarBoookFavoritos($google_books_id, $user_id)
{
    $bookController = new BookController();

    $userIdActive = returnUserActiveId($user_id);

    $bookController->deleteBook($google_books_id, $userIdActive);
}
function agregarFavoritos($array)
{
    $bookController = new BookController();
    $userIdActive = returnUserActiveId($array['user_id']);

    $bookController->saveBook(
        $userIdActive,
        $array['google_books_id'],
        $array['titulo'],
        $array['autor'],
        $array['imagen_portada'],
        $array['resena_personal'],
        $array['descripion'],
        $array['fechaPublicacion']
    );
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
                    //'Descripcion' => resumenTexto($book['volumeInfo']['description'] ?? "No disponible"),
                    'Descripcion' => $book['volumeInfo']['description'] ?? "No disponible",
                    'FechaPublicacion' => $book['volumeInfo']['publishedDate'] ?? "",
                );
            }
        } else {
            //echo json_encode(['error' => 'No se encontraron resultados.']);
        }
    } else {
        //  echo json_encode(['error' => 'campo vacio']);
    }
}
