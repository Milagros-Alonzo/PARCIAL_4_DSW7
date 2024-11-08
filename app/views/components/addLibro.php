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
            <label for="rol">Rol</label>
            <select class="form-select" aria-label="Default select example" requiere>
              <?php foreach ($array_rol as $rol): ?>
                <option value="<?php echo $rol['rol'] ?>"><?php echo $rol['rol'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
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