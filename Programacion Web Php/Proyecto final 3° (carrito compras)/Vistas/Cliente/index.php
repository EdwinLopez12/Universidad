<?php @session_start();

  if($_SESSION["AUTENTICA"] != 'SI'){
    header('Location: ../Session/function.php?salir=true');
  }else{
    require_once '../../Modelos/Conexion.php';
    require_once '../../Modelos/Factura.php';
    require_once '../../Controladores/FacturaController.php';

    if(isset($_GET['imagen'])){
      $img = $_GET['imagen'];
      $_SESSION['foto'] = $img;
    }

    if(isset($_GET['fin']) == true){
      session_destroy();
    }
  }

 ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>La tienda de Tulio</title>
    <!-- Incluir Bootstrap -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css" />
    <!-- Incluir Fontawesome -->
    <link rel="stylesheet" href="../../public/css/fontawesome.min.css" />
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="../../Public/imagenes/Extras/Tienda-de-tulio.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
          La tienda de Tulio
        </a>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
          <ul class="navbar-nav mr-auto">
            <!-- espaciado -->
          </ul>
          <ul class="navbar-nav">
            <li class="nav-link" >
              <a href="index.php">
                <i class="fas fa-spinner" style="color:RGB(124,124,125);"></i>
              </a>
            </li>
            <li>
              <a href="carrito.php" class="nav-link">
                <i class="fa fa-shopping-cart"></i>
                <span><?php if(isset($_SESSION['CARRITO'])){ echo count($_SESSION['CARRITO']);}else{ echo 0;} ?> Producto(s) | <?php if(isset($_SESSION['TOTAL_COMPRA'])){echo $_SESSION['TOTAL_COMPRA'];}else{ echo "$0";} ?></span>
              </a>
            </li>
            <!-- funciones    -->
            <li class="nav-link dropdown nav-item">
                <a class="dropdown" data-toggle="dropdown" href="#">
                    <img src="<?php echo "../".$_SESSION['foto']; ?>"  style="max-height: 30px; max-width: 30px;" > </img><i class="fa fa-caret-down" style="color:RGB(124,124,125);"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a href="" class="dropdown-item" id="facturas" data-toggle='modal' data-target='#ModalContainer'><i class="fa fa-user fa-fw" style="color:RGB(124,124,125);"></i> Facturas</a>
                    <a href="" class="dropdown-item" id="perfil" data-toggle='modal' data-target='#ModalContainer' ><i class="fab fa-product-hunt" style="color:RGB(124,124,125);"></i> Editar perfil</a>
                    <a href="../Session/function.php?salir=true" class="dropdown-item"><i class="fas fa-sign-out-alt" style="color:RGB(124,124,125);"></i> Cerrar Sesi&oacute;n</a>
                </ul>
            </li>
          </ul>
        </div>
        <!-- boton del collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

        <!-- contenido pagina -->
          <div class="container" style="margin-top: 2%;">
            <div class="header">
              <form action="index.php"  type="POST" class="form-inline" style="float: right;">
                <input class="form-control mr-sm-2" type="search" placeholder="Nombre Producto." aria-label="Search" name="nombre_buscar">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" id="buscar"><i class="fa fa-search fa-fw"></i></button>
              </form>
              <h1>Listado de productos</h1>



            </div>
            <section style="margin-top:2%;">
              <?php
                if(isset($_GET['respuesta'])){
                  $res = $_GET['respuesta'];
                  echo "<div class='alert alert-success' style='margin-top: 2%;'><fieldset>".$res."</fieldset></div>";

                }

                if(isset($_GET['error'])){
                  $res = $_GET['error'];
                  echo "<div class='alert alert-warning' role='alert' style='margin-top: 2%;'><fieldset>".$res."</fieldset></div>";
                } ?>

              <div class="card-group">
                <?php
                    if(isset($_REQUEST['nombre_buscar'])){
                     $nombre = $_REQUEST['nombre_buscar'];
                     buscar($nombre);
                   }else{
                     listarProductos();
                   }
                ?>
              </div>

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
     <script src="../../public/js/jquery.min.js"></script>
     <!-- Incluir Bootstrap -->
     <script src="../../public/js/bootstrap.min.js"></script>
     <!-- Incluir Fontawesome -->
     <script src="../../public/js/fontawesome.min.js"></script>

     <script type="text/javascript">

      $(document).on("click", "#agregar", function () {
        var nit = $(this).data("nit");
        var parametros = '&nit='+nit;

        $("#ContentModal").load('agregar.php?'+parametros,function(){
        });
      });


      $(document).on("click", "#perfil", function () {

        $("#ContentModal").load('edit.php',function(){
        });
      });

      $(document).on("click", "#facturas", function () {

        $("#ContentModal").load('facturas.php',function(){
        });
      });
    </script>
  </body>
</html>
