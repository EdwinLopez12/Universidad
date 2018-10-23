  <div class="modal-header">
    <h5 class="modal-title"> Crear Producto</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="container">
  		<form action="../../../Controladores/ProductoController.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="">Nombre</label>
          <input type="text" name="nombre" class="form-control" placeholder="Nombre Producto" required>
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

        <input type="hidden" name="opcion" value="create">
        <input type="hidden" name="cantidad" value="0">

        <input type="submit" hidden id="guardar_producto">

      </form>
  	</div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-success" id="guardar">Crear Producto</button>
    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
  </div>

  <script type="text/javascript">
     $(document).ready(function () {
       $("#guardar").on("click", function () {
         $("#guardar_producto").click();
       });
     });

   </script>
