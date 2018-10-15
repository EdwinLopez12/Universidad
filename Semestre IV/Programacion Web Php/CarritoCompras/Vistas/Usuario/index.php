<?php @session_start();

  if ($_SESSION["AUTENTICA"] != 'SI') {
    header('Location: ../Index/index.php?salir=true');
  }else{
    require_once '../../Modelos/Conexion.php';
    require_once '../../Modelos/Usuario.php';
    require_once '../../Controladores/UsuarioController.php';
  }
 ?>

 <!DOCTYPE html>
   <html lang="es">
     <head>
       <meta charset="utf-8">
       <title>Admin: Usuarios</title>

         <!-- Incluir Bootstrap -->
      <link rel="stylesheet" href="../../public/css/bootstrap.min.css" />
      <!-- Incluir Fontawesome -->
      <link rel="stylesheet" href="../../public/css/fontawesome.min.css" />
     </head>

     <body>
       <!-- navbar 1 -->
       <div class="fixed-top">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
           <div class="container">
             <a class="navbar-brand" href="#">
               <img src="../../Public/imagenes/Extras/Tienda-de-tulio.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
               La tienda de Tulio
             </a>

             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
             </button>

             <div class="collapse navbar-collapse" id="navbarSupportedContent">

               <ul class="navbar-nav mr-auto">
                 <!-- espaciado -->
               </ul>
               <ul class="navbar-nav">

                 <li class="nav-link" >
                   <a href="../Index/index.php">
                     <i class="fas fa-home" style="color:RGB(124,124,125);"></i>
                   </a>
                 </li>

                 <li class="nav-link" >
                   <a href="index.php">
                     <i class="fas fa-spinner" style="color:RGB(124,124,125);"></i>
                   </a>
                 </li>
                 <!-- funciones    -->
                 <li class="nav-link dropdown nav-item">
                   <a class="dropdown" data-toggle="dropdown" href="#">
                     <i class="fa fa-user fa-fw" style="color:RGB(124,124,125);"></i><i class="fa fa-caret-down" style="color:RGB(124,124,125);"></i>
                   </a>
                   <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                     <a href="index.php" class="dropdown-item" id=""><i class="fa fa-user fa-fw" style="color:RGB(124,124,125);"></i> Usuarios</a>
                     <a href="../Producto/index.php" class="dropdown-item" id=""><i class="fab fa-product-hunt" style="color:RGB(124,124,125);"></i> Productos</a>
                     <a href="../Index/index.php?salir=true" class="dropdown-item"><i class="fas fa-sign-out-alt" style="color:RGB(124,124,125);"></i> Cerrar Sesi&oacute;n</a>
                   </ul>
                 </li>
               </ul>
             </div>
           </div>
          </nav>
       </div>


      <!-- contenido pagina -->
      <div id="page-wrapper">
        <div class="container" style="margin-top: 7%;">
          <div class="header">
            <h1>Listado de Usuarios</h1>
            <button type="button" class="btn btn-primary" id="Add"><i class="fa fa-plus-circle"></i> Añadir Nuevo Usuario</button>

            <form action="search.php"  type="POST" class="form-inline" style="float: right;">
              <input class="form-control mr-sm-2" type="search" placeholder="Nombre Usuario." aria-label="Search" name="nombre_buscar">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="buscar"><i class="fa fa-search fa-fw"></i></button>
            </form>


          </div>
          <section style="margin-top:2%;">
            <table class="table table-bordered table-sm" style="text-align: center;">
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Opciones</th>
              </tr>
              <?php
              if(isset($_GET['respuesta'])){
                $res = $_GET['respuesta'];
                echo "<div class='alert alert-success' style='margin-top: 2%;'><fieldset>".$res."</fieldset></div>";

              }
              index(); ?>
            </table>
          </section>
        </div>
      </div>

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
    </body>
   </html>

  <script type="text/javascript">
    $(document).ready(function () {
      $("#Add").on("click", function () {
        $("#page-wrapper").load('create.php');
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
