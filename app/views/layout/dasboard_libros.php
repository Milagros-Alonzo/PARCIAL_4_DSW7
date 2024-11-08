<?php
require __DIR__ . '/../../src/libros/dasboard_libros.php';
require __DIR__ . '/../components/addLibro.php';
require __DIR__ . '/../components/editLibro.php';
require __DIR__ . '/../components/editLibro.php';

?>
<div class=" body container-fluid justify-content-center " id="container-libros">
    <div class="header-admin">

        <h2> Dasboard de Libros Biblioteca</h2>
    </div>
    <div class="container-eventos d-flex">

        <div class="eventos d-flex p-2 gap-3">
            <span>
                <input type="checkbox" class="btn-check" id="btn-check_all" autocomplete="off">
                <label class="btn btn-primary" for="btn-check_all">Seleccionar Todo</label>
            </span>

            <button class="btn btn-danger" id="btn_delete_all_user" disabled> <i class="fa-solid fa-trash"></i> Eliminar Todo</button>
            <button class="btn btn-secondary" data-bs-target="#add_admin_modal" data-bs-toggle="modal">
                <i class="fa-solid fa-plus"></i> Añadir Libro
            </button>
        </div>
    </div>
    <!-- table  -->
    <div class="overflow-x-auto">
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">eventos</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Google Books Id</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Imagen Portada</th>
                    <th scope="col">Reseña Personal</th>
                    <th scope="col">Fecha Guardado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrayDatosPorPagina as $arrayBook): ?>
                    <tr>
                        <th scope='row'>
                            <input class="form-check-input"
                                type="checkbox" 
                                value="<?php echo $$arrayBook['Id']?>"
                                id="checbox<?php echo $$arrayBook['Id'] ?>                                                                                                                                ?>">
                        </th>
                        <td class="container-acciones">
                            <!-- Edit button that opens the modal and passes the user ID -->
                            <span data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Edit">
                                <buttom class=" btn btn-primary "
                                    data-libro-id="<?php echo $$arrayBook['Id'];
                                                    ?>"
                                    data-bs-target="#edit_admin_modal"
                                    id="btn_edit_user"
                                    data-bs-toggle="modal">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </buttom>
                            </span>

                            <button
                                class="btn btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-title="Delete"
                                id="btnDeleteUser"
                                data-libro-id="<?php echo $$arrayBook['Id']; 
                                                ?>"
                                class="btn btn-danger" data-bs-toggle="tooltip">
                                <i class="fa fa-trash"></i>
                            </button>

                        </td>

                        <td><?php echo $arrayBook['UserId']?></td>
                        <td><?php echo $arrayBook['GoogleBooksId']?></td>
                        <td><?php echo $arrayBook['Titulo']?></td>
                        <td><?php echo $arrayBook['Autor']?></td>
                        <td>
                            <span>
                                <img class='img-fluid' src="<?php echo $arrayBook['ImagenPortada']?>" alt="<?php echo $arrayBook['Titulo']?>">
                            </span>
                        </td>
                        <td><?php echo $arrayBook['ReseñaPersonal']?></td>
                        <td><?php echo $arrayBook['FechaGuardado']?></td>


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
    const btnCheckAll = document.getElementById('btn-check_all');
    const btnDeleteAllUser = document.getElementById('btn_delete_all_user');
    const btnDeleteUser = document.getElementById('btnDeleteUser');
    btnCheckAll.onclick = function() {
        var checkboxes = document.querySelectorAll('.form-check-input');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
        //valida el estado del boton de eliminar todos los usuario
        let status = btnCheckAll.checked ? false : true;
        btnDeleteAllUser.disabled = status;
    }


    document.addEventListener('DOMContentLoaded', function() {
        const btnEditUser = document.querySelectorAll('#btn_edit_user'); // Cambia a querySelectorAll para manejar múltiples botones

        btnEditUser.forEach(button => {
            button.addEventListener('click', (e) => {
                const libroId = button.getAttribute('data-libro-id'); // Obtiene el `libroId` del atributo `data-libro-id`

                // Verifica que `libroId` no esté vacío
                if (!libroId) {
                    console.error('Error: el ID de usuario no está definido.');
                    alert('Error: el ID de usuario no está definido.');
                    return;
                }

                // Crear un objeto FormData a partir del formulario
                const formData = new FormData();
                formData.append("action", "getDataUser"); // Agregar el campo 'action' con el valor 'editUser '
                formData.append("libroId", libroId); // Agregar el campo 'libroId'

                fetch('./src/admin/usuarios.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json()) // Asegúrate de que el servidor devuelva un JSON
                    .then(data => {
                        // Aquí se asume que el servidor devuelve un objeto con los datos del usuario
                        if (data) {
                            // Actualiza los campos del formulario en el modal
                            document.getElementById('id').value = data.id;
                            document.getElementById('user_id').value = data.user_id;
                            document.getElementById('google_books_id').value = data.google_books_id;
                            document.getElementById('title').value = data.title;
                            document.getElementById('imagen_portada').value = data.portada;
                            document.getElementById('resena_personal').value = data.resena_personal;
                            document.getElementById('fecha_guardado').value = data.fecha_guardado;
                            /*
                             // Muestra el modal
                            onst modal = new bootstrap.Modal(document.getElementById('edit_admin_modal'));
                              modal.show();*/

                        } else {
                            console.error('Error: no se recibieron datos del usuario.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
    btnDeleteUser.addEventListener('click', (e) => {
        const libroId = btnDeleteUser.getAttribute('data-libro-id'); // Obtiene el `libroId` del atributo `data-libro-id`

        // Verifica que `libroId` no esté vacío
        if (!libroId) {
            console.error('Error: el ID de usuario no está definido.');
            alert('Error: el ID de usuario no está definido.');
            return;
        }
        // Crear un objeto FormData a partir del formulario
        const formData = new FormData();
        formData.append("action", "deleteUser"); // Agregar el campo 'action' con el valor 'addUser'
        formData.append("libroId", libroId); // Agregar el campo 'action' con el valor 'addUser'

        fetch('./src/admin/usuarios.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => console.error('Error:', error));
    });

    btnDeleteAllUser.addEventListener('click', (e) => {
        // Crear un objeto FormData a partir del formulario
        const formData = new FormData();
        formData.append("action", "deleteAllUser"); // Agregar el campo 'action' con el valor 'addUser'

        fetch('./src/admin/usuarios.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => console.error('Error:', error));
    });


    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.form-check-input');

        function updateButtonState() {
            let selectedCount = 0;

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    selectedCount++;
                }
            });

            // Habilita el botón si hay 2 o más checkboxes seleccionados
            btnDeleteAllUser.disabled = selectedCount < 2;
        }

        // Llama a la función al cargar la págiNna para establecer el estado inicial del botón
        updateButtonState();

        // Añade el evento 'change' a cada checkbox para actualizar el estado del botón en tiempo real
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', updateButtonState);
        });
    });
</script>