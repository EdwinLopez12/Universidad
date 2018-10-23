<?php @session_start();

  if(isset($_REQUEST['opcion'])){

    $opcion = $_REQUEST['opcion'];
    date_default_timezone_set('America/Bogota');

    if($opcion == 'finalizar'){
      require_once '../Modelos/Conexion.php';
      require_once '../Modelos/Factura.php';
      $horario = date('y-m-d-H-i-s');
      $gv = guardar_venta($horario, $_SESSION['TOTAL_COMPRA'], $_SESSION['id']);
      if($gv){
        $venta = getVenta($horario);
        foreach ($_SESSION['CARRITO'] as $indice => $producto) {
          guardar_productos($producto['ID'],$venta, $producto['CANTIDAD'], $producto['ANTIGUA']);
        }
        $res = "Venta realizada satisfactoriamente";
        header ('Location: ../Vistas/Cliente/index.php?respuesta='.$res.'&fin=true');
      }else{
        echo "error";
      }
    }
  }


   function paginar()
  {
      $facturas = new Factura();
      $listadoFacturas = $facturas->paginar();
  }


  function index(){
    $facturas = new Factura();
    $listadoFacturas = $facturas->index();
    if($listadoFacturas !== false){
      foreach ($listadoFacturas as $factura) {
        echo "<tr>";
        echo "<td>".$factura['id_venta']."</td>";
        echo "<td>".$factura['fecha']."</td>";
        echo "<td>".$factura['nombre_usuario']."</td>";
        echo "<td>".$factura['valor_total']."</td>";

        echo "<td>
        <button class='btn btn-outline-primary'  id='show' data-nit='".$factura['id_venta']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Ver</button>

        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 5%;'><fieldset> No hay registros en la base de datos</fieldset></div>";
    }
  }

  function listarProductos(){
    $productos = new Factura();
    $listadoProductos = $productos->listarProductos();
    if($listadoProductos !== false){
      foreach ($listadoProductos as $producto) {
        echo '

         <div class="col-md-4 col-sm-6" style="margin-bottom: 1%;" class="productoHover">
           <center>
             <div class="card">
               <img class="card-img-top" src="../'.$producto['foto'].'" style="max-height: 100px; max-width: 150px;">
               <div class="card-body">
                 <h5 class="card-title">'.$producto['nombre_producto'].'</h5>

                 <p class="card-text">Precio por unidad: '.$producto['valor'].'</p>

                 <center>
                     <a href="#" class="btn btn-outline-success" id="agregar" data-nit="'.$producto['id_producto'].'" data-toggle="modal" data-target="#ModalContainer"><i class="fa fa-plus-circle"></i> Añadir</a>
                 </center>
               </div>
             </div>
           </center>
         </div>

         ';
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 5%;'><fieldset> No hay registros en la base de datos</fieldset></div>";
    }
  }

  function mostrarDatos($id){
    $productos = new Factura($id);
    $listadoProductos = $productos->mostrar($id);
    if($listadoProductos !== false){
      foreach ($listadoProductos as $producto) {
        echo '
          <div class="">
            <form action="carrito.php" method="post">

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="">Nombre</label>
                  <input type="text" name="nombre_producto" class="form-control" readonly value="'.$producto['nombre_producto'].'">
                </div>
                <div class="form-group col-md-6">
                  <label for="">Descripción</label>
                  <input type="text" name="descripcion" class="form-control" readonly value="'.$producto['descripcion'].'">
                </div>
              </div>

              <center class="form-group">
                <label for="">Cantidad disponible</label>
                <input type="number" name="cantidad_disponible" class="form-control" readonly value="'.$producto['cantidad'].'" style="text-align:center; max-width: 100px;">
              </center>

              <center class="form-group">
                <label for="">Cantidad a comprar</label>
                <input type="number" name="cantidad_comprar" class="form-control" required placeholder="###" style="text-align:center; max-width: 100px;">
              </center>

               <input type="hidden" name="opcion" value="agregar">
               <input type="hidden" name="valor" value="'.$producto['valor'].'">
               <input type="hidden" name="id_producto" value="'.$producto['id_producto'].'">

               <input type="submit" hidden id="agregar_producto">

             </form>
          </div>

        ';
      }
    }
  }

  function buscar($nombre){
    $productos = new Factura();
    $listadoProductos = $productos->search_productos($nombre);
    if($listadoProductos !== false){
      foreach ($listadoProductos as $producto) {
        echo '

         <div class="col-md-4 col-sm-6" style="margin-bottom: 1%;" class="productoHover">
           <center>
             <div class="card">
               <img class="card-img-top" src="../'.$producto['foto'].'" style="max-height: 100px; max-width: 150px;">
               <div class="card-body">
                 <h5 class="card-title">'.$producto['nombre_producto'].'</h5>

                 <p class="card-text">Precio por unidad: '.$producto['valor'].'</p>

                 <center>
                     <a href="#" class="btn btn-outline-success" id="agregar" data-nit="'.$producto['id_producto'].'" data-toggle="modal" data-target="#ModalContainer"><i class="fa fa-plus-circle"></i> Añadir</a>
                 </center>
               </div>
             </div>
           </center>
         </div>

         ';
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 5%;'><fieldset> No se encontraron coincidencias</fieldset></div>";
    }
  }

  function buscar_facturas($dato) {
    $facturas = new Factura();
    $listadoFacturas = $facturas->search_fac($dato);
    if($listadoFacturas !== false){
      foreach ($listadoFacturas as $factura) {
        echo "<tr>";
        echo "<td>".$factura['id_venta']."</td>";
        echo "<td>".$factura['fecha']."</td>";
        echo "<td>".$factura['nombre_usuario']."</td>";
        echo "<td>".$factura['valor_total']."</td>";

        echo "<td>
        <button class='btn btn-outline-primary'  id='show' data-nit='".$factura['id_venta']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Ver</button>

        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 5%;'><fieldset> No se encontraron coincidencias</fieldset></div>";
    }
  }

  function ver_facturas($id){
    $facturas = new Factura();
    $listadoFacturas = $facturas->search_fac($dato);
    if($listadoFacturas !== false){
      foreach ($listadoFacturas as $factura) {
        echo "<tr>";
        echo "<td>".$factura['id_venta']."</td>";
        echo "<td>".$factura['fecha']."</td>";
        echo "<td>".$factura['nombre_usuario']."</td>";
        echo "<td>".$factura['valor_total']."</td>";

        echo "<td>
        <button class='btn btn-outline-primary'  id='show' data-nit='".$factura['id_venta']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Ver</button>

        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 5%;'><fieldset> No se encontraron compras</fieldset></div>";
    }
  }

  function getVenta($fecha) {
    $venta = new Factura();
    $resultado = $venta->getVenta($fecha);
    return $resultado;
  }

  function guardar_venta($horario, $total, $usuario){
    $venta = new Factura();
    $resultado = $venta->save_venta($horario, $total, $usuario);
    if($resultado == true){
      return true;
    }else{
      return false;
    }
  }


  function actualizarProducto($producto, $cantidad, $antigua){
    $productos = new Factura();
    $resultado = $productos->updateProducto($producto, $cantidad, $antigua);

  }

  function guardar_productos($producto,$venta, $cantidad, $antigua){
    $productos = new Factura();
    $resultado = $productos->save_factura($producto, $venta, $cantidad);
    if($resultado){
      // echo "Bien";
      actualizarProducto($producto, $cantidad, $antigua);
    }else{
      // echo "Mal";
    }
  }
 ?>
