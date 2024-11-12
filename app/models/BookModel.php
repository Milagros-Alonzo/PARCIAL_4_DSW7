<?php

class BookModel
{
    private $db;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Guardar un libro en la base de datos
    public function saveBook($user_id, $google_books_id, $titulo, $autor, $imagen_portada, $reseña_personal, $descripcion, $fecha_publicacion)
    {
        $query = "INSERT INTO libros_guardados (user_id, google_books_id, titulo, autor, imagen_portada, reseña_personal,descripcion,fecha_publicacion) 
                  VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);

        $stmt->bind_param("isssssss", $user_id, $google_books_id, $titulo, $autor, $imagen_portada, $reseña_personal, $descripcion, $fecha_publicacion);

        return $stmt->execute();
    }

    // Obtener todos los libros guardados por un usuario
    public function getBooksByUserId($user_id)
    {
        $query = "SELECT * FROM libros_guardados l,usuarios u
                  WHERE l.user_id = u.id
                  and l.user_id = ?
                  ORDER BY fecha_guardado DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $user_id); // Usa bind_param con el tipo de dato (i para entero)
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    

    // Obtener un libro guardado por su google_books_id y user_id
    public function getBookByGoogleIdAndUser($google_books_id, $user_id)
    {
        $query = "SELECT * FROM libros_guardados WHERE google_books_id = :google_books_id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':google_books_id', $google_books_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar la reseña personal de un libro guardado
    public function updateReview($google_books_id, $user_id, $reseña_personal)
    {
        $query = "UPDATE libros_guardados SET reseña_personal = :reseña_personal WHERE google_books_id = :google_books_id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':reseña_personal', $reseña_personal);
        $stmt->bindParam(':google_books_id', $google_books_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // Eliminar un libro de la biblioteca personal
    public function deleteBook($google_books_id, $user_id)
    {
        $query = "DELETE FROM libros_guardados 
        WHERE google_books_id = ? 
        AND user_id = ?";
        $stmt = $this->db->prepare($query);

        // Vincula los parámetros con los valores adecuados
        $stmt->bind_param("si", $google_books_id, $user_id);
        return $stmt->execute();
    }
}
