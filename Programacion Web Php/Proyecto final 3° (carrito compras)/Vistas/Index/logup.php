<div class="modal-header">
  <h5 class="modal-title"> Registrarse</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="container">
    <form action="../../Controladores/UsuarioController.php" method="post" enctype="multipart/form-data">
      <fieldset>
        <!-- id_usuario	nombre_usuario		direccion	telefono	email	password	foto	rol -->
        <div class="row">
       <div class="form-group col-md-6">
         <label for="">Nombre</label>
         <input type="text" name="nombre" required placeholder="Ingrese su nombre" class="form-control">
       </div>

       <div class="form-group col-md-6">
         <label for="">Direccion</label>
         <input type="text" name="direccion" required placeholder="Ingrese su direccion" class="form-control">
       </div>
     </div>

      <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Ingrese su Email" required>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <label for="">Telefono</label>
          <input type="text" name="telefono" class="form-control" placeholder="Ingrese su telefono" required>
        </div>
        <div class="form-group col-md-6">
          <label for="">Foto</label>
          <input type="file" name="foto" class="form-control" required>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <label for="">Contraseña</label>
          <input type="password" name="password" class="form-control" placeholder="Ingrese una Contraseña" required>
        </div>
        <div class="form-group col-md-6">
          <label for="">Repita la contraseña</label>
          <input type="password" name="password2" class="form-control" placeholder="Repita la contraseña" required>
        </div>
      </div>

        <input type="hidden" name="rol" value="cliente">
        <input type="hidden" name="opcion" value="create_u">
        <input type="submit" hidden name="guardar" class="btn btn-success" id="guardar"></input>

      </fieldset>
    </form>
  </div>
</div>

<div class="modal-footer">
  <div class="mr-auto">
    <button type="button" class="btn btn-outline-primary" id="iniciar">Iniciar sesion</button>
  </div>
  <button type="button" class="btn btn-outline-success" id="registrar">Registrarse</button>
  <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
</div>


<script type="text/javascript">
  $(document).on("click", "#iniciar", function () {
    $("#ContentModal").load('login.php',function(){
    });
  });

  $(document).on("click", "#registrar", function () {
    $("#guardar").click();
  });
</script>
