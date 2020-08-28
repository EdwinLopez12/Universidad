<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Admin: La tienda de Tulio</title>
    <!-- Incluir Bootstrap -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css" />
    <!-- Incluir Fontawesome -->
    <link rel="stylesheet" href="../../public/css/fontawesome.min.css" />
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">La tienda de Tulio</a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mt-2 mt-lg-0 mr-auto">
        </ul>
        <ul class="navbar-nav mt-2 mt-lg-0 ">

          <li class="nav-item">
            <a class="nav-link" data-toggle='modal' data-target='#ModalContainer' id="iniciar_sesion">Iniciar sesion</a>
          </li>
        </ul>
      </div>
    </nav>

    <br />

    <?php
    if(isset($_GET['respuesta'])){
      $res = $_GET['respuesta'];
      echo "<div class='alert alert-success' role='alert' style='margin-top: -1.7%;'><fieldset>".$res."</fieldset></div>";
    }

    if(isset($_GET['error'])){
      $res = $_GET['error'];
      echo "<div class='alert alert-warning' role='alert' style='margin-top: -1.7%;'><fieldset>".$res."</fieldset></div>";
    }
    ?>
    <div class="container">
      <h2>La tienda que tiene todo lo que necesitas en base a alimentos</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

      <h2>Productos mas vendidos</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <h2>Promociones</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>


    <!-- contenedor de modales -->
    <div class="modal fade" id="ModalContainer" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="ContentModal">

        </div>
      </div>
    </div>

    <!-- Incluir Jquery -->
     <script src="../../public/js/jquery.min.js"></script>
     <!-- Incluir Bootstrap -->
     <script src="../../public/js/bootstrap.min.js"></script>
     <!-- Incluir Fontawesome -->
     <script src="../../public/js/fontawesome.min.js"></script>

     <!-- cargar contenido de modales -->
     <script type="text/javascript">
      $(document).ready(function () {
        $("#iniciar_sesion").on("click", function () {
          $("#ContentModal").load('login.php',function(){
          });
        });
      });

      $(document).on("click", "#show", function () {
        var nit = $(this).data("nit");
        var parametros = '&nit='+nit;

        $("#ContentModal").load('show.php?'+parametros,function(){
        });
      });

      $(document).on("click", "#edit", function () {
        var nit = $(this).data("nit");
        var parametros = '&nit='+nit;

        $("#ContentModal").load('edit.php?'+parametros,function(){
        });
      });
    </script>

  </body>
</html>
