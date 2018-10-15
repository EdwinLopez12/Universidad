<?php
  $dir_subida = '../Public/imagenes/Usuarios/';
  
  if (isset($_REQUEST['opcion'])) {
    require_once '../Modelos/Conexion.php';
    require_once '../Modelos/Usuario.php';

    $opcion = $_REQUEST['opcion'];

    if ($opcion == 'create') {
      $nombre = $_REQUEST['nombre'];
      $email = $_REQUEST['email'];
      $password = $_REQUEST['password'];

      $fichero_subido = $dir_subida.basename($_FILES['foto']['name']);
      if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
  		    // echo "El fichero es válido y se subió con éxito.\n";
  		} else {
  		    // echo "¡Posible ataque de subida de ficheros!\n";
  		}
      store($nombre, $email, $password, $fichero_subido);
    }

    if ($opcion == 'edit') {
      $id = $_REQUEST['id'];
      $nombre = $_REQUEST['nombre'];
      $email = $_REQUEST['email'];
      $password = $_REQUEST['password'];

      $fichero_subido = $dir_subida.basename($_FILES['foto']['name']);
      if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
  		    // echo "El fichero es válido y se subió con éxito.\n";
  		} else {
  		    // echo "¡Posible ataque de subida de ficheros!\n";
  		}
      edit($id, $nombre, $email, $password, $fichero_subido);
    }

    if($opcion === 'delete'){
      $id = $_REQUEST['id'];
      delete($id);
    }
  }

  function index(){
  	$usuarios = new Usuario();
  	$listadoUsuarios = $usuarios->index();
    if($listadoUsuarios !== false){
      foreach($listadoUsuarios as $usuario){
        echo "<tr>";
        echo "<td>".$usuario['id']."</td>";
        echo "<td>".utf8_encode($usuario['nombre_usuario'])."</td>";
        echo "<td>".$usuario['email']."</td>";
        echo "<td> <img src='../".$usuario['foto']."' height='50px' width='50px'></td>";
        echo "<td>
        <a class='btn btn-primary' id='show' data-nit='".$usuario['id']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-search'></i> Ver</a>

        <a class='btn btn-warning' id='edit' data-nit='".$usuario['id']."' data-toggle='modal' data-target='#ModalContainer'><i class='fa fa-edit'></i> Editar</a>

        <a class='btn btn-danger' onClick=\"return confirm('Eliminar este Resgistro')\" href='../../Controladores/UsuarioController.php?opcion=delete&id=".$usuario['id']."'><i class='fa fa-trash'></i> Eliminar</a>
        </td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-success' style='margin-top: 2%;'><fieldset> No hay registros en la base de datos</fieldset></div>";
    }
  }

  function show($id){
  	$usuarios = new Usuario();
  	$listadoUsuarios = $usuarios->show($id);
  	foreach ($listadoUsuarios as $usuario) {
  		echo "<div class='form-group'>";
  		echo "<label class=''>Nombre Usuario</label>";
  		echo "<input type='text' class='form-control' readonly value='".utf8_encode($usuario['nombre_usuario'])."'/>";

  		echo "<label class=''>Descripción Usuario</label>";
  		echo "<input type='email' class='form-control' readonly value='".$usuario['email']."'/>";

      echo "<label class=''>Foto</label>";
      echo "<br /><img src='../".$usuario['foto']."' height='50px' width='50px'>";

      echo "</div>";
  	}
  }

  function edit($id, $nombre, $email, $password, $foto){
    $usuarios = NEW Usuario();
    $resultado = $usuarios->update($id, $nombre, $email, $password, $foto);
    header ('Location: ../Vistas/Usuario/index.php?respuesta='.$resultado.'');
  }

  function store($nombre, $email, $password, $foto){
    $usuario = NEW Usuario();
    $resultado = $usuario->store($nombre, $email, $password, $foto);
    header ('Location: ../Vistas/Usuario/index.php?respuesta='.$resultado.'');
  }

  function delete(){
    $id = $_GET['id'];
    $usuario = NEW Usuario();
    $resultado = $usuario->delete($id);
    header ('Location: ../Vistas/Usuario/index.php?respuesta='.$resultado.'');
  }

  function search($nombre){
    $usuarios = NEW Usuario();
    $listadoUsuarios = $usuarios->search($nombre);
    if($listadoUsuarios !== false){
      foreach ($listadoUsuarios as $usuario) {
        echo "<tr>";
        echo "<td>".$usuario['id']."</td>";
        echo "<td>".$usuario['nombre_usuario']."</td>";
        echo "<td>".$usuario['email']."</td>";
        echo "<td> <img src='../".$usuario['foto']."' height='50px' width='50px'></td>";
        echo "</tr>";
      }
    }else{
      echo "<div class='alert alert-success' style='margin-top: 2%;'><fieldset> No se encontraron coincidencias</fieldset></div>";
    }
  }
 ?>
