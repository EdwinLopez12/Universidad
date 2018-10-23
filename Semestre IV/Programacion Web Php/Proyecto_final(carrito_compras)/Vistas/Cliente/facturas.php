
<?php @session_start();
  require_once '../../Modelos/Conexion.php';
  require_once '../../Modelos/Usuario.php';
  require_once '../../Controladores/UsuarioController.php';


  $id = $_SESSION['id'];
 ?>


 <div class="modal-header">
   <h5 class="modal-title"> Ver facturas</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>
 <div class="modal-body">
   <?php ver_facturas($id); ?>
 </div>

 <div class="modal-footer">
   <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
 </div>

 <script type="text/javascript">

 </script>
