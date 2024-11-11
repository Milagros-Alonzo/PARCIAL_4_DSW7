<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'libros.php';

$user_id = $_SESSION['userId'];
$_GET['lastBookSearch'] = "";


// El resto del código...

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    var_dump($_POST);
    if (isset($_POST['evento']) && $_POST['evento'] == 'searchBook') {
        if (isset($_POST['bookName'])) {
            $query = $_POST['bookName'];
            $_GET['lastBookSearch'] = $_POST['bookName'];
            searchBook($query);
        }
    }

    if (isset($_POST['evento']) && $_POST['evento'] == 'listarFavoritos') {
        $_SESSION['action'] = 'ListarFavoritos';
      //  $user_id = $_SESSION['userId'];
        listarFavoritos($user_id);
    }

    if (isset($_POST['evento']) && $_POST['evento'] == 'agregarFavoritos') {
        $_SESSION['action'] = 'AgregarFavoritos';
       // $user_id = $_SESSION['userId'];
        //agregarFavoritos('');
    }

    if (isset($_POST['evento']) && $_POST['evento'] == 'salirFavoritos') {
        $_SESSION['action'] = 'ListarLibros';
        if (isset($_POST['bookName'])) {
            $query =  $_GET['lastBookSearch'];
            searchBook($query);
        }
    }
    if (isset($_POST['evento']) && $_POST['evento'] == 'eliminarBookFavoritos') {
        $_SESSION['action'] = 'ListarLibros';
        $google_books_id = $_POST['libroId'];
       // $user_id = $_SESSION['userId'];
        eliminarBoookFavoritos($google_books_id, $user_id);
    }

    // die();
}
// Si no se han buscado libros previamente
if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [];
}

// Si no se han buscado libros previamente
if (!isset($_SESSION['action'])) {
    $_SESSION['action'] = 'ListarLibros';
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
