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