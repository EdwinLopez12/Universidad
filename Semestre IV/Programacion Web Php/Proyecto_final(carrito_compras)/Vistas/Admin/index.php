<?php
  require_once '../../Modelos/Session.php';
  require_once '../../Controladores/SessionController.php';

  validar_session();

  if(isset($_GET['salir'])){
    $salir = $_GET['salir'];
    if($salir){
      salir();
    }
  }

  if($_SESSION['rol'] == "cliente"){
    header('Location: ../Cliente/index.php');
  }

 ?>

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
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Productos/index.php">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Usuarios/index.php">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Facturas/index.php">Facturas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Session/function.php?salir=true">Salir</a>
          </li>
        </ul>
      </div>
    </nav>

    <br />
    <div class="container">
      <h2>Pagina de Administradores</h2>
      <p>En estás secciones de las "Tienda de Tulio", se podra realizar las operaciones pertinentes a crear, editar y eliminar, tanto usuarios como productos y facturas</p>

      <div class="row">
        <div class="col-md-4" style="margin-bottom: 2%;">
          <center>
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="../../Public/imagenes/Extras/usuarios.png" style="max-width: 250px; height: 250px; margin-top:1%;">
              <div class="card-body">
                <h5 class="card-title">Usuarios</h5>
                <p class="card-text">Ver los <strong>Usuarios</strong> registrados en la pagina</p><br />
                <a href="Usuarios/index.php" class="btn btn-primary">Ir: usuarios</a>
              </div>
            </div>
          </center>
        </div>

        <div class="col-md-4" style="margin-bottom: 2%;">
          <center>
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="../../Public/imagenes/Extras/productos.jpg" style="max-width: 250px; height: 250px; margin-top:1%;">
              <div class="card-body">
                <h5 class="card-title">Productos</h5>
                <p class="card-text">Ver, editar, elimar <strong>Productos</strong>, asi como manejar el inventario de los mismos</p>
                <a href="Productos/index.php" class="btn btn-primary">Ir: productos</a>
              </div>
            </div>
          </center>
        </div>

        <div class="col-md-4" style="margin-bottom: 2%;">
          <center>
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="../../Public/imagenes/Extras/factura.png" style="max-width: 250px; height: 250px; margin-top:1%;">
              <div class="card-body">
                <h5 class="card-title">Facturas</h5>
                <p class="card-text">Ver todas las facturas</p><br /><br />
                <a href="Facturas/index.php" class="btn btn-primary">Ir: facturas</a>
              </div>
            </div>
          </center>
        </div>
      </div>


    <!-- Incluir Jquery -->
     <script src="../../public/js/jquery.min.js"></script>
     <!-- Incluir Bootstrap -->
     <script src="../../public/js/bootstrap.min.js"></script>
     <!-- Incluir Fontawesome -->
     <script src="../../public/js/fontawesome.min.js"></script>
  </body>
</html>
