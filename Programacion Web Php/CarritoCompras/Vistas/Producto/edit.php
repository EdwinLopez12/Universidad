<?php @session_start();

  if($_SESSION["AUTENTICA"] != 'SI'){
    header('Location: ../Index/index.php?salir=true');
  }else{
    require_once '../../Modelos/Conexion.php';
    require_once '../../Modelos/Producto.php';
    require_once '../../Controladores/ProductoController.php';

    $id = $_REQUEST['nit'];

    $modelo = new Conexion();
    $conexion = $modelo->getConexion();
    $sql = "SELECT * FROM productos WHERE id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->execute();
    $resultado= $statement->fetchAll();
  }
 ?>

 <div class="modal-header">
    <h5 class="modal-title"> Editar Producto</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <?php
       foreach ($resultado as $producto) {
     ?>
    <form action="../../Controladores/ProductoController.php" method="post" enctype="multipart/form-data">
       <input type="hidden" name="opcion" value="edit">
       <input type="hidden" name="id" value="<?php echo $producto['id']?>">

       <div class="form-group">
         <label for="">Nombre</label>
         <input type="text" name="nombre" class="form-control" placeholder="Ingrese el Nombre del producto" required value="<?php echo $producto['nombre'] ?>">
       </div>

       <div class="form-group">
         <label for="">Descripción</label>
         <input type="text" name="descripcion" class="form-control" placeholder="Ingrese la descripcion" required value="<?php echo $producto['descripcion'] ?>">
       </div>

       <div class="form-group">
         <label for="">Imagen</label>
         <input type="file" name="foto" class="form-control" placeholder="Ingrese la nueva imagen" required value="">
       </div>

       <div class="form-group">
         <label for="">Valor</label>
         <input type="number" name="valor" class="form-control" placeholder="Ingrese el valor" required value="<?php echo $producto['valor']?>">
       </div>
       
       <input type="submit" name="" id="guardar" class="btn btn-success" value="" style="display:none;">
     </form>
  </div>
  <div class="modal-footer">
    <button id="env" class="btn btn-success"> Guardar datos</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
  </div>

  <?php } ?>

  <script type="text/javascript">
    $(document).ready(function () {
      $("#env").on("click", function () {
        $("#guardar").click();
      });
    });

  </script>
