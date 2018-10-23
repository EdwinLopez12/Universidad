<?php

  $dir_subida = '../Public/imagenes/Usuarios/';

  if(isset($_REQUEST['opcion'])){
    require_once '../Modelos/Conexion.php';
    require_once '../Modelos/Usuario.php';

    $opcion = $_REQUEST['opcion'];
    date_default_timezone_set('America/Bogota');

    if($opcion == 'create'){
      $nombre = $_REQUEST['nombre'];
      $direccion = $_REQUEST['direccion'];
      $telefono = $_REQUEST['telefono'];
      $email = $_REQUEST['email'];
      $password = $_REQUEST['password'];
      $password2 = $_REQUEST['password2'];
      $rol = $_REQUEST['rol'];
      $horario = date('y_m_d_H_i_s_');

      if($password == $password2){
          if($rol == 'no'){
            $error = "Debe seleccionar un rol para el usuario a crear";
            header ('Location: ../Vistas/Admin/Usuarios/index.php?error='.$error.'');
          }else{
            $password = password_hash($password2, PASSWORD_BCRYPT);
            // tamaño de la imagen
            if($_FILES['foto']['size']< 10000000){
              //extension de la imagen
              $ext = explode(".",$_FILES['foto']['name']);
              if(strtolower($ext[1]) == "png" || strtolower($ext[1] == "jpg") || strtolower($ext[1] == "jpeg") || strtolower($ext[1] == "tif")){
                $fichero_subido = $dir_subida.$horario.basename($_FILES['foto']['name']);
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
                  store($nombre,$direccion, $telefono, $email, $password, $fichero_subido, $rol);
                } else {
                  $error = "No se pudo almacenar";
                  header ('Location: ../Vistas/Admin/Usuarios/index.php?error='.$error.'');
                }
              }else{
                $error = "La archivo no es permitido, las extensiones permitidas son: png, jpg, jpeg y tif";
                header ('Location: ../Vistas/Admin/Usuarios/index.php?error='.$error.'');
              }
            }else{
              $error = "El archivo es demasiado grande";
              header ('Location: ../Vistas/Admin/Usuarios/index.php?error='.$error.'');
            }
          }
        }else{
          $error = "Las contraseñas no coinciden";
          header ('Location: ../Vistas/Admin/Usuarios/index.php?error='.$error.'');
        }
    }

    if($opcion == 'edit_admin'){
      $id = $_REQUEST['id_usuario'];
      $rol = $_REQUEST['rol'];

      if($rol == 'no'){
        $error = "Debe seleccionar un rol para el usuario";
        header ('Location: ../Vistas/Admin/Usuarios/index.php?error='.$error.'');
      }else{
        update_a($id, $rol);
      }
    }

    if($opcion === 'delete'){
      $id = $_REQUEST['id'];
      $imagen = getImage($id);
      delete($id, $imagen);
    }

    // opciones cliente

    if($opcion == 'create_u'){
      $nombre = $_REQUEST['nombre'];
      $direccion = $_REQUEST['direccion'];
      $telefono = $_REQUEST['telefono'];
      $email = $_REQUEST['email'];
      $password = $_REQUEST['password'];
      $password2 = $_REQUEST['password2'];
      $rol = $_REQUEST['rol'];
      $horario = date('y_m_d_H_i_s_');

      if($password == $password2){
        $password = password_hash($password2, PASSWORD_BCRYPT);
        // tamaño de la imagen
        if($_FILES['foto']['size']< 10000000){
          //extension de la imagen
          $ext = explode(".",$_FILES['foto']['name']);
          if(strtolower($ext[1]) == "png" || strtolower($ext[1] == "jpg") || strtolower($ext[1] == "jpeg") || strtolower($ext[1] == "tif")){
            $fichero_subido = $dir_subida.$horario.basename($_FILES['foto']['name']);
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
              store_u($nombre,$direccion, $telefono, $email, $password, $fichero_subido, $rol);
            } else {
              $error = "No se pudo almacenar";
              header ('Location: ../Vistas/Index/index.php?error='.$error.'');
            }
          }else{
            $error = "La archivo no es permitido, las extensiones permitidas son: png, jpg, jpeg y tif";
            header ('Location: ../Vistas/Index/index.php?error='.$error.'');
          }
        }else{
          $error = "El archivo es demasiado grande";
          header ('Location: ../Vistas/Index/index.php?error='.$error.'');
        }
      }else{
        $error = "Las contraseñas no coinciden";
        header ('Location: ../Vistas/Index/index.php?error='.$error.'');
      }
    }



    if($opcion == 'edit'){
      $id = $_REQUEST['id'];
      $nombre = $_REQUEST['nombre'];
      $direccion = $_REQUEST['direccion'];
      $telefono = $_REQUEST['telefono'];
      $email = $_REQUEST['email'];
      $password = $_REQUEST['password'];
      $password2 = $_REQUEST['password2'];
      $rol = $_REQUEST['rol'];
      $horario = date('y_m_d_H_i_s_');

      if($password == $password2){
        $password = password_hash($password2, PASSWORD_BCRYPT);
        // tamaño de la imagen
        if($_FILES['foto']['size']< 10000000){
          //extension de la imagen
          $ext = explode(".",$_FILES['foto']['name']);
          if(strtolower($ext[1]) == "png" || strtolower($ext[1] == "jpg") || strtolower($ext[1] == "jpeg") || strtolower($ext[1] == "tif")){
            $fichero_subido = $dir_subida.$horario.basename($_FILES['foto']['name']);
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
              $imagen = getImage($id);
              edit_u($id, $nombre,$direccion, $telefono, $email, $password, $fichero_subido, $rol, $imagen);
            } else {
              $error = "No se pudo almacenar";
              header ('Location: ../Vistas/Cliente/index.php?error='.$error.'');
            }
          }else{
            $error = "La archivo no es permitido, las extensiones permitidas son: png, jpg, jpeg y tif";
            header ('Location: ../Vistas/Cliente/index.php?error='.$error.'');
          }
        }else{
          $error = "El archivo es demasiado grande";
          header ('Location: ../Vistas/Cliente/index.php?error='.$error.'');
        }
      }else{
        $error = "Las contraseñas no coinciden";
        header ('Location: ../Vistas/Cliente/index.php?error='.$error.'');
      }
    }


  }
  /** usuarios
   * 	id_usuario	nombre	direccion	telefono	email	password	foto	rol
   */

  // Funciones

   function paginar()
  {
     $usuarios = NEW Usuario();
     $listadoUsuarios = $usuarios->paginar();
  }


  function index(){
    $usuarios = NEW Usuario();
    $listadoUsuarios = $usuarios->index();
    if($listadoUsuarios !== false){
      foreach ($listadoUsuarios as $usuario) {
        echo "<tr>";
        echo "<td>".$usuario['id_usuario']."</td>";
        echo "<td>".$usuario['nombre_usuario']."</td>";
        echo "<td>".$usuario['direccion']."</td>";
        echo "<td>".$usuario['telefono']."</td>";
        echo "<td>".$usuario['email']."</td>";
        echo "<td> <a href='../../".$usuario['foto']."' target='_blank'>
                <img src='../../".$usuario['foto']."' height='70px' width='70px'>
              </a></td>";
        echo "<td>".$usuario['rol']."</td>";
        echo "<td>
        <a class='btn btn-primary'  id='show' data-nit='".$usuario['id_usuario']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Ver</a>

        <a class='btn btn-warning' id='edit' data-nit='".$usuario['id_usuario']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-edit'></i> Editar</a>

        <a class='btn btn-danger' onClick=\"return confirm('Eliminar este Resgistro')\" href='../../../Controladores/UsuarioController.php?opcion=delete&id=".$usuario['id_usuario']."'><i class='fa fa-trash'></i> Eliminar</a>
        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 2%;'><fieldset> No hay registros en la base de datos</fieldset></div>";
    }
  }

  function store($nombre,$direccion, $telefono, $email, $password, $foto, $rol){
    $usuarios = new Usuario();
    $resultado = $usuarios->store($nombre,$direccion, $telefono, $email, $password, $foto, $rol);
    if($resultado == true){
      $res = "Usuario creado correctamente";
      header ('Location: ../Vistas/Admin/Usuarios/index.php?respuesta='.$res.'');
    }else{
      $error = "Error al crear el Usuario";
      header ('Location: ../Vistas/Admin/Usuarios/index.php?error='.$error.'');
    }
  }

  function show($id){
  	$usuarios = new Usuario();
  	$listadoUsuarios = $usuarios->show($id);
  	foreach ($listadoUsuarios as $usuario) {
      echo "<div class='row'>";
        echo "<div class='form-group col-md-6'>";
          echo "<label class=''>Nombre Usuario</label>";
          echo "<input type='text' class='form-control' readonly value='".$usuario['nombre_usuario']."'/>";
        echo "</div>";

        echo "<div class='form-group col-md-6'>";
          echo "<label class=''>Direccion Usuario</label>";
          echo "<input type='text' class='form-control' readonly value='".$usuario['direccion']."'/>";
        echo "</div>";
      echo "</div>";

      echo "<div class='row'>";
        echo "<div class='form-group col-md-6'>";
          echo "<label class=''>Telefono</label>";
          echo "<input type='text' class='form-control' readonly value='".$usuario['telefono']."'/>";
          echo "</div>";
          echo "<div class='form-group col-md-6'>";
            echo "<label class=''>Rol</label>";
            echo "<input type='text' class='form-control' readonly value='".$usuario['rol']."'/>";
          echo "</div>";
      echo "</div>";

      echo "<div class='form-group'>";
        echo "<label class=''>Email</label>";
        echo "<input type='text' class='form-control' readonly value='".$usuario['email']."'/>";
      echo "</div>";

      echo "<div class='form-group'>";
        echo "<label class=''>Foto</label>";
        echo "<center>";
          echo "<a href='../../".$usuario['foto']."' target='_blank'>
                  <img src='../../".$usuario['foto']."' height='100px' width='100px'>
                </a>";
        echo "</center>";
      echo "</div>";

  	}
  }

  function show_datos($id){
    $usuarios = new Usuario();
    $listadoUsuarios = $usuarios->show($id);
     foreach ($listadoUsuarios as $usuario) {
       echo '

       <div class="container">
     		<form action="../../../Controladores/UsuarioController.php" method="post" enctype="multipart/form-data">

          <div class="form-group">
           <label for="">Rol</label>
           <select class="custom-select" name="rol">
             <option value="no" selected>Seleccione un rol</option>
             <option value="cliente">Cliente</option>
             <option value="administrador">Administrador</option>
           </select>
         </div>


           <input type="hidden" name="opcion" value="edit_admin">
           <input type="hidden" name="id_usuario" value="'.$usuario['id_usuario'].'">

           <input type="submit" hidden id="guardar_usuario">

         </form>
     	</div>
       ';

     }
  }

  function show_datos_edit_u($id){
    $usuarios = new Usuario();
    $listadoUsuarios = $usuarios->show($id);
     foreach ($listadoUsuarios as $usuario) {
       echo '
       <div class="container">
         <form action="../../Controladores/UsuarioController.php" method="post" enctype="multipart/form-data">
           <fieldset>
             <div class="row">
              <div class="form-group col-md-6">
                <label for="">Nombre</label>
                <input type="text" name="nombre" required placeholder="Ingrese su nombre" value="'.$usuario['nombre_usuario'].'" class="form-control">
              </div>

              <div class="form-group col-md-6">
                <label for="">Direccion</label>
                <input type="text" name="direccion" required placeholder="Ingrese su direccion" value="'.$usuario['direccion'].'" class="form-control">
              </div>
            </div>

           <div class="form-group">
             <label for="">Email</label>
             <input type="email" name="email" class="form-control" placeholder="Ingrese su Email" value="'.$usuario['email'].'" required>
           </div>

           <div class="row">
             <div class="form-group col-md-6">
               <label for="">Telefono</label>
               <input type="text" name="telefono" class="form-control" placeholder="Ingrese su telefono" value="'.$usuario['telefono'].'" required>
             </div>
             <div class="form-group col-md-6">
               <label for="">Foto</label>
               <input type="file" name="foto" class="form-control" required>
             </div>
           </div>

           <div class="row">
             <div class="form-group col-md-6">
               <label for="">Contraseña</label>
               <input type="password" name="password" class="form-control" placeholder="Ingrese una Contraseña" required>
             </div>
             <div class="form-group col-md-6">
               <label for="">Repita la contraseña</label>
               <input type="password" name="password2" class="form-control" placeholder="Repita la contraseña" required>
             </div>
           </div>

             <input type="hidden" name="rol" value="cliente">
             <input type="hidden" name="id" value="'.$usuario['id_usuario'].'">

             <input type="hidden" name="opcion" value="edit">
             <input type="submit" hidden name="guardar" class="btn btn-success" id="guardar_usuario"></input>

           </fieldset>
         </form>
       </div>
       ';

     }
  }

  function update_a($id, $rol){
    $usuarios = new Usuario();
    $resultado = $usuarios->update_a($id, $rol);
    if($resultado == true){
      $res = "Usuario editado correctamente";
      header ('Location: ../Vistas/Admin/Usuarios/index.php?respuesta='.$res.'');
    }else{
      $error = "Error al editar el Usuario";
      header ('Location: ../Vistas/Admin/Usuarios/index.php?error='.$error.'');
    }
  }

  function edit_u($id, $nombre,$direccion, $telefono, $email, $password, $foto, $rol, $imagen){
    $usuarios = new Usuario();
    $resultado = $usuarios->update_u($id, $nombre,$direccion, $telefono, $email, $password, $foto, $rol, $imagen);
    if($resultado == true){

      $res = "Editado correctamente";
      header ('Location: ../Vistas/Cliente/index.php?respuesta='.$res.'&imagen='.$foto.'');
    }else{
      $error = "Error al editar";
      header ('Location: ../Vistas/Cliente/index.php?error='.$error.'');
    }
  }

  function getImage($id){
    $image = NEW Usuario();
    $imagen = $image->getImage($id);
    return $imagen;
  }

  function delete($id, $imagen){
    $usuario = NEW Usuario();
    $resultado = $usuario->delete($id, $imagen);

    if($resultado == true){
      $res = "Usuario eliminado correctamente";
      header ('Location: ../Vistas/Admin/Usuarios/index.php?respuesta='.$res.'');
    }else{
      $error = "Error al eliminar el Usuario";
      header ('Location: ../Vistas/Admin/Usuarios/index.php?error='.$error.'');
    }
  }

  function search($nombre){
    $usuarios = new Usuario();
    $listadoUsuarios = $usuarios->search($nombre);
    if($listadoUsuarios !== false){
      foreach ($listadoUsuarios as $usuario) {
        echo "<tr>";
        echo "<td>".$usuario['id_usuario']."</td>";
        echo "<td>".$usuario['nombre_usuario']."</td>";
        echo "<td>".$usuario['direccion']."</td>";
        echo "<td>".$usuario['telefono']."</td>";
        echo "<td>".$usuario['email']."</td>";
        echo "<td> <a href='../../".$usuario['foto']."' target='_blank'>
                <img src='../../".$usuario['foto']."' height='70px' width='70px'>
              </a></td>";
        echo "<td>".$usuario['rol']."</td>";
        echo "<td>
        <a class='btn btn-primary'  id='show' data-nit='".$usuario['id_usuario']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Ver</a>

        <a class='btn btn-warning' id='edit' data-nit='".$usuario['id_usuario']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-edit'></i> Editar</a>

        <a class='btn btn-danger' onClick=\"return confirm('Eliminar este Resgistro')\" href='../../../Controladores/UsuarioController.php?opcion=delete&id=".$usuario['id_usuario']."'><i class='fa fa-trash'></i> Eliminar</a>
        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-warning' role='alert' style='margin-top: 2%;'><fieldset> No se encontraron coincidencias</fieldset></div>";
    }
  }

  function store_u($nombre,$direccion, $telefono, $email, $password, $foto, $rol){
    $usuarios = new Usuario();
    $resultado = $usuarios->store($nombre,$direccion, $telefono, $email, $password, $foto, $rol);
    if($resultado == true){
      $res = "Usuario creado correctamente";
      header ('Location: ../Vistas/Index/index.php?respuesta='.$res.'');
    }else{
      $error = "Error al crear el Usuario";
      header ('Location: ../Vistas/Index/index.php?error='.$error.'');
    }
  }
 ?>
