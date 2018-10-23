<div class="modal-header">
  <h5 class="modal-title"> BIENVENIDO</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="container">
    <form action="../../Controladores/SessionController.php" method="post">
      <fieldset>

        <div class="form-group">
          <label for="" class="control-label col-sm-2">Usuario</label>
          <div class="col-sm-12">
            <input type="email" name="email" class="form-control" placeholder="Nombre de usuario" required id="email">
            <p class="help-block">Ingrese su correo sin espacios</p>
          </div>
        </div>

        <div class="form-group">
          <label for="" class="control-label col-sm-2">Contrase&ntilde;a</label>
          <div class="col-sm-12">
            <input type="password" name="pass" class="form-control" placeholder="Contraseña" required >
            <p class="help-block">Ingrese la contraseña sin espacios</p>
          </div>
        </div>

        <input type="submit" hidden name="enviar" class="btn btn-success" id="enviar"></input>

      </fieldset>
    </form>
  </div>
</div>

<div class="modal-footer">
  <div class="mr-auto">
    <button type="button" class="btn btn-outline-primary" id="regis">Registrarse</button>
  </div>
  <button type="button" class="btn btn-outline-success" id="iniciar">Iniciar sesion</button>
  <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
</div>


<script type="text/javascript">
  $(document).on("click", "#regis", function () {
    $("#ContentModal").load('logup.php',function(){
    });
  });

  $(document).on("click", "#iniciar", function () {
    $("#enviar").click();
  });
</script>
