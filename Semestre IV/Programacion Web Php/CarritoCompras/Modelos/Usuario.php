<?php

  class Usuario{

    public function index(){
      $rows = NULL;
      $contador = 0;
  		$modelo = new Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "SELECT * FROM usuarios";
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

    public function store($nombre,$email,$password, $foto){
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "INSERT INTO usuarios(nombre_usuario,email,password, foto) VALUES(:nombre,:email,:password, :foto)";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':nombre',$nombre);
      $statement->bindParam(':email',$email);
      $statement->bindParam(':password',$password);
      $statement->bindParam(':foto',$foto);


      if(!$statement){
        return "Error al crear el Usuario";
      }else{
        $statement->execute();
        return "Usuario creado correctamente";
      }
    }

    public function show($id){
  		$modelo = new Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "SELECT * FROM usuarios WHERE id = :id";
  		$statement = $conexion->prepare($sql);
  		$statement->bindParam(':id',$id);
  		$statement->execute();
  		$resultado= $statement->fetchAll();
  		return $resultado;
  	}

    public function update($id, $nombre,$email,$password, $foto){
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "UPDATE usuarios SET nombre_usuario = :nombre, email = :email, password = :password, foto = :foto
              WHERE id = :id";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':id',$id);
      $statement->bindParam(':nombre',$nombre);
      $statement->bindParam(':email',$email);
      $statement->bindParam(':password',$password);
      $statement->bindParam(':foto', $foto);

      if(!$statement){
        return "Error al actualizar el Usuario";
      }else{
        $statement->execute();
        return "Usuario modificado correctamente";
      }
    }

    public function delete($id){
      $modelo = new Conexion();
  		$conexion = $modelo->getConexion();
  		$sql = "DELETE FROM usuarios WHERE id=:id";
  		$statement = $conexion->prepare($sql);
  		$statement->bindParam(':id', $id);

  		if(!$statement){
  			return "Error al eliminar el Usuario";
  		}else{
  			$statement->execute();
  			return "Usuario eliminado correctamente";
  		}
    }

    public function search($nombre){
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM usuarios WHERE nombre_usuario LIKE ?";
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
