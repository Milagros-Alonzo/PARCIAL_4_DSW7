<?php //require './src/admin/usuarios.php'; 
?>

<div class="modal fade" id="agregarLibroFavorito" tabindex="-1" aria-labelledby="agregarLibroFavoritoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="agregarLibroFavoritoLabel">Agregar Libro a Favoritos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formUpdateLibro">
        <div class="modal-body">
          <div class="form-group">
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Agregar Reseña</label>
              <textarea class="form-control" name='resena' id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
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
    event.preventDefault();

    // Crear un objeto FormData a partir del formulario
    const formData = new FormData(document.getElementById('formUpdateLibro'));
    formData.append("libroId", ""); // Agregar el campo 'userId'
    formData.append('evento', 'agregarFavoritos');
    fetch('http://localhost/PARCIALES/PARCIAL_4_DSW7/app/src/libros/dasboard.php', {
        method: 'POST',
        body: formData
      })
      .catch(error => console.error('Error:', error));
  });
</script>