<?php
// Archivo: app/controllers/BookController.php

// Incluir el modelo de libro
require_once 'app/models/BookModel.php';
// Incluir la función de conexión a la base de datos
<<<<<<< HEAD
require_once '../config/database.php';
=======
require_once __DIR__ . '/../src/database/database.php';
>>>>>>> 2f23a7bc328f41b0f56059eac88060d12c7bf710

class BookController {

    private $bookModel;
<<<<<<< HEAD
=======
    private $db;
>>>>>>> 2f23a7bc328f41b0f56059eac88060d12c7bf710

    // Constructor: inicializa el modelo de libros con la conexión a la base de datos
    public function __construct() {
        // Obtener la conexión a la base de datos
<<<<<<< HEAD
        $db = getDBConnection();
        $this->bookModel = new BookModel($db); // Pasar la conexión a BookModel
=======
        $database = new Database();
        $this->db = $database->getConnection();
        $this->bookModel = new BookModel($this->db); // Pasar la conexión a BookModel
>>>>>>> 2f23a7bc328f41b0f56059eac88060d12c7bf710
    }

    // Guardar un libro en la base de datos
    public function saveBook($user_id, $google_books_id, $titulo, $autor, $imagen_portada, $reseña_personal) {
        if ($this->bookModel->saveBook($user_id, $google_books_id, $titulo, $autor, $imagen_portada, $reseña_personal)) {
            return "Libro guardado exitosamente.";
        } else {
            return "Hubo un error al guardar el libro.";
        }
    }

    // Obtener todos los libros guardados por un usuario
    public function getBooksByUser($user_id) {
        return $this->bookModel->getBooksByUserId($user_id);
    }

    // Obtener un libro guardado específico
    public function getBook($google_books_id, $user_id) {
        return $this->bookModel->getBookByGoogleIdAndUser($google_books_id, $user_id);
    }

    // Actualizar la reseña de un libro guardado
    public function updateReview($google_books_id, $user_id, $reseña_personal) {
        if ($this->bookModel->updateReview($google_books_id, $user_id, $reseña_personal)) {
            return "Reseña actualizada exitosamente.";
        } else {
            return "Hubo un error al actualizar la reseña.";
        }
    }

    // Eliminar un libro guardado
    public function deleteBook($google_books_id, $user_id) {
        if ($this->bookModel->deleteBook($google_books_id, $user_id)) {
            return "Libro eliminado exitosamente.";
        } else {
            return "Hubo un error al eliminar el libro.";
        }
    }
}
?>
