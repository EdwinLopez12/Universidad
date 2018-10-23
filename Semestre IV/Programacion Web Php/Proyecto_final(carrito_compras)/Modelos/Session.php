<?php
/**
 * Clase donde se manejaran las sesiones de usuario, y uno u otro metodo extra
 */
class Session{

  public function control($email, $pass){
    $modelo = NEW Conexion();
    $conexion = $modelo->getConexion();
    $sql = "SELECT * FROM usuarios WHERE email = :ema";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':ema',$email);

    if(!$statement){
      return false;
    }else{
      $statement->execute();
      $resultado= $statement->fetch();
      if($resultado !== false){
        if(password_verify($pass,$resultado['password'])){
          session_start();
          $_SESSION["AUTENTICA"] = "SI";
          $_SESSION['id'] = $resultado['id_usuario'];
          $_SESSION['nombre'] = $resultado['nombre_usuario'];
          $_SESSION['rol'] = $resultado['rol'];
          $_SESSION['foto'] = $resultado['foto'];
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }
  }

  public function security(){
    @session_start();
    if($_SESSION["AUTENTICA"] != "SI"){
      return false;
    }else{
      return true;
    }
  }

  public function exit(){
    @session_start();
    session_destroy();
  }

}


?>
