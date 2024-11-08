<?php //require './src/admin/usuarios.php'; ?>

<div class="modal fade" id="edit_libro" tabindex="-1" aria-labelledby="editLibroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editLibroLabel">Editar Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formUpdateLibro">
        <div class="modal-body">
          <input type="hidden" id="user_id" name="user_id">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre" required>
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa el apellido" required>
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa el e-mail" required>
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingresa el teléfono" required>
          </div>
          <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresa la dirección" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </form>
      <div id="respuesta"></div>
    </div>
  </div>
</div>

<script>

  document.getElementById('formUpdateLibro').addEventListener('submit', function(event) {
    event.preventDefault();

    // Crear un objeto FormData a partir del formulario
    const formData = new FormData(this);
    formData.append("action", "updateLibro");
    formData.append("libroId", ""); // Agregar el campo 'userId'
    fetch('./src/admin/usuarios.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById("respuesta").innerHTML = data;
        // Cerrar el modal después de guardar los cambios
        // var modal = bootstrap.Modal.getInstance(document.getElementById('edit_libro'));
        // modal.hide();
      })
      .catch(error => console.error('Error:', error));
  });
</script>