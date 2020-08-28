<?php @session_start();

  if($_SESSION["AUTENTICA"] != 'SI'){
    header('Location: ../Index/index.php?salir=true');
  }else{
    require_once '../../Modelos/Conexion.php';
    require_once '../../Modelos/Producto.php';
    require_once '../../Controladores/ProductoController.php';
  }
 ?>

<div class="container" style="margin-top: 8%;">
    <h1>Crear Productos</h1>
		<form action="../../Controladores/ProductoController.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="opcion" value="create">
      <div class="form-group">
        <label for="">Nombre</label>
        <input type="text" name="nombre" class="form-control" placeholder="Ingrese Nombre" required>
      </div>
      <div class="form-group">
        <label for="">Descripción</label>
        <input type="text" name="descripcion" class="form-control" placeholder="Ingrese Descripcion" required>
      </div>
			<div class="form-group">
				<label for="">imagen</label>
        <input type="file" name="foto" class="form-control" required>
			</div>
      <div class="form-group">
        <label for="">Valor</label>
        <input type="number" name="valor" class="form-control" placeholder="Ingrese Valor" required>
      </div>

      <div class="form-group">
        <input type="submit" name="" class="btn btn-success" value="Crear Producto">
        <a href="index.php" class="btn btn-primary">Volver</a>
      </div>
    </form>
	</div>
