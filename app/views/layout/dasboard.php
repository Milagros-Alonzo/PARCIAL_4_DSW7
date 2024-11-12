<?php
require __DIR__ . '/../../src/libros/dasboard.php';
require __DIR__ . '/../components/libro_ver_mas.php';
require __DIR__ . '/../components/agregar_favoritos_libro.php';



define('BASE_URL', '/PARCIALES/PARCIAL_4_DSW7/');

?>
<div class=" body  " id="container-libros">
    <div class="header-dasoard bg-secondary-subtle">
        <span class="  container-header  d-flex gap-3">
            <p class="title">Biblioteca</p>
            <span class="d-flex gap-3">
                <p class="user-name"><?php echo $_SESSION['userSesionName'] ?></p>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>public/logout.php">Cerrar Sesion</a></li>
                    </ul>
                </div>
            </span>
        </span>
    </div>
    <div class="container-eventos container-fluid">

        <div class="eventos d-flex gap-3 p-2 ">
            <?php if (isset($_SESSION['action']) && $_SESSION['action'] === 'ListarFavoritos'): ?>

                <form id="formSalirFavoriteBook" method="post">
                    <input type="hidden" name="evento" value="salirFavoritos">
                    <button type="submit" class="btn btn-secondary" id="btnSalirFavoriteBook">
                        <i class="fa-solid fa-star"></i> Salir de Favoritos
                    </button>
                </form>

            <?php endif; ?>
            <?php if (isset($_SESSION['action']) && $_SESSION['action'] != 'ListarFavoritos'): ?>
                <form id="formListFavoriteBook" method="post">
                    <input type="hidden" name="evento" value="listarFavoritos">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa-solid fa-star"></i> Libros Favoritos
                    </button>
                </form>
            <?php endif; ?>
        </div>
        <div class="">
            <?php if (isset($_SESSION['action']) && $_SESSION['action'] != 'ListarFavoritos'): ?>
            <form class="d-flex " method="post" action="" id="formSearchBook">
                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-primary input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="hidden" name="evento" value="searchBook">
                    <input type="text" class="form-control" name="bookName" data-book-event="SearchBook" id="searchBook" placeholder="Enter a Boook Name">
                </div>
            </form>
            <?php endif; ?>

        </div>
    </div>
    <!-- table  -->
    <div class="overflow-x-auto  container-fluid justify-content-center">
        <table class="table table-light table-hover">
            <thead>
                <tr>

                    <th scope="col">Eventos</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Imagen Portada</th>
                    <th scope="col">Descripcion</th>
                    <?php if (isset($_SESSION['action']) && $_SESSION['action'] === 'ListarFavoritos'): ?>
                        <th scope="col">Reseña Personal</th>
                    <?php endif; ?>
                    <th scope="col">Fecha Publicacíon</th>
                    <?php if (isset($_SESSION['action']) && $_SESSION['action'] === 'ListarFavoritos'): ?>
                        <th scope="col">Fecha Guardados</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrayDatosPorPagina as $arrayBook): ?>
                    <tr data-libro-id="<?php echo $arrayBook['Id']; ?>">

                        <td class="container-acciones">
                            <?php if (isset($_SESSION['action']) && $_SESSION['action'] === 'ListarFavoritos'): ?>

                                <button
                                    class="btn btn-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-title="Delete"
                                    id="btnDeleteBook" onclick="handleClickBtnDeleteFavorite(this)"
                                    data-libro-id="<?php echo $arrayBook['Id'];
                                                    ?>"
                                    data-bs-toggle="tooltip">
                                    <i class="fa fa-trash"></i>
                                </button>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['action']) && $_SESSION['action'] != 'ListarFavoritos'): ?>

                                <span data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Agregar a Favoritos">
                                    <buttom class=" btn btn-primary "
                                        data-libro-id="<?php echo $arrayBook['Id'];
                                                        ?>"
                                        data-bs-target="#agregarLibroFavorito"
                                        id="btnFavoriteBook"
                                        data-bs-toggle="modal">
                                        <i class="fa-solid fa-star"></i>
                                    </buttom>
                                </span>


                            <?php endif; ?>
                        </td>
                        <td><?php echo $arrayBook['Titulo'] ?></td>
                        <td><?php echo $arrayBook['Autor'] ?></td>
                        <td>
                            <span>
                                <img class='img-fluid' src="<?php echo $arrayBook['ImagenPortada'] ?>" alt="<?php echo $arrayBook['Titulo'] ?>">
                            </span>
                        </td>
                        <td>
                        <span class="truncated-text"><?php echo $arrayBook['Descripcion']; ?></span>

                            <buttom class=" btn btn-vermas "
                                data-descripcion="<?php echo htmlspecialchars($arrayBook['Descripcion'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-libro-id="<?php echo $arrayBook['Id'];
                                                ?>"
                                data-bs-target="#verMasDesLibro"
                                id="btnVerMasDescripcionBook"
                                data-bs-toggle="modal">ver mas
                            </buttom>
                        </td>
                        <?php if (isset($_SESSION['action']) && $_SESSION['action'] === 'ListarFavoritos'): ?>
                            <td><?php echo $arrayBook['ResenaPersonal'] ?></td>
                        <?php endif; ?>
                        <td><?php echo $arrayBook['FechaPublicacion'] ?></td>
                        <?php if (isset($_SESSION['action']) && $_SESSION['action'] === 'ListarFavoritos'): ?>

                            <td><?php echo $arrayBook['FechaGuardado'] ?></td>
                        <?php endif; ?>


                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <!-- Paginación -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($paginaActual > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?pagina=<?php echo $paginaActual - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>

                <li class="page-item">
                    <a class="page-link <?php echo (isset($_GET['pagina']) && $_GET['pagina'] == $i) ? "active" : ""  ?>" href="index.php?&pagina=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($paginaActual < $totalPaginas): ?>
                <li class="page-item">
                    <a class="page-link " href="index.php?pagina=<?php echo $paginaActual + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>



<script>
    const btnFavoriteListBook = document.getElementById('btnListFavoriteBook');
    const btnFavoriteBook = document.querySelectorAll('#btnFavoriteBook');


    btnFavoriteBook.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const bookId = row.getAttribute('data-libro-id'); // Obtiene el data-libro-id
            const titulo = row.cells[1].textContent;
            const autor = row.cells[2].textContent;
            const image = row.querySelector('img').src; // Ajustado para obtener la fuente de la imagen
            const descripcion = row.cells[4].textContent;
            const fecha = row.cells[5].textContent;

            // Rellenar el modal con la información del libro
            document.getElementById('f_bookId').value = bookId; // Suponiendo que tienes un campo oculto con id "bookId"
            document.getElementById('f_autor').value = autor;
            document.getElementById('f_titulo').value = titulo;
            document.getElementById('f_image').value = image;
            document.getElementById('f_descripcion').value = descripcion;
            document.getElementById('f_fecha').value = fecha;

            document.getElementById('modalTitle').textContent = titulo; // Establecer el título en el modal

        });
    });

    document.querySelectorAll('#btnVerMasDescripcionBook').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const titulo = row.cells[1].textContent;
            //  const descripcion = row.cells[4].textContent;
            const descripcion = this.getAttribute('data-descripcion');
            document.getElementById('titleBookDes').textContent = titulo;
            document.getElementById('descriptionBookDes').textContent = descripcion;

        });
    });

    // Cuando se hace submit en el formulario del modal
    document.getElementById('formAgregarbookFavorito').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío por defecto del formulario

        // Crear un objeto FormData a partir del formulario
        const formData = new FormData(document.getElementById('formAgregarbookFavorito'));

        formData.append('evento', 'agregarFavoritos'); // Evento
        // Enviar los datos con fetch
        fetch('http://localhost/PARCIALES/PARCIAL_4_DSW7/app/src/libros/dasboard.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {

                $('#agregarLibroFavorito').modal('hide');
            })
            .catch(error => console.error('Error:', error));
    });


    function handleClickBtnDeleteFavorite(button) {
        const idBook = button.getAttribute('data-libro-id');

        if (!idBook) {
            console.error('Error: Book ID is not defined.');
            return;
        }

        const formData = new FormData();
        formData.append('bookId', idBook);
        formData.append('evento', 'eliminarBookFavoritos');
        fetch('http://localhost/PARCIALES/PARCIAL_4_DSW7/app/src/libros/dasboard.php', {
                method: 'POST',
                body: formData
            })

            .then(response => response.text()) 
            .then(data => {
                //alert(data);
                window.location.reload();

            })
            .catch(error => console.error('Error:', error));
    }

    document.getElementById('formListFavoriteBook').addEventListener('submit', (e) => {
        //e.preventDefault(); // Previene el envío predeterminado del formulario

        const formData = new FormData(document.getElementById('formListFavoriteBook'));
        fetch('http://localhost/PARCIALES/PARCIAL_4_DSW7/app/src/libros/dasboard.php', {
                method: 'POST',
                body: formData
            })
            /*
            .then(response => response.text()) // Cambia a .text() para recibir el mensaje como texto
            .then(data => {
                alert(data);
            })
                */
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('formSalirFavoriteBook').addEventListener('submit', (e) => {
        //e.preventDefault(); // Previene el envío predeterminado del formulario

        const formData = new FormData(document.getElementById('formSalirFavoriteBook'));
        fetch('http://localhost/PARCIALES/PARCIAL_4_DSW7/app/src/libros/dasboard.php', {
                method: 'POST',
                body: formData
            })
            /*
            .then(response => response.text()) // Cambia a .text() para recibir el mensaje como texto
            .then(data => {
                alert(data);
            })
                */
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('formSearchBook').addEventListener('submit', (e) => {
        //e.preventDefault(); // Previene el envío predeterminado del formulario

        const formData = new FormData(document.getElementById('formSearchBook'));
        fetch('http://localhost/PARCIALES/PARCIAL_4_DSW7/app/src/libros/dasboard.php', {
                method: 'POST',
                body: formData
            })
            /*

            .then(response => response.text()) // Cambia a .text() para recibir el mensaje como texto
            .then(data => {
                alert(data);
            })
            */
            .catch(error => console.error('Error:', error));
    });
</script>