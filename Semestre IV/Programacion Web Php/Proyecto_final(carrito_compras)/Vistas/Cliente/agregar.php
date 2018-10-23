<?php
  require_once '../../Modelos/Conexion.php';
  require_once '../../Modelos/Factura.php';
  require_once '../../Controladores/FacturaController.php';
  
  if(isset($_REQUEST['nit'])){
      $id = $_REQUEST['nit'];
    }
 ?>


 <div class="modal-header">
   <h5 class="modal-title"> Añadir Productos</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>
 <div class="modal-body">
   <?php mostrarDatos($id); ?>
 </div>

 <div class="modal-footer">
      <button type="button" class="btn btn-outline-success" id="guardar">Añadir al carro</button>
   <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
 </div>

 <script type="text/javascript">

   $(document).on("click", "#guardar", function () {
     $("#agregar_producto").click();
   });
 </script>
