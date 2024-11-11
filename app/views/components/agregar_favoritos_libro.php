<div class="modal fade" id="agregarLibroFavorito" tabindex="-1" aria-labelledby="agregarLibroFavoritoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="agregarLibroFavoritoLabel">Agregar Libro a Favoritos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formAgregarbookFavorito">
        <div class="modal-body">
        <h5 id="modalTitle"></h5> <!-- Aquí se mostrará el título del libro -->
         <!-- Campo oculto para las variables -->
        <input type="hidden" id="f_bookId" name="bookId"> 
        <input type="hidden" id="f_autor" name="autor"> 
        <input type="hidden" id="f_titulo" name="titulo"> 
        <input type="hidden" id="f_image" name="image"> 
        <input type="hidden" id="f_descripcion" name="descripcion"> 
        <input type="hidden" id="f_fecha" name="fechaPublicacion"> 
          <div class="form-group">
            <div class="mb-3">
              <label for="resenaLabel" class="form-label">Agregar Reseña</label>
              <textarea class="form-control" name='resena' id="resenaLabel" rows="3"></textarea>
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

