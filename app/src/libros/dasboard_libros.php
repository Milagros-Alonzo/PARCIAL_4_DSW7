<?php
$books_array = [
    [
        'Id' => 1,
        'UserId' => 101,
        'GoogleBooksId' => 'Bk1',
        'Titulo' => 'The Great Gatsby',
        'Autor' => 'F. Scott Fitzgerald',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
        'ReseñaPersonal' => 'A fascinating look into the American dream.',
        'FechaGuardado' => '2024-01-01',
    ],
    [
        'Id' => 2,
        'UserId' => 102,
        'GoogleBooksId' => 'Bk2',
        'Titulo' => 'To Kill a Mockingbird',
        'Autor' => 'Harper Lee',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/8228691-L.jpg',
        'ReseñaPersonal' => 'A profound story of justice and innocence.',
        'FechaGuardado' => '2024-02-01',
    ],
    [
        'Id' => 3,
        'UserId' => 103,
        'GoogleBooksId' => 'Bk3',
        'Titulo' => '1984',
        'Autor' => 'George Orwell',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
        'ReseñaPersonal' => 'A chilling dystopian novel that remains relevant.',
        'FechaGuardado' => '2024-03-01',
    ],
    [
        'Id' => 4,
        'UserId' => 104,
        'GoogleBooksId' => 'Bk4',
        'Titulo' => 'Pride and Prejudice',
        'Autor' => 'Jane Austen',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/8081536-L.jpg',
        'ReseñaPersonal' => 'A delightful and insightful story of love and society.',
        'FechaGuardado' => '2024-04-01',
    ],
    [
        'Id' => 5,
        'UserId' => 105,
        'GoogleBooksId' => 'Bk5',
        'Titulo' => 'The Catcher in the Rye',
        'Autor' => 'J.D. Salinger',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/8231851-L.jpg',
        'ReseñaPersonal' => 'A raw and honest story of adolescent struggles.',
        'FechaGuardado' => '2024-05-01',
    ],
    [
        'Id' => 6,
        'UserId' => 106,
        'GoogleBooksId' => 'Bk6',
        'Titulo' => 'Moby Dick',
        'Autor' => 'Herman Melville',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
        'ReseñaPersonal' => 'An epic tale of adventure and obsession.',
        'FechaGuardado' => '2024-06-01',
    ],
    [
        'Id' => 7,
        'UserId' => 107,
        'GoogleBooksId' => 'Bk7',
        'Titulo' => 'War and Peace',
        'Autor' => 'Leo Tolstoy',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/7233862-L.jpg',
        'ReseñaPersonal' => 'A monumental work of history and human experience.',
        'FechaGuardado' => '2024-07-01',
    ],
    [
        'Id' => 8,
        'UserId' => 108,
        'GoogleBooksId' => 'Bk8',
        'Titulo' => 'The Hobbit',
        'Autor' => 'J.R.R. Tolkien',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/7984916-L.jpg',
        'ReseñaPersonal' => 'A delightful fantasy adventure.',
        'FechaGuardado' => '2024-08-01',
    ],
    [
        'Id' => 9,
        'UserId' => 109,
        'GoogleBooksId' => 'Bk9',
        'Titulo' => 'The Odyssey',
        'Autor' => 'Homer',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/8235233-L.jpg',
        'ReseñaPersonal' => 'A timeless journey of heroism and resilience.',
        'FechaGuardado' => '2024-09-01',
    ],
    [
        'Id' => 10,
        'UserId' => 110,
        'GoogleBooksId' => 'Bk10',
        'Titulo' => 'Brave New World',
        'Autor' => 'Aldous Huxley',
        'ImagenPortada' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
        'ReseñaPersonal' => 'A thought-provoking look at a utopian future.',
        'FechaGuardado' => '2024-10-01',
    ]
];

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

?>