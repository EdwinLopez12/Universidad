<?php
  if (isset($_GET['estado'])) {
    $estado = $_GET['estado'];
    if($estado == 0){
      echo "<div class='alert alert-success'><fieldset> El usuario o la contraseña son incorrectos</fieldset></div>";
    }
  }
 ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Login: La tienda de tulio</title>

      <!-- Incluir Bootstrap -->
  	<link rel="stylesheet" href="../../public/css/bootstrap.min.css" />
  	<!-- Incluir Fontawesome -->
  	<link rel="stylesheet" href="../../public/css/fontawesome.min.css" />

    <style media="screen">
      body{
        background: url(../../Public/imagenes/fondo.jpg);
      }
      form{
        background: #F3F3F3;
        width: 50%;
        max-width: 500px;
        margin-top: 7%;
        padding: 5% 0 5% 6%;
        margin-left: 30%;
      }
      p{
        font-size: 12px;
      }
      label{
        font-size: 20px;
      }
    </style>
  </head>
  <body>

    <div class="container">
      <form action="../../Controladores/SessionController.php" method="post">
        <fieldset>
          <div class="text-center col-sm-10">
            <legend class="">BIENVENIDO</legend>
            <br />
          </div>

          <div class="form-group">
            <label for="" class="control-label col-sm-2">Usuario</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" placeholder="Nombre de usuario" required id="email">
              <p class="help-block">Ingrese su correo sin espacios</p>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="control-label col-sm-2">Contrase&ntilde;a</label>
            <div class="col-sm-10">
              <input type="password" name="pass" class="form-control" placeholder="Contraseña" required >
              <p class="help-block">Ingrese la contraseña sin espacios</p>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="ingresar"></label>
            <div class="text-center col-sm-10">
              <button type="submit" name="ingresar" class="btn btn-success">Iniciar Sesión</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>


    <!-- Incluir Jquery -->
  	<script src="../../public/js/jquery.min.js"></script>
  	<!-- Incluir Bootstrap -->
  	<script src="../../public/js/bootstrap.min.js"></script>
  	<!-- Incluir Fontawesome -->
  	<script src="../../public/js/fontawesome.min.js"></script>

    <!-- efectos -->
    <script type="text/javascript">
    $(document).ready(function () {
      $('#email').focus();
    });
    </script>
  </body>
</html>
