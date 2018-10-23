<?php @session_start();
  require_once '../../Modelos/Conexion.php';
  require_once '../../Modelos/Usuario.php';
  require_once '../../Controladores/UsuarioController.php';


  $id = $_SESSION['id'];
 ?>


 <div class="modal-header">
   <h5 class="modal-title"> Editar Usuario</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>
 <div class="modal-body">
   <?php show_datos_edit_u($id); ?>
 </div>

 <div class="modal-footer">
      <button type="button" class="btn btn-outline-success" id="guardar">Guardar datos</button>
   <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
 </div>

 <script type="text/javascript">

   $(document).on("click", "#guardar", function () {
     $("#guardar_usuario").click();
   });
 </script>
