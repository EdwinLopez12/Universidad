<?php @session_start();

  require_once '../../Modelos/Conexion.php';
  require_once '../../Modelos/Factura.php';
  require_once '../../Controladores/FacturaController.php';

  if(isset($_REQUEST['opcion'])){
    $opcion = $_REQUEST['opcion'];

    if($opcion == 'agregar'){

      $id = $_REQUEST['id_producto'];
      $nombre = $_REQUEST['nombre_producto'];
      $cantidad_comprar = $_REQUEST['cantidad_comprar'];
      $cantidad_disponible = $_REQUEST['cantidad_disponible'];
      $precio = $_REQUEST['valor'];

      if($cantidad_disponible - $cantidad_comprar >= 0){
        if(!isset($_SESSION['CARRITO'])){
          $producto = array(
            'ID' => $id,
            'NOMBRE' => $nombre,
            'CANTIDAD' => $cantidad_comprar,
            'ANTIGUA' => $cantidad_disponible,
            'PRECIO' => $precio
          );
          $_SESSION['CARRITO'][0] = $producto;
        }else{
          $numeroProductos = count($_SESSION['CARRITO']);
          $producto = array(
            'ID' => $id,
            'NOMBRE' => $nombre,
            'CANTIDAD' => $cantidad_comprar,
            'ANTIGUA' => $cantidad_disponible,
            'PRECIO' => $precio
          );
          $_SESSION['CARRITO'][$numeroProductos] = $producto;
        }
      }else{
        $error = "No tenemos los suficientes productos para esta compra";
        header('Location: index.php?error='.$error.'');
      }

    }

    if($opcion == 'eliminar'){
      $posicion = $_REQUEST['posicion'] -1;
      unset($_SESSION['CARRITO'][$posicion]);
      $res = "Producto Eliminando del carrito de compras";
      header('Location: index.php?respuesta='.$res.'');
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
           <img src="../../Public/imagenes/Extras/Tienda-de-tulio.jpg" width="30" height="30" class="d-inline-block align-top" alt="" >
           La tienda de Tulio
         </a>
         <div id="navbarNavDropdown" class="navbar-collapse collapse">
           <ul class="navbar-nav mr-auto">
             <!-- espaciado -->
           </ul>
           <ul class="navbar-nav">
             <li class="nav-link" >

             </li>

             <!-- funciones    -->
             <li class="nav-link dropdown nav-item">
                 <a class="dropdown" data-toggle="dropdown" href="#">
                     <img src="<?php echo "../".$_SESSION['foto']; ?>"  style="max-height: 30px; max-width: 30px;" > </img><i class="fa fa-caret-down" style="color:RGB(124,124,125);"></i>
                 </a>

                 <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                     <!-- <a href="" class="dropdown-item" id=""><i class="fa fa-user fa-fw" style="color:RGB(124,124,125);"></i> Facturas</a> -->
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

     <div class="container">
       <section style="margin-top: 5%;">
         <center>
           <h2>Carrito compras</h2>
         </center>
         <a href="index.php" class="btn btn-info">
           <i class="fas fa-home" ></i> Volver
         </a>
         <?php echo "<a class='btn btn-success' style='float:right;' onClick=\"return confirm('Finalizar la compra')\" href='../../Controladores/FacturaController.php?opcion=finalizar'><i class='fas fa-shopping-cart'></i> Finalizar </a>"; ?>
         <?php


          if(!isset($_SESSION['CARRITO'])){
            echo "No hay productos selecionados";
          }else{
          ?>
         <table class="table table-striped table-sm" style="margin-top: 3%; text-align: center;">
           <th scope="col">#</th>
           <th scope="col">Nombre</th>
           <th scope="col">Cantidad</th>
           <th scope="col">Valor unitario</th>
           <th scope="col">Valor Total</th>
           <th scope="col">Opcion</th>
             <?php $total = 0;
             $contador = 1;
              foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                echo '
                  <tr>
                    <td scope="row">
                      '.$contador.'
                    </td>
                    <td >
                      '.$producto['NOMBRE'].'
                    </td>
                    <td >
                      '.$producto['CANTIDAD'].'
                    </td>
                    <td >
                      '.$producto['PRECIO'].'
                    </td>
                    <td >
                      '.$producto['PRECIO']*$producto['CANTIDAD'].'
                    </td>
                    <td>
                      <a href="carrito.php?opcion=eliminar&posicion='.$contador.'" onClick=\'return confirm("Eliminar el articulo del carrito de compras?")\' class="btn btn-danger"><i class=""> Eliminar</i></a>
                    </td>
                  </tr>
                ';
                $contador +=1;
                $total = $total+($producto['PRECIO']*$producto['CANTIDAD']);
              }
              ?>

              <tfoot>
                <th colspan="4">VALOR TOTAL COMPRA</th>
                <th><?php echo $total; $_SESSION['TOTAL_COMPRA'] = $total; ?></th>
              </tfoot>
              <!-- <td></td> -->
         </table>

      <?php } ?>
       </section>
     </div>


     <!-- Incluir Jquery -->
      <script src="../../public/js/jquery.min.js"></script>
      <!-- Incluir Bootstrap -->
      <script src="../../public/js/bootstrap.min.js"></script>
      <!-- Incluir Fontawesome -->
      <script src="../../public/js/fontawesome.min.js"></script>

      <script type="text/javascript">

   </body>
 </html>
