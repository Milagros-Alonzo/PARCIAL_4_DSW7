# PARCIAL_4_DSW7

## Estructura del Proyecto

```plaintext
mini_biblioteca/
├── public/                     # Carpeta pública (para archivos accesibles desde la web)
│   ├── index.php               # Punto de entrada principal
│   ├── login.php               # Página de inicio de sesión (redirección a Google OAuth)
│   └── logout.php              # Archivo para cerrar sesión
│
├── app/                        # Código principal de la aplicación
│   ├── controllers/            # Controladores manejan la lógica de negocio
│   │   ├── AuthController.php  # Lógica de autenticación
│   │   ├── BookController.php  # Lógica para las acciones CRUD de libros
│   │   └── UserController.php  # Lógica para operaciones de usuarios
│   │
│   ├── models/                 # Modelos interactúan con la base de datos
│   │   ├── UserModel.php       # Modelo de usuario (CRUD para usuarios)
│   │   └── BookModel.php       # Modelo de libro (CRUD para libros guardados)
│   │
│   ├── views/                  # Vistas de la aplicación
│   │   ├── layout/             # Layouts o plantillas comunes
│   │   │   └── header.php      # Encabezado común (barra de navegación, etc.)
│   │   │   └── footer.php      # Pie de página común
│   │   ├── auth/               # Vistas de autenticación
│   │   │   └── login.php       # Vista de inicio de sesión
│   │   ├── books/              # Vistas relacionadas con libros
│   │   │   ├── list.php        # Listado de libros guardados
│   │   │   ├── add.php         # Formulario para agregar un libro
│   │   │   └── edit.php        # Formulario para editar la reseña de un libro
│   │   └── users/              # Vistas relacionadas con usuarios
│   │       └── profile.php     # Perfil del usuario
│
├── config/                     # Configuración de la aplicación
│   ├── database.php            # Conexión a la base de datos
│   └── google_oauth.php        # Configuración de credenciales de Google OAuth
│
├── vendor/                     # Dependencias de Composer (si usas alguna)
│
└── assets/                     # Archivos estáticos (CSS, JS, imágenes)
    ├── css/                    # Estilos CSS
    ├── js/                     # Scripts JS
    └── images/                 # Imágenes y recursos gráficos
