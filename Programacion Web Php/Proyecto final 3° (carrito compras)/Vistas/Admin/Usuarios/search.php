<?php @session_start();

  if($_SESSION["AUTENTICA"] != 'SI'){
    header('Location: ../../Session/function.php?salir=true');
  }else{
    require_once '../../../Modelos/Conexion.php';
    require_once '../../../Modelos/Usuario.php';
    require_once '../../../Controladores/UsuarioController.php';
  }

    if($_SESSION['rol'] == "cliente"){
      header('Location: ../../Cliente/index.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Admin-usuarios: La tienda de Tulio</title>
    <!-- Incluir Bootstrap -->
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css" />
    <!-- Incluir Fontawesome -->
    <link rel="stylesheet" href="../../../public/css/fontawesome.min.css" />
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
          <li class="nav-link" >
            <a href="search.php">
              <i class="fas fa-spinner" style="color:RGB(124,124,125);"></i>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Productos/index.php">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Facturas/index.php">Facturas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../Session/function.php?salir=true">Salir</a>
          </li>
        </ul>
      </div>
    </nav>

    <br />
    <!-- contenido pagina -->
      <div class="container" style="margin-top: 2%;">
        <div class="header">
          <h1>Resultado busqueda de usuarios</h1>
            <button type="button" class="btn btn-outline-success" id="nuevo_usuario"  data-toggle='modal' data-target='#ModalContainer'><i class="fa fa-plus-circle"></i> Añadir Nuevo Usuario</button>


          <form action="search.php"  type="POST" class="form-inline" style="float: right;">
            <input class="form-control mr-sm-2" type="search" placeholder="Nombre Producto." aria-label="Search" name="nombre_buscar">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" id="buscar"><i class="fa fa-search fa-fw"></i></button>
          </form>


        </div>
        <section style="margin-top:2%;">
          <table class="table table-bordered table-sm" style="text-align: center;">
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Foto</th>
              <th>Rol</th>
              <th>Opciones</th>
            </tr>
            <?php
              if(isset($_REQUEST['nombre_buscar'])){
               $nombre = $_REQUEST['nombre_buscar'];
               search($nombre);
              }else{
               // echo "<div class='alert alert-warning' style='margin-top: 2%;'><fieldset>No hay parametros de busqueda</fieldset></div>";
               index();
             }

             if(isset($_GET['respuesta'])){
               $res = $_GET['respuesta'];
               echo "<div class='alert alert-success' style='margin-top: 2%;'><fieldset>".$res."</fieldset></div>";

             }
             ?>
          </table>
        </section>
      </div>


      <!-- contenedor de modales -->
      <div class="modal fade" id="ModalContainer" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" id="ContentModal">

          </div>
        </div>
      </div>


    <!-- Incluir Jquery -->
     <script src="../../../public/js/jquery.min.js"></script>
     <!-- Incluir Bootstrap -->
     <script src="../../../public/js/bootstrap.min.js"></script>
     <!-- Incluir Fontawesome -->
     <script src="../../../public/js/fontawesome.min.js"></script>

     <!-- cargar contenido de modales -->
     <script type="text/javascript">
      $(document).ready(function () {
        $("#nuevo_usuario").on("click", function () {
          $("#ContentModal").load('create.php',function(){
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
