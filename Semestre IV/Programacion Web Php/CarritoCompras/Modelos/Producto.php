<?php
  /**
   * Metodos de la clase producto
   */
  class Producto{

    public function index(){
      $rows = NULL;
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM productos";
      $statement = $conexion->prepare($sql);
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

    public function store($nombre, $descripcion, $foto, $valor){
      $modelo = new Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "INSERT INTO productos(nombre,descripcion,foto,valor) VALUES(:nombre,:descripcion,:foto,:valor)";
  		$statement = $conexion->prepare($sql);
  		$statement->bindParam(':nombre',$nombre);
  		$statement->bindParam(':descripcion',$descripcion);
  		$statement->bindParam(':foto',$foto);
  		$statement->bindParam(':valor',$valor);

  		if(!$statement){
  			return "Error al crear el producto";
  		}else{
  			$statement->execute();
  			return "Producto creado correctamente";
  		}
    }

    public function show($id){
  		$modelo = new Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "SELECT * FROM productos WHERE id = :id";
  		$statement = $conexion->prepare($sql);
  		$statement->bindParam(':id',$id);
  		$statement->execute();
  		$resultado= $statement->fetchAll();
  		return $resultado;
  	}

    public function update($id, $nombre, $descripcion, $foto, $valor){
  		$modelo = NEW Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, foto = :foto, valor =:valor WHERE id=:id";
  		$statement = $conexion->prepare($sql);
  		$statement->bindParam(':nombre', $nombre);
  		$statement->bindParam(':descripcion', $descripcion);
  		$statement->bindParam(':valor', $valor);
  		$statement->bindParam(':foto', $foto);
  		$statement->bindParam(':id', $id);

  		if(!$statement){
  			return "Error al editar el producto";
  		}else{
  			$statement->execute();
  			return "Producto editado correctamente";
  		}
  	}

    public function delete($id){
  		$modelo = NEW Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "DELETE FROM productos WHERE id=:id";
  		$statement = $conexion->prepare($sql);
  		$statement->bindParam(':id', $id);

  		if(!$statement){
  			return "Error al eliminar el producto";
  		}else{
  			$statement->execute();
  			return "Producto eliminado correctamente";
  		}
  	}

    public function search($nombre){
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM productos WHERE nombre LIKE ?";
      $statement = $conexion->prepare($sql);
      $statement->bindValue(1,"%$nombre%" );
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

  }
 ?>
