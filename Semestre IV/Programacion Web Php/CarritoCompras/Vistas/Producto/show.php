<?php @session_start();

  if($_SESSION["AUTENTICA"] != 'SI'){
    header('Location: ../Index/index.php?salir=true');
  }else{
    require_once '../../Modelos/Conexion.php';
    require_once '../../Modelos/Producto.php';
    require_once '../../Controladores/ProductoController.php';

    if(isset($_REQUEST['nit'])){
      $id = $_REQUEST['nit'];
    }
  }
 ?>

<div class="modal-header">
  <h5 class="modal-title"> Detalles Producto</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <?php show($id); ?>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
</div>
