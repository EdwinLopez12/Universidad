<div class="modal-header">
  <h5 class="modal-title"> Crear Usuarios</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-body">
  <div class="container">
    <form action="../../../Controladores/UsuarioController.php" method="post" enctype="multipart/form-data">

      <div class="row">
        <div class="form-group col-md-6">
          <label for="">Nombre</label>
          <input type="text" name="nombre" class="form-control" placeholder="Nombre un nombre" required>
        </div>
        <div class="form-group col-md-6">
          <label for="">Direccion</label>
          <input type="text" name="direccion" class="form-control" placeholder="Ingrese una Direccion" required>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <label for="">Telefono</label>
          <input type="number" name="telefono" required class="form-control" placeholder="Ingrese un Telefono">
        </div>
        <div class="form-group col-md-6">
          <label for="">Email</label>
          <input type="email" name="email" required class="form-control" placeholder="usuario@corre.com">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <label for="">imagen</label>
          <input type="file" name="foto" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
          <label for="">Rol</label>
          <select class="custom-select" name="rol" required>
            <option value="no" selected>Seleccione un rol</option>
            <option value="cliente">Cliente</option>
            <option value="administrador">Administrador</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <label for="">Contraseña</label>
          <input type="password" name="password" required class="form-control" placeholder="****">
        </div>
        <div class="form-group col-md-6">
          <label for="">Repetir contraseña</label>
          <input type="password" name="password2" required class="form-control" placeholder="****">
        </div>

      </div>


      <input type="hidden" name="opcion" value="create">

      <input type="submit" hidden id="guardar_usuario">

    </form>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-success" id="guardar">Crear Usuario</button>
  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
</div>

<script type="text/javascript">
   $(document).ready(function () {
     $("#guardar").on("click", function () {
       $("#guardar_usuario").click();
     });
   });

 </script>
