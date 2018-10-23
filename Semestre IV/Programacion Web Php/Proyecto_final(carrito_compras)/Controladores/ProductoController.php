<?php

$dir_subida = '../Public/imagenes/Productos/';

if (isset($_REQUEST['opcion'])) {
  require_once '../Modelos/Conexion.php';
  require_once '../Modelos/Producto.php';

  $opcion = $_REQUEST['opcion'];
  date_default_timezone_set('America/Bogota');

  if ($opcion == 'create') {
    $nombre = $_REQUEST['nombre'];
    $descripcion = $_REQUEST['descripcion'];
    $cantidad = $_REQUEST['cantidad'];
    $valor = $_REQUEST['valor'];
    $horario = date('y_m_d_H_i_s_');

    //tamaño de la imagen
    if($_FILES['foto']['size']< 10000000){
      // extension de la imagen
      $ext = explode(".",$_FILES['foto']['name']);
      if(strtolower($ext[1]) == "png" || strtolower($ext[1] == "jpg") || strtolower($ext[1] == "jpeg") || strtolower($ext[1] == "tif")){
        $fichero_subido = $dir_subida.$horario.basename($_FILES['foto']['name']);
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
          store($nombre, $descripcion, $fichero_subido, $cantidad, $valor);
        }else {
          $error = "No se pudo almacenar";
          header ('Location: ../Vistas/Admin/Productos/index.php?error='.$error.'');
        }
      }else{
       $error = "La archivo no es permitido, las extensiones permitidas son: png, jpg, jpeg y tif";
       header ('Location: ../Vistas/Admin/Productos/index.php?error='.$error.'');
      }
    }else{
      $error = "El archivo es demasiado grande";
      header ('Location: ../Vistas/Admin/Productos/index.php?error='.$error.'');
    }
  }

  if ($opcion == 'edit') {
    $id = $_REQUEST['id_producto'];
    $nombre = $_REQUEST['nombre'];
    $descripcion = $_REQUEST['descripcion'];
    $cantidad = $_REQUEST['cantidad'];
    $valor = $_REQUEST['valor'];
    $horario = date('y_m_d_H_i_s_');

    //tamaño de la imagen
    if($_FILES['foto']['size']< 10000000){
      // extension de la imagen
      $ext = explode(".",$_FILES['foto']['name']);
      if(strtolower($ext[1]) == "png" || strtolower($ext[1] == "jpg") || strtolower($ext[1] == "jpeg") || strtolower($ext[1] == "tif")){
        $fichero_subido = $dir_subida.$horario.basename($_FILES['foto']['name']);
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {

          $imagen = getImage($id);


          edit($id, $nombre, $descripcion, $fichero_subido, $cantidad, $valor, $imagen);
        }else {
          $error = "No se pudo almacenar";
          header ('Location: ../Vistas/Admin/Productos/index.php?error='.$error.'');
        }
      }else{
       $error = "La archivo no es permitido, las extensiones permitidas son: png, jpg, jpeg y tif";
       header ('Location: ../Vistas/Admin/Productos/index.php?error='.$error.'');
     }
    }else{
      $error = "El archivo es demasiado grande";
      header ('Location: ../Vistas/Admin/Productos/index.php?error='.$error.'');
    }
  }

  if($opcion == 'delete'){
    $id = $_REQUEST['id'];
    $imagen = getImage($id);
    delete($id, $imagen);
  }

  if($opcion == 'create_stock'){
    $id = $_REQUEST['id_producto'];
    $cantidad = $_REQUEST['cantidad'];
    $almacen = getCantidad($id);
    $nueva_cantidad = $almacen + $cantidad;
    save_stock($id, $nueva_cantidad);
  }

}

  // Funciones
  
  function paginar()
  {
     $productos = NEW Producto();
     $listadoProductos = $productos->paginar();
  }

  function index(){
    $productos = NEW Producto();
    $listadoProductos = $productos->index();
    if($listadoProductos !== false){
      foreach ($listadoProductos as $producto) {
        echo "<tr>";
        echo "<td>".$producto['id_producto']."</td>";
        echo "<td>".$producto['nombre_producto']."</td>";
        echo "<td>".$producto['descripcion']."</td>";
        echo "<td> <a href='../../".$producto['foto']."' target='_blank'>
                <img src='../../".$producto['foto']."' height='70px' width='70px'>
              </a></td>";
        echo "<td>".$producto['cantidad']."</td>";
        echo "<td>".$producto['valor']."</td>";
        echo "<td>
        <a class='btn btn-primary'  id='show' data-nit='".$producto['id_producto']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Ver</a>

        <a class='btn btn-warning' id='edit' data-nit='".$producto['id_producto']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-edit'></i> Editar</a>

        <a class='btn btn-danger' onClick=\"return confirm('Eliminar este Resgistro')\" href='../../../Controladores/ProductoController.php?opcion=delete&id=".$producto['id_producto']."'><i class='fa fa-trash'></i> Eliminar</a>
        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 2%;'><fieldset> No hay registros en la base de datos</fieldset></div>";
    }
  }

  function store($nombre, $descripcion, $foto, $cantidad, $valor) {
    $productos = new Producto();
    $resultado = $productos->store($nombre, $descripcion, $foto, $cantidad, $valor);
    if($resultado == true){
      $res = "Producto creado correctamente";
      header ('Location: ../Vistas/Admin/Productos/index.php?respuesta='.$res.'');
    }else{
      $error = "Error al crear el Producto";
      header ('Location: ../Vistas/Admin/Productos/index.php?error='.$error.'');
    }
  }

  function show($id){
  	$productos = new Producto();
  	$obtenerProducto = $productos->show($id);
  	foreach ($obtenerProducto as $producto) {
      echo "<div class='row'>";
        echo "<div class='form-group col-md-6'>";
          echo "<label class=''>Nombre Producto</label>";
          echo "<input type='text' class='form-control' readonly value='".$producto['nombre_producto']."'/>";
        echo "</div>";

        echo "<div class='form-group col-md-6'>";
          echo "<label class=''>Valor Producto</label>";
          echo "<input type='text' class='form-control' readonly value='".$producto['valor']."'/>";
        echo "</div>";
      echo "</div>";

     echo "<div class='row'>";
       echo "<div class='form-group col-md-6'>";
         echo "<label class=''>Descripción Producto</label>";
         echo "<input type='text' class='form-control' readonly value='".$producto['descripcion']."'/>";
       echo "</div>";
       echo "<div class='form-group col-md-6'>";
         echo "<label class=''>Cantidad Producto</label>";
         echo "<input type='text' class='form-control' readonly value='".$producto['cantidad']."'/>";
       echo "</div>";
     echo "</div>";


       echo "<div class='form-group'>";
         echo "<label class=''>Foto</label>";
         echo "<center>";
           echo "<a href='../../".$producto['foto']."' target='_blank'>
                   <img src='../../".$producto['foto']."' height='100px' width='100px'>
                 </a>";
         echo "</center>";
       echo "</div>";

  	}
  }

  function show_datos($id){
    $productos = new Producto();
    $obtenerProducto = $productos->show($id);
     foreach ($obtenerProducto as $producto) {
       echo '

       <div class="container">
     		<form action="../../../Controladores/ProductoController.php" method="post" enctype="multipart/form-data">
           <div class="form-group">
             <label for="">Nombre</label>
             <input type="text" name="nombre" class="form-control" placeholder="Ingrese Nombre" required value="'.$producto['nombre_producto'].'">
           </div>
           <div class="form-group">
             <label for="">Descripción</label>
             <input type="text" name="descripcion" class="form-control" placeholder="Ingrese Descripcion" required value="'.$producto['descripcion'].'">
           </div>
     			<div class="form-group">
     				<label for="">imagen</label>
             <input type="file" name="foto" class="form-control" required>
     			</div>

          <div class="form-group">
            <label for="">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" placeholder="Ingrese una cantidad" required value="'.$producto['cantidad'].'">
          </div>

           <div class="form-group">
             <label for="">Valor</label>
             <input type="number" name="valor" class="form-control" placeholder="Ingrese Valor" required value="'.$producto['valor'].'">
           </div>

           <input type="hidden" name="opcion" value="edit">
           <input type="hidden" name="id_producto" value="'.$producto['id_producto'].'">

           <input type="submit" hidden id="guardar_producto">

         </form>
     	</div>
       ';

     }
  }

  function edit($id, $nombre, $descripcion, $foto, $cantidad, $valor, $imagen) {
    $productos = new Producto();
  	$resultado = $productos->update($id, $nombre, $descripcion, $foto, $cantidad, $valor, $imagen);
    if($resultado == true){
      $res = "Producto editado correctamente";
      header ('Location: ../Vistas/Admin/Productos/index.php?respuesta='.$res.'');
    }else{
      $error = "Error al editar el Producto";
      header ('Location: ../Vistas/Admin/Productos/index.php?error='.$error.'');
    }
  }

  function getImage($id){
    $image = NEW Producto();
    $imagen = $image->getImage($id);
    return $imagen;
  }

  function delete($id, $imagen){
  	$productos = new Producto();
  	$resultado = $productos->delete($id, $imagen);
    if($resultado == true){
      $res = "Producto eliminado correctamente";
      header ('Location: ../Vistas/Admin/Productos/index.php?respuesta='.$res.'');
    }else{
      $error = "Error al eliminar el Producto";
      header ('Location: ../Vistas/Admin/Productos/index.php?error='.$error.'');
    }
  }

  function search($nombre){
    $productos = NEW Producto();
    $obtenerProducto = $productos->search($nombre);
    if($obtenerProducto !== false){
      foreach ($obtenerProducto as $producto) {
        echo "<tr>";
        echo "<td>".$producto['id_producto']."</td>";
        echo "<td>".$producto['nombre_producto']."</td>";
        echo "<td>".$producto['descripcion']."</td>";
        echo "<td> <a href='../../".$producto['foto']."' target='_blank'>
                <img src='../../".$producto['foto']."' height='70px' width='70px'>
              </a></td>";
        echo "<td>".$producto['cantidad']."</td>";
        echo "<td>".$producto['valor']."</td>";
        echo "<td>
        <a class='btn btn-primary'  id='show' data-nit='".$producto['id_producto']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Ver</a>

        <a class='btn btn-warning' id='edit' data-nit='".$producto['id_producto']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-edit'></i> Editar</a>

        <a class='btn btn-danger' onClick=\"return confirm('Eliminar este Resgistro')\" href='../../../Controladores/ProductoController.php?opcion=delete&id=".$producto['id_producto']."'><i class='fa fa-trash'></i> Eliminar</a>
        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 2%;'><fieldset> No se encontraron coincidencias</fieldset></div>";
    }
  }

  function stock(){
    $productos = NEW Producto();
    $listadoProductos = $productos->index();
    if($listadoProductos !== false){
      foreach ($listadoProductos as $producto) {
        echo "<tr>";
        echo "<td>".$producto['id_producto']."</td>";
        echo "<td>".$producto['nombre_producto']."</td>";
        echo "<td>".$producto['descripcion']."</td>";
        echo "<td> <a href='../../".$producto['foto']."' target='_blank'>
                <img src='../../".$producto['foto']."' height='70px' width='70px'>
              </a></td>";
        echo "<td>".$producto['cantidad']."</td>";
        echo "<td>".$producto['valor']."</td>";
        echo "<td>
        <button type='button' class='btn btn-outline-info'  id='nuevo_stock' data-nit='".$producto['id_producto']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Nueva Cantidad</button>

        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 2%;'><fieldset> No hay registros en la base de datos</fieldset></div>";
    }

  }

  function search_stock($nombre){
    $productos = NEW Producto();
    $obtenerProducto = $productos->search($nombre);
    if($obtenerProducto !== false){
      foreach ($obtenerProducto as $producto) {
        echo "<tr>";
        echo "<td>".$producto['id_producto']."</td>";
        echo "<td>".$producto['nombre_producto']."</td>";
        echo "<td>".$producto['descripcion']."</td>";
        echo "<td> <a href='../../".$producto['foto']."' target='_blank'>
                <img src='../../".$producto['foto']."' height='70px' width='70px'>
              </a></td>";
        echo "<td>".$producto['cantidad']."</td>";
        echo "<td>".$producto['valor']."</td>";
        echo "<td>

        <button type='button' class='btn btn-outline-info'  id='nuevo_stock' data-nit='".$producto['id_producto']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Nueva Cantidad</button>

        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 2%;'><fieldset> No se encontraron coincidencias</fieldset></div>";
    }
  }

  function save_stock($id, $cantidad){
    $productos = new Producto();
  	$resultado = $productos->save($id, $cantidad);
    if($resultado == true){
      $res = "Stock agregado correctamente";
      header ('Location: ../Vistas/Admin/Productos/stock.php?respuesta='.$res.'');
    }else{
      $error = "Error al agregar el stock del el Producto";
      header ('Location: ../Vistas/Admin/Productos/stock.php?error='.$error.'');
    }
  }

  function getCantidad($id){
    $almacen = NEW Producto();
    $cantidad = $almacen->getCantidad($id);
    return $cantidad;
  }
 ?>
