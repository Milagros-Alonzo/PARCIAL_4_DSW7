# PARCIAL_4_DSW7

## Estructura del Proyecto

```plaintext
mini_biblioteca/
├── config/
│   └── config.php               # Configuración global, credenciales de OAuth y conexión a la base de datos
├── database/
│   └── db.php                   # Conexión a la base de datos (MySQL/MariaDB)
├── models/
│   ├── Usuario.php              # Modelo para gestionar usuarios en la base de datos
│   └── Libro.php                # Modelo para gestionar los libros guardados
├── controllers/
│   ├── AuthController.php       # Controlador para manejar autenticación OAuth
│   └── LibroController.php      # Controlador para la búsqueda y gestión de libros favoritos
├── views/
│   ├── layout/
│   │   ├── header.php           # Cabecera con enlaces de navegación y estado de sesión
│   │   └── footer.php           # Pie de página
│   ├── auth/
│   │   └── login.php            # Página de login
│   └── libros/
│       ├── lista.php            # Página para ver libros guardados
│       ├── buscar.php           # Página de búsqueda de libros
│       └── detalle.php          # Página de detalles de un libro específico
├── assets/
│   ├── css/                     # Archivos de estilo
│   ├── js/                      # Archivos JavaScript
│   └── images/                  # Imágenes de portada y otros recursos gráficos
├── index.php                    # Página principal
└── login.php                    # Página de inicio de sesión y redirección a Google OAuth
