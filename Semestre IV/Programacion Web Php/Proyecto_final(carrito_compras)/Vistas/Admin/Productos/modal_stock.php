<?php
  require_once '../../../Modelos/Conexion.php';
  require_once '../../../Modelos/Producto.php';
  require_once '../../../Controladores/ProductoController.php';
  if(isset($_REQUEST['nit'])){
      $id = $_REQUEST['nit'];
    }
 ?>


<div class="modal-header">
  <h5 class="modal-title"> Registrar nueva cantidad del Producto</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="container">
    <form action="../../../Controladores/ProductoController.php" method="post">
      <div class="form-group">
        <label for="">Cantidad</label>
        <input type="number" name="cantidad" class="form-control" required>
      </div>

      <input type="hidden" name="opcion" value="create_stock">
      <input type="hidden" name="id_producto" value="<?php echo $id ?>">
      <input type="submit" hidden id="guardar_producto">
    </form>
  </div>
</div>
<div class="modal-footer">
     <button type="button" class="btn btn-outline-success" id="guardar">Guardar datos</button>
  <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
</div>

<script type="text/javascript">

  $(document).on("click", "#guardar", function () {
    $("#guardar_producto").click();
  });
</script>
