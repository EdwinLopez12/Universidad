<?php

  /** usuarios
   * 	id_usuario	nombre_usuario		direccion	telefono	email	password	foto	rol
   */
  class Usuario{

    public function paginar()
    {
      $rows = NULL;
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM usuarios";
      $statement = $conexion->prepare($sql);
      $statement->execute();
      $tamano_paginas = 5; //Numero de registros por pagina
      $pagina = 1;      //Pagina principal
      if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1)
        {
          //header("Location: index.php?pagina=1");
        }else{
          $pagina = $_GET["pagina"];
        }
      }else{
        $pagina=1;
      }
      $empezar_desde =(($pagina-1 )*$tamano_paginas); //registro desde el que se empieze dependiendo de la pagina;
      $num_filas = $statement->rowcount(); //Saber el total de registros
      $total_paginas =ceil($num_filas / $tamano_paginas);//ceil redondea el resultado.
      //$posicion = (int)$_GET['pagina'];
      echo "<strong>".$pagina." de ".$total_paginas." </strong>";
      echo " <nav aria-label='Page navigation example'>";
      echo  " <ul class='pagination justify-content-center'>";
      echo    "<li class='page-item'>";
      if($pagina>=2)
      {
        $o = 1;
        echo "<a class='page-link' href='?pagina=1' tabindex='-1'>Primero</a>";
        echo "</li>";
      }
      for($i=1;$i<=$total_paginas;$i++)
      {
        echo "<li class='page-item'><a class='page-link' href='?pagina=".$i."'>".$i."</a></li>";
      }
      if($pagina < ($total_paginas))
      {
        echo "<a class='page-link' href='?pagina=".($total_paginas)."'>Ultimo</a>  ";
      }
      echo "</li></ul></nav>";
       echo "<br><br>";
    }

    
    public function index(){
      $rows = NULL;
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM usuarios";
      $statement = $conexion->prepare($sql);
      $statement->execute();

     $tamano_paginas = 5; //Numero de registros por pagina
      $pagina = 1;      //Pagina principal
      if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1)
        {
          //header("Location: index.php?pagina=1");
        }else{
          $pagina = $_GET["pagina"];
        }
      }else{
        $pagina=1;
      }
      $empezar_desde =(($pagina-1 )*$tamano_paginas); //registro desde el que se empieze dependiendo de la pagina;
      $num_filas = $statement->rowcount(); //Saber el total de registros
      $total_paginas =ceil($num_filas / $tamano_paginas);//ceil redondea el resultado.
      //$posicion = (int)$_GET['pagina'];
      $sql_limit = "SELECT * FROM usuarios LIMIT $empezar_desde,$tamano_paginas";
      $statement = $conexion->prepare($sql_limit);
      $statement->execute();
      while($resultado = $statement->fetch()){
        $contador +=1;
        $rows[] = $resultado;
      }
      if ($contador == 0) {
        return false;
      }else{
        return $rows;
    }
  }

    public function show($id){
     $modelo = new Conexion();
     $conexion = $modelo->getConexion();
     $sql = "SELECT * FROM usuarios WHERE id_usuario = :id";
     $statement = $conexion->prepare($sql);
     $statement->bindParam(':id',$id);
     $statement->execute();
     $resultado= $statement->fetchAll();
     return $resultado;
    }

    public function store($nombre,$direccion, $telefono, $email, $password, $foto, $rol){
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "INSERT INTO usuarios(nombre_usuario,direccion,telefono,email,password,foto,rol) VALUES(:nombre,:direccion,:telefono,:email,:password,:foto,:rol)";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':nombre',$nombre);
      $statement->bindParam(':direccion',$direccion);
      $statement->bindParam(':telefono',$telefono);
      $statement->bindParam(':email',$email);
      $statement->bindParam(':password',$password);
      $statement->bindParam(':foto',$foto);
      $statement->bindParam(':rol',$rol);

      if(!$statement){
        return false;
      }else{
        $statement->execute();
        return true;
      }
    }

    public function update_a($id, $rol){
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "UPDATE usuarios SET rol = :rol WHERE id_usuario =:id";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':rol',$rol);
      $statement->bindParam(':id',$id);

      if(!$statement){
        return false;
      }else{
        $statement->execute();
        return true;
      }
    }

    public function update_u($id, $nombre,$direccion, $telefono, $email, $password, $foto, $rol, $imagen){
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "UPDATE usuarios SET nombre_usuario = :nombre, direccion = :direccion, telefono = :telefono, email = :email, password = :password, foto = :foto, rol = :rol WHERE id_usuario = :id";

      $statement = $conexion->prepare($sql);
      $statement->bindParam(':nombre',$nombre);
      $statement->bindParam(':direccion',$direccion);
      $statement->bindParam(':telefono',$telefono);
      $statement->bindParam(':email',$email);
      $statement->bindParam(':password',$password);
      $statement->bindParam(':foto',$foto);
      $statement->bindParam(':rol',$rol);
      $statement->bindParam(':id',$id);


      if(!$statement){
        return false;
      }else{
        $statement->execute();
        unlink(''.$imagen.'');
        return true;
      }
    }

    public function delete($id, $imagen){
      $modelo = new Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "DELETE FROM usuarios WHERE id_usuario =:id";
  		$statement = $conexion->prepare($sql);
  		$statement->bindParam(':id', $id);

  		if(!$statement){
  			return false;
  		}else{
  			$statement->execute();
        unlink(''.$imagen.'');
  			return true;
  		}
    }

    public function search($nombre){
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $dato = "%".$nombre."%";
      $sql = "SELECT * FROM usuarios WHERE nombre_usuario LIKE :dato OR email LIKE :dato OR direccion LIKE :dato OR telefono LIKE :dato OR rol LIKE :dato  ORDER BY nombre_usuario DESC";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':dato', $dato);
      $statement->execute();

      while($resultado = $statement->fetch()){
        $contador +=1;
        $rows[] = $resultado;
      }
      if ($contador == 0) {
        return false;
      }else{
        return $rows;
      }
    }

    public function getImage($id){
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM usuarios WHERE id_usuario = :id";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':id',$id);
      $statement->execute();
      $resultado= $statement->fetch();
      return $resultado['foto'];
    }


  }
 ?>
