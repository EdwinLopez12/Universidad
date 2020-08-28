<?php @session_start();

  if($_SESSION["AUTENTICA"] != 'SI'){
    header('Location: ../Index/index.php?salir=true');
  }else{
    require_once '../../Modelos/Conexion.php';
    require_once '../../Modelos/Usuario.php';
    require_once '../../Controladores/UsuarioController.php';

    $id = $_REQUEST['nit'];

    $modelo = new Conexion();
    $conexion = $modelo->getConexion();
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->execute();
    $resultado= $statement->fetchAll();
  }
 ?>

 <div class="modal-header">
    <h5 class="modal-title"> Editar Usuarios</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <?php
       foreach ($resultado as $usuario) {
     ?>
     <form action="../../Controladores/UsuarioController.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="opcion" value="edit">
        <input type="hidden" name="id" value="<?php echo $usuario['id']?>">

        <div class="form-group">
          <label for="">Nombre</label>
          <input type="text" name="nombre" class="form-control" placeholder="Ingrese Nombre del usuario" required value="<?php echo $usuario['nombre_usuario']; ?>">
        </div>

        <div class="form-group">
          <label for="">Email</label>
          <input type="email" name="email" class="form-control" placeholder="Ingrese el Email" required value="<?php echo $usuario['email'] ?>">
        </div>

        <div class="form-group">
          <label for="">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Ingrese una Contraseña" required value="<?php echo $usuario['password'] ?>">
        </div>

        <div class="form-group">
          <label for="">imagen</label>
           <input type="file" name="foto" class="form-control" placeholder="Ingrese la nueva imagen" required value="">
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
