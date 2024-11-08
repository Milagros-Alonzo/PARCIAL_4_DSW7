<?php
 
function fetchBooks($query) {
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
    if(curl_errno($ch)) {
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

// Ejemplo de uso
$query = "a";
$books = fetchBooks($query);

if ($books && isset($books['items'])) {
    foreach ($books['items'] as $book) {
        //print_r($book);
        echo "image" . $book['volumeInfo']['imageLinks']['thumbnail'] . "\n";
        echo '<img src="' . $book['volumeInfo']['imageLinks']['thumbnail'] . '" alt="Descripción de la imagen" width="ancho" height="altura">';
        echo "Título: " . $book['volumeInfo']['title'] . "<br>";
        echo "Autor(es): " . implode(", ", $book['volumeInfo']['authors'] ?? []) . "<br>";
        echo "Descripción: " . ($book['volumeInfo']['description'] ?? "No disponible") . "<br><br>";
    }
} else {
    echo "No se encontraron resultados.";
}


?>