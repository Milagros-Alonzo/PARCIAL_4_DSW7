<?php //require './src/admin/usuarios.php';?>

<div class="modal fade" id="add_admin_modal" tabindex="-1" aria-labelledby="reservas_usuarios_adminLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="reservas_usuarios_adminLabel">Añadir Nuevos Usuarios</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formAddUser">
        <div class="modal-body">
          <div class="form-group">
            <label for="GoogleBooksId">Google Books Id</label>
            <input type="text" class="form-control" id="GoogleBooksId" name="GoogleBooksId" placeholder="Ingresa el GoogleBooksId" required>
          </div>
          <div class="form-group">
            <label for="Titulo">Titulo</label>
            <input type="text" class="form-control" id="Titulo" name="Titulo" placeholder="Ingresa el Titulo" required>
          </div>
          <div class="form-group">
            <label for="Autor">Autor</label>
            <input type="text" class="form-control" id="Autor" name="Autor" placeholder="Ingresa el autor" required>
          </div>
          <div class="form-group">
            <label for="ImagenPortada">ImagenPortada</label>
            <input type="text" class="form-control" id="ImagenPortada" name="ImagenPortada" placeholder="Ingresa el imagenPortada" required>
          </div>
          <div class="form-group">
            <label for="ReseñaPersonal">Reseña Personal</label>
            <input type="text" class="form-control" id="ReseñaPersonal" name="ReseñaPersonal" placeholder="Ingresa la reseña Personal" required>
          </div>
          <div class="form-group">
            <label for="FechaGuardado">Fecha Guardado</label>
            <input type="text" class="form-control" id="FechaGuardado" name="FechaGuardado" placeholder="Ingresa la fecha Guardado" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
      </form>
      <div id="respuesta"></div>
    </div>
  </div>
</div>


<script>
document.getElementById('formAddUser').addEventListener('submit', function(event) {
  event.preventDefault(); // Evita el envío tradicional del formulario

  // Crear un objeto FormData a partir del formulario
  const formData = new FormData(this);
  formData.append("action", "addUser"); // Agregar el campo 'action' con el valor 'addUser'

  const xhr = new XMLHttpRequest();
  xhr.open("POST", './src/admin/usuarios.php', true);

  // Manejador para la respuesta del servidor
  xhr.onload = function() {
    if (xhr.status === 200) {
      document.getElementById("respuesta").innerHTML = xhr.responseText;
    } else {
      document.getElementById("respuesta").innerHTML = "Error en la petición";
    }
  };

  // Enviar los datos del formulario
  xhr.send(formData);
});

</script>