-- Crear la base de datos
CREATE DATABASE biblioteca;

-- Usar la base de datos creada
USE Biblioteca;

-- Crear la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    nombre VARCHAR(255) NOT NULL,
    google_id VARCHAR(255) NOT NULL UNIQUE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear la tabla de libros_guardados
CREATE TABLE IF NOT EXISTS libros_guardados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    google_books_id VARCHAR(255) NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255),
    imagen_portada VARCHAR(255),
    reseña_personal TEXT,
    fecha_guardado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE
);


mysql://root:ZOskAlesufLbKVbvYFmyZelfBHzROMsG@autorack.proxy.rlwy.net:56051/railway