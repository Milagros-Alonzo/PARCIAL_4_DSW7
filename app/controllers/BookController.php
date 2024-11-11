<?php
// Archivo: app/controllers/BookController.php

// Incluir el modelo de libro
require_once __DIR__  .'/../models/BookModel.php';
// Incluir la función de conexión a la base de datos
require_once __DIR__ . '/../src/database/database.php';

class BookController {

    private $bookModel;
    private $db;

    // Constructor: inicializa el modelo de libros con la conexión a la base de datos
    public function __construct() {
        // Obtener la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        $this->bookModel = new BookModel($this->db); // Pasar la conexión a BookModel
    }

    // Guardar un libro en la base de datos
    public function saveBook($user_id, $google_books_id, $titulo, $autor, $imagen_portada, $reseña_personal,$descripcion,$fecha_publicacion) {
        if ($this->bookModel->saveBook($user_id, $google_books_id, $titulo, $autor, $imagen_portada, $reseña_personal,$descripcion,$fecha_publicacion)) {
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