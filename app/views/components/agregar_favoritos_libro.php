<?php //require './src/admin/usuarios.php'; ?>

<div class="modal fade" id="edit_libro" tabindex="-1" aria-labelledby="editLibroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editLibroLabel">Agregar Libro a Favoritos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formUpdateLibro">
      <div class="modal-body">
          <div class="form-group">
            <label for="GoogleBooksId">Agrega una Reseña del libro</label>
            <input type="text" class="form-control" name="GoogleBooksId" placeholder="Agrega una Reseña del libro" required>
          </div>
  
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Agregar Libro </button>
        </div>
      </form>
      <div id="respuesta"></div>
    </div>
  </div>
</div>

<script>

  document.getElementById('formUpdateLibro').addEventListener('submit', function(event) {
    //event.preventDefault();

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