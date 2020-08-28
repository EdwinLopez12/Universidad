<?php
/**
 * Clase donde se manejaran las sesiones de usuario, y uno u otro metodo extra
 */
class Session{

  public function control($email, $pass){
    $modelo = NEW Conexion();
    $conexion = $modelo->getConexion();
    $sql = "SELECT * FROM usuarios WHERE email = :ema AND password = :passw";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':ema',$email);
    $statement->bindParam(':passw',$pass);

    if(!$statement){
      return "Error de conexion";
    }else{
      $statement->execute();
      $resultado= $statement->fetch();
      if($resultado !== false){
        session_start();
        $_SESSION["AUTENTICA"] = "SI";
        return true;
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
