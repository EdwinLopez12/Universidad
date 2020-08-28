<?php

  /** productos
   * 	id_producto	nombre	descripcion	foto	cantidad	valor
   */
  class Producto{

    public function paginar()
    {
      $rows = NULL;
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM productos";
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
      $sql = "SELECT * FROM productos";
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
      $sql_limit = "SELECT * FROM productos LIMIT $empezar_desde,$tamano_paginas";
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

    public function store($nombre, $descripcion, $foto, $cantidad, $valor){
      $modelo = new Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "INSERT INTO productos(nombre_producto,descripcion,foto, cantidad, valor) VALUES(:nombre,:descripcion,:foto, :cantidad, :valor)";
  		$statement = $conexion->prepare($sql);
  		$statement->bindParam(':nombre',$nombre);
  		$statement->bindParam(':descripcion',$descripcion);
  		$statement->bindParam(':foto',$foto);
      $statement->bindParam(':cantidad',$cantidad);
  		$statement->bindParam(':valor',$valor);

      if(!$statement){
        return false;
      }else{
        $statement->execute();
        return true;
      }
    }

    public function show($id){
     $modelo = new Conexion();
     $conexion = $modelo->getConexion();
     $sql = "SELECT * FROM productos WHERE id_producto = :id";
     $statement = $conexion->prepare($sql);
     $statement->bindParam(':id',$id);
     $statement->execute();
     $resultado= $statement->fetchAll();
     return $resultado;
    }

    public function update($id, $nombre, $descripcion, $foto, $cantidad, $valor, $imagen){
      $modelo = NEW Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "UPDATE productos SET nombre_producto = :nombre, descripcion = :descripcion, foto = :foto, cantidad = :cantidad, valor =:valor WHERE id_producto=:id";
  		$statement = $conexion->prepare($sql);
  		$statement->bindParam(':nombre', $nombre);
  		$statement->bindParam(':descripcion', $descripcion);
      $statement->bindParam(':foto', $foto);
      $statement->bindParam(':cantidad', $cantidad);
  		$statement->bindParam(':valor', $valor);
  		$statement->bindParam(':id', $id);

      if(!$statement){
        return false;
      }else{
        $statement->execute();
        unlink(''.$imagen.'');
        return true;
      }
    }

    public function getImage($id){
     $modelo = new Conexion();
     $conexion = $modelo->getConexion();
     $sql = "SELECT * FROM productos WHERE id_producto = :id";
     $statement = $conexion->prepare($sql);
     $statement->bindParam(':id',$id);
     $statement->execute();
     $resultado= $statement->fetch();
     return $resultado['foto'];
    }

    public function delete($id, $imagen){
  		$modelo = NEW Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "DELETE FROM productos WHERE id_producto =:id";
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
      $sql = "SELECT * FROM productos WHERE nombre_producto LIKE :dato OR descripcion LIKE :dato OR valor LIKE :dato ORDER BY nombre_producto DESC";
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

    public function save($id, $cantidad){
      $modelo = NEW Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "UPDATE productos SET cantidad = :cantidad WHERE id_producto =:id";
  		$statement = $conexion->prepare($sql);
      $statement->bindParam(':cantidad', $cantidad);
      $statement->bindParam(':id', $id);

      if(!$statement){
        return false;
      }else{
        $statement->execute();
        return true;
      }
    }

    public function getCantidad($id){
     $modelo = new Conexion();
     $conexion = $modelo->getConexion();
     $sql = "SELECT * FROM productos WHERE id_producto = :id";
     $statement = $conexion->prepare($sql);
     $statement->bindParam(':id',$id);
     $statement->execute();
     $resultado= $statement->fetch();
     return $resultado['cantidad'];
    }
  }




 ?>
