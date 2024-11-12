# PARCIAL_4_DSW7

# Biblioteca Digital

Este proyecto es una aplicación web para gestionar una biblioteca digital donde los usuarios pueden buscar libros, agregar sus favoritos, ver detalles de cada libro y gestionar sus preferencias de usuario. La aplicación utiliza Google Books API para obtener información sobre libros y permite iniciar sesión mediante Google Auth.

## Características
- **Autenticación con Google**: Permite a los usuarios iniciar sesión con su cuenta de Google mediante Google OAuth 2.0.
- **Búsqueda de Libros**: Los usuarios pueden buscar libros usando la API de Google Books.
- **Gestor de Favoritos**: Los usuarios pueden agregar, listar y eliminar libros de su lista de favoritos.
- **Perfil de Usuario**: Los usuarios pueden gestionar la información de su perfil.

## Estructura del Proyecto

### Archivos y Directorios

#### Raíz del Proyecto
- **`.gitignore`**: Define los archivos y directorios que deben ser ignorados por Git.
- **`README.md`**: Documentación del proyecto.
- **`index.php`**: Punto de entrada principal de la aplicación.

#### Carpeta `app/`
- **`controllers/`**
  - **`AuthController.php`**: Gestiona la autenticación de usuarios, incluyendo login, registro y logout.
  - **`BookController.php`**: Gestiona las operaciones sobre libros (agregar, eliminar, obtener).
  - **`UserController.php`**: Gestiona las operaciones sobre usuarios, como obtención y actualización de información.
- **`models/`**
  - **`BookModel.php`**: Modelo que maneja la lógica relacionada con los datos de los libros en la base de datos.
  - **`UserModel.php`**: Modelo que maneja la lógica relacionada con los datos de los usuarios.
- **`oauth/`**
  - **`GoogleOAuth.php`**: Implementa la autenticación de usuarios mediante Google OAuth 2.0.
  - **`callback.php`**: Maneja la respuesta de Google después de la autenticación.
  - **`sesion_GoogleOauth.php`**: Gestiona la sesión del usuario autenticado con Google.
- **`src/`**
  - **`database/`**
    - **`bd.sql`**: Script para la creación de la base de datos.
    - **`database.php`**: Archivo que establece la conexión con la base de datos.
  - **`libros/`**
    - **`dasboard.php`**: Vista para el panel de libros.
    - **`libros.php`**: Archivo que gestiona la visualización de los libros y sus detalles.
  - **`usuario/`**
    - **`perfil.php`**: Gestiona la información del perfil del usuario.
- **`views/`**
  - **`auth/`**
    - **`register.php`**: Formulario para el registro de usuarios.
  - **`components/`**
    - **`agregar_favoritos_libro.php`**: Componente para agregar un libro a favoritos.
    - **`libro_ver_mas.php`**: Componente para ver más detalles de un libro.
  - **`layout/`**
    - **`dasboard.php`**: Vista del panel principal del usuario.
    - **`footer.php`**: Pie de página de la aplicación.
    - **`header.php`**: Encabezado de la aplicación.

#### Carpeta `assets/`
- **`css/`**: Archivos de estilo para la aplicación.
  - **`Style.css`**, **`dasboard.css`**, **`index.css`**, **`login.css`**, **`register.css`**, **`vars.css`**: Estilos específicos para distintas secciones.
- **`img/`**
  - **`background.jpg`**: Imagen de fondo de la aplicación.
- **`js/`**
  - **`script.js`**: Funcionalidades JavaScript para la aplicación.

#### Carpeta `config/`
- **`config.php`**: Configuración general de la aplicación.
- **`google_oauth.php`**: Configuración de Google OAuth (clave y secreto de cliente).

#### Carpeta `public/`
- **`env.php`**: Variables de entorno de la aplicación.
- **`login.php`**, **`logout.php`**, **`register.php`**: Formularios de autenticación de usuarios.

#### Carpeta `session/`
- **`session.php`**: Manejo de la sesión del usuario.

## Configuración de las APIs

### 1. Google Auth
Para permitir que los usuarios se autentiquen con sus cuentas de Google:
1. **Crear un proyecto en la consola de Google Cloud**.
2. **Activar la API de Google OAuth**.
3. **Configurar credenciales** para obtener el ID de cliente y secreto de cliente.
4. Añadir las **URLs de redirección** que se utilizan para recibir la respuesta de Google.
5. Definir estas credenciales en `config/google_oauth.php`.

### 2. Google Books API
Para buscar libros en la base de datos de Google Books:
1. **Activar la API de Google Books** en la consola de Google Cloud.
2. Obtener una **clave de API** y definirla en el archivo `libros.php`.
3. La API se utiliza en la función `fetchBooks($query)` para buscar libros relacionados con una consulta.

## Instalación y Uso
1. **Clonar el repositorio**:
   ```bash
   git clone <URL-del-repositorio>
   ```
2. **Instalar dependencias** y configurar la base de datos usando el script `bd.sql`.
3. **Configurar las credenciales** de Google OAuth en `config/google_oauth.php` y la conexión a la base de datos en `config/config.php`.
4. **Ejecutar el proyecto** en un servidor local (por ejemplo, usando XAMPP o similar).

## Tecnologías Utilizadas
- **PHP**: Lenguaje principal del backend.
- **MySQL**: Base de datos para almacenar usuarios y libros favoritos.
- **HTML/CSS/JavaScript**: Para la interfaz de usuario.
- **Google Books API**: Para buscar información sobre libros.
- **Google OAuth 2.0**: Para autenticación de usuarios.

## Contribuciones
Las contribuciones son bienvenidas. Si deseas mejorar este proyecto, por favor crea un **pull request** o abre un **issue** para discutir los cambios que te gustaría realizar.

## Licencia
Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.
